<div id="form"><?php echo $this->form ?></div>

<?php if (count($this->books) <> 0) { ?>
<div id="list">
    <?php foreach($this->books as $book) { ?>
        <?php echo $this->partial('books/views/scripts/book.php', array('book' => $book)) ?>
    <?php } ?>
</div>
<?php } else { ?>
    <p>No results found</p>
<?php } ?>

<?php echo $this->partial('books/views/scripts/info.php') ?>
