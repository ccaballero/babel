<?php

class Help_View_Helper_Manuals
{
    public function manuals() {
        $path = APPLICATION_PATH . '/../docs/manual/';
        $array = array();

        foreach(@scandir($path) as $directory) {
            if ($directory <> '.' && $directory <> '..' && is_dir($path . $directory)) {
                $array[substr($directory, 0, 1)] = substr($directory, 2);
            }
        }

        ksort($array);
        return $array;
    }
}
