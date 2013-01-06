<?php echo $this->partial('books/views/scripts/book/tools.php', array(
    'user' => $this->user, 
    'book' => $this->book, 
    'file' => $this->file, 
    'translate' => $this->translate,
    'auth' => $this->auth
)) ?>

<div>
    <dl>
        <dt><?php echo $this->translate->_('Author') ?>:</dt>
        <dd><?php echo $this->none($this->book->author) ?></dd>
        <dt><?php echo $this->translate->_('Publisher') ?>:</dt>
        <dd><?php echo $this->none($this->book->publisher) ?></dd>
        <dt><?php echo $this->translate->_('Language') ?>:</dt>
        <dd><?php echo $this->none($this->language($this->book->language)) ?></dd>
        <dt><?php echo $this->translate->_('Year') ?>:</dt>
        <dd><?php echo $this->none($this->book->year) ?></dd>
    </dl>
</div>

<div>
    <dl>
        <dt><?php echo $this->translate->_('Size') ?>:</dt>
        <dd><?php echo $this->size($this->file->size) ?></dd>
        <dt><?php echo $this->translate->_('Number of pages') ?>:</dt>
        <dd><?php echo $this->pages($this->file->getPath()) ?></dd>
    </dl>
</div>
