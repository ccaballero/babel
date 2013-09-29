<?php

class Books_Stats extends Babel_Models_Table
{
    protected $_name = 'babel_books_stats';
    protected $_primary = 'book';

    public function findByHash($hash) {
        return $this->fetchRow($this->select()->where('book = ?', $hash));
    }
}
