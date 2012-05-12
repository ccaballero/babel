<?php

class Catalogs_IndexController extends Babel_Action
{
    public function indexAction() {
        $model_catalogs = new Catalogs();

        $this->view->catalogs = $model_catalogs->selectRoots();

        if ($this->auth <> null) {
            $this->view->form = new Catalogs_Form_Create();
        }
    }

    public function newAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form = new Catalogs_Form_Create();
            if ($form->isValid($request->getPost())) {
                $model_catalogs = new Catalogs();
                $catalog = $model_catalogs->createRow();

                $catalog->label = $form->getSubForm('information')->getElement('label')->getValue();
                //$catalog->code = $form->getSubForm('information')->getElement('code')->getValue();
                $catalog->mode = $form->getSubForm('information')->getElement('mode')->getValue();
                $catalog->description = $form->getSubForm('information')->getElement('description')->getValue();
                $catalog->owner = $this->user->ident;
                $catalog->tsregister = time();

                // Parent comprobation
                $id_parent = $request->getParam('catalog', 0);
                $parent = $model_catalogs->findByIdent($id_parent);
                if ($parent <> NULL) {
                    $catalog->parent = $parent->ident;
                    if ($parent->root <> NULL) {
                        $catalog->root = $parent->root;
                    } else {
                        $catalog->root = $parent->ident;
                    }
                }

                $catalog->save();
                $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('Catalog %s was created'), $catalog->label));

                if ($form->getSubForm('photo')->getElement('photo')->receive()) {
                    $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();

                    if (!empty($filename) && file_exists($filename)) {
                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/catalogs/' . $catalog->ident . '.jpg', 0, 100);
                        unlink($filename);
                    }

                    $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('The photo of catalog %s was updated successfully'), $catalog->label));
                }

                if ($id_parent == 0) {
                    $this->_helper->redirector('index', 'index', 'catalogs');
                } else {
                    $url = new Zend_Controller_Action_Helper_Url();
                    $this->_redirect($url->url(array('catalog' => $id_parent), 'catalogs_catalog_view'));
                }
            } else {
                $this->_helper->flashMessenger->addMessage($this->translate->_('You must define a catalog name'));
            }
        }

        $this->_helper->redirector('index', 'index', 'catalogs');
    }
}
