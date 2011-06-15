<h1>Users</h1>
<div id="list">
    <?php foreach ($this->users as $user) { ?><?php echo $this->partial('users/views/scripts/user.php', array('user' => $user,)) ?><?php } ?>
</div>
