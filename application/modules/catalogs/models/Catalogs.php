<?php

class Catalogs extends Babel_Models_Table
{
    protected $_name = 'babel_catalogs';
    protected $_primary = 'ident';
    protected $_rowClass = 'Catalogs_Catalog';

    public function findByIdent($ident) {
        return $this->fetchRow($this->select()->where('ident = ?', $ident));
    }

    public function findByLabel($label) {
        return $this->fetchRow($this->select()->where('label = ?', $label));
    }

    public function findByUrl($url) {
        return $this->fetchRow($this->select()->where('url = ?', $url));
    }
}
