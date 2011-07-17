<?php

class Books_BookController extends Babel_Action
{
    public function infoAction() {
        $request = $this->getRequest();
        $ident = $request->getParam('book');

        $model_collection = new Books_Collection();
        $book = $model_collection->findByIdent($ident);

        $class = new StdClass();
        if (!empty($book)) {
            if ($this->auth <> null) {
                $class->bookstore = $book->bookstore;
                $class->directory = $book->directory;
                $class->file = $book->file;
                $class->size = $book->size;
                $class->md5 = $book->md5_file;
            }

            $model_shared = new Books();
            $book = $model_shared->findByBook($book->ident);

            $url = new Zend_Controller_Action_Helper_Url();

            if (!empty($book)) {
                $class->title = $book->title;
                $class->author = $book->author;
                $class->publisher = $book->publisher;
                $class->language = $book->language;

                $class->url->catalog = $url->url(array('book' => $book->book), 'books_book_catalog');
                $class->url->download = $url->url(array('book' => $book->book), 'books_book_download');
            }
        }

        header("HTTP/1.1 200 OK");
        header("Status: 200 OK");
        header('Content-Type: application/json');
        echo json_encode(array('book' => $class));
        die;
    }

    public function catalogAction() {
        $request = $this->getRequest();
        $ident = $request->getParam('book');

        $model_shared = new Books();
        $model_books_catalogs = new Books_Catalogs();
        $model_catalogs = new Catalogs();

        $book = $model_shared->findByBook($ident);
        if (!empty($book)) {
            if ($request->isPost()) {
                $catalogs = $request->getParam('catalogs');

                $model_books_catalogs->cleanCatalogs($book->book);
                foreach ($catalogs as $catalog) {
                    $catalog = $model_catalogs->findByIdent($catalog);
                    if (!empty($catalog)) {
                        $book_catalog = $model_books_catalogs->createRow();
                        $book_catalog->book = $book->book;
                        $book_catalog->catalog = $catalog->ident;
                        $book_catalog->save();
                    }
                }
                $this->_helper->flashMessenger->addMessage('The catalogs were updated');

                $url = new Zend_Controller_Action_Helper_Url();
                $this->_redirect($url->url(array('book' => $book->book), 'books_book_catalog'));
            }

            $ob_catalogs = $book->findCatalogsViaBooks_Catalogs();
            $catalogs = array();
            foreach ($ob_catalogs as $ob_catalog) {
                $catalogs[] = $ob_catalog->ident;
            }

            $this->view->book = $book;
            $this->view->roots = $model_catalogs->selectRoots();
            $this->view->catalogs = $catalogs;
        }
    }

    public function downloadAction() {
        $request = $this->getRequest();
        $ident = $request->getParam('book');

        $model_shared = new Books();
        $book = $model_shared->findByBook($ident);

        if (!empty($book)) {
            $stats = $book->getStats();
            $stats->downloads = $stats->downloads + 1;
            $stats->save();

            try {
                header("HTTP/1.1 200 OK");
                header("Status: 200 OK");
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . $book->getFilename() . '";');
                header('Content-Length: '. $book->getSize() . '; ');
                ob_clean();
                flush();
                readfile($book->getPath());
            } catch (Exception $e) {}
        }

        die;
    }

    public function thumbAction() {
        $request = $this->getRequest();
        $ident = $request->getParam('book');

        $page = $request->getParam('page', 1);
        $page = intval($page);
        $page = $page <= 0 ? 1 : $page;

        $model_collection = new Books_Collection();
        $book = $model_collection->findByIdent($ident);

        if (!empty($book)) {
            try {
                $image = new Imagick($book->getPath() . '[0]');
                $image->setImageFormat('png');
                $image->thumbnailImage(400, 0);
                header('Content-Type: image/png');
                echo $image;
            } catch (Exception $e) {}
        }

        die;
    }

    public function fileAction() {
        $this->requireLogin();

        $form = new Books_Form_Collection();

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_collection = new Books_Collection();

                $ident = $request->getParam('book');
                $book = $model_collection->findByIdent($ident);

                $bookstores = array();
                foreach(Zend_Registry::get('Config')->babel->properties->bookstores as $bookstore) {
                    $bookstores[] = $bookstore;
                }

                $book->bookstore = $bookstores[$request->getParam('bookstore')];
                $book->directory = $request->getParam('directory');
                $book->file = $request->getParam('file');

                if ($book->inDisk()) {
                    $book->size = filesize($book->getPath());
                    $book->md5_file = @md5_file($book->getPath());
                    $book->md5_path = @md5($book->getPath());

                    $book->save();
                    $this->_helper->flashMessenger->addMessage('The book was edited successfully');
                } else {
                    $this->_helper->flashMessenger->addMessage('The file can not be found in {' . $book->getPath() . '}');
                }
            }
            $this->_helper->redirector('index', 'index', 'books');
        }
    }

    public function bookAction() {
        $this->requireLogin();

        $form = new Books_Form_Shared();

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_books = new Books();

                $ident = $request->getParam('book');
                $book = $model_books->findByBook($ident);

                $book->title = $request->getParam('title');
                $book->author = $request->getParam('author');
                $book->publisher = $request->getParam('publisher');
                $book->language = $request->getParam('language');

                // Avatar
                try {
                    $image = new Imagick($book->getPath() . '[0]');
                    $image->setImageFormat('png');
                    $image->thumbnailImage(400, 0);
                    $image->writeImage(APPLICATION_PATH . '/../public/media/img/books/' . $book->book . '.png');

                    $thumbnail = new Yachay_Helpers_Thumbnail();
                    $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/books/' . $book->book . '.png',
                                          APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $book->book . '.jpg', 100, 100);
                    $book->avatar = true;
                    $this->_helper->flashMessenger->addMessage('The thumb was generated successfully');
                } catch (Exception $e) {}

                $book->save();
                $this->_helper->flashMessenger->addMessage('The book was edited successfully');
            }
            $this->_helper->redirector('shared', 'index', 'books');
        }
    }
}