<?php

class Books_Form_Collection extends Zend_Form
{
    public function init() {
        $this->setMethod('post');
        $this->setName('form_file');

        $directory = $this->createElement('text', 'directory');
        $directory->setRequired(false)
              ->setLabel('Directory')
              ->setAttrib('class', 'directory')
              ->addFilter('StringTrim');

        $file = $this->createElement('text', 'file');
        $file->setRequired(true)
              ->setLabel('File')
              ->setAttrib('class', 'label')
              ->addFilter('StringTrim');

        $this->addElement($directory);
        $this->addElement($file);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Edit',));
    }
}
