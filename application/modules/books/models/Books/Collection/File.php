<?php

class Books_Collection_File extends Zend_Db_Table_Row_Abstract
{
    public function inDisk() {
        return file_exists($this->getPath());
    }

    public function inCollection() {
        return !empty($this->tsregister);
    }

    public function inSearch() {
        return ($this->inCollection() && $this->published);
    }

    public function getPath() {
        return "{$this->directory}/{$this->file}";
    }

    public function hasThumb() {
        return file_exists(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $this->hash . '.jpg');
    }

    public function save() {
        $this->tsupdated = time();
        parent::save();
    }
}
