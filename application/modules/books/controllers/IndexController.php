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
            $this->requireAdmin();

            $hashes = $request->getParam('books');
            if ($request->getParam('unpublish')) {
                foreach ($hashes as $hash) {
                    $file = $model_collection->findByHash($hash);
                    if ($file <> null) {
                        $file->published = false;
                    }
                    $file->save();
                }
                $this->_helper->flashMessenger->addMessage($this->translate->_('Books unpublished successfully'));
                $this->_helper->redirector('published', 'index', 'books');
            }
        }

        $this->view->books = $books;
        $this->view->form = new Books_Form_Meta();
    }

    public function lostAction() {
        $this->requireAdmin();

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
                $this->_helper->flashMessenger->addMessage($this->translate->_('The files were removed'));
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
        $this->requireAdmin();
        $request = $this->getRequest();

        $index_bookstore = intval($request->getParam('bookstore'));
        $index_directory = intval($request->getParam('directory'));

        $bookstores = Zend_Registry::get('config')->babel->properties->bookstores;
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

        $adapters = array();
        $warnings = array();
        $metas = array();

        if (!empty($directories)) {
            $directory = $directories[$index_directory];
            $scanner = new Babel_Utils_DirectoryScanner();
            $books = $scanner->scan_collection("$bookstore/$directory", $adapters, $warnings, $metas);
        } else {
            $books = array();
        }

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
                $this->_helper->flashMessenger->addMessage($this->translate->_('Books added successfully'));
            }
            if ($request->getParam('delete')) {
                foreach ($hashes as $hash) {
                    $adapters[$hash]->delete();
                }
                $this->_helper->flashMessenger->addMessage($this->translate->_('Books removed successfully'));
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
                $this->_helper->flashMessenger->addMessage($this->translate->_('Books published successfully'));
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
                $this->_helper->flashMessenger->addMessage($this->translate->_('Books unpublished successfully'));
            }
            if ($request->getParam('thumb')) {
                foreach ($hashes as $hash) {
                    $file = $adapters[$hash];
                    if (!$file->hasThumb()) {
                        try {
                            $image = new Imagick($file->getPath() . '[0]');
                            
                            $image->setImageFormat('jpeg');
                            $image->setImageType (imagick::IMGTYPE_TRUECOLOR);
                            $image->thumbnailImage(0, 390);
                            $image->writeImage(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg');

                            $thumbnail = new Yachay_Helpers_Thumbnail();
                            $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg',
                                                  APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '-small.jpg', 0, 100);
                        } catch (Exception $e) {
                        }
                    }
                }
                $this->_helper->flashMessenger->addMessage($this->translate->_('Thumbnails were generated'));
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

    public function exportAction() {
        $this->requireLogin();

        $_bookstores = Zend_Registry::get('config')->babel->properties->bookstores;
        $bookstores = $_bookstores->toArray();

        $form = new Books_Form_Export();
        $form->setBookstores($bookstores);

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $i = intval($form->getElement('bookstores')->getValue());

                $model_metas = new Books_Meta();
                if ($i === -1) {
                    $books = $model_metas->fetchAll();
                } else if ($i >= 0) {
                    $books = $model_metas->fetchAll(
                        $model_metas->select()->where(
                            'book IN (
                                SELECT hash
                                FROM babel_books_collection
                                WHERE directory LIKE ?)', $bookstores[$i] . '%'
                        )
                    );
                }

                echo 'book,title,author,year,publisher,language' . PHP_EOL;
                foreach ($books as $book) {
                    echo '"'.$book->book.'","'.$book->title.'","'.$book->author.'","'.$book->year.'","'.$book->publisher.'","'.$book->language.'"' . PHP_EOL;
                }

                $this->getResponse()->setHeader('Content-Type', 'text/plain');
                $this->_helper->layout->disableLayout();
                $this->_helper->viewRenderer->setNoRender();
            }
        }

        $this->view->form = $form;
    }

    public function importAction() {
        $this->requireAdmin();

        $request = $this->getRequest();
        $form = new Books_Form_Import();

        if ($request->isPost()) {
            if ($form->getElement('file')->receive()) {
                $model_meta = new Books_Meta();
                $filename = $form->getElement('file')->getFileName();

                $csv = new File_CSV_DataSource;
                $csv->load($filename);
                $rows = $csv->connect();

                foreach ($rows as $row) {
                    $hash = $row['book'];

                    $book = $model_meta->findByHash($hash);
                    if (empty($book)) {
                        $book = $model_meta->createRow();
                        $book->book = $hash;
                    }

                    if (empty($book->title)) { $book->title = $row['title']; }
                    if (empty($book->author)) { $book->author = $row['author']; }
                    if (empty($book->year)) { $book->year = $row['year']; }
                    if (empty($book->publisher)) { $book->publisher = $row['publisher']; }
                    if (empty($book->language)) { $book->language = $row['language']; }

                    $book->save();
                }

                unlink($filename);
                $this->_helper->flashMessenger->addMessage($this->translate->_('Meta-information uploaded successfully'));
                $this->_helper->redirector('index', 'index', 'frontpage');
            }
        }

        $this->view->form = $form;
    }
}
