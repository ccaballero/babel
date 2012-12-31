<div class="right">
    <ul>
    <?php if ($this->auth->hasIdentity()) { ?>
        <li>
            <a id="book_edit" 
               href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_edit') ?>">
                <img src="<?php echo $this->baseUrl('/media/img/icons/pencil.png') ?>" 
                     alt="<?php echo $this->translate->_('Edit information') ?>" 
                     title="<?php echo $this->translate->_('Edit information') ?>" />
            </a>
        </li>
    <?php } ?>
        <li>
            <a id="book_download" 
               href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_download') ?>">
                <img src="<?php echo $this->baseUrl('/media/img/icons/disk.png') ?>" 
                     alt="<?php echo $this->translate->_('Download') ?>" 
                     title="<?php echo $this->translate->_('Download') ?>" />
            </a>
        </li>
        <li>
            <a id="book_catalog" 
               href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_catalog') ?>">
                <img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" 
                     alt="<?php echo $this->translate->_('Catalogs') ?>" 
                     title="<?php echo $this->translate->_('Catalogs') ?>" />
            </a>
        </li>
    </ul>
</div>

<div>
    <dl>
        <dt><?php echo $this->translate->_('Author') ?>:</dt>
        <dd><?php echo $this->none($this->book->author) ?></dd>
        <dt><?php echo $this->translate->_('Publisher') ?>:</dt>
        <dd><?php echo $this->none($this->book->publisher) ?></dd>
        <dt><?php echo $this->translate->_('Language') ?>:</dt>
        <dd><?php echo $this->none($this->language($this->book->language)) ?></dd>
        <dt><?php echo $this->translate->_('Year') ?>:</dt>
        <dd><?php echo $this->none($this->book->year) ?></dd>
    </dl>
</div>
