<?php

class Books_Form_Shared extends Zend_Form
{
    public function init() {
        $this->setMethod('post');
        $this->setName('form_book');

        $title = $this->createElement('text', 'title');
        $title->setRequired(false)
              ->setLabel('Title')
              ->setAttrib('class', 'bookstore')
              ->addFilter('StringTrim');

        $author = $this->createElement('text', 'author');
        $author->setRequired(false)
               ->setLabel('Author')
               ->setAttrib('class', 'user')
               ->addFilter('StringTrim');

        $publisher = $this->createElement('text', 'publisher');
        $publisher->setRequired(false)
                  ->setLabel('Publisher')
                  ->setAttrib('class', 'world')
                  ->addFilter('StringTrim');

        $language = $this->createElement('text', 'language');
        $language->setRequired(false)
                 ->setLabel('Language')
                 ->setAttrib('class', 'flag')
                 ->addFilter('StringTrim');

        $this->addElement($title);
        $this->addElement($author);
        $this->addElement($publisher);
        $this->addElement($language);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Edit',));
    }
}
