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
            <div id="menubar"><?php echo $this->placeholder('menubar') ?></div>
            <div id="toolbar"><?php echo $this->placeholder('toolbar') ?></div>
        </div>
        <div id="wrapper">
            <div id="main">
                <?php echo $this->placeholder('messages') ?>
                <?php echo $this->layout()->content; ?>
            </div>
        </div>
        <div id="foot">
            <img src="/media/img/copyleft.jpg" alt="" title="" /><a href="http://scesi.fcyt.umss.edu.bo/" target="_BLANK">SCESI</a>|<a href="<?php echo $this->url(array(), 'help') ?>"><?php echo $this->translate->_('Help') ?></a>
        </div>
    </body>
</html>
