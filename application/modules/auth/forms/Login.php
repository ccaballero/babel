<?php

class Auth_Form_Login extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $email = $this->createElement('text', 'email');
        $email->setRequired(true)
              ->setLabel('Email')
              ->setAttrib('class', 'focus email')
              ->addFilter('StringTrim')
              ->addValidator('StringLength', false, array(0, 64))
              ->addValidator('EmailAddress', false);

        $password = $this->createElement('password', 'password');
        $password->setRequired(true)
                 ->setLabel('Password')
                 ->setAttrib('class', 'key');

        $this->addElement($email);
        $this->addElement($password);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Login',));
    }
}
