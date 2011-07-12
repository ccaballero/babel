<?php

class Catalogs_CatalogController extends Babel_Action
{
    public function viewAction() {
        $request = $this->getRequest();
        $ident_catalog = $request->getParam('catalog');

        $model_catalogs = new Catalogs();
        $catalog = $model_catalogs->findByIdent($ident_catalog);

        $children = $catalog->findDependentRowset('Catalogs');

        $this->view->catalog = $catalog;
        $this->view->catalogs = $children;
    }
}
