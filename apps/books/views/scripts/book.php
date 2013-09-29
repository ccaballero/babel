<div class="element book" name="book_<?php echo $this->book->book ?>" rel="#book_info">
    <div class="photo">
        <img src="<?php echo $this->baseUrl($this->book->getUrlPhoto()) ?>" alt="" title="" />
    </div>
    <div class="details">
        <h1><?php echo $this->none($this->book->title) ?></h1>
    <?php if (!empty($this->book->author)) { ?>
        <h2><?php echo $this->book->author ?></h2>
    <?php } ?>
    </div>
</div>
