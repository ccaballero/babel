<?php

class Users_User extends Zend_Db_Table_Row_Abstract
{
    public function getUrlPhoto() {
        if ($this->avatar) {
            return '/media/img/thumbnails/users/' . $this->ident . '.jpg';
        } else {
            return '/babel.png';
        }
    }
}