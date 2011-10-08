<?php

class Books_IndexController extends Babel_Action
{
    public function publishedAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();
        $books = $model_collection->selectWithMetas();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hashes = $request->getParam('books');
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    $book = $model_collection->findByHash($hash);
                    if ($book <> null) {
                        $book->published = false;
                    }
                    $book->save();
                }
                $this->_helper->flashMessenger->addMessage('Books unpublished successfully');
                $this->_helper->redirector('published', 'index', 'books');
            }
        }

        $this->view->books = $books;
        $this->view->form = new Books_Form_Meta();
    }

    public function indexAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();
        $books = $model_collection->fetchAll($model_collection->select()->order('CONCAT(directory,\'/\',file) ASC'));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hashes = $request->getParam('books');
            if ($request->getParam('publish')) {
                foreach ($hashes as $hash) {
                    $book = $model_collection->findByHash($hash);
                    if ($book <> null) {
                        $book->published = true;
                    }
                    $book->save();
                }
                $this->_helper->flashMessenger->addMessage('Books published successfully');
                $this->_helper->redirector('index', 'index', 'books');
            }
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    $book = $model_collection->findByHash($hash);
                    if ($book <> null) {
                        $book->published = false;
                    }
                    $book->save();
                }
                $this->_helper->flashMessenger->addMessage('Books unpublished successfully');
                $this->_helper->redirector('index', 'index', 'books');
            }
            if ($request->getParam('delete')) {
                foreach ($hashes as $hash) {
                    $book = $model_collection->findByHash($hash);
                    if ($book <> null) {
                        $book->delete();
                    }
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

        $adapters = array();
        $warnings = array();
        $books = $this->_scan_collection("$bookstore/$directory", &$adapters, &$warnings);

        if ($request->isPost()) {
            $hashes = $request->getParam('books');
            if ($request->getParam('add')) {
                foreach ($hashes as $hash) {
                    $adapters[$hash]->tsregister = time();
                    $adapters[$hash]->save();
                }
                $this->_helper->flashMessenger->addMessage('Books added successfully');
            }
            if ($request->getParam('delete')) {
                foreach ($hashes as $hash) {
                    $adapters[$hash]->delete();
                }
                $this->_helper->flashMessenger->addMessage('Books removed successfully');
            }
            if ($request->getParam('publish')) {
                foreach ($hashes as $hash) {
                    $adapters[$hash]->published = true;
                    $adapters[$hash]->save();
                }
                $this->_helper->flashMessenger->addMessage('Books published successfully');
            }
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    $adapters[$hash]->published = false;
                    $adapters[$hash]->save();
                }
                $this->_helper->flashMessenger->addMessage('Books unpublished successfully');
            }

            $this->_redirect($this->url);
        }

        $this->view->bookstores = $bookstores;
        $this->view->bookstore = $index_bookstore;
        $this->view->directories = $directories;
        $this->view->directory = $index_directory;
        $this->view->books = $books;
        $this->view->warnings = $warnings;
    }

    private function _scan_collection($bookstore, $adapters = null, $warnings = null) {
        $model_collection = new Books_Collection();
        $scan = array();

        $dict_books = array();
        $books = $model_collection->selectByDirectory($bookstore);
        foreach ($books as $book) {
            $dict_books[$book->hash] = $book;
        }

        $files = $this->_scan_files($bookstore);
        foreach ($files as $file) {
            if (isset($dict_books[$file['hash']])) {
                $book = $dict_books[$file['hash']];
                if ($book->getPath() <> "{$file['directory']}/{$file['file']}") {
                    $book = $model_collection->createRow($file);
                    $warnings[$book->getPath()] = $dict_books[$file['hash']]->getPath();
                }
            } else {
                $book = $model_collection->createRow($file);
            }

            $scan[] = $book;

            if (isset($adapters)) {
                $adapters[$book->hash] = $book;
            }
        }

        return $scan;
    }

    private function _scan_files($directory) {
        $files = array();

        $subdirectories = @scandir($directory);
        if ($subdirectories) {
            foreach ($subdirectories as $file) {
                if (($file <> '.') && ($file <> '..')) {
                    $path = "$directory/$file";
                    if (is_dir($path)) {
                        $files = @array_merge($files, $this->_scan_files($path));
                    } else if (is_file($path)) {
                        if (substr(strtolower($file), -3) == 'pdf') {
                            $files[] = array(
                                'directory' => $directory,
                                'file' => $file,
                                'size' => filesize($path),
                                'hash' => md5_file($path),
                            );
                        }
                    }
                }
            }
        }

        return $files;
    }
}
