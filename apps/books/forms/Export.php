<?php

class Books_Form_Export extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $bookstore = $this->createElement('select', 'bookstores');
        $bookstore->setRequired(true)
                  ->setLabel('Bookstore');

        $this->addElement($bookstore);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Export'));
    }

    public function setBookstores($bookstores) {
        $element = $this->getElement('bookstores');

        $element->addMultiOption(-1, 'All bookstores');
        foreach ($bookstores as $i => $bookstore) {
            $element->addMultiOption($i, basename($bookstore));
        }
    }
}
