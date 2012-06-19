<?php

class Babel_Utils_FTPDirectoryManager
{
    public static function createAccount($username) {
        $config = Zend_Registry::get('Config');

        $ftp = $config->babel->properties->ftp;
        $ftp_dir = $ftp->root . DIRECTORY_SEPARATOR . $ftp->prefix . $username;
        
        $flag = true;
        if (!file_exists($ftp_dir)) {
            $flag = mkdir($ftp_dir);
        }

        if ($flag) {
            $books_dir = $ftp_dir . DIRECTORY_SEPARATOR . 'books';
            if (!file_exists($books_dir)) {
                @mkdir($ftp_dir . DIRECTORY_SEPARATOR . 'books');
                @chmod($ftp_dir . DIRECTORY_SEPARATOR . 'books', 0777);
            }

            $terms_from = $config->babel->static->terms;
            $terms_to = $ftp_dir . DIRECTORY_SEPARATOR . 'terminos de uso';
            if (!file_exists($terms_to) && file_exists($terms_from)) {
                copy($terms_from, $terms_to);
            }

            $privacy_from = $config->babel->static->privacy;
            $privacy_to = $ftp_dir . DIRECTORY_SEPARATOR . 'politica de privacidad';
            if (!file_exists($privacy_to) && file_exists($privacy_from)) {
                copy($privacy_from, $privacy_to);
            }
        }
        
        return $flag;
    }
}
