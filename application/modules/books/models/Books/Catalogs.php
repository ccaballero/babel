<?php

class Books_Catalogs extends Babel_Models_Table
{
    protected $_name = 'babel_books_catalogs';

    protected $_referenceMap    = array(
        'Book'                  => array(
            'columns'           => 'book',
            'refTableClass'     => 'Books',
            'refColumns'        => 'book',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
        'Catalog'               => array(
            'columns'           => 'catalog',
            'refTableClass'     => 'Catalogs',
            'refColumns'        => 'ident',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function cleanCatalogs($book) {
        $this->delete($this->getAdapter()->quoteInto('book = ?', $book, 'INTEGER'));
    }

    public function deleteBookAndCatalog($book, $catalog) {
        $this->delete(array(
            $this->getAdapter()->quoteInto('book = ?', $book, 'INTEGER'),
            $this->getAdapter()->quoteInto('catalog = ?', $catalog, 'INTEGER'),
        ));
    }
}
