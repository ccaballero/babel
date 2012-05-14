<div class="element catalog <?php echo ($this->user->ident == $this->catalog->owner) ? 'author' : '' ?>" name="catalog_<?php echo $this->catalog->ident ?>" rel="#catalog_info">
    <div class="photo" style="float:left; padding: 0em 1.0em 0em 0.3em; width: 100px; height: 100px;">
        <a href="<?php echo $this->url(array('catalog' => $this->catalog->ident), 'catalogs_catalog_view') ?>"><img src="<?php echo $this->baseUrl($this->catalog->getUrlPhoto()) ?>" alt="<?php echo $this->escape($this->catalog->label) ?>" title="<?php echo $this->escape($this->catalog->label) ?>" /></a>
    </div>
    <div>
        <h2><a href="<?php echo $this->url(array('catalog' => $this->catalog->ident), 'catalogs_catalog_view') ?>"><?php echo $this->escape($this->catalog->label) ?> (<?php echo $this->catalog->getStats()->books ?>)</a></h2>
    <p style="margin-top: 0.5em;">
        <?php if ($this->catalog->mode == 'open') { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/lock_open.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Catalog opened') ?>" />
        <?php } else { ?>
            <img src="<?php echo $this->baseUrl('/media/img/icons/lock.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Catalog closed') ?>" />
        <?php } ?>
        <?php if ($this->user->ident == $this->catalog->owner) { ?>
            <a class="update_catalog" name="edit_<?php echo $this->catalog->ident ?>" rel="#new_catalog"><img src="<?php echo $this->baseUrl('/media/img/icons/pencil.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Edit') ?>" /></a>
        <?php } ?>
    </p>
    </div>
</div>
