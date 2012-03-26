<?php

class Babel_Helpers_Translations
{
    public function translations() {
        $i18n = APPLICATION_PATH . '/../data/i18n/';
        $langs = array();
        
        $files = @scandir($i18n);
        foreach ($files as $file) {
            if (is_file($i18n . $file) && substr($file, -4) == '.csv') {
                $langs[] = substr($file, 0, -4);
            }
        }
        
        return $langs;
    }
}
