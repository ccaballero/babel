<?php

class Babel_Action extends Zend_Controller_Action
{
    public $auth = null;
    public $user = null;
    public $route = null;

    public function preDispatch() {
        $this->view->addScriptPath(APPLICATION_PATH . '/modules');
        $this->view->translate = Zend_Registry::get('Zend_Translate');

        $this->view->auth = Zend_Auth::getInstance();
        $this->auth = $this->view->auth->getIdentity();

        if (!empty($this->auth)) {
            $model_users = new Users();
            $this->user = $model_users->findByIdent($this->auth->ident);
        }

        $this->view->addHelperPath(APPLICATION_PATH . '/../library/Yachay/Helpers', 'Yachay_Helpers');
        $this->view->addHelperPath(APPLICATION_PATH . '/../library/Babel/Helpers', 'Babel_Helpers');

        $this->view->route = $this->getFrontController()->getRouter()->getCurrentRouteName();
        $this->route = $this->view->route;
    }

    public function postDispatch() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();

        $this->view->render('frontpage/views/scripts/toolbar.php');
        $this->view->render('frontpage/views/scripts/menubar.php');
        $this->view->render('frontpage/views/scripts/messages.php');
    }
}
