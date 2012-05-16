<div id="classic">
    <?php echo $this->partial('books/views/scripts/book/header.php', array('user' => $this->user, 'book' => $this->book, 'file' => $this->file, 'translate' => $this->translate)) ?>
    <h2><?php echo $this->catalog->label ?></h2>
    <form method="post" action="" accept-charset="utf-8">
        <table>
        <?php foreach ($this->catalogs as $catalog) { ?>
            <tr>
                <td><?php echo $catalog->label ?></td>
                <td style="text-align: right;"><input name="catalogs[<?php echo $catalog->ident ?>]" type="checkbox" <?php echo in_array($catalog->ident, $this->book_catalogs) ? 'checked="checked"':'' ?>/></td>
            </tr>
        <?php } ?>
            <tr>
                <td>&nbsp;</td>
                <td style="text-align: right;"><input type="submit" value="<?php echo $this->translate->_('Update') ?>" /></td>
            </tr>
        </table>
    </form>
</div>
