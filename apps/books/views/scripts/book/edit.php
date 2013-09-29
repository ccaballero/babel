<div id="classic">
    <h1><?php echo $this->translate->_('Book information') ?></h1>

    <div id="thumb"><img src="<?php echo $this->file->getUrlPhoto() ?>" alt="" title="" /></div>

    <div id="details">
        <?php echo $this->partial('books/views/scripts/book/tools.php', array(
            'user' => $this->user, 
            'book' => $this->book, 
            'file' => $this->file, 
            'translate' => $this->translate,
            'auth' => $this->auth
        )) ?>
        <div id="form"><?php echo $this->form ?></div>
    </div>
</div>