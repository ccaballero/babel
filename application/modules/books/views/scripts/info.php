<div class="overlay" id="book_info">
    <div id="thumb" style="float:left; margin: 0em 1.3em 0em 0em; height: 400px; width: 300px;"></div>
    <div style="float:left; width: 200px;">
        <h1 id="book_title"></h1>
        <div style="margin-bottom: 1.0em;">
            <a id="book_download" href=""><img src="<?php echo $this->baseUrl('/media/img/icons/disk.png') ?>" alt="<?php echo $this->translate->_('Download') ?>" title="<?php echo $this->translate->_('Download') ?>" /></a>&nbsp;
            <a id="book_catalog" href=""><img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a>
        </div>
        <div>
            <p><span class="bold"><?php echo $this->translate->_('Author') ?>:</span> <span id="book_author" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Publisher') ?>:</span> <span id="book_publisher" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Language') ?>:</span> <span id="book_language" class="italic"></span></p>
            <p><span class="bold"><?php echo $this->translate->_('Year') ?>:</span> <span id="book_year" class="italic"></span></p>
        </div>
    </div>
</div>
