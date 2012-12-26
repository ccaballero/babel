<?php if (empty($this->catalog)) { ?>
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
<?php } else { ?>
    <div id="breadcrumb">
        <a href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('Catalogs') ?></a>
        <?php foreach ($this->breadcrumb($this->catalog) as $catalog) { ?>
            <a href="<?php echo $this->url(array('catalog' => $catalog->ident), 'catalogs_catalog_view') ?>"><?php echo $catalog->label ?></a>
        <?php } ?>
    </div>
    <h1><?php echo $this->catalog->label ?></h1>
    <p class="description"><?php echo $this->catalog->description ?></p>
    <div id="list">
        <?php foreach ($this->catalogs as $catalog) { ?>
            <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('user' => $this->user, 'catalog' => $catalog, 'translate' => $this->translate)) ?>
        <?php } ?>
        <?php foreach ($this->books as $book) { ?>
            <?php echo $this->partial('books/views/scripts/book.php', array('book' => $book->getMeta(), 'translate' => $this->translate)) ?>
        <?php } ?>
        <?php if ($this->auth->hasIdentity()) { ?>
            <?php if ($this->catalog->mode == 'open' || ($this->catalog->mode == 'close' && $this->catalog->owner == $this->user->ident)) { ?>
                <?php echo $this->partial('catalogs/views/scripts/new.php', array('translate' => $this->translate)) ?>
            <?php } ?>
        <?php } ?>
    </div>
    <?php if ($this->auth->hasIdentity()) { ?>
        <?php echo $this->partial('catalogs/views/scripts/info.php', array('form' => $this->form, 'translate' => $this->translate)) ?>
    <?php } ?>
    <?php echo $this->partial('books/views/scripts/info.php', array('translate' => $this->translate)) ?>
<?php } ?>

<?php if ($this->auth->hasIdentity() && isset($this->overlay)) { ?>
    <?php if (empty($this->catalog) || ($this->catalog->mode == 'open' || ($this->catalog->mode == 'close' && $this->catalog->owner == $this->user->ident))) { ?>
        <?php if ($this->action == 'new') { ?>
            <script type="text/javascript">$(document).ready(function(){$('#catalog_new').click();});</script>
        <?php } else if ($this->action == 'edit') { ?>
            <script type="text/javascript">$(document).ready(function(){$('a[name=edit_'+<?php echo $this->edit ?>+']').click();});</script>
        <?php } ?>
    <?php } ?>
<?php } ?>
