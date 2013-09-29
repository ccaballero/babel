<?php echo $this->doctype() ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->headTitle() ?>
        <?php echo $this->headMeta() ?>
        <?php echo $this->headLink() ?>
        <?php echo $this->headStyle() ?>
        <?php echo $this->headScript() ?>
    </head>
    <body>
        <div id="head">
            <div id="menubar" class="left"><?php echo $this->placeholder('menubar') ?></div>
            <div id="toolbar" class="right"><?php echo $this->placeholder('toolbar') ?></div>
        </div>
        <div id="main">
            <?php echo $this->placeholder('messages') ?>
            <?php echo $this->layout()->content; ?>
        </div>
        <div id="foot">
            <div id="translate" class="left"><?php echo $this->placeholder('translate') ?></div>
            <div id="footer" class="right"><?php echo $this->placeholder('footer') ?></div>
        </div>
    </body>
</html>
