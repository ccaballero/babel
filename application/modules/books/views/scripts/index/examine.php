<h1>Books directories</h1>
<form method="post" action="" accept-charset="utf-8">
    <div class="tool-panel">
        <input type="submit" name="add" value="Add to collection" />
        <input type="submit" name="delete" value="Remove from collection" />
    </div>
    <table>
        <tr>
            <th style="width:20px;">&nbsp;</th>
            <th>Directory</th>
            <th>File</th>
            <th>MD5</th>
            <th>Size</th>
            <th style="width:30px;"><img src="/media/img/icons/book.png" alt="" title="" /></th>
            <th style="width:30px;"><img src="/media/img/icons/eye.png" alt="" title="" /></th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach($this->books as $bookstore => $books) { ?>
            <tr class="title color5">
                <td class="center"><input type="checkbox" name="groupall" class="ratio-<?php echo $i ?>" /></td>
                <td colspan="6"><?php echo $bookstore ?></td>
            </tr>
            <?php foreach($books as $key => $book) { ?>
                <tr class="<?= $key % 2 == 0 ? 'even' : 'odd' ?>">
                    <td class="center"><input type="checkbox" class="ratio-<?php echo $i ?>" name="books[]" value="<?php echo $book->md5_path ?>" /></td>
                    <td class="left"><?php echo $book->bookstore . '/' . $book->directory ?></td>
                    <td class="left">
                        <?php echo $book->file ?>
                        <?php if (!$this->warnings_filenames[$book->file]) { ?>
                            <img style="float:right;" src="/media/img/icons/error.png" alt="" title="" />
                        <?php } ?>
                    </td>
                    <td class="left">
                        <?php /*echo strtoupper($book->md5_file) */?>
                        <?php echo strtoupper($book->md5_path) ?>
                        <?php if (!$this->warnings_md5_files[$book->md5_file]) { ?>
                            <img style="float:right;" src="/media/img/icons/error.png" alt="" title="" />
                        <?php } ?>
                    </td>
                    <td class="right"><?php echo $this->size($book->size) ?></td>
                    <td class="center">
                        <?php if ($book->inCollection()) { ?>
                            <img src="/media/img/icons/tick.png" alt="" title="" />
                        <?php } ?>
                    </td>
                    <td class="center">
                        <?php if ($book->isShared()) { ?>
                            <img src="/media/img/icons/tick.png" alt="" title="" />
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            <?php $i++ ?>
        <?php } ?>
    </table>
    <div class="tool-panel">
        <input type="submit" name="add" value="Add to collection" />
        <input type="submit" name="delete" value="Remove from collection" />
    </div>
</form>
