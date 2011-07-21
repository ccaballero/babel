<?php $this->placeholder('menubar')->captureStart() ?>

<a id="search_menu" class="main color1" href="<?php echo $this->url(array(), 'frontpage') ?>"><?php echo $this->translate->_('Search') ?></a>

<a id="catalogs_menu" class="main color2" href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('Catalogs') ?></a>
<a class="catalogs <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('List') ?></a>
<a class="catalogs <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'tags') ?>"><?php echo $this->translate->_('Tagcloud') ?></a>

<?php if ($this->auth->hasIdentity()) { ?>

<a id="users_menu" class="main color3" href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('Users') ?></a>
<a class="users <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('List') ?></a>
<a class="users <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'users_new') ?>"><?php echo $this->translate->_('New') ?></a>

<a id="books_menu" class="main color4" href="<?php echo $this->url(array(), 'books_shared') ?>"><?php echo $this->translate->_('Books') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_shared') ?>"><?php echo $this->translate->_('Published') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_collection') ?>"><?php echo $this->translate->_('Collection') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_examine') ?>"><?php echo $this->translate->_('Files') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'search_index') ?>"><?php echo $this->translate->_('Index') ?></a>

<?php } ?>

<?php $this->placeholder('menubar')->captureEnd() ?>
