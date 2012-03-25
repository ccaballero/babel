<?php

class Babel_Helpers_CheckBook
{
    public function checkBook($hash) {
        $model_books = new Books();
        $book = $model_books->findByHash($hash);
        return !empty($book);
    }
}
