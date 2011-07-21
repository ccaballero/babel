<h1><?php echo $this->translate->_('Books collection') ?></h1>
<form method="post" action="" accept-charset="utf-8">
    <div class="tool-panel">
        <input type="submit" name="add" value="<?php echo $this->translate->_('Share to everybody') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
    <table>
        <tr>
            <th style="width:20px;">&nbsp;</th>
            <th style="width:30px;"><img src="/media/img/icons/book_edit.png" alt="" title="" /></th>
            <th><?php echo $this->translate->_('Directory') ?></th>
            <th><?php echo $this->translate->_('File') ?></th>
            <th style="width:30px;"><img src="/media/img/icons/database.png" alt="" title="" /></th>
            <th style="width:30px;"><img src="/media/img/icons/eye.png" alt="" title="" /></th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach ($this->books as $bookstore => $books) { ?>
            <?php if (count($books) > 0) { ?>
            <tr class="title color5">
                <td class="center"><input type="checkbox" name="groupall" class="ratio-<?php echo $i ?>" /></td>
                <td colspan="5"><?php echo $bookstore ?></td>
            </tr>
            <?php foreach($books as $key => $book) { ?>
                <tr class="<?= $key % 2 == 0 ? 'even' : 'odd' ?>">
                    <td class="center"><input type="checkbox" class="ratio-<?php echo $i ?>" name="books[]" value="<?php echo $book->ident ?>" /></td>
                    <td class="center">
                        <a class="update_file" name="edit_<?php echo $book->ident ?>" rel="#update_file"><img src="/media/img/icons/pencil.png" alt="<?php echo $this->translate->_('Edit') ?>" title="Edit" /></a>
                    </td>
                    <td class="left"><?php echo $book->directory ?></td>
                    <td class="left"><?php echo $book->file ?></td>
                    <td class="center">
                    <?php if ($book->inDisk()) { ?>
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
        <?php } ?>
    </table>
    <div class="tool-panel">
        <input type="submit" name="add" value="<?php echo $this->translate->_('Share to everybody') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
</form>

<div class="overlay" id="update_file">
    <h1><?php echo $this->translate->_('Edit information') ?></h1>
    <div id="form"><?php echo $this->form ?></div>
</div>
