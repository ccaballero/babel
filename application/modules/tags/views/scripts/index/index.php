<?php if (!empty($this->catalogs)) { ?>
    <?php foreach ($this->catalogs as $catalog) { ?>
        <div class="tag">
            <a href="<?php echo $this->url(array('catalog' => $catalog['ident']), 'catalogs_catalog_view') ?>"><?php echo $catalog['label'] . ' (' . $catalog['books'] . ')' ?></a>
        </div>
    <?php } ?>
<?php } else { ?>
    <div id="classic"><p><?php echo $this->translate->_('No tags founded') ?></p></div>
<?php } ?>
