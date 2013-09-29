<?php

class Books_Collection_File extends Zend_Db_Table_Row_Abstract
{
    private $_meta = null;
    private $_stats = null;

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

    public function getUrlPhoto() {
        if ($this->hasThumb()) {
            return '/media/img/thumbnails/books/' . $this->hash . '.jpg';
        } else {
            return '/media/img/book_default.jpg';
        }
    }

    public function save() {
        try {
            $this->tsupdated = time();
            parent::save();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getMeta() {
        if ($this->_meta == null) {
            $model_metas = new Books_Meta();
            $meta = $model_metas->findByHash($this->hash);
            if (empty($meta)) {
                $meta = $model_metas->createRow();
                $meta->book = $this->hash;
                $meta->save();
            }
            $this->_meta = $meta;
        }
        return $this->_meta;
    }

    public function getStats() {
        if ($this->_stats == null) {
            $model_stats = new Books_Stats();
            $stats = $model_stats->findByHash($this->hash);
            if (empty($stats)) {
                $stats = $model_stats->createRow();
                $stats->book = $this->hash;
                $stats->save();
            }
            $this->_stats = $stats;
        }
        return $this->_stats;
    }
}
