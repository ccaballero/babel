<?php

class Users_Form_Create extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $information_subform = new Zend_Form_SubForm();

        $fullname = $information_subform->createElement('text', 'fullname');
        $fullname->setRequired(true)
                 ->setLabel('Fullname')
                 ->setAttrib('class', 'focus user')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128));

        $username = $information_subform->createElement('text', 'username');
        $username->setRequired(true)
                 ->setLabel('Username')
                 ->setAttrib('class', 'user')
                 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('StringLength', false, array(4, 128))
                 ->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                 ->addValidator(new Babel_Validators_UniqueField(new Users(), 'username'));

        $information_subform->addElement($fullname);
        $information_subform->addElement($username);

        $password_subform = new Zend_Form_SubForm();

        $password1 = $password_subform->createElement('password', 'password1');
        $password1->setRequired(true)
                  ->setLabel('Password')
                  ->setAttrib('class', 'key')
                  ->addValidator('StringLength', false, array(6, 20));

        $password2 = $password_subform->createElement('password', 'password2');
        $password2->setRequired(true)
                  ->setLabel('Retype password')
                  ->setAttrib('class', 'key')
                  ->addValidator('Identical', false, array('token' => 'password1'));

        $password_subform->addElement($password1);
        $password_subform->addElement($password2);

        $this->addSubForms(array(
            'information' => $information_subform,
            'password' => $password_subform,
        ));
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Create'));
    }
}
