<?php

class Yachay_Helpers_Iconv
{
    public function iconv($string) {
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($a), $b);
        $string = strtolower($string);
        $string = utf8_encode($string);

        $translit = @iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $search = array('/[^a-z0-9]/', '/--+/', '/^-+/', '/-+$/');
        $replace = array('-', '-', '', '');
        return preg_replace($search, $replace, strtolower($translit));
    }
}
