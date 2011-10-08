<?php

class Books_Meta_Book extends Zend_Db_Table_Row_Abstract
{
    //private $_collection = null;
    //private $_stats = null;

    /*private function _getCollection() {
        if ($this->_collection == null) {
            $this->_collection = $this->findParentRow('Books_Collection');
        }
        return $this->_collection;
    }*/

    /*public function getStats() {
        if ($this->_stats == null) {
            $model_stats = new Books_Stats();
            $stats = $model_stats->findByBook($this->book);
            if (empty($stats)) {
                $stats = $model_stats->createRow();
                $stats->book = $this->book;
                $stats->save();
            }
            $this->_stats = $stats;
        }
        return $this->_stats;
    }*/
}
