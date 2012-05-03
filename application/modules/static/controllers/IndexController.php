<?php

class Static_IndexController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $page = $request->getParam('page');

        $config = Zend_Registry::get('Config');
        $static = $config->babel->static;

        $this->view->page = $page;
        if (isset($static->$page)) {
            $this->view->contents = file_get_contents($static->$page);
        } else {
            $this->view->contents = $this->translate->_('Page not found');
        }
    }
}
