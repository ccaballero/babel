<h1>Catalogs</h1>
<div id="list">
    <?php foreach ($this->catalogs as $catalog) { ?>
        <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('catalog' => $catalog)) ?>
    <?php } ?>
</div>
