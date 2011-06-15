<?php

abstract class Babel_Models_Table extends Zend_Db_Table_Abstract
{
    public function __construct() {
        $db = Zend_Db_Table::getDefaultAdapter();
        parent::__construct(array('db' => $db));
    }
}
