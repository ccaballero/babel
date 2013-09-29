<div class="element catalog <?php echo ($this->user->ident == $this->catalog->owner) ? 'author' : '' ?>" name="catalog_<?php echo $this->catalog->ident ?>" rel="#catalog_info">
    <h2><a href="<?php echo $this->url(array('catalog' => $this->catalog->ident), 'catalogs_catalog_view') ?>"><?php echo $this->escape($this->catalog->label) ?> (<?php echo $this->catalog->getStats()->books ?>)</a></h2>
    <p>
    <?php if ($this->catalog->parent == null) { ?>
        <?php if ($this->catalog->mode == 'open') { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/key.png') ?>" alt="<?php echo $this->translate->_('Catalog opened') ?>" title="<?php echo $this->translate->_('Catalog opened') ?>" />
        <?php } else { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/lock.png') ?>" alt="<?php echo $this->translate->_('Catalog closed') ?>" title="<?php echo $this->translate->_('Catalog closed') ?>" />
        <?php } ?>
        <?php if ($this->catalog->type == 't') { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/arrow_join.png') ?>" alt="<?php echo $this->translate->_('Taxonomy') ?>" title="<?php echo $this->translate->_('Taxonomy') ?>" />
        <?php } else { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/arrow_divide.png') ?>" alt="<?php echo $this->translate->_('Folksonomy') ?>" title="<?php echo $this->translate->_('Folksonomy') ?>" />
        <?php } ?>
    <?php } ?>
        <?php if ($this->user->ident == $this->catalog->owner) { ?>
            <a class="update_catalog" name="edit_<?php echo $this->catalog->ident ?>" rel="#new_catalog"><img src="<?php echo $this->baseUrl('/media/img/icons/pencil.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Edit') ?>" /></a>
            <a href="<?php echo $this->url(array('catalog' => $this->catalog->ident), 'catalogs_catalog_delete') ?>" onclick="return confirm('<?php echo $this->translate->_('You will delete the catalog and all internal catalogs. Are you sure?') ?>');"><img src="<?php echo $this->baseUrl('/media/img/icons/delete.png') ?>" alt="<?php echo $this->translate->_('Delete') ?>" title="<?php echo $this->translate->_('Delete') ?>" /></a>
        <?php } ?>
    </p>
</div>
