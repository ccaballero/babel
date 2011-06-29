<?php

class Books_IndexController extends Babel_Action
{
    public function sharedAction() {
        $this->requireLogin();

        $model_shared = new Books();
        $books = $model_shared->fetchAll();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ident_books = $request->getParam('books');
            if ($request->getParam('delete')) {
                foreach ($ident_books as $ident) {
                    $book = $model_shared->findByBook($ident);
                    $book->delete();
                }
                $this->_helper->flashMessenger->addMessage('Books removed successfully');
                $this->_helper->redirector('shared', 'index', 'books');
            }
        }

        $this->view->books = $books;
        $this->view->form = new Books_Form_Shared();
    }

    public function indexAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();
        $model_shared = new Books();

        $books = array();

        $bookstores = Zend_Registry::get('Config')->babel->properties->bookstores;
        foreach($bookstores as $bookstore) {
            $books[$bookstore] = $model_collection->selectByBookstore($bookstore);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ident_books = $request->getParam('books');
            if ($request->getParam('add')) {
                foreach ($ident_books as $ident) {
                    $book = $model_shared->findByBook($ident);
                    if ($book == null) {
                        $book = $model_shared->createRow();
                        $book->book = $ident;
                        $book->save();
                    }
                }
                $this->_helper->flashMessenger->addMessage('Books shared successfully');
                $this->_helper->redirector('shared', 'index', 'books');
            }
            if ($request->getParam('delete')) {
                foreach ($ident_books as $ident) {
                    $book = $model_collection->findByIdent($ident);
                    $book->delete();
                }
                $this->_helper->flashMessenger->addMessage('Books removed successfully');
                $this->_helper->redirector('index', 'index', 'books');
            }
        }

        $this->view->books = $books;
        $this->view->form = new Books_Form_Collection();
    }

    public function examineAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();

        $bookstores = Zend_Registry::get('Config')->babel->properties->bookstores;

        $adapters = array();
        $scan = $this->_scan_bookstores($bookstores, &$adapters);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $md5_paths = $request->getParam('books');
            if ($request->getParam('add')) {
                foreach ($md5_paths as $md5) {
                    $adapters[$md5]->tsregister = time();
                    $adapters[$md5]->save();
                }
                $this->_helper->flashMessenger->addMessage('Books added successfully');
            }
            if ($request->getParam('delete')) {
                foreach ($md5_paths as $md5) {
                    $adapters[$md5]->delete();
                }
                $this->_helper->flashMessenger->addMessage('Books removed successfully');
            }

            $this->_helper->redirector('index', 'index', 'books');
        }

        $this->view->books = $scan[0];
        $this->view->warnings_filenames = $scan[1];
        $this->view->warnings_md5_files = $scan[2];
    }

    private function _scan_bookstores($bookstores, $adapters = null) {
        $model_collection = new Books_Collection();
        $books = array();

        $warning_filenames = array();
        $warning_md5_files = array();

        foreach($bookstores as $bookstore) {
            $files = $this->_scan_files($bookstore);

            foreach ($files as $file) {
                $book = $model_collection->findByMD5($file['md5']);
                if ($book == null) {
                    $book = $model_collection->createRow();
                    $book->size = filesize($file['directory'] . '/' . $file['file']);
                    $book->bookstore = $bookstore;
                    $book->directory = substr($file['directory'], strlen($bookstore) + 1);
                    $book->file = $file['file'];
                    $book->md5_file = @md5_file($file['directory'] . '/' . $file['file']);
                    $book->md5_path = @md5($file['directory'] . '/' . $file['file']);
                }

                if (isset($warning_filenames[$book->file])) {
                    $warning_filenames[$book->file] = false;
                } else {
                    $warning_filenames[$book->file] = true;
                }

                if (isset($warning_md5_files[$book->md5_file])) {
                    $warning_md5_files[$book->md5_file] = false;
                } else {
                    $warning_md5_files[$book->md5_file] = true;
                }

                if (isset($adapters)) {
                    $adapters[$book->md5_path] = $book;
                }

                $books[$bookstore][] = $book;
            }
        }

        return array($books, $warning_filenames, $warning_md5_files);
    }

    private function _scan_files($directory) {
        $files = array();

        $subdirectories = @scandir($directory);
        foreach ($subdirectories as $file) {
            if (($file <> '.') && ($file <> '..')) {
                if (is_dir($directory . '/' . $file)) {
                    $files = @array_merge($files, $this->_scan_files($directory . '/' . $file));
                } else if (is_file($directory . '/' . $file)) {
                    if (substr(strtolower($file), -3) == 'pdf') {
                        $files[] = array(
                            'md5' => md5($directory . '/' . $file),
                            'directory' => $directory,
                            'file' => $file,
                        );
                    }
                }
            }
        }

        return $files;
    }
}
