<?php

class Books_Form_Import extends Zend_Form
{
    public function init() {
        $this->setMethod('post');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

        $meta = $this->createElement('file', 'file');
        $meta->setRequired(false)
              ->setLabel('File')
              ->setDestination(APPLICATION_PATH . '/../data/upload/')
              ->addValidator('Count', false, 1)
              ->addValidator('Size', false, 2097152)
              ->addValidator('Extension', false, 'csv');

        $override = $this->createElement('checkbox', 'override');
        $override->setLabel('Allow override metas');

        $this->addElement($meta);
        $this->addElement($override);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Import'));
    }
}
