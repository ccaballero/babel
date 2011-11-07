<?php

class ImageController extends Babel_Action
{
    public function indexAction() {
        $base = $this->getFrontController()->getBaseUrl();

        $dir_images = APPLICATION_PATH . '/../public/media/img/wallpaper/';
        $stack = scandir($dir_images);
        $array = array();

        foreach($stack as $element) {
            if ($element <> '.' || $element <> '..') {
                if (is_file($dir_images . $element)) {
                    $array[] = $base . '/media/img/wallpaper/' . $element;
                }
            }
        }

        $this->_helper->json(array('image' => $array[rand(0, count($array) - 1)]));
    }
}
