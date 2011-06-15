<?php $this->placeholder('toolbar')->captureStart() ?>
<?php if ($this->auth->hasIdentity()) { ?><a href="<?php echo $this->url(array(), 'settings') ?>"><?php echo $this->auth->getIdentity()->fullname ?></a><a href="<?php echo $this->url(array(), 'auth_out') ?>"><?php echo $this->translate->_('Logout') ?></a><?php } else { ?><a href="<?php echo $this->url(array(), 'auth_in') ?>"><?php echo $this->translate->_('Login') ?></a><?php } ?>
<?php $this->placeholder('toolbar')->captureEnd() ?>
