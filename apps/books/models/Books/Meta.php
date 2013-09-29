<?php

class Books_Meta extends Babel_Models_Table
{
    protected $_name = 'babel_books_meta';
    protected $_primary = 'book';
    protected $_rowClass = 'Books_Meta_Book';

    protected $_dependentTables = array();

    public function findByHash($hash) {
        return $this->fetchRow($this->select()->where('book = ?', $hash));
    }
}
