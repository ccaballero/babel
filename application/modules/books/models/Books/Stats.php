<?php

class Books_Stats extends Babel_Models_Table
{
    protected $_name = 'babel_books_stats';
    protected $_primary = 'book';

    protected $_referenceMap    = array(
        'Book'                  => array(
            'columns'           => 'book',
            'refTableClass'     => 'Books_Collection',
            'refColumns'        => 'ident',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function findByBook($book) {
        return $this->fetchRow($this->select()->where('book = ?', $book));
    }
}
