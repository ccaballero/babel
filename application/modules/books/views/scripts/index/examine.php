<h1><?php echo $this->translate->_('Books directories') ?></h1>
<div id="wall">
    <div id="column1">
    <?php foreach ($this->bookstores as $i => $bookstore) { ?>
        <a class="list<?php echo ($i == $this->bookstore) ? ' active' : '' ?>"
           href="<?php echo $this->url(array('bookstore' => $i), 'books_examine') ?>"><?php echo basename($bookstore) ?></a>
    <?php } ?>
    </div>
    <div id="column2">
    <?php foreach ($this->directories as $i => $directory) { ?>
        <a class="list<?php echo ($i == $this->directory) ? ' active' : '' ?>"
           href="<?php echo $this->url(array('bookstore' => $this->bookstore, 'directory' => $i), 'books_examine') ?>"><?php echo $directory ?></a>
    <?php } ?>
    </div>
    <div id="column3">
        <form method="post" action="" accept-charset="utf-8">
            <div class="tool-panel">
                <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
                <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
                <input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" />
                <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
                <input type="submit" name="thumb" value="<?php echo $this->translate->_('Generate thumbs') ?>" />
            </div>
            <table>
                <tr>
                    <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
                    <th><?php echo $this->translate->_('Directory') ?></th>
                    <th><?php echo $this->translate->_('File') ?></th>
                    <th><?php echo $this->translate->_('MD5') ?></th>
                    <th><?php echo $this->translate->_('Size') ?></th>
                    <th style="width:20px;"><img src="/media/img/icons/book.png" alt="<?php echo $this->translate->_('Book in collection') ?>" title="<?php echo $this->translate->_('Book in collection') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/transmit_blue.png" alt="<?php echo $this->translate->_('Published book') ?>" title="<?php echo $this->translate->_('Published book') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/photo.png" alt="<?php echo $this->translate->_('Thumbnail generate') ?>" title="<?php echo $this->translate->_('Thumbnail generate') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/book_open.png" alt="<?php echo $this->translate->_('Established title') ?>" title="<?php echo $this->translate->_('Established title') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/user.png" alt="<?php echo $this->translate->_('Established author') ?>" title="<?php echo $this->translate->_('Established author') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/world.png" alt="<?php echo $this->translate->_('Established publisher') ?>" title="<?php echo $this->translate->_('Established publisher') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/calendar.png" alt="<?php echo $this->translate->_('Established year') ?>" title="<?php echo $this->translate->_('Established year') ?>" /></th>
                    <th style="width:20px;"><img src="/media/img/icons/flag_yellow.png" alt="<?php echo $this->translate->_('Established language') ?>" title="<?php echo $this->translate->_('Established language') ?>" /></th>
                    <th style="width:20px;">&nbsp;</th>
                    <th style="width:20px;">&nbsp;</th>
                </tr>
            <?php foreach ($this->books as $book) { ?>
                <tr class="<?php echo $this->cycle(array("even", "odd"))->next()?>">
                    <td class="center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>
                    <td class="left"><?php echo $book->directory ?></td>
                    <td class="left"><?php echo $book->file ?></td>
                    <td style="width:180px;" class="left">
                        <?php echo strtolower($book->hash) ?>
                    </td>
                    <td class="center"><?php echo $this->size($book->size) ?></td>
                    <td>
                    <?php if ($book->inCollection()) { ?>
                        <img src="/media/img/icons/tick_cut.png" alt="" title="" />
                    <?php } ?>
                    <?php if (isset($this->warnings[$book->getPath()])) { ?>
                        <img src="/media/img/icons/error.png"
                             alt="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>"
                             title="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($book->inSearch()) { ?>
                        <img src="/media/img/icons/tick_cut.png" alt="" title="" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($book->hasThumb()) { ?>
                        <img src="/media/img/icons/tick_cut.png" alt="" title="" />
                    <?php } ?>
                    </td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->title <> '') { ?><img src="/media/img/icons/tick_cut.png" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->author <> '') { ?><img src="/media/img/icons/tick_cut.png" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->publisher <> '') { ?><img src="/media/img/icons/tick_cut.png" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->year <> '') { ?><img src="/media/img/icons/tick_cut.png" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->language <> '') { ?><img src="/media/img/icons/tick_cut.png" alt="" title="" /><?php } ?></td>
                    <?php if ($book->inSearch()) { ?>
                    <td><a class="update_book" name="edit_<?php echo $book->hash ?>" rel="#update_book"><img src="/media/img/icons/pencil.png" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Edit') ?>" /></a></td>
                    <td><a href="<?php echo $this->url(array('book' => $book->hash), 'books_book_catalog') ?>"><img src="/media/img/icons/tag_blue.png" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a></td>
                    <?php } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </table>
            <div id="box" style="background-color:#000000; background-image: url('/media/img/toolbar.png'); height: 0px;"></div>
            <div class="tool-panel">
                <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
                <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
                <input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" />
                <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
                <input type="submit" name="thumb" value="<?php echo $this->translate->_('Generate thumbs') ?>" />
            </div>
        </form>
    </div>
</div>

<div class="overlay" id="update_book">
    <div id="thumb" style="float:left; margin: 0em 1.3em 0em 0em; height: 400px; width: 300px;"></div>
    <div style="float:left;">
        <h1><?php echo $this->translate->_('Book information') ?></h1>
        <div id="form"><?php echo $this->form ?></div>
    </div>
</div>
