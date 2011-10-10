<h1><?php echo $this->translate->_('Books collection') ?></h1>
<form method="post" action="" accept-charset="utf-8">
    <div class="tool-panel">
        <input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" />
        <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
    <table>
        <tr>
            <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
            <th style="width:30px;"><img src="/media/img/icons/book_edit.png" alt="" title="" /></th>
            <th><?php echo $this->translate->_('Directory') ?></th>
            <th><?php echo $this->translate->_('File') ?></th>
            <th style="width:30px;"><img src="/media/img/icons/database.png" alt="" title="" /></th>
            <th style="width:30px;"><img src="/media/img/icons/transmit_blue.png" alt="" title="" /></th>
        </tr>
        <?php foreach ($this->books as $i => $book) { ?>
            <tr class="<?= $i % 2 == 0 ? 'even' : 'odd' ?>">
                <td class="center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>
                <td class="center">
                    <a class="update_file" name="edit_<?php echo $book->hash ?>" rel="#update_file"><img src="/media/img/icons/pencil.png" alt="<?php echo $this->translate->_('Edit') ?>" title="Edit" /></a>
                </td>
                <td class="left"><?php echo $book->directory ?></td>
                <td class="left"><?php echo $book->file ?></td>
                <td class="center">
                <?php if ($book->inDisk()) { ?>
                    <img src="/media/img/icons/tick.png" alt="" title="" />
                <?php } else { ?>
                    <img src="/media/img/icons/cross.png" alt="" title="" />
                <?php } ?>
                </td>
                <td class="center">
                    <?php if ($book->inSearch()) { ?>
                        <img src="/media/img/icons/tick.png" alt="" title="" />
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="tool-panel">
        <input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" />
        <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
</form>

<div class="overlay" id="update_file">
    <h1><?php echo $this->translate->_('Edit information') ?></h1>
    <div id="form"><?php echo $this->form ?></div>
</div>
