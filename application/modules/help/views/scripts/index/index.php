<div id="wall">
    <div id="column1">
        <a class="list <?php echo ($this->page == 'search') ? ' active':' inactive' ?>" href="<?php echo $this->url(array('page' => 'search'), 'help_manual') ?>"><?php echo $this->translate->_('Search') ?></a>
        <a class="list <?php echo ($this->page == 'catalogs') ? ' active':' inactive' ?>" href="<?php echo $this->url(array('page' => 'catalogs'), 'help_manual') ?>"><?php echo $this->translate->_('Catalogs') ?></a>
        <a class="list <?php echo ($this->page == 'books') ? ' active':' inactive' ?>" href="<?php echo $this->url(array('page' => 'books'), 'help_manual') ?>"><?php echo $this->translate->_('Books') ?></a>
        <a class="list <?php echo ($this->page == 'users') ? ' active':' inactive' ?>" href="<?php echo $this->url(array('page' => 'users'), 'help_manual') ?>"><?php echo $this->translate->_('Users') ?></a>
    </div>
    <div id="column3">
        <?php echo $this->partial('help/views/scripts/' . $this->escape($this->page) . '/' . $this->locale . '.php') ?>
    </div>
</div>
