<?php

class Catalogs_CatalogController extends Babel_Action
{
    public function infoAction() {
        $request = $this->getRequest();
        $ident = $request->getParam('catalog');

        $model_catalogs = new Catalogs();
        $catalog = $model_catalogs->findByIdent($ident);

        $class = new StdClass();
        if (!empty($catalog)) {
            $class->label = $catalog->label;
            $class->mode = $catalog->mode;
            $class->description = $catalog->description;
        }

        $this->_helper->json(array('catalog' => $class));
    }

    public function editAction() {
        $this->requireLogin();
        $request = $this->getRequest();
        $model_catalogs = new Catalogs();

        $ident = $request->getParam('catalog', 0);
        $catalog = $model_catalogs->findByIdent($ident);
        if (empty($catalog) || $catalog->owner <> $this->user->ident) {
            $this->_helper->redirector('index', 'index', 'catalogs');
        }

        $request->setParam('catalog', $catalog->parent);

        if ($request->isPost()) {
            $form = new Catalogs_Form_Catalog();
            $url = new Zend_Controller_Action_Helper_Url();

            if ($form->isValid($request->getPost())) {
                $catalog->label = $form->getElement('catalog')->getValue();
                $catalog->mode = $form->getElement('mode')->getValue();
                $catalog->type = $form->getElement('type')->getValue();
                $catalog->description = $form->getElement('description')->getValue();
                $catalog->save();

                $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('Catalog %s was updated'), $catalog->label));

//                if ($form->getSubForm('photo')->getElement('photo')->receive()) {
//                    $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();
//
//                    if (!empty($filename) && file_exists($filename)) {
//                        $thumbnail = new Yachay_Helpers_Thumbnail();
//                        $avatar = $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/catalogs/' . $catalog->ident . '.jpg', 100, 100);
//                        unlink($filename);
//
//                        if ($avatar) {
//                            $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('The photo of catalog %s was updated successfully'), $catalog->label));
//                        }
//                    }
//                }

                if (empty($catalog->parent)) {
                    $this->_helper->redirector('index', 'index', 'catalogs');
                } else {
                    $this->_redirect($url->url(array('catalog' => $catalog->parent), 'catalogs_catalog_view'));
                }
            } else {
                $this->_helper->flashMessenger->addMessage($this->translate->_('You must define a catalog name'));
            }
        }

        $this->view->overlay = true;
        $this->view->action = 'edit';
        $this->view->edit = $catalog->ident;
        //$this->view->form = $form;

        $this->_useForward = true;
        $this->_forward('index', 'index', 'catalogs');
    }

    public function deleteAction() {
        $this->requireLogin();
        $request = $this->getRequest();
        $model_catalogs = new Catalogs();

        $ident = $request->getParam('catalog', 0);
        $catalog = $model_catalogs->findByIdent($ident);
        if (empty($catalog) || $catalog->owner <> $this->user->ident) {
            $this->_helper->redirector('index', 'index', 'catalogs');
        }

        $url = new Zend_Controller_Action_Helper_Url();
        $parent = $catalog->parent;
        $label = $catalog->label;
        
        $catalog->delete();

        $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('Catalog %s and all references was deleted'), $label));

        if (empty($parent)) {
            $this->_helper->redirector('index', 'index', 'catalogs');
        } else {
            $this->_redirect($url->url(array('catalog' => $parent), 'catalogs_catalog_view'));
        }
    }
}
