<?php

class Babel_Helpers_CheckCollection
{
    public function checkCollection($md5) {
        $model_books = new Books_Collection();
        $book = $model_books->findByMD5($md5);
        return !empty($book);
    }
}
