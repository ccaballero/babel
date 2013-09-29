<div id="classic">
    <h1><?php echo $this->book->title ?></h1>

    <div id="details">
        <div class="left">
            <ul>
                <li>
                    <a id="first_page"
                    href="<?php echo $this->url(array('book' => $this->book->book, 'page' => 0), 'books_book_preview') ?>">
                        <img src="<?php echo $this->baseUrl('/media/img/icons/book.png') ?>"
                            alt="<?php echo $this->translate->_('First page') ?>"
                            title="<?php echo $this->translate->_('First page') ?>" />
                    </a>
                </li>
                <li>
                    <a id="previous_page"
                    href="<?php echo $this->url(array('book' => $this->book->book, 'page' => ($this->page - 1)), 'books_book_preview') ?>">
                        <img src="<?php echo $this->baseUrl('/media/img/icons/book_previous.png') ?>"
                            alt="<?php echo $this->translate->_('Previous page') ?>"
                            title="<?php echo $this->translate->_('Previous page') ?>" />
                    </a>
                </li>
                <li>
                    <a id="next_page"
                    href="<?php echo $this->url(array('book' => $this->book->book, 'page' => ($this->page + 1)), 'books_book_preview') ?>">
                        <img src="<?php echo $this->baseUrl('/media/img/icons/book_next.png') ?>"
                            alt="<?php echo $this->translate->_('Next page') ?>"
                            title="<?php echo $this->translate->_('Next page') ?>" />
                    </a>
                </li>
            </ul>
        </div>
        
        <?php /* TODO: fix the style */ ?>
        <div class="left italic" style="margin-left: 10px; font-size: 11pt;">
            <ul>
                <li id="count"><?php echo ($this->page + 1) ?></li>
                <li>/</li>
                <li><?php echo $this->max_page ?></li>
            </ul>
        </div>

        <?php echo $this->partial('books/views/scripts/book/tools.php', array(
            'user' => $this->user,
            'book' => $this->book,
            'page' => $this->page,
            'file' => $this->file,
            'translate' => $this->translate,
            'auth' => $this->auth
        )) ?>
        <div class="clear"></div>

        <div id="preview">
            <div><img src="<?php echo $this->url(array(
                'book' => $this->book->book,
                'page' => $this->page,
                'height' => 0,
                'width' => 600,
            ), 'books_book_thumb') ?>" alt="" title="" /></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    var img=new Image();
    var transform=function(params) {
        $(img)
            .load(function(){
                $('#preview img').attr('src',$(this).attr('src'));
                $('#count').text(params[4] + 1);
            })
            .error(function(){})
            .attr('src',params.join('/'));
    };

    $('#first_page').click(function(){
        var params=$('#preview img').attr('src').split('/');
        params[4]=0;
        transform(params);
        return false;
    });

    $('#previous_page').click(function(){
        var params=$('#preview img').attr('src').split('/');
        params[4]=parseInt(params[4]) - 1;
        if(params[4]>=0){transform(params);}
        return false;
    });

    $('#next_page').click(function() {
        var params=$('#preview img').attr('src').split('/');
        params[4]=parseInt(params[4]) + 1;
        transform(params);
        return false;
    });
});
</script>
