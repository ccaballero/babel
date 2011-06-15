<?php

class Users_Form_Create extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $fullname = $this->createElement('text', 'fullname');
        $fullname->setRequired(true)
                 ->setLabel('Fullname')
                 ->setAttrib('class', 'focus user')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128))
                 ->addValidator('Alpha', false, array('allowWhiteSpace' => true));

        $email = $this->createElement('text', 'email');
        $email->setRequired(true)
              ->setLabel('Email')
              ->setAttrib('class', 'email')
              ->addFilter('StringTrim')
              ->addValidator('StringLength', false, array(0, 64))
              ->addValidator('EmailAddress', false);

        $this->addElement($fullname);
        $this->addElement($email);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Create',));
    }
}
