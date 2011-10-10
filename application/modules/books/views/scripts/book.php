<div class="element book" name="book_<?php echo $this->book->book ?>" rel="#book_info">
    <div class="photo" style="float:left; margin: 0em 1.0em 0em 0em; height: 100px; width: 85px; background-image: url('<?php echo $this->book->getUrlPhoto() ?>')"></div>
    <div>
        <p><span class="bold"><?php echo $this->translate->_('Title') ?>:</span> <?php echo $this->none($this->book->title) ?></p>
    <?php if (!empty($this->book->author)) { ?>
        <p><span class="bold"><?php echo $this->translate->_('Author') ?>:</span> <?php echo $this->book->author ?></p>
    <?php } ?>
    </div>
</div>
