<?php echo $this->doctype() ?>
<html>
    <head>
        <?php echo $this->headTitle() ?>
        <?php echo $this->headMeta() ?>
        <?php echo $this->headLink() ?>
        <?php echo $this->headStyle() ?>
        <?php echo $this->headScript() ?>
    </head>
    <body>
        <header>
            <nav><?php echo $this->placeholder('menubar') ?></nav>
            <nav><?php echo $this->placeholder('toolbar') ?></nav>
        </header>
        <section>
            <?php echo $this->placeholder('messages') ?>
            <?php echo $this->layout()->content; ?>
        </section>
        <footer>
            <nav><?php echo $this->placeholder('translate') ?></nav>
            <nav><?php echo $this->placeholder('footer') ?></nav>
        </footer>
    </body>
</html>
