<?php

class Books_Collection_File extends Zend_Db_Table_Row_Abstract
{
    public function inDisk() {
        return file_exists($this->getPath());
    }

    public function inCollection() {
        return !empty($this->tsregister);
    }

    public function isShared() {
        if ($this->inCollection() && count($this->findBooks()) != 0) {
            return true;
        }
        return false;
    }

    public function getPath() {
        return "{$this->directory}/{$this->file}";
    }
}
