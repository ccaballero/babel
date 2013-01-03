<?php $this->placeholder('menubar')->captureStart() ?>
<ul>
    <li class="primary color1">
        <a href="<?php echo $this->url(array(), 'frontpage') ?>"><?php echo $this->translate->_('Search') ?></a>
    </li>

    <li id="catalogs_menu" class="primary color2">
        <a href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('Catalogs') ?></a>
    </li>
    <li class="catalogs_item <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('List') ?></a>
    </li>
    <li class="catalogs_item <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'tags') ?>"><?php echo $this->translate->_('Tagcloud') ?></a>
    </li>
<?php if ($this->auth->hasIdentity()) { ?>
    <li id="users_menu" class="primary color3">
        <a href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('Users') ?></a>
    </li>
    <li class="users_item <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('List') ?></a>
    </li>
    <li class="users_item <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'users_new') ?>"><?php echo $this->translate->_('Add') ?></a>
    </li>
<?php if ($this->auth->hasIdentity()) { ?>
    <li id="books_menu" class="primary color4">
        <a href="<?php echo $this->url(array(), 'books_examine') ?>"><?php echo $this->translate->_('Books') ?></a>
    </li>
    <?php if ($this->user->role == 'admin') { ?>
    <li class="books_item <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'books_examine') ?>"><?php echo $this->translate->_('Files') ?></a>
    </li>
    <?php } ?>
    <li class="books_item <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'books_published') ?>"><?php echo $this->translate->_('Published') ?></a>
    </li>
    <?php if ($this->user->role == 'admin') { ?>
    <li class="books_item <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'books_lost') ?>"><?php echo $this->translate->_('Lost') ?></a>
    </li>
    <?php } ?>
    <li class="books_item <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'books_export') ?>"><?php echo $this->translate->_('Export') ?></a>
    </li>
    <?php if ($this->user->role == 'admin') { ?>
    <li class="books_item <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>">
        <a href="<?php echo $this->url(array(), 'books_import') ?>"><?php echo $this->translate->_('Import') ?></a>
    </li>
    <?php } ?>
<?php } ?>
<?php } ?>
</ul>
<?php $this->placeholder('menubar')->captureEnd() ?>
