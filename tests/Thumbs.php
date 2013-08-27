<?php

class Thumbs {
    public function __construct() {
        echo 'Testing of imagemagick' . PHP_EOL;
    }
    
    public function test() {
        $image = new Imagick();
        
        echo 'Class Imagick founded!!! yeah' . PHP_EOL;
    }
}

$thumbs = new Thumbs();
$thumbs->test();
