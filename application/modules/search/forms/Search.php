<?php

class Search_Form_Search extends Zend_Form
{
    public function init(array $array = null) {
        $this->setMethod('get');
        $this->setAction('/search');
        $this->addElement('text', 'q', array('class' => 'focus find',));
    }
}
