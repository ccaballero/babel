<div id="classic">
    <h1><?php echo $this->book->title ?></h1>
    
    <div id="details">
        <?php echo $this->partial('books/views/scripts/book/tools.php', array(
            'user' => $this->user, 
            'book' => $this->book, 
            'file' => $this->file, 
            'translate' => $this->translate,
            'auth' => $this->auth
        )) ?>
        <div class="clear"></div>
        
        <div id="preview">
            <div><img src="<?php echo $this->url(array(
                'book' => $this->book->book, 
                'page' => $this->page,
                'height' => 0,
                'width' => 600,
            ), 'books_book_thumb') ?>" alt="" title="" /></div>
        </div>
    </div>

</div>