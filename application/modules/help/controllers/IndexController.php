<?php

class Help_IndexController extends Babel_Action
{
    public function indexAction() {
        $translate = Zend_Registry::get('Zend_Translate');
        $locale = $translate->getLocale();

        $request = $this->getRequest();
        $page = $request->getParam('page', 'contents');

        $this->view->page = $page;
        $this->view->locale = $locale;
    }
}
