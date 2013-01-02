<?php

class ImageController extends Babel_Action
{
    public function indexAction() {
        $base = $this->getFrontController()->getBaseUrl();

        $config = Zend_Registry::get('config');
        $dir_images = $config->babel->properties->images->dir;
        $stack = scandir($dir_images);
        $array = array();
        
        foreach($stack as $element) {
            if ($element <> '.' || $element <> '..') {
                if (is_file($dir_images . DIRECTORY_SEPARATOR . $element)) {
                    $array[] = $base . $config->babel->properties->images->url . '/' . $element;
                }
            }
        }

        $this->_helper->json(array('image' => $array[rand(0, count($array) - 1)]));
    }
}
