<?php

class Catalogs_IndexController extends Babel_Action
{
    public function indexAction() {
        $model_catalogs = new Catalogs();
        $this->view->catalogs = $model_catalogs->fetchAll();
    }

    public function newAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        $form = new Catalogs_Form_Create();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_catalogs = new Catalogs();
                $catalog = $model_catalogs->createRow();

                $catalog->label = $form->getSubForm('information')->getElement('label')->getValue();
                $catalog->description = $form->getSubForm('information')->getElement('description')->getValue();
                $catalog->tsregister = time();

                $iconv = new Yachay_Helpers_Iconv();
                $catalog->url = $iconv->iconv($catalog->label);

                $catalog->save();
                $this->_helper->flashMessenger->addMessage('The catalog ' . $catalog->label . ' was created');

                if ($form->getSubForm('photo')->getElement('photo')->receive()) {
                    $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();

                    if (file_exists($filename)) {
                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/catalogs/' . $catalog->ident . '.jpg', 100, 100);
                        unlink($filename);

                        $catalog->avatar = true;
                        $catalog->save();
                    }

                    $this->_helper->flashMessenger->addMessage('The photo of catalog ' . $catalog->label . ' was updated successfully');
                }

                $this->_helper->redirector('index', 'index', 'catalogs');
            }
        }

        $this->view->form = $form;
    }
}
