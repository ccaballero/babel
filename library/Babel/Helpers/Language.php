<?php

class Babel_Helpers_Language
{
    public function language($language) {
        $translate = Zend_Registry::get('Zend_Translate');

        switch ($language) {
            case 'EN': return $translate->_('English');
            case 'ES': return $translate->_('Spanish');
            default: return '';
        }
    }
}
