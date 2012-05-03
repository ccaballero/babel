<?php $this->placeholder('footer')->captureStart() ?>
<div class="left">
    <?php foreach ($this->translations() as $translation) { ?>
        <a <?php echo ($this->language == $translation) ? 'class="active" ' : '' ?>href="<?php echo $this->url(array('lang' => $translation), 'frontpage_translate') ?>"><?php echo $translation ?></a>
    <?php } ?>
</div>
<div class="right">
    <a href="http://creativecommons.org/"><img src="<?php echo $this->baseUrl('/media/img/copyleft.jpg') ?>" alt="" title="" /></a>
    <a href="http://scesi.fcyt.umss.edu.bo/" target="_BLANK">SCESI</a>
    <a class="border" href="http://www.memi.umss.edu.bo/" target="_BLANK">MEMI</a>
    <a class="border" href="<?php echo $this->url(array('page' => 'terms'), 'static') ?>"><?php echo $this->translate->_('Terms') ?></a>
    <a class="border" href="<?php echo $this->url(array('page' => 'privacy'), 'static') ?>"><?php echo $this->translate->_('Privacy') ?></a>
    <a class="border" href="<?php echo $this->url(array('page' => 'development'), 'static') ?>"><?php echo $this->translate->_('Development') ?></a>
    <a class="border" href="https://github.com/ccaballero/babel"><?php echo $this->translate->_('Source code') ?></a>
    <a class="border" href="<?php echo $this->url(array(), 'help') ?>"><?php echo $this->translate->_('Help') ?></a>
</div>
<?php $this->placeholder('footer')->captureEnd() ?>
