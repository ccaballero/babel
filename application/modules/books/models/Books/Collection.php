<?php

class Books_Collection extends Babel_Models_Table
{
    protected $_name = 'babel_books_collection';
    protected $_primary = 'hash';

    protected $_rowClass = 'Books_Collection_File';
    protected $_dependentTables = array();

    public function selectByDirectory($directory) {
        return $this->fetchAll($this->select()->where('directory LIKE ?', $directory . '%'));
    }

    public function findByHash($hash) {
        return $this->fetchRow($this->select()->where('hash = ?', $hash));
    }

    public function selectWithMetas() {
        return $this->fetchAll(
               $this->select()->setIntegrityCheck(false)
                   ->from($this, array('hash', 'directory', 'file'))
                   ->joinLeft('babel_books_meta', 'babel_books_collection.hash = babel_books_meta.book', array('title', 'author', 'publisher', 'year', 'language'))
                   ->where('babel_books_collection.published = ?', true));
    }
}
