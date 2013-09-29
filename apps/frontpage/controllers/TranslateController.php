<?php

class TranslateController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $lang = $request->getParam('lang');
        
        $session = new Zend_Session_Namespace('babel');
        $session->lang = $lang;

        $url = new Zend_Controller_Action_Helper_Url();

        $this->_helper->flashMessenger->addMessage($this->translate->_('You change the language'));

        $this->_redirect($url->url(array(), 'frontpage'));
    }
}
