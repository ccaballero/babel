<?php

class Babel_Action extends Zend_Controller_Action
{
    public $auth = null;
    public $user = null;
    public $route = null;

    public function preDispatch() {
        $this->view->addScriptPath(APPLICATION_PATH . '/modules');
        $this->view->translate = Zend_Registry::get('Zend_Translate');

        $request = $this->getRequest();

        $this->view->auth = Zend_Auth::getInstance();
        $this->auth = $this->view->auth->getIdentity();

        if (!empty($this->auth)) {
            $model_users = new Users();
            $this->user = $model_users->findByIdent($this->auth->ident);
        } else {
            $this->user = new Users_Guest;
        }
        $this->view->user = $this->user;

        $this->view->addScriptPath(APPLICATION_PATH . '/../docs/manual/');

        $this->view->addHelperPath(APPLICATION_PATH . '/../library/Yachay/Helpers', 'Yachay_Helpers');
        $this->view->addHelperPath(APPLICATION_PATH . '/../library/Babel/Helpers', 'Babel_Helpers');

        $this->view->route = $this->getFrontController()->getRouter()->getCurrentRouteName();
        $this->route = $this->view->route;
        $this->url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getRequestUri();

        $this->view->language = Zend_Registry::get('lang');
    }

    public function postDispatch() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_flashMessenger->setNamespace('babel');
        $this->view->messages = $this->_flashMessenger->getMessages();

        $this->view->render('frontpage/views/scripts/toolbar.php');
        $this->view->render('frontpage/views/scripts/menubar.php');
        $this->view->render('frontpage/views/scripts/messages.php');
        $this->view->render('frontpage/views/scripts/footer.php');
    }

    public function requireLogin() {
        if ($this->auth == null) {
            $this->_helper->flashMessenger->addMessage('You must be logged');
            $this->_helper->redirector('in', 'index', 'auth');
        }
    }

    public function requireAdmin() {
        $this->requireLogin();

        if ($this->user->role <> 'admin') {
            $this->_helper->flashMessenger->addMessage('You must be admin');
            $this->_helper->redirector('in', 'index', 'auth');
        }
    }
}
