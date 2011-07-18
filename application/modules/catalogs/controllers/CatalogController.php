<?php

class Catalogs_CatalogController extends Babel_Action
{
    public function viewAction() {
        $request = $this->getRequest();
        $ident_catalog = $request->getParam('catalog');

        $model_catalogs = new Catalogs();
        $catalog = $model_catalogs->findByIdent($ident_catalog);

        if ($catalog == NULL) {
            $this->_helper->redirector('index', 'index', 'catalogs');
        }
        
        $children = $catalog->findDependentRowset('Catalogs');
        $books = $catalog->findBooksViaBooks_Catalogs();

        $this->view->catalog = $catalog;
        $this->view->catalogs = $children;
        $this->view->books = $books;

        if ($this->auth <> null) {
            $url = new Zend_Controller_Action_Helper_Url();

            $form = new Catalogs_Form_Create();
            $form->setAction($url->url(array('catalog' => $catalog->ident), 'catalogs_catalog_new'));

            $this->view->form = $form;
        }
    }
}
