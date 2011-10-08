<h1><?php echo $this->translate->_('Books directories') ?></h1>
<div id="wall">
    <div id="column1">
    <?php foreach ($this->bookstores as $i => $bookstore) { ?>
        <a class="list<?php echo ($i == $this->bookstore) ? ' active' : '' ?>"
           href="<?php echo $this->url(array('bookstore' => $i), 'books_examine') ?>"><?php echo $bookstore ?></a>
    <?php } ?>
    </div>
    <div id="column2">
    <?php foreach ($this->directories as $i => $directory) { ?>
        <a class="list<?php echo ($i == $this->directory) ? ' active' : '' ?>"
           href="<?php echo $this->url(array('bookstore' => $this->bookstore, 'directory' => $i), 'books_examine') ?>"><?php echo $directory ?></a>
    <?php } ?>
    </div>
    <div id="column3">
        <form method="post" action="" accept-charset="utf-8">
            <div class="tool-panel">
                <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
                <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
            </div>
            <table>
                <tr>
                    <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
                    <th><?php echo $this->translate->_('Directory') ?></th>
                    <th><?php echo $this->translate->_('File') ?></th>
                    <th><?php echo $this->translate->_('MD5') ?></th>
                    <th><?php echo $this->translate->_('Size') ?></th>
                    <th style="width:30px;"><img src="/media/img/icons/book.png" alt="" title="" /></th>
                    <th style="width:30px;"><img src="/media/img/icons/eye.png" alt="" title="" /></th>
                </tr>
            <?php foreach ($this->books as $i => $book) { ?>
                <tr class="<?= $i % 2 == 0 ? 'even' : 'odd' ?>">
                    <td class="center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>
                    <td class="left"><?php echo $book->directory ?></td>
                    <td class="left"><?php echo $book->file ?></td>
                    <td style="width:180px;" class="left">
                        <?php echo strtolower($book->hash) ?>
                    </td>
                    <td class="center"><?php echo $this->size($book->size) ?></td>
                    <td>
                    <?php if ($book->inCollection()) { ?>
                        <img src="/media/img/icons/tick.png" alt="" title="" />
                    <?php } ?>
                    <?php if (isset($this->warnings[$book->getPath()])) { ?>
                        <img src="/media/img/icons/error.png"
                             alt="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>"
                             title="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($book->isShared()) { ?>
                        <img src="/media/img/icons/tick.png" alt="" title="" />
                    <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </table>
            <div class="tool-panel">
                <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
                <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
            </div>
        </form>
    </div>
</div>
