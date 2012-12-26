<?php if (!empty($this->catalogs)) { ?>
    <h1><?php echo $this->translate->_('Tags') ?></h1>
    <?php foreach ($this->catalogs as $catalog) { ?>
        <div class="tag">
            <a href="<?php echo $this->url(array('catalog' => $catalog['ident']), 'catalogs_catalog_view') ?>"><?php echo $catalog['label'] . ' (' . $catalog['books'] . ')' ?></a>
        </div>
    <?php } ?>
<?php } else { ?>
    <div id="classic">
        <h1><?php echo $this->translate->_('Tags') ?></h1>
        <p><?php echo $this->translate->_('No tags founded') ?></p>
    </div>
<?php } ?>
