<?php $this->placeholder('menubar')->captureStart() ?>
<ul>
    <li>
        <a href="<?php echo $this->url(array(), 'frontpage') ?>">
            <?php echo $this->translate->_('Search') ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $this->url(array(), 'catalogs') ?>">
            <?php echo $this->translate->_('Catalogs') ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo $this->url(array(), 'catalogs') ?>">
                    <?php echo $this->translate->_('List') ?>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->url(array(), 'tags') ?>">
                    <?php echo $this->translate->_('Tagcloud') ?>
                </a>
            </li>
        </ul>
    </li>
<?php if ($this->auth->hasIdentity()) { ?>
    <li>
        <a href="<?php echo $this->url(array(), 'users') ?>">
            <?php echo $this->translate->_('Users') ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo $this->url(array(), 'users') ?>">
                    <?php echo $this->translate->_('List') ?>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->url(array(), 'users_new') ?>">
                    <?php echo $this->translate->_('Add') ?>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->url(array(), 'books_examine') ?>">
            <?php echo $this->translate->_('Books') ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo $this->url(array(), 'books_upload') ?>">
                    <?php echo $this->translate->_('Upload') ?>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->url(array(), 'books_examine') ?>">
                    <?php echo $this->translate->_('Files') ?>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->url(array(), 'books_published') ?>">
                    <?php echo $this->translate->_('Published') ?>
                </a>
            </li>
        <?php if ($this->user->role == 'admin') { ?>
            <li>
                <a href="<?php echo $this->url(array(), 'books_lost') ?>">
                    <?php echo $this->translate->_('Lost') ?>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->url(array(), 'books_import') ?>">
                    <?php echo $this->translate->_('Import') ?>
                </a>
            </li>
        <?php } ?>
            <li>
                <a href="<?php echo $this->url(array(), 'books_export') ?>">
                    <?php echo $this->translate->_('Export') ?>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>
</ul>
<?php $this->placeholder('menubar')->captureEnd() ?>
