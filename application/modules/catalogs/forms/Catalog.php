<?php

class Catalogs_Form_Catalog extends Zend_Form
{
    public function init() {
        $this->setMethod('post');
        $this->setName('form_catalog');

        $url = new Zend_Controller_Action_Helper_Url();
        $this->setAction($url->url(array(), 'catalogs_new'));

        $information_subform = new Zend_Form_SubForm();
        $catalog = $information_subform->createElement('text', 'catalog');
        $catalog->setRequired(true)
              ->setLabel('Label')
              ->setAttrib('class', 'focus label')
              ->addFilter('StringTrim')
              ->addValidator('StringLength', false, array(1, 128));

        $mode = $this->createElement('select', 'mode');
        $mode->setRequired(false)
             ->setLabel('Mode')
             ->setMultiOptions(array('open' => 'Open', 'close' => 'Close'));

        $type = $this->createElement('select', 'type');
        $type->setRequired(false)
             ->setLabel('Type')
             ->setMultiOptions(array('f' => 'Folksonomy', 't' => 'Taxonomy'));

        $description = $information_subform->createElement('textarea', 'description');
        $description->setRequired(false)
                    ->setLabel('Description')
                    ->addFilter('StringTrim')
                    ->addFilter('StripTags');

        $return = $this->createElement('hidden', 'return');

        $this->addElement($catalog);
        $this->addElement($mode);
        $this->addElement($type);
        $this->addElement($description);
        $this->addElement($return);

//        $photo_subform = new Zend_Form_SubForm();
//        $photo = $photo_subform->createElement('file', 'photo');
//        $photo->setRequired(false)
//              ->setLabel('Photo')
//              ->setDestination(APPLICATION_PATH . '/../data/upload/')
//              ->addValidator('Count', false, 1)
//              ->addValidator('Size', false, 2097152)
//              ->addValidator('Extension', false, 'jpg,png,gif');
//
//        $photo_subform->addElement($photo);

//        $this->addSubForms(array(
//            'information' => $information_subform,
//            'photo' => $photo_subform,
//        ));
//        $this->addElement($information_subform);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Edit'));
    }

    public function hideMode() {
//        $information = $this->getSubForm('information');
//        $information->removeElement('mode');
        $this->removeElement('mode');
    }

    public function hideType() {
//        $information = $this->getSubForm('information');
//        $information->removeElement('type');
        $this->removeElement('type');
    }
}
