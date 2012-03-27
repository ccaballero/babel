<?php

class Help_IndexController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $page = $request->getParam('page', 'contents');

        $this->view->page = $page;
        $this->view->locale = Zend_Registry::get('lang');
    }
}
