<h1><?php echo $this->translate->_('Books directories') ?></h1>
<div id="wall">
    <div id="column1">
    <?php foreach ($this->bookstores as $i => $bookstore) { ?>
        <div class="vertical tag<?php echo ($i == $this->bookstore) ? ' active' : '' ?>">
            <a href="<?php echo $this->url(array('bookstore' => $i), 'books_examine') ?>"><?php echo $bookstore ?></a>
        </div>
    <?php } ?>
    </div>
    <div id="column2">
    <?php foreach ($this->directories as $i => $directory) { ?>
        <div class="vertical tag<?php echo ($i == $this->directory) ? ' active' : '' ?>">
            <a href="<?php echo $this->url(array('bookstore' => $this->bookstore, 'directory' => $i), 'books_examine') ?>"><?php echo $directory ?></a>
        </div>
    <?php } ?>
    </div>
    <div id="column3">
        <table>
            <tr>
                <th style="width:20px;">&nbsp;</th>
                <th><?php echo $this->translate->_('Directory') ?></th>
                <th><?php echo $this->translate->_('File') ?></th>
            </tr>
        <?php foreach ($this->books as $i => $book) { ?>
            <tr class="<?= $i % 2 == 0 ? 'even' : 'odd' ?>">
                <td>&nbsp;</td>
                <td><?php echo $book['directory'] ?></td>
                <td><?php echo $book['file'] ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
</div>



<?php /*
<form method="post" action="" accept-charset="utf-8">
    <div class="tool-panel">
        <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
    <table>
        <tr>
            <th style="width:20px;">&nbsp;</th>
            <th><?php echo $this->translate->_('Directory') ?></th>
            <th><?php echo $this->translate->_('File') ?></th>
            <th><?php echo $this->translate->_('MD5') ?></th>
            <th><?php echo $this->translate->_('Size') ?></th>
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
                            <img style="float:right;" src="/media/img/icons/error.png" alt="<?php echo $this->translate->_('Filename repeated') ?>" title="<?php echo $this->translate->_('Filename repeated') ?>" />
                        <?php } ?>
                    </td>
                    <td class="left">
                        <?php echo strtoupper($book->md5_path) ?>
                        <?php if (!$this->warnings_md5_files[$book->md5_file]) { ?>
                            <img style="float:right;" src="/media/img/icons/error.png" alt="<?php echo $this->translate->_('Repeated checksum') ?>" title="<?php echo $this->translate->_('Repeated checksum') ?>" />
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
        <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
        <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    </div>
</form>
*/ ?>
