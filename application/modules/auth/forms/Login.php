<?php

class Auth_Form_Login extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $email = $this->createElement('text', 'username');
        $email->setRequired(true)
              ->setLabel('Username')
              ->setAttrib('class', 'focus user')
              ->addFilter('StringTrim')
              ->addValidator('StringLength', false, array(0, 128));

        $password = $this->createElement('password', 'password');
        $password->setRequired(true)
                 ->setLabel('Password')
                 ->setAttrib('class', 'key');

        $this->addElement($email);
        $this->addElement($password);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Login',));
    }
}
