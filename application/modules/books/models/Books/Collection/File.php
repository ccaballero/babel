<?php

class Books_Collection_File extends Zend_Db_Table_Row_Abstract
{
    public function inDisk() {
        $path = $this->getPath();
        return file_exists($path);
    }

    public function inCollection() {
        return !empty($this->ident);
    }

    public function isShared() {
        if ($this->inCollection() && count($this->findBooks()) != 0) {
            return true;
        }
        return false;
    }

    public function getPath() {
        if (empty($this->directory)) {
            return $this->bookstore . '/' . $this->file;
        } else {
            return $this->bookstore . '/' . $this->directory . '/' .$this->file;
        }
    }
}
