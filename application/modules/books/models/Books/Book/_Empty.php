<?php

class Books_Book_Empty
{
    public function getUrlPhoto() {
        if ($this->avatar) {
            return '/media/img/thumbnails/books/' . $this->book . '.jpg';
        } else {
            return '/media/img/user.png';
        }
    }
}
