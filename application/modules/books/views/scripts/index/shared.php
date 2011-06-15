<h1>Books shared</h1>
<form method="post" action="" accept-charset="utf-8">
    <div class="tool-panel">
        <input type="submit" name="delete" value="Unpublish" />
    </div>
    <table>
        <tr>
            <th style="width:20px;">&nbsp;</th>
            <th style="width:30px;"><img src="/media/img/icons/book_edit.png" alt="" title="" /></th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Language</th>
            <th>Path</th>
            <th style="width:30px;"><img src="/media/img/icons/photo.png" alt="" title="" /></th>
        </tr>
        <?php foreach ($this->books as $key => $book) { ?>
            <tr class="<?= $key % 2 == 0 ? 'even' : 'odd' ?>">
                <td class="center"><input type="checkbox" name="books[]" value="<?php echo $book->book ?>" /></td>
                <td class="center">
                    <a class="update_book" name="edit_<?php echo $book->book ?>" rel="#update_book"><img src="/media/img/icons/pencil.png" alt="Edit" title="Edit" /></a>
                </td>
                <td class="left"><?php echo $book->title ?></td>
                <td class="left"><?php echo $book->author ?></td>
                <td class="left"><?php echo $book->publisher ?></td>
                <td class="left"><?php echo $book->language ?></td>
                <td class="left"><?php echo $book->getPath() ?></td>
                <td class="center">
                <?php if ($book->avatar) { ?>
                    <img src="/media/img/icons/tick.png" alt="Yes" title="Yes" />
                <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="tool-panel">
        <input type="submit" name="delete" value="Unpublish" />
    </div>
</form>

<div class="overlay" id="update_book">
    <div style="float:left; margin: 0em 1.3em 0em 0em; width: 400px;">
        <img id="thumb" src="" alt="" title="" />
    </div>
    <div style="float:left;">
        <h1>Book information</h1>
        <div id="form"><?php echo $this->form ?></div>
    </div>
</div>
