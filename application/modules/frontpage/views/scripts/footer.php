<?php $this->placeholder('footer')->captureStart() ?>
<ul>
    <li><a href="http://creativecommons.org/"><img src="<?php echo $this->baseUrl('/media/img/copyleft.jpg') ?>" alt="" title="" /></a></li>
    <li><a href="http://www.scesi.memi.umss.edu.bo/" target="_BLANK">SCESI</a></li>
    <li><a class="border" href="http://www.memi.umss.edu.bo/" target="_BLANK">MEMI</a></li>
    <li><a class="border" href="<?php echo $this->url(array('page' => 'terms'), 'static') ?>"><?php echo $this->translate->_('Terms') ?></a></li>
    <li><a class="border" href="<?php echo $this->url(array('page' => 'privacy'), 'static') ?>"><?php echo $this->translate->_('Privacy') ?></a></li>
    <li><a class="border" href="https://github.com/ccaballero/babel" target="_BLANK"><?php echo $this->translate->_('Source code') ?></a></li>
    <li><a class="border" href="<?php echo $this->url(array(), 'help') ?>"><?php echo $this->translate->_('Help') ?></a></li>
</ul>
<?php $this->placeholder('footer')->captureEnd() ?>
