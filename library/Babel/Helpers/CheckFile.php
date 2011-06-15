<?php

class Babel_Helpers_CheckFile
{
    public function checkFile($bookstore, $directory, $filename) {
        if (empty($directory)) {
            return file_exists("$bookstore/$filename");
        } else {
            return file_exists("$bookstore/$directory/$filename");
        }
    }
}
