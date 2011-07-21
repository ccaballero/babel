<h1>Catalogs</h1>
<div id="list">
    <?php foreach ($this->catalogs as $catalog) { ?>
        <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('catalog' => $catalog)) ?>
    <?php } ?>
    <?php if ($this->auth->hasIdentity()) { ?>
        <?php echo $this->partial('catalogs/views/scripts/new.php') ?>
    <?php } ?>
</div>

<?php if ($this->auth->hasIdentity()) { ?>
    <?php echo $this->partial('catalogs/views/scripts/info.php', array('form' => $this->form)) ?>
<?php } ?>
