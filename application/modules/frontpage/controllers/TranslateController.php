<?php

class TranslateController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $lang = $request->getParam('lang');
        
        $session = new Zend_Session_Namespace('babel');
        $session->lang = $lang;

        $this->_helper->flashMessenger->addMessage('You change the language');

        $this->_redirect($_SERVER['HTTP_REFERER']);
    }
}
