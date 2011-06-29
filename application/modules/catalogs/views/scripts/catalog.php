<div class="element catalog" name="catalog_<?php echo $this->catalog->ident ?>" rel="#catalog_info">
    <div class="photo" style="float:left; padding: 0em 1.0em 0em 0.3em;">
        <img src="<?php echo $this->catalog->getUrlPhoto() ?>" alt="<?php echo $this->catalog->label ?>" title="<?php echo $this->catalog->label ?>" />
    </div>
    <div>
        <p>
            <span class="bold"><?php echo $this->none($this->catalog->label) ?></span>
            <?php echo $this->catalog->description ?>
        </p>
    </div>
</div>
