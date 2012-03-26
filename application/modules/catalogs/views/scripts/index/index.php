<h1><?php echo $this->translate->_('Catalogs') ?></h1>
<div id="list">
    <?php foreach ($this->catalogs as $catalog) { ?>
        <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('user' => $this->user, 'catalog' => $catalog, 'translate' => $this->translate)) ?>
    <?php } ?>
    <?php if ($this->auth->hasIdentity()) { ?>
        <?php echo $this->partial('catalogs/views/scripts/new.php', array('translate' => $this->translate)) ?>
    <?php } ?>
</div>

<?php if ($this->auth->hasIdentity()) { ?>
    <?php echo $this->partial('catalogs/views/scripts/info.php', array('form' => $this->form, 'translate' => $this->translate)) ?>
<?php } ?>
