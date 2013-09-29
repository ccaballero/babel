<?php

class IndexController extends Babel_Action
{
    public function indexAction() {
        $form = new Search_Form_Search();
        $this->view->form = $form;
    }
    
    public function jsAction() {
        $this->getResponse()->setHeader('Content-Type', 'text/javascript');
        
        echo 'var test=\'\';';
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }
}
