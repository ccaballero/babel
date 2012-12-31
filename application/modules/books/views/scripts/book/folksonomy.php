<div id="classic">
    <h1><?php echo $this->book->title ?></h1>

    <div id="thumb"><img src="<?php echo $this->file->getUrlPhoto() ?>" alt="" title="" /></div>

    <div id="details">
        <?php echo $this->partial('books/views/scripts/book/header.php', array(
            'user' => $this->user, 
            'book' => $this->book, 
            'file' => $this->file, 
            'translate' => $this->translate)
        ) ?>

        <h2><?php echo $this->catalog->label ?></h2>
        <form id="form" method="post" action="" accept-charset="utf-8">
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
    
    <div class="clear"></div>
</div>
