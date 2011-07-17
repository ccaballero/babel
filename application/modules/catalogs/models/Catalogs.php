<?php

class Catalogs extends Babel_Models_Table
{
    protected $_name = 'babel_catalogs';
    protected $_primary = 'ident';
    protected $_rowClass = 'Catalogs_Catalog';

    protected $_dependentTables = array('Catalogs', 'Books_Catalogs');
    protected $_referenceMap    = array(
        'Parent'                => array(
            'columns'           => 'parent',
            'refTableClass'     => 'Catalogs',
            'refColumns'        => 'ident',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function findByIdent($ident) {
        return $this->fetchRow($this->select()->where('ident = ?', $ident));
    }

    public function selectRoots() {
        return $this->fetchAll($this->select()->where('parent IS NULL'));
    }

    public function selectElementsByRoot($root) {
        return $this->fetchAll($this->select()->where('root = ?', $root)->order('code ASC')->order('label ASC'));
    }
}
