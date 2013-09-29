<div id="classic">
    <h1><?php echo $this->book->title ?></h1>

    <div id="thumb"><img src="<?php echo $this->file->getUrlPhoto() ?>" alt="" title="" /></div>

    <div id="details">
        <?php echo $this->partial('books/views/scripts/book/header.php', array(
            'user' => $this->user, 
            'book' => $this->book, 
            'file' => $this->file, 
            'translate' => $this->translate,
            'auth' => $this->auth
        )) ?>

    <?php if (!empty($this->taxonomies)) { ?>
        <h2><?php echo $this->translate->_('Taxonomies') ?>:</h2>
        <form id="form" method="post" action="" accept-charset="utf-8">
            <table>
            <?php foreach ($this->taxonomies as $root) { ?>
                <?php if (!empty($this->availables[$root->ident])) { ?>
                <tr>
                    <td style="padding-right: 20px;"><?php echo $root->label ?>:</td>
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
                    <td colspan="2" class="text-right"><input type="submit" value="<?php echo $this->translate->_('Update') ?>" /></td>
                </tr>
            </table>
        </form>
    <?php } ?>

    <?php if (!empty($this->folksonomies)) { ?>
        <h2><?php echo $this->translate->_('Folksonomies') ?>:</h2>
        <table>
        <?php foreach ($this->folksonomies as $root) { ?>
            <tr>
                <td style="padding-right: 20px;"><?php echo $root->label ?>:</td>
                <td><button onclick="javascript:location.href='<?php echo $this->url(array('book' => $this->file->hash, 'catalog' => $root->ident), 'books_book_folksonomy') ?>';"><?php echo $this->translate->_('Update') ?></button></td>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>
    </div>
    
    <div class="clear"></div>
</div>
