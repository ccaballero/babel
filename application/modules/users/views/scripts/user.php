<div class="element user <?php echo ($this->user->role == 'admin') ? 'admin' : '' ?>">
    <img src="<?php echo $this->user->getUrlPhoto() ?>" alt="<?php echo $this->user->fullname ?>" title="<?php echo $this->user->fullname ?>" />
</div>
