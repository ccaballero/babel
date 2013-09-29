<?php $this->placeholder('toolbar')->captureStart() ?>
<ul>
<?php if ($this->auth->hasIdentity()) { ?>
    <li>
        <a href="<?php echo $this->url(array(), 'settings') ?>">
            <?php echo $this->auth->getIdentity()->fullname ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $this->url(array(), 'auth_out') ?>">
            <?php echo $this->translate->_('Logout') ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="<?php echo $this->url(array(), 'auth_in') ?>">
            <?php echo $this->translate->_('Login') ?>
        </a>
    </li>
<?php } ?>
</ul>
<?php $this->placeholder('toolbar')->captureEnd() ?>
