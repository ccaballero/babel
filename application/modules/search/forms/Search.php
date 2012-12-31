<?php

class Search_Form_Search extends Zend_Form
{
    public function init() {
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        
        $this->setMethod('get');
        $this->setAction($baseUrl . '/search');
        $this->addElement('text', 'q', array('class' => 'focus find'));
    }
}
