<?php

class Books_Form_Meta extends Zend_Form
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

        $year = $this->createElement('text', 'year');
        $year->setRequired(false)
             ->setLabel('Year')
             ->setAttrib('class', 'calendar')
             ->addFilter('Int');

        $language = $this->createElement('select', 'language');
        $language->setRequired(false)
                 ->setLabel('Language')
                 ->setAttrib('class', 'flag')
                 ->addFilter('StringTrim')
                 ->addValidator('InArray', true, array('haystack' => array('', 'EN', 'ES')))
                 ->setMultiOptions(array(
                     ''   => '----------',
                     'EN' => 'English',
                     'ES' => 'Spanish',
                 ));

        $this->addElement($title);
        $this->addElement($author);
        $this->addElement($publisher);
        $this->addElement($year);
        $this->addElement($language);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Edit',));
    }
}
