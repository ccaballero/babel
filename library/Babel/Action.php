<?php

class Babel_Action extends Zend_Controller_Action
{
    public $auth = null;
    public $user = null;
    public $route = null;
    public $translate = null;

    protected $_useForward = false;

    public function init() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_flashMessenger->setNamespace('babel');
        
        $this->_redirector = $this->_helper->getHelper('Redirector');
        $this->_redirector->setPrependBase(false);
    }

    public function preDispatch() {
        if (!$this->_useForward) {
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

            $this->view->addScriptPath(APPLICATION_PATH . '/modules');
            $this->view->addScriptPath(APPLICATION_PATH . '/../docs/manual/');

            $this->view->addHelperPath(APPLICATION_PATH . '/../library/Yachay/Helpers', 'Yachay_Helpers');
            $this->view->addHelperPath(APPLICATION_PATH . '/../library/Babel/Helpers', 'Babel_Helpers');

            $this->view->route = $this->getFrontController()->getRouter()->getCurrentRouteName();
            $this->route = $this->view->route;
            $this->url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getRequestUri();

            $this->view->language = Zend_Registry::get('lang');
            $this->view->translate = Zend_Registry::get('Zend_Translate');
            $this->translate = $this->view->translate;
        }
    }

    public function postDispatch() {
        if (!$this->_useForward) {
            $this->view->messages = array_merge($this->_flashMessenger->getCurrentMessages(), $this->_flashMessenger->getMessages());
            $this->_helper->getHelper('FlashMessenger')->clearCurrentMessages();
            $this->_helper->getHelper('FlashMessenger')->clearMessages();

            $this->view->render('frontpage/views/scripts/toolbar.php');
            $this->view->render('frontpage/views/scripts/menubar.php');

            $this->view->render('frontpage/views/scripts/translate.php');
            $this->view->render('frontpage/views/scripts/footer.php');

            $this->view->render('frontpage/views/scripts/messages.php');
        }
    }

    public function requireLogin() {
        if ($this->auth == null) {
            $this->_helper->flashMessenger->addMessage($this->translate->_('You must be logged'));
            $this->_helper->redirector('in', 'index', 'auth');
        }
    }

    public function requireAdmin() {
        $this->requireLogin();

        if ($this->user->role <> 'admin') {
            $this->_helper->flashMessenger->addMessage($this->translate->_('You must be admin'));
            $this->_helper->redirector('in', 'index', 'auth');
        }
    }
}
