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

<div class="overlay" id="book_info">
    <div style="float:left; margin: 0em 1.3em 0em 0em; width: 400px;">
        <img id="thumb" src="" alt="" title="" />
    </div>
    <div style="float:left; width: 200px;">
        <h1 id="book_title"></h1>
        <div>
            <p><span class="bold">Author: </span><span id="book_author" class="italic"></span></p>
            <p><span class="bold">Publisher: </span><span id="book_publisher" class="italic"></span></p>
            <p><span class="bold">Language: </span><span id="book_language" class="italic"></span></p>
        </div>
        <div style="margin: 1.2em 0em 0em 0em;">
            <a id="book_download" href="" target="_BLANK"><img src="/media/img/icons/basket_put.png" alt="Download" title="Download" /></a>
            (<span id="book_downloads_number"></span>)
        </div>
    </div>
</div>
