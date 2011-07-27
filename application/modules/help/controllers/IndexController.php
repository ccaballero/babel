<?php

class Help_IndexController extends Babel_Action
{
    public function indexAction() {
        $translate = Zend_Registry::get('Zend_Translate');
        $locale = $translate->getLocale();

        return $this->render("index-$locale");
    }
}
