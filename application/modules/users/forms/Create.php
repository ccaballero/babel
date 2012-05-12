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

        $username = $this->createElement('text', 'username');
        $username->setRequired(true)
                 ->setLabel('Username')
                 ->setAttrib('class', 'user')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128))
                 ->addValidator('Alpha', false, array('allowWhiteSpace' => true))
                 ->addValidator(new Babel_Validators_UniqueField(new Users(), 'username'));

        $password = $this->createElement('password', 'password');
        $password->setRequired(true)
                 ->setLabel('Password')
                 ->setAttrib('class', 'key')
                 ->addValidator('StringLength', false, array(5, 128));

        $this->addElement($fullname);
        $this->addElement($username);
        $this->addElement($password);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Create',));
    }
}
