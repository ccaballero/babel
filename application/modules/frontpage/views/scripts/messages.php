<?php $this->placeholder('messages')->captureStart() ?>
<?php if (!empty($this->messages)) { ?>
<div id="messages">
    <div class="right closeable"><a href="#">x</a></div>
    <?php foreach ($this->messages as $message) { ?>
    <p class="message"><?php echo $message ?></p>
    <?php } ?>
</div>
<?php } ?>
<?php $this->placeholder('messages')->captureEnd() ?>
