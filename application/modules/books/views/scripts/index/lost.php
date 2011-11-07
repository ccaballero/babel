<h1><?php echo $this->translate->_('Books lost') ?></h1>
<div id="column3">
    <form method="post" action="" accept-charset="utf-8">
        <div class="tool-panel">
            <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
        </div>
        <table>
            <tr>
                <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
                <th><?php echo $this->translate->_('Directory') ?></th>
                <th><?php echo $this->translate->_('File') ?></th>
                <th style="width:20px;"><img src="/media/img/icons/transmit_blue.png" alt="<?php echo $this->translate->_('Published book') ?>" title="<?php echo $this->translate->_('Published book') ?>" /></th>
                <th style="width:20px;">&nbsp;</th>
            </tr>
            <?php foreach ($this->books as $book) { ?>
                <tr class="<?php echo $this->cycle(array("even", "odd"))->next()?>">
                    <td class="center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>
                    <td class="left"><?php echo $book->directory ?></td>
                    <td class="left"><?php echo $book->file ?></td>
                    <td class="center">
                        <?php if ($book->inSearch()) { ?>
                            <img src="/media/img/icons/tick.png" alt="" title="" />
                        <?php } ?>
                    </td>
                    <td class="center"><a class="update_file" name="edit_<?php echo $book->hash ?>" rel="#update_file"><img src="/media/img/icons/pencil.png" alt="<?php echo $this->translate->_('Edit') ?>" title="Edit" /></a></td>
                </tr>
            <?php } ?>
        </table>
        <div id="box" style="background-color:#000000; background-image: url('/media/img/toolbar.png'); height: 0px;"></div>
        <div class="tool-panel">
            <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
        </div>
    </form>
</div>
<div class="overlay" id="update_file">
    <h1><?php echo $this->translate->_('Edit information') ?></h1>
    <div id="form"><?php echo $this->form ?></div>
</div>
