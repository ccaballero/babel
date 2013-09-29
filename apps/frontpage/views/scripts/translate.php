<?php $this->placeholder('translate')->captureStart() ?>
<ul>
<?php foreach ($this->translations() as $translation) { ?>
    <li>
        <a href="<?php echo $this->url(
            array('lang' => $translation), 'frontpage_translate') ?>">
            <?php echo $translation ?>
        </a>
    </li>
<?php } ?>
</ul>
<?php $this->placeholder('translate')->captureEnd() ?>
