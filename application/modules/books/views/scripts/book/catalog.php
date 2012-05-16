<div id="classic">
    <?php echo $this->partial('books/views/scripts/book/header.php', array('user' => $this->user, 'book' => $this->book, 'file' => $this->file, 'translate' => $this->translate)) ?>

    <?php if (!empty($this->taxonomies)) { ?>
        <h2><?php echo $this->translate->_('Taxonomies') ?>:</h2>
        <form method="post" action="" accept-charset="utf-8">
            <table>
            <?php foreach ($this->taxonomies as $root) { ?>
                <?php if (!empty($this->availables[$root->ident])) { ?>
                <tr>
                    <td><?php echo $root->label ?></td>
                    <td>
                        <select name="catalogs[<?php echo $root->ident ?>]">
                            <option value="0">----------</option>
                        <?php foreach ($this->availables[$root->ident] as $catalog) { ?>
                            <option value="<?php echo $catalog->ident ?>"<?php echo (in_array($catalog->ident, $this->assigned)) ? ' selected="selected"':'' ?>><?php echo (!is_null($catalog->code)) ? $catalog->code . ' - ':'' ?><?php echo $catalog->label ?></option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: right;"><input type="submit" value="<?php echo $this->translate->_('Update') ?>" /></td>
                </tr>
            </table>
        </form>
    <?php } ?>

    <?php if (!empty($this->folksonomies)) { ?>
        <h2><?php echo $this->translate->_('Folksonomies') ?>:</h2>
        <table>
        <?php foreach ($this->folksonomies as $root) { ?>
            <tr>
                <td><?php echo $root->label ?></td>
                <td><button onclick="javascript:location.href='<?php echo $this->url(array('book' => $this->file->hash, 'catalog' => $root->ident), 'books_book_folksonomy') ?>';"><?php echo $this->translate->_('Update') ?></button></td>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>
    </div>
</div>
