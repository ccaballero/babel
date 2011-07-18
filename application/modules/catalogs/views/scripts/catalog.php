<a href="<?php echo $this->url(array('catalog' => $this->catalog->ident), 'catalogs_catalog_view') ?>">
<div class="element catalog" name="catalog_<?php echo $this->catalog->ident ?>" rel="#catalog_info">
    <div class="photo" style="float:left; padding: 0em 1.0em 0em 0.3em;">
        <img src="<?php echo $this->catalog->getUrlPhoto() ?>" alt="<?php echo $this->catalog->label ?>" title="<?php echo $this->catalog->label ?>" />
    </div>
    <div>
        <h2><?php echo $this->catalog->label ?></h2>
        <p>(<?php echo $this->catalog->getStats()->books ?>)</p>
    </div>
</div>
</a>
