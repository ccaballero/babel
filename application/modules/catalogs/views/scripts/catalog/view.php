<h1><?php echo $this->catalog->label ?></h1>
<div id="breadcrumb">
    <a href="<?php echo $this->url(array(), 'catalogs') ?>">Catalogs</a>
    <?php foreach ($this->breadcrumb($this->catalog) as $catalog) { ?>
        <a href="<?php echo $this->url(array('catalog' => $catalog->ident), 'catalogs_catalog_view') ?>"><?php echo $catalog->label ?></a>
    <?php } ?>
</div>
<div id="list">
    <?php if ($this->auth->hasIdentity()) { ?>
        <?php echo $this->partial('catalogs/views/scripts/new.php') ?>
    <?php } ?>
    <?php foreach ($this->catalogs as $catalog) { ?>
        <?php echo $this->partial('catalogs/views/scripts/catalog.php', array('catalog' => $catalog)) ?>
    <?php } ?>
    <?php foreach ($this->books as $book) { ?>
        <?php echo $this->partial('books/views/scripts/book.php', array('book' => $book)) ?>
    <?php } ?>
</div>

<?php if ($this->auth->hasIdentity()) { ?>
    <?php echo $this->partial('catalogs/views/scripts/info.php', array('form' => $this->form)) ?>
<?php } ?>
<?php echo $this->partial('books/views/scripts/info.php') ?>
