<?php

class Books_Collection extends Babel_Models_Table
{
    protected $_name = 'babel_books_collection';
    protected $_primary = 'hash';

    protected $_rowClass = 'Books_Collection_File';
    protected $_dependentTables = array('Books', 'Books_Stats');

    public function selectByDirectory($directory) {
        return $this->fetchAll($this->select()->where('directory = ?', $directory));
    }

    public function findByHash($hash) {
        return $this->fetchRow($this->select()->where('hash = ?', $hash));
    }
}
