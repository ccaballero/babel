<?php

class Babel_Helpers_CheckCollection
{
    public function checkCollection($hash) {
        $model_books = new Books_Collection();
        $book = $model_books->findByHash($hash);
        return !empty($book);
    }
}
