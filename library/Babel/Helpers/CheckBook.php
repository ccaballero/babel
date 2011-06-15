<?php

class Babel_Helpers_CheckBook
{
    public function checkBook($md5) {
        $model_books = new Books();
        $book = $model_books->findByMD5($md5);
        return !empty($book);
    }
}
