<div id="columns">
    <div id="column1">
        <ul>
        <?php foreach ($this->manuals as $element) { ?>
            <li class="<?php echo ($this->page == $element) ? 'active':'inactive' ?>">
                <a href="<?php echo $this->url(array('page' => $element), 'help_manual') ?>"><?php echo $this->translate->_(ucfirst($element)) ?></a>
            </li>
        <?php } ?>
        </ul>
    </div>
    <div id="column3">
        <?php if (in_array($this->page, $this->manuals)) { ?>
            <?php $script = array_search($this->page, $this->manuals) . '_' . $this->escape($this->page) . '/' . $this->locale . '.php'; ?>
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
