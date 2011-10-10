<?php

class Books_Meta_Book extends Zend_Db_Table_Row_Abstract
{
    public function hasThumb() {
        return file_exists(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $this->book . '.small.jpg');
    }

    public function getUrlPhoto() {
        if ($this->hasThumb()) {
            return '/media/img/thumbnails/books/' . $this->book . '.small.jpg';
        } else {
            return '/media/img/book_default.small.jpg';
        }
    }
}
