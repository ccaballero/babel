<div class="left hidden">
    <ul>
        <li>
            <a id="first_page" href="">
                <img src="<?php echo $this->baseUrl('/media/img/icons/book.png') ?>" 
                     alt="<?php echo $this->translate->_('First page') ?>" 
                     title="<?php echo $this->translate->_('First page') ?>" />
            </a>
        </li>
        <li>
            <a id="previous_page" href="">
                <img src="<?php echo $this->baseUrl('/media/img/icons/book_previous.png') ?>" 
                     alt="<?php echo $this->translate->_('Previous page') ?>" 
                     title="<?php echo $this->translate->_('Previous page') ?>" />
            </a>
        </li>
        <li>
            <a id="next_page" href="">
                <img src="<?php echo $this->baseUrl('/media/img/icons/book_next.png') ?>" 
                     alt="<?php echo $this->translate->_('Next page') ?>" 
                     title="<?php echo $this->translate->_('Next page') ?>" />
            </a>
        </li>
    </ul>
</div>
        
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
            <a id="book_preview" 
               href="<?php echo $this->url(array('book' => $this->book->book), 'books_book_preview') ?>">
                <img src="<?php echo $this->baseUrl('/media/img/icons/eye.png') ?>" 
                     alt="<?php echo $this->translate->_('Preview') ?>" 
                     title="<?php echo $this->translate->_('Preview') ?>" />
            </a>
        </li>
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
