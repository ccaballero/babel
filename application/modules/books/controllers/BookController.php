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
            
            // Taxonomies Management
            $root_catalogs_1 = $model_catalogs->selectRootsByType('t');
            
            $root_catalogs_2 = array();
            foreach ($root_catalogs_1 as $root_catalog) {
                if ($root_catalog->mode == 'open' || $root_catalog->owner == $this->user->ident) {
                    $root_catalogs_2[] = $root_catalog;
                }
            }

            $available_catalogs = array();
            foreach ($root_catalogs_2 as $root_catalog) {
                foreach ($model_catalogs->selectElementsByRoot($root_catalog->ident) as $catalog) {
                    if ($catalog->mode == 'open' || $catalog->owner == $this->user->ident) {
                        $available_catalogs[$root_catalog->ident][] = $catalog;
                    }
                }
            }

            $current_catalogs_1 = $file->findCatalogsViaBooks_Catalogs();
            $current_catalogs_2 = array();
            foreach ($current_catalogs_1 as $current_catalog) {
                $current_catalogs_2[$current_catalog->root] = $current_catalog->ident;
            }

            // Folksonomies Management
            $root_catalogs_3 = $model_catalogs->selectRootsByType('f');
            $root_catalogs_4 = array();
            foreach ($root_catalogs_3 as $root_catalog) {
                if ($root_catalog->mode == 'open' || $root_catalog->owner == $this->user->ident) {
                    $root_catalogs_4[] = $root_catalog;
                }
            }

            if ($request->isPost()) {
                // Taxonomies Management
                $catalogs = $request->getParam('catalogs');

                foreach ($root_catalogs_2 as $root_catalog) {
                    if (array_key_exists($root_catalog->ident, $catalogs)) {
                        $new_assign = empty($catalogs[$root_catalog->ident]) ? 0 : $catalogs[$root_catalog->ident];
                        $old_assign = empty($current_catalogs_2[$root_catalog->ident]) ? 0 : $current_catalogs_2[$root_catalog->ident];

                        if ($new_assign <> $old_assign) {
                            if (empty($new_assign)) {
                                // remove book from catalog
                                $model_books_catalogs->deleteBookAndCatalog($file->hash, $old_assign);
                                $model_stats->decreaseBook($old_assign);
                            } else if (empty($old_assign)) {
                                // add book to catalog
                                $book_catalog = $model_books_catalogs->createRow();
                                $book_catalog->book = $file->hash;
                                $book_catalog->catalog = $new_assign;
                                $book_catalog->save();
                                $model_stats->increaseBook($new_assign);
                            } else {
                                foreach ($available_catalogs[$root_catalog->ident] as $catalog) {
                                    if ($old_assign == $catalog->ident) {
                                        // remove book from catalog
                                        $model_books_catalogs->deleteBookAndCatalog($file->hash, $catalog->ident);
                                        $model_stats->decreaseBook($catalog->ident);
                                    }
                                }
                                foreach ($available_catalogs[$root_catalog->ident] as $catalog) {
                                    if ($new_assign == $catalog->ident) {
                                        // add book to catalog
                                        $book_catalog = $model_books_catalogs->createRow();
                                        $book_catalog->book = $file->hash;
                                        $book_catalog->catalog = $catalog->ident;
                                        $book_catalog->save();
                                        $model_stats->increaseBook($catalog->ident);
                                    }
                                }
                            }
                        }
                    }
                }

                $this->_helper->flashMessenger->addMessage($this->translate->_('Catalogs were updated'));

                $url = new Zend_Controller_Action_Helper_Url();
                $this->_redirect($url->url(array('book' => $book->book), 'books_book_catalog'));
            }

            $this->view->book = $book;
            $this->view->file = $file;
            $this->view->taxonomies = $root_catalogs_2;
            $this->view->availables = $available_catalogs;
            $this->view->assigned = $current_catalogs_2;
            $this->view->folksonomies = $root_catalogs_4;
        } else {
            $this->_helper->flashMessenger->addMessage($this->translate->_('Book not found'));
            $this->_helper->redirector('index', 'index', 'frontpage');
        }
    }

    public function folksonomyAction() {
        $request = $this->getRequest();
        $hash = $request->getParam('book');
        $ident_catalog = $request->getParam('catalog');

        $model_collection = new Books_Collection();
        $model_metas = new Books_Meta();
        $model_books_catalogs = new Books_Catalogs();
        $model_catalogs = new Catalogs();
        $model_stats = new Catalogs_Stats();

        $file = $model_collection->findByHash($hash);
        $book = $model_metas->findByHash($hash);
        $root_catalog = $model_catalogs->findByIdent($ident_catalog);
        
        if (!empty($file) && !empty($root_catalog)) {
            $catalogs_1 = $model_catalogs->selectElementsByRoot($root_catalog->ident);
            $catalogs_2 = array();
            foreach ($catalogs_1 as $catalog_1) {
                if ($catalog_1->mode == 'open' || $catalog_1->owner == $this->user->ident) {
                    $catalogs_2[] = $catalog_1;
                }
            }

            $books_catalog_1 = $model_books_catalogs->selectByBook($file->hash);
            $books_catalog_2 = array();
            foreach ($books_catalog_1 as $book_catalog) {
                $books_catalog_2[] = $book_catalog->catalog;
            }
            
            if ($request->isPost()) {
                $catalogs = $request->getParam('catalogs');

                foreach ($catalogs_2 as $catalog) {
                    $new_assign = array_key_exists($catalog->ident, $catalogs) ? true : false;
                    $old_assign = in_array($catalog->ident, $books_catalog_2) ? true : false;
                    
                    if ($new_assign <> $old_assign) {
                        if ($new_assign) {
                            // add book to catalog
                            $book_catalog = $model_books_catalogs->createRow();
                            $book_catalog->book = $file->hash;
                            $book_catalog->catalog = $catalog->ident;
                            $book_catalog->save();
                            $model_stats->increaseBook($catalog->ident);
                        }
                        if ($old_assign) {
                            // remove book from catalog
                            $model_books_catalogs->deleteBookAndCatalog($file->hash, $catalog->ident);
                            $model_stats->decreaseBook($catalog->ident);
                        }
                    }
                }

                $this->_helper->flashMessenger->addMessage($this->translate->_('Catalogs were updated'));

                $url = new Zend_Controller_Action_Helper_Url();
                $this->_redirect($url->url(array('book' => $book->book, 'catalog' => $root_catalog->ident), 'books_book_folksonomy'));
            }

            $this->view->book = $book;
            $this->view->file = $file;
            $this->view->catalog = $root_catalog;
            $this->view->catalogs = $catalogs_2;
            $this->view->book_catalogs = $books_catalog_2;
        } else {
            $this->_helper->redirector('index', 'index', 'frontpage');
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
                header('Content-Disposition: attachment; filename=' . $file->file . ';');
                header('Content-Transfer-Encoding: binary');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: '. $file->size);
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
                                              APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $book->book . '-small.jpg', 0, 100);
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
