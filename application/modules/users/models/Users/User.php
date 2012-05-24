<?php

class Users_User extends Zend_Db_Table_Row_Abstract
{
    public function getUrlPhoto() {
        $url_base = '/media/img/thumbnails/users/' . $this->ident . '.jpg';
        if (file_exists(APPLICATION_PATH . '/../public' . $url_base)) {
            return $url_base;
        } else {
            return '/babel_small.png';
        }
    }

    public function isFTPActivate() {
        $model_users_ftp = new Users_FTP();
        $user = $model_users_ftp->findByUser($this->ident);
        return !empty($user);
    }
}
