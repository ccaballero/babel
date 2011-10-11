<?php

class Books_IndexController extends Babel_Action
{
    public function indexAction() {
        $this->_helper->redirector('examine', 'index', 'books');
    }

    public function publishedAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();
        $books = $model_collection->selectWithMetas();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hashes = $request->getParam('books');
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    $file = $model_collection->findByHash($hash);
                    if ($file <> null) {
                        $file->published = false;
                    }
                    $file->save();
                }
                $this->_helper->flashMessenger->addMessage('Books unpublished successfully');
                $this->_helper->redirector('published', 'index', 'books');
            }
        }

        $this->view->books = $books;
        $this->view->form = new Books_Form_Meta();
    }

    public function lostAction() {
        $this->requireLogin();

        $model_collection = new Books_Collection();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hashes = $request->getParam('books');
            if ($request->getParam('delete')) {
                foreach ($hashes as $hash) {
                    $file = $model_collection->findByHash($hash);
                    if ($file <> null) {
                        $file->delete();
                    }
                }
                $this->_helper->flashMessenger->addMessage('The files were removed');
                $this->_helper->redirector('lost', 'index', 'books');
            }
        }

        $files = $model_collection->fetchAll($model_collection->select()->order('CONCAT(directory,\'/\',file) ASC'));
        $books = array();
        foreach ($files as $file) {
            if (!$file->inDisk()) {
                $books[] = $file;
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
        $metas = array();
        $books = $this->_scan_collection("$bookstore/$directory", &$adapters, &$warnings, &$metas);

        if ($request->isPost()) {
            $model_meta = new Books_Meta();

            $hashes = $request->getParam('books');
            if ($request->getParam('add')) {
                foreach ($hashes as $hash) {
                    if (empty($adapters[$hash]->tsregister)) {
                        $adapters[$hash]->tsregister = time();
                    }
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
                    if (empty($adapters[$hash]->tsregister)) {
                        $adapters[$hash]->tsregister = time();
                    }
                    $adapters[$hash]->published = true;
                    $adapters[$hash]->save();

                    $meta = $model_meta->findByHash($hash);
                    if (empty($meta)) {
                        $meta = $model_meta->createRow();
                        $meta->book = $hash;
                        $meta->save();
                    }
                }
                $this->_helper->flashMessenger->addMessage('Books published successfully');
            }
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    if (empty($adapters[$hash]->tsregister)) {
                        $adapters[$hash]->tsregister = time();
                    }
                    $adapters[$hash]->published = false;
                    $adapters[$hash]->save();

                    $meta = $model_meta->findByHash($hash);
                    if (empty($meta)) {
                        $meta = $model_meta->createRow();
                        $meta->book = $hash;
                        $meta->save();
                    }
                }
                $this->_helper->flashMessenger->addMessage('Books unpublished successfully');
            }
            if ($request->getParam('thumb')) {
                foreach ($hashes as $hash) {
                    $file = $adapters[$hash];
                    if (!$file->hasThumb()) {
                        try {
                            $image = new Imagick($file->getPath() . '[0]');
                            $image->setImageFormat('jpg');
                            $image->thumbnailImage(0, 390);
                            $image->writeImage(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg');

                            $thumbnail = new Yachay_Helpers_Thumbnail();
                            $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg',
                                                  APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.small.jpg', 0, 100);
                        } catch (Exception $e) {
                        }
                    }
                }
                $this->_helper->flashMessenger->addMessage('Thumbnails were generated');
            }

            $this->_redirect($this->url);
        }

        $this->view->bookstores = $bookstores;
        $this->view->bookstore = $index_bookstore;
        $this->view->directories = $directories;
        $this->view->directory = $index_directory;
        $this->view->books = $books;
        $this->view->metas = $metas;
        $this->view->warnings = $warnings;
        $this->view->form = new Books_Form_Meta();
    }

    private function _scan_collection($bookstore, $adapters = null, $warnings = null, $metas = null) {
        $model_collection = new Books_Collection();

        $scan = array();
        $dict_books = array();
        $hashes = array();

        //$books = $model_collection->selectByDirectory($bookstore);
        $books = $model_collection->fetchAll();
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
            $hashes[] = $file['hash'];

            if (isset($adapters)) {
                $adapters[$book->hash] = $book;
            }
        }

        if (isset($metas) && count($hashes) <> 0) {
            $model_metas = new Books_Meta();
            $_metas = $model_metas->fetchAll($model_metas->select()->where('book IN (?)', $hashes));
            foreach ($_metas as $meta) {
                $metas[$meta->book] = $meta;
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
