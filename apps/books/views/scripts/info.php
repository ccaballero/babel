<div class="overlay" id="book_info">
    <div id="thumb"></div>
    <div class="details" style="width: 200px;">
        <h1 id="book_title"></h1>
        <div>
            <a id="book_catalog" href=""><img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a>
            <a id="book_preview" href=""><img src="<?php echo $this->baseUrl('/media/img/icons/eye.png') ?>" alt="<?php echo $this->translate->_('Preview') ?>" title="<?php echo $this->translate->_('Preview') ?>" /></a>&nbsp;
            <a id="book_download" href=""><img src="<?php echo $this->baseUrl('/media/img/icons/disk.png') ?>" alt="<?php echo $this->translate->_('Download') ?>" title="<?php echo $this->translate->_('Download') ?>" /></a>&nbsp;
        </div>
        <div>
            <p><span class="bold"><?php echo $this->translate->_('Author') ?>:</span> <span id="book_author" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Publisher') ?>:</span> <span id="book_publisher" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Language') ?>:</span> <span id="book_language" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Year') ?>:</span> <span id="book_year" class="italic"></span></p>
        </div>
    </div>
</div>
