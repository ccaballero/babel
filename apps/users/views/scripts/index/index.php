<h1><?php echo $this->translate->_('Users') ?></h1>
<div id="list">
<?php if (count($this->users) <> 0) { ?>
    <?php foreach ($this->users as $user) { ?>
        <?php echo $this->partial('users/views/scripts/user.php', array('user' => $user)) ?>
    <?php } ?>
<?php } else { ?>
    <p class="description"><?php echo $this->translate->_('No users founded') ?></p>
<?php } ?>
</div>
