<?php

class Books_BookController extends Babel_Action
{
    public function infoAction() {
        $request = $this->getRequest();
        $hash = $request->getParam('book');

        $model_collection = new Books_Collection();
        $file = $model_collection->findByHash($hash);

        $class = new StdClass();
        if (!empty($file)) {
            if ($this->auth <> null) {
                $class->directory = $file->directory;
                $class->file = $file->file;
                $class->size = $file->size;
                $class->hash = $file->hash;
            }

            $model_metas = new Books_Meta();
            $book = $model_metas->findByHash($file->hash);

            $url = new Zend_Controller_Action_Helper_Url();
            $language = new Babel_Helpers_Language();

            if (!empty($book)) {
                $class->title = $book->title;
                $class->author = $book->author;
                $class->publisher = $book->publisher;
                $class->language = $book->language;
                $class->year = $book->year;
            } else {
                $class->title = '';
                $class->author = '';
                $class->publisher = '';
                $class->language = $language->language('');
                $class->year = '';
            }

            $class->url = new stdClass();
            $class->url->catalog = $url->url(array('book' => $book->book), 'books_book_catalog');
            $class->url->download = $url->url(array('book' => $book->book), 'books_book_download');
            $class->url->thumb = $this->view->baseUrl($file->getUrlPhoto());
        }

        $this->_helper->json(array('book' => $class));
    }

    public function catalogAction() {
        $request = $this->getRequest();
        $hash = $request->getParam('book');

        $model_collection = new Books_Collection();
        $model_metas = new Books_Meta();
        $model_books_catalogs = new Books_Catalogs();
        $model_catalogs = new Catalogs();
        $model_stats = new Catalogs_Stats();

        $file = $model_collection->findByHash($hash);
        $book = $model_metas->findByHash($hash);
        if (!empty($file)) {
            $db_catalogs = $file->findCatalogsViaBooks_Catalogs();
            $catalogs_list = array();
            $current_catalogs = array();

            foreach ($db_catalogs as $db_catalog) {
                $catalogs_list[] = $db_catalog->ident;
                $current_catalogs[$db_catalog->ident] = $db_catalog;
            }

            if ($request->isPost()) {
                $new_catalogs = $request->getParam('catalogs');

                foreach ($new_catalogs as $key1 => $new_catalog) {
                    $new_catalog = intval($new_catalog);
                    foreach ($catalogs_list as $key2 => $old_catalog) {
                        if ($new_catalog == $old_catalog) {
                            unset($new_catalogs[$key1]);
                            unset($catalogs_list[$key2]);
                        }
                    }
                }

                foreach ($new_catalogs as $new_catalog) {
                    $catalog = $model_catalogs->findByIdent($new_catalog);
                    if (!empty($catalog)) {
                        $book_catalog = $model_books_catalogs->createRow();
                        $book_catalog->book = $file->hash;
                        $book_catalog->catalog = $catalog->ident;
                        $book_catalog->save();

                        $model_stats->increaseBook($catalog);
                    }
                }

                foreach ($catalogs_list as $old_catalog) {
                    $catalog = $current_catalogs[$old_catalog];
                    if (!empty($catalog)) {
                        $model_books_catalogs->deleteBookAndCatalog($file->hash, $catalog->ident);

                        $model_stats->decreaseBook($catalog);
                    }
                }

                $this->_helper->flashMessenger->addMessage($this->translate->_('Catalogs were updated'));

                $url = new Zend_Controller_Action_Helper_Url();
                $this->_redirect($url->url(array('book' => $book->book), 'books_book_catalog'));
            }

            $this->view->book = $book;
            $this->view->file = $file;
            $this->view->roots = $model_catalogs->selectRoots();
            $this->view->catalogs = $catalogs_list;
        }
    }

    public function downloadAction() {
        $request = $this->getRequest();
        $hash = $request->getParam('book');

        $model_collection = new Books_Collection();
        $file = $model_collection->findByHash($hash);

        if (!empty($file)) {
            $stats = $file->getStats();
            $stats->downloads = $stats->downloads + 1;
            $stats->save();

            try {
                header("HTTP/1.1 200 OK");
                header("Status: 200 OK");
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . $file->file . '";');
                header('Content-Length: '. $file->size . '; ');
                ob_clean();
                flush();
                readfile($file->getPath());
            } catch (Exception $e) {}
        }

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function thumbAction() {
        $request = $this->getRequest();
        $hash = $request->getParam('book');

        $page = $request->getParam('page', 1);
        $page = intval($page);
        $page = $page <= 0 ? 1 : $page;

        $model_collection = new Books_Collection();
        $book = $model_collection->findByHash($hash);

        if (!empty($book)) {
            try {
                $this->getResponse()->setHeader('Content-Type', 'image/png');

                $image = new Imagick($book->getPath() . '[0]');
                $image->setImageFormat('png');
                $image->thumbnailImage(0, 390);
                echo $image;
            } catch (Exception $e) {}
        }

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function fileAction() {
        $this->requireLogin();

        $form = new Books_Form_Collection();

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_collection = new Books_Collection();

                $hash = $request->getParam('book');
                $file = $model_collection->findByHash($hash);

                $file->directory = $request->getParam('directory');
                $file->file = $request->getParam('file');

                if ($file->inDisk()) {
                    $config = Zend_Registry::get('Config');

                    $file->size = filesize($file->getPath());
                    $file->hash = @hash_file($config->babel->properties->algo, $file->getPath());
                    $file->save();
                    $this->_helper->flashMessenger->addMessage($this->translate->_('File was edited successfully'));
                } else {
                    $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('The file can not be found in: %s'), $file->getPath()));
                }
            }
            $this->_helper->redirector('lost', 'index', 'books');
        }
    }

    public function editAction() {
        $this->requireLogin();

        $form = new Books_Form_Meta();

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_collection = new Books_Collection();
                $model_metas = new Books_Meta();

                $hash = $request->getParam('book');
                $file = $model_collection->findByHash($hash);

                $book = $model_metas->findByHash($hash);
                if (empty($book)) {
                    $book = $model_metas->createRow();
                    $book->book = $hash;
                }
                $book->title = $request->getParam('title');
                $book->author = $request->getParam('author');
                $book->publisher = $request->getParam('publisher');
                $book->language = $request->getParam('language');
                $book->year = $request->getParam('year');

                $book->save();
                $file->save();

                $this->_helper->flashMessenger->addMessage($this->translate->_('The book was edited successfully'));

                if (!$file->hasThumb()) {
                    try {
                        $image = new Imagick($file->getPath() . '[0]');
                        $image->setImageFormat('jpg');
                        $image->thumbnailImage(0, 390);
                        $image->writeImage(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $book->book . '.jpg');

                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $book->book . '.jpg',
                                              APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $book->book . '.small.jpg', 0, 100);
                        $this->_helper->flashMessenger->addMessage($this->translate->_('The thumb was generated successfully'));
                    } catch (Exception $e) {
                        $this->_helper->flashMessenger->addMessage($this->translate->_('The thumb wasn\'t generated'));
                    }
                }
            }
            $this->_redirect($request->getParam('return'));
        }
    }
}
