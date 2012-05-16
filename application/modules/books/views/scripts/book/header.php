<h1><?php echo $this->book->title ?></h1>
<div id="thumb" style="float:left; margin: 0px 0px 0em 0em; height: 416px; width: 275px; background-image: url('<?php echo $this->file->getUrlPhoto() ?>')">
    <a id="book_download" href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_download') ?>"><img src="<?php echo $this->baseUrl('/media/img/icons/disk.png') ?>" alt="<?php echo $this->translate->_('Download') ?>" title="<?php echo $this->translate->_('Download') ?>" /></a>&nbsp;
    <a id="book_catalog" href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_catalog') ?>"><img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a>
</div>
<div style="margin-top:10px; margin-left: 290px;">
<p><span class="bold"><?php echo $this->translate->_('Title') ?>:</span> <?php echo $this->none($this->book->title) ?></p>
<p><span class="bold"><?php echo $this->translate->_('Author') ?>:</span> <?php echo $this->book->author ?></p>
<p><span class="bold"><?php echo $this->translate->_('Publisher') ?>:</span> <?php echo $this->book->publisher ?></p>
<p><span class="bold"><?php echo $this->translate->_('Language') ?>:</span> <?php echo $this->language($this->book->language) ?></p>
<p><span class="bold"><?php echo $this->translate->_('Year') ?>:</span> <?php echo $this->none($this->book->year) ?></p>