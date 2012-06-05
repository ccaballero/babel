<div id="wall">
    <?php $manuals = $this->manuals(); ?>
    <div id="column1">
    <?php foreach ($manuals as $element) { ?>
        <a class="list <?php echo ($this->page == $element) ? ' active':' inactive' ?>" href="<?php echo $this->url(array('page' => $element), 'help_manual') ?>"><?php echo $this->translate->_(ucfirst($element)) ?></a>
    <?php } ?>
    </div>
    <div id="column3" class="help" style="background: #f0f0f0;">
        <?php if (in_array($this->page, $manuals)) { ?>
            <?php $script = array_search($this->page, $manuals) . '_' . $this->escape($this->page) . '/' . $this->locale . '.php'; ?>
            <?php if (file_exists(APPLICATION_PATH . '/../docs/manual/' . $script)) { ?>
                <?php echo $this->partial($script) ?>
            <?php } else { ?>
                <?php echo $this->partial('help/views/scripts/notfound.php', array('translate' => $this->translate)) ?>
            <?php } ?>
        <?php } else { ?>
            <?php echo $this->partial('help/views/scripts/notfound.php', array('translate' => $this->translate)) ?>
        <?php } ?>
    </div>
</div>
