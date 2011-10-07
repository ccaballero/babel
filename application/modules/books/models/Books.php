<?php

class Books extends Babel_Models_Table
{
    protected $_name = 'babel_books_shared';
    protected $_primary = 'hash';

    protected $_rowClass = 'Books_Book';

    protected $_dependentTables = array('Books_Catalogs');
    protected $_referenceMap    = array(
        'Hash'                  => array(
            'columns'           => 'hash',
            'refTableClass'     => 'Books_Collection',
            'refColumns'        => 'hash',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function findByHash($hash) {
        return $this->fetchRow($this->select()->where('hash = ?', $hash));
    }

    public function selectByStats() {
        return $this->fetchAll($this->select()->setIntegrityCheck(false)->from($this)->joinLeft('babel_books_stats', 'babel_books_shared.book = babel_books_stats.book', 'downloads'));
    }
}
