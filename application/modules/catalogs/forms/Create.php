<?php

class Catalogs_Form_Create extends Zend_Form
{
    public function init() {
        $this->setMethod('post');

        $url = new Zend_Controller_Action_Helper_Url();
        $this->setAction($url->url(array(), 'catalogs_new'));

        $information_subform = new Zend_Form_SubForm();
        $label = $information_subform->createElement('text', 'label');
        $label->setRequired(true)
              ->setLabel('Label')
              ->setAttrib('class', 'focus label')
              ->addFilter('StringTrim')
              ->addValidator('StringLength', false, array(1, 128))
              ->addValidator('Alnum', false, array('allowWhiteSpace' => true));

        /*$code = $information_subform->createElement('text', 'code');
        $code->setRequired(true)
             ->setLabel('Code')
             ->setAttrib('class', 'key')
             ->addFilter('StringTrim')
             ->addValidator('StringLength', false, array(1, 8))
             ->addValidator('Alnum', false, array('allowWhiteSpace' => false));*/

        $description = $information_subform->createElement('textarea', 'description');
        $description->setRequired(false)
                    ->setLabel('Description')
                    ->addFilter('StringTrim')
                    ->addFilter('StripTags');

        $information_subform->addElement($label);
        //$information_subform->addElement($code);
        $information_subform->addElement($description);

        $photo_subform = new Zend_Form_SubForm();
        $photo = $photo_subform->createElement('file', 'photo');
        $photo->setRequired(false)
              ->setLabel('Photo')
              ->setDestination(APPLICATION_PATH . '/../upload/')
              ->addValidator('Count', false, 1)
              ->addValidator('Size', false, 2097152)
              ->addValidator('Extension', false, 'jpg,png,gif');

        $photo_subform->addElement($photo);

        $this->addSubForms(array(
            'information' => $information_subform,
            'photo' => $photo_subform,
        ));
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Create',));
    }
}
