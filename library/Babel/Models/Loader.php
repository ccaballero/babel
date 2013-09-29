<?php

class Babel_Models_Loader implements Zend_Loader_Autoloader_Interface
{
    public function autoload($class) {
        $position = strpos($class, '_');
        if (empty($position)) {
            $module = strtolower($class);
        } else {
            $module = strtolower(substr($class, 0, $position));
        }
        Zend_Loader::loadClass($class,
            APPLICATION_PATH . '/apps/' . $module . '/models');
    }
}
