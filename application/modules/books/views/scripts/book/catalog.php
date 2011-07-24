<div id="classic">
    <h1><?php echo $this->book->title ?></h1>
    <div class="photo">
        <img src="/media/img/books/<?php echo $this->book->book ?>.png" alt="" title="" />
    </div>
    <div>
        <p><span class="bold"><?php echo $this->translate->_('Title') ?>:</span> <?php echo $this->none($this->book->title) ?></p>
        <p><span class="bold"><?php echo $this->translate->_('Author') ?>:</span> <?php echo $this->book->author ?></p>
        <p><span class="bold"><?php echo $this->translate->_('Publisher') ?>:</span> <?php echo $this->book->publisher ?></p>
        <p><span class="bold"><?php echo $this->translate->_('Language') ?>:</span> <?php echo $this->language($this->book->language) ?></p>
        <p><span class="bold"><?php echo $this->translate->_('Year') ?>:</span> <?php echo $this->none($this->book->year) ?></p>

        <h2><?php echo $this->translate->_('Catalogs') ?>:</h2>
        <form method="post" action="" accept-charset="utf-8">
            <table>
        <?php foreach ($this->roots as $root) { ?>
                <tr>
                    <td><?php echo $root->label ?></td>
                    <td><?php echo $this->catalogs($root->ident, $this->catalogs) ?></td>
                </tr>
        <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="<?php echo $this->translate->_('Update') ?>" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
