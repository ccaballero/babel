<?php

class Catalogs_Catalog extends Zend_Db_Table_Row_Abstract
{
    public function getUrlPhoto() {
        if ($this->avatar) {
            return '/media/img/thumbnails/catalogs/' . $this->ident . '.jpg';
        } else {
            return '/media/img/user.png';
        }
    }
}
