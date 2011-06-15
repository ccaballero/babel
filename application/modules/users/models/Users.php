<?php

class Users extends Babel_Models_Table
{
    protected $_name = 'babel_users';
    protected $_primary = 'ident';
    protected $_rowClass = 'Users_User';

    public function findByIdent($ident) {
        return $this->fetchRow($this->select()->where('ident = ?', $ident));
    }
}
