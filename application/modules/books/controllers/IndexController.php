<?php

class Books_IndexController extends Babel_Action
{
    public function sharedAction() {
        $this->requireLogin();

        $model_shared = new Books();
        $books = $model_shared->selectByStats();

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

    /*public function refreshAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();
        $collection = $model_collection->fetchAll();

        foreach ($collection as $file) {
            $file->md5_path = md5($file->getPath());
            $file->save();
        }

        $this->_helper->flashMessenger->addMessage('MD5 refreshed');
        $this->_helper->redirector('examine', 'index', 'books');
    }*/

    public function examineAction() {
        $this->requireLogin();
        $request = $this->getRequest();

        $index_bookstore = intval($request->getParam('bookstore'));
        $index_directory = intval($request->getParam('directory'));

        $bookstores = Zend_Registry::get('Config')->babel->properties->bookstores;
        $bookstores = $bookstores->toArray();

        if (!isset($bookstores[$index_bookstore])) {
            $index_bookstore = 0;
        }
        $bookstore = $bookstores[$index_bookstore];

        $directories = array();
        $scan = scandir($bookstore);
        foreach ($scan as $i => $file) {
            if ($file == "." || $file == ".." || !is_dir("$bookstore/$file")) {
                unset($scan[$i]);
            }
        }
        foreach ($scan as $file) {
            $directories[] = $file;
        }
        if (!isset($directories[$index_directory])) {
            $index_directory = 0;
        }
        $directory = $directories[$index_directory];

        $books = $this->_scan_files("$bookstore/$directory");

        /*$model_collection = new Books_Collection();
        $adapters = array();
        $scan = $this->_scan_bookstores($bookstores, &$adapters);
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
        $this->view->warnings_filenames = $scan[1];
        $this->view->warnings_md5_files = $scan[2];
         */

        $this->view->bookstores = $bookstores;
        $this->view->bookstore = $index_bookstore;
        $this->view->directories = $directories;
        $this->view->directory = $index_directory;
        $this->view->books = $books;
    }

    /*private function _scan_bookstores($bookstores, $adapters = null) {
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
    }*/

    private function _scan_files($directory) {
        $files = array();

        $subdirectories = @scandir($directory);
        if ($subdirectories) {
            foreach ($subdirectories as $file) {
                if (($file <> '.') && ($file <> '..')) {
                    if (is_dir($directory . '/' . $file)) {
                        $files = @array_merge($files, $this->_scan_files($directory . '/' . $file));
                    } else if (is_file($directory . '/' . $file)) {
                        if (substr(strtolower($file), -3) == 'pdf') {
                            $files[] = array(
                                'directory' => $directory,
                                'file' => $file,
                            );
                        }
                    }
                }
            }
        }

        return $files;
    }
}
