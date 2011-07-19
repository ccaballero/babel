<?php

class Tags_IndexController extends Babel_Action
{
    public function indexAction() {
        $model_catalogs = new Catalogs();
        $catalogs = $model_catalogs->selectByStats();

        $array_catalogs = $catalogs->toArray();
        shuffle($array_catalogs);

        $this->view->catalogs = $array_catalogs;
    }
}
