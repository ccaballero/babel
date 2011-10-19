<?php

class Settings_Form_Setting extends Zend_Form
{
    public function init() {
        $this->setMethod('post');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

        $information_subform = new Zend_Form_SubForm();
        $fullname = $information_subform->createElement('text', 'fullname');
        $fullname->setRequired(true)
                 ->setLabel('Fullname')
                 ->setAttrib('class', 'focus user')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128))
                 ->addValidator('Alpha', false, array('allowWhiteSpace' => true));

        $username = $information_subform->createElement('text', 'username');
        $username->setRequired(true)
                 ->setLabel('Username')
                 ->setAttrib('class', 'email')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', false, array(0, 128))
                 ->addValidator('Alpha', false, array('allowWhiteSpace' => true));

        $information_subform->addElement($fullname);
        $information_subform->addElement($username);

        $photo_subform = new Zend_Form_SubForm();
        $photo = $photo_subform->createElement('file', 'photo');
        $photo->setRequired(false)
              ->setLabel('Photo')
              ->setDestination(APPLICATION_PATH . '/../data/upload/')
              ->addValidator('Count', false, 1)
              ->addValidator('Size', false, 2097152)
              ->addValidator('Extension', false, 'jpg,png,gif');

        $photo_subform->addElement($photo);

        $password_subform = new Zend_Form_SubForm();

        $password1 = $password_subform->createElement('password', 'password1');
        $password1->setRequired(false)
                  ->setLabel('New password')
                  ->setAttrib('class', 'key')
                  ->addValidator('StringLength', false, array(6, 20));

        $password2 = $password_subform->createElement('password', 'password2');
        $password2->setRequired(false)
                  ->setLabel('Retype password')
                  ->setAttrib('class', 'key')
                  ->addValidator('Identical', false, array('token' => 'password1'));

        $password_subform->addElement($password1);
        $password_subform->addElement($password2);

        $this->addSubForms(array(
            'information' => $information_subform,
            'photo' => $photo_subform,
            'password' => $password_subform,
        ));
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Change',));
    }

    public function setUser($user) {
        $this->getSubForm('information')->getElement('fullname')->setValue($user->fullname);
        $this->getSubForm('information')->getElement('username')->setValue($user->username);
    }
}
