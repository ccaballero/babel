<?php

class Books_Collection extends Babel_Models_Table
{
    protected $_name = 'babel_books_collection';
    protected $_primary = 'ident';

    protected $_rowClass = 'Books_Collection_File';
    protected $_dependentTables = array('Books');
    
    public function selectByBookstore($bookstore) {
        return $this->fetchAll($this->select()->where('bookstore = ?', $bookstore)->order('file ASC'));
    }

    public function findByIdent($ident) {
        return $this->fetchRow($this->select()->where('ident = ?', $ident));
    }

    public function findByMD5($md5) {
        return $this->fetchRow($this->select()->where('md5_path = ?', $md5));
    }
}
