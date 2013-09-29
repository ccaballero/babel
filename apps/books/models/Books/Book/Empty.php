<?php

class Books_Book_Empty
{
    public function hasThumb() {
        return file_exists(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $this->book . '-small.jpg');
    }

    public function getUrlPhoto() {
        if ($this->hasThumb()) {
            return '/media/img/thumbnails/books/' . $this->book . '-small.jpg';
        } else {
            return '/media/img/book_default-small.jpg';
        }
    }
}
