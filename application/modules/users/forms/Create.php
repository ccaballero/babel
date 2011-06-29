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
                 ->setAttrib('class', 'email')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128))
                 ->addValidator('Alpha', false, array('allowWhiteSpace' => true));

        $this->addElement($fullname);
        $this->addElement($username);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Create',));
    }
}
