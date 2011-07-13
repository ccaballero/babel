<h1><?php echo $this->catalog->label ?></h1>
<div id="breadcrumb">
    <a href="<?php echo $this->url(array(), 'catalogs') ?>">Catalogs</a>
    <?php foreach ($this->breadcrumb($this->catalog) as $catalog) { ?>
        <a href="<?php echo $this->url(array('catalog' => $catalog->ident), 'catalogs_catalog_view') ?>"><?php echo $catalog->label ?></a>
    <?php } ?>
</div>
<div id="list">
    <?php foreach ($this->catalogs as $catalog) { ?>
        <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('catalog' => $catalog)) ?>
    <?php } ?>
    <?php if ($this->auth->hasIdentity()) { ?>
        <?php echo $this->partial('catalogs/views/scripts/new.php') ?>
    <?php } ?>
</div>

<?php if ($this->auth->hasIdentity()) { ?>
<div class="overlay" id="new_catalog">
    <h1>New catalog</h1>
    <div id="form"><?php echo $this->form ?></div>
</div>
<?php } ?>
