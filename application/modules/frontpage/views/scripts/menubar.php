<?php $this->placeholder('menubar')->captureStart() ?>
<ul>
    <li class="primary color1"><a href="<?php echo $this->url(array(), 'frontpage') ?>"><?php echo $this->translate->_('Search') ?></a></li>

    <li class="primary color2"><a href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('Catalogs') ?></a></li>
<!--    <li><a class="catalogs <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'catalogs') ?>"><?php echo $this->translate->_('List') ?></a></li>-->
<!--    <li><a class="catalogs <?php echo $this->isHidden($this->route, 'catalogs') || $this->isHidden($this->route, 'tags') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'tags') ?>"><?php echo $this->translate->_('Tagcloud') ?></a></li>-->

<?php if ($this->auth->hasIdentity()) { ?>

    <li class="primary color3"><a href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('Users') ?></a></li>
<!--<a class="users <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'users') ?>"><?php echo $this->translate->_('List') ?></a>-->
<!--<a class="users <?php echo $this->isHidden($this->route, 'users') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'users_new') ?>"><?php echo $this->translate->_('Add') ?></a>-->

<?php if ($this->user->role == 'admin') { ?>

    <li class="primary color4"><a href="<?php echo $this->url(array(), 'books_examine') ?>"><?php echo $this->translate->_('Books') ?></a></li>
<!--<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_examine') ?>"><?php echo $this->translate->_('Files') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_published') ?>"><?php echo $this->translate->_('Published') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_lost') ?>"><?php echo $this->translate->_('Lost') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_export') ?>"><?php echo $this->translate->_('Export') ?></a>
<a class="books <?php echo $this->isHidden($this->route, 'books') ? 'showed' : 'hidden' ?>" href="<?php echo $this->url(array(), 'books_import') ?>"><?php echo $this->translate->_('Import') ?></a>-->

<?php }} ?>
</ul>
<?php $this->placeholder('menubar')->captureEnd() ?>
