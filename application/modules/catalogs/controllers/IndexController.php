<?php

class Catalogs_IndexController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $model_catalogs = new Catalogs();

        $ident = $request->getParam('catalog', 0);
        $catalog = $model_catalogs->findByIdent($ident);

        if (empty($catalog)) {
            $this->view->catalogs = $model_catalogs->selectRoots();
            if (!empty($this->auth)) {
                if (!isset($this->view->form)) {
                    $this->view->form = new Catalogs_Form_Catalog();
                }
            }
        } else {
            $this->view->catalog = $catalog;
            $this->view->catalogs = $catalog->findDependentRowset('Catalogs');
            $this->view->books = $catalog->findBooks_CollectionViaBooks_Catalogs();
            if (!empty($this->auth)) {
                $url = new Zend_Controller_Action_Helper_Url();

                $form = new Catalogs_Form_Catalog();
                $form->setAction($url->url(array('catalog' => $catalog->ident), 'catalogs_catalog_new'));

                if (!isset($this->view->form)) {
                    $this->view->form = $form;
                }
            }
        }
    }

    public function newAction() {
        $this->requireLogin();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new Catalogs_Form_Catalog();

            if ($form->isValid($request->getPost())) {
                $model_catalogs = new Catalogs();
                $url = new Zend_Controller_Action_Helper_Url();

                $catalog = $model_catalogs->createRow();
                $catalog->label = $form->getSubForm('information')->getElement('catalog')->getValue();
                $catalog->mode = $form->getSubForm('information')->getElement('mode')->getValue();
                $catalog->description = $form->getSubForm('information')->getElement('description')->getValue();
                $catalog->owner = $this->user->ident;
                $catalog->tsregister = time();

                // Parent comprobation
                $ident_parent = $request->getParam('catalog', 0);
                $parent = $model_catalogs->findByIdent($ident_parent);
                if ($parent <> null) {
                    $catalog->parent = $parent->ident;
                    if ($parent->root <> null) {
                        $catalog->root = $parent->root;
                    } else {
                        $catalog->root = $parent->ident;
                    }

                    // Owner comprobation
                    if ($catalog->mode == 'close' && $parent->owner <> $this->user->ident) {
                        $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('You can\'t create catalogs inside of %s'), $parent->label));
                        $this->_redirect($url->url(array('catalog' => $catalog->ident), 'catalogs_catalog_view'));
                    }
                }

                $catalog->save();
                $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('Catalog %s was created'), $catalog->label));

                if ($form->getSubForm('photo')->getElement('photo')->receive()) {
                    $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();

                    if (!empty($filename) && file_exists($filename)) {
                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/catalogs/' . $catalog->ident . '.jpg', 100, 100);
                        unlink($filename);

                        $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('The photo of catalog %s was updated successfully'), $catalog->label));
                    }
                }

                if ($parent <> null) {
                    $this->_redirect($url->url(array('catalog' => $parent->ident), 'catalogs_catalog_view'));
                } else {
                    $this->_helper->redirector('index', 'index', 'catalogs');
                }

            } else {
                $this->_helper->flashMessenger->addMessage($this->translate->_('You must define a catalog name'));
            }
        }

        $this->view->overlay = true;
        $this->view->action = 'new';
        $this->view->form = $form;

        $this->_useForward = true;
        $this->_forward('index', 'index', 'catalogs');
    }
}
