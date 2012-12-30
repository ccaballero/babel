<div id="form"><?php echo $this->form ?></div>

<div id="list">
<?php if (count($this->books) <> 0) { ?>
    <?php foreach($this->books as $book) { ?>
        <?php echo $this->partial('books/views/scripts/book.php', array('book' => $book, 'translate' => $this->translate)) ?>
    <?php } ?>
<?php } else { ?>
    <p class="description"><?php echo $this->translate->_('No results found') ?></p>
<?php } ?>
</div>

<?php echo $this->partial('books/views/scripts/info.php', array('translate' => $this->translate)) ?>
