<?php

class Users_FTP extends Babel_Models_Table
{
    protected $_name = 'babel_users_ftp';
    protected $_primary = 'user';

    protected $_referenceMap    = array(
        'User'               => array(
            'columns'           => 'user',
            'refTableClass'     => 'Users',
            'refColumns'        => 'ident',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function findByUser($user) {
        return $this->fetchRow($this->select()->where('user = ?', $user));
    }
}
