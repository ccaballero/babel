<?php

class Books_Form_Collection extends Zend_Form
{
    public function init() {
        $bookstores = array();
        foreach(Zend_Registry::get('Config')->babel->properties->bookstores as $bookstore) {
            $bookstores[] = $bookstore;
        }

        $this->setMethod('post');
        $this->setName('form_file');

        $bookstore = $this->createElement('select', 'bookstore');
        $bookstore->setRequired(true)
                  ->setLabel('Bookstore')
                  ->addFilter('StringTrim')
                  ->setMultiOptions($bookstores);

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

        $this->addElement($bookstore);
        $this->addElement($directory);
        $this->addElement($file);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Edit',));
    }
}
