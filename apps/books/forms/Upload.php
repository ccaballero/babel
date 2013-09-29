<?php

class Books_Form_Upload extends Zend_Form
{
    public $count_file = 8;

    public function init() {
        $this->setMethod('post');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

        $files = $this->createElement('file', 'files');
        $files->setRequired(false)
              ->setLabel('Files')
//              ->setDestination($this->dir_upload)
              ->addValidator('Count', false, array(
                  'min' => 1,
                  'max' => $this->count_file
                ))
              ->addValidator('Extension', false, 'pdf');
        $files->setMultiFile($this->count_file);

        $this->addElement($files);
        $this->addElement('submit', 'submit', array('ignore' => true, 'label' => 'Upload files'));
    }

    public function setDestination($username) {
        $config = Zend_Registry::get('config');

        $ftp = $config->babel->properties->ftp;
        $dir_upload = $ftp->root . DIRECTORY_SEPARATOR . $ftp->prefix . $username . DIRECTORY_SEPARATOR . 'books';

        $this->getElement('files')->setDestination($dir_upload);
    }
}
