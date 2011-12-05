<?php

class Users_User extends Zend_Db_Table_Row_Abstract
{
    public function getUrlPhoto() {
        $file = '/media/img/thumbnails/users/' . $this->ident . '.jpg';
        if (file_exists($file)) {
            return $file;
        } else {
            return '/babel_small.png';
        }
    }
}
