<div id="columns">
    <div id="column1">
        <ul>
        <?php foreach ($this->bookstores as $i => $bookstore) { ?>
            <li class="list<?php echo ($i == $this->bookstore) ? ' active' : '' ?>">
                <a href="<?php echo $this->url(array('bookstore' => $i), 'books_examine') ?>"><?php echo basename($bookstore) ?></a>
            </li>
        <?php } ?>
        </ul>
    </div>
    <div id="column2">
        <ul>
        <?php foreach ($this->directories as $i => $directory) { ?>
            <li class="list<?php echo ($i == $this->directory) ? ' active' : '' ?>">
                <a href="<?php echo $this->url(array('bookstore' => $this->bookstore, 'directory' => $i), 'books_examine') ?>"><?php echo $directory ?></a>
            </li>
        <?php } ?>
        </ul>
    </div>
    <div id="column3">
        <h1><?php echo $this->translate->_('Books directories') ?></h1>
        <form method="post" action="" accept-charset="utf-8">
            <div class="tool-panel"><input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" /><input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" /><input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" /><input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" /><input type="submit" name="thumb" value="<?php echo $this->translate->_('Generate thumbs') ?>" /></div>
            <table>
                <tr>
                    <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
                    
                    <th><?php echo $this->translate->_('Directory') ?></th>
                    <th><?php echo $this->translate->_('File') ?></th>
                    <th><?php echo $this->translate->_('Hash') ?></th>
                    <th><?php echo $this->translate->_('Size') ?></th>
                    
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/book.png') ?>" alt="<?php echo $this->translate->_('Book in collection') ?>" title="<?php echo $this->translate->_('Book in collection') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/transmit_blue.png') ?>" alt="<?php echo $this->translate->_('Published book') ?>" title="<?php echo $this->translate->_('Published book') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/photo.png') ?>" alt="<?php echo $this->translate->_('Thumbnail generate') ?>" title="<?php echo $this->translate->_('Thumbnail generate') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/book_open.png') ?>" alt="<?php echo $this->translate->_('Established title') ?>" title="<?php echo $this->translate->_('Established title') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/user.png') ?>" alt="<?php echo $this->translate->_('Established author') ?>" title="<?php echo $this->translate->_('Established author') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/world.png') ?>" alt="<?php echo $this->translate->_('Established publisher') ?>" title="<?php echo $this->translate->_('Established publisher') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/calendar.png') ?>" alt="<?php echo $this->translate->_('Established year') ?>" title="<?php echo $this->translate->_('Established year') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/flag_yellow.png') ?>" alt="<?php echo $this->translate->_('Established language') ?>" title="<?php echo $this->translate->_('Established language') ?>" /></th>
                    
                    <th style="width:20px;">&nbsp;</th>
                    <th style="width:20px;">&nbsp;</th>
                </tr>
            <?php foreach ($this->books as $book) { ?>
                <tr class="<?php echo $this->cycle(array("even", "odd"))->next()?>">
                    <td class="text-center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>

                    <td class="text-left"><?php echo $this->escape($book->directory) ?></td>
                    <td class="text-left"><?php echo $book->file ?></td>
                    <td class="text-center"><?php echo strtolower(substr($book->hash, 0, 16)) ?></td>
                    <td class="text-right"><?php echo $this->size($book->size) ?></td>

                    <td>
                    <?php if ($book->inCollection()) { ?>
                        <img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" />
                    <?php } ?>
                    <?php if (isset($this->warnings[$book->getPath()])) { ?>
                        <img src="<?php echo $this->baseUrl('/media/img/icons/error.png"') ?>"
                             alt="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>"
                             title="<?php echo $this->translate->_('Repeated checksum') . ' ('. $this->warnings[$book->getPath()] . ')' ?>" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($book->inSearch()) { ?>
                        <img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($book->hasThumb()) { ?>
                        <img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" />
                    <?php } ?>
                    </td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->title <> '') { ?><img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->author <> '') { ?><img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->publisher <> '') { ?><img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->year <> '') { ?><img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" /><?php } ?></td>
                    <td><?php if (isset($this->metas[$book->hash]) && $this->metas[$book->hash]->language <> '') { ?><img src="<?php echo $this->baseUrl('/media/img/icons/tick_cut.png') ?>" alt="" title="" /><?php } ?></td>

                <?php if ($book->inSearch()) { ?>
                    <td><a class="update_book" name="edit_<?php echo $book->hash ?>" rel="#update_book"><img src="<?php echo $this->baseUrl('/media/img/icons/pencil.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Edit') ?>" /></a></td>
                    <td><a href="<?php echo $this->url(array('book' => $book->hash), 'books_book_catalog') ?>"><img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a></td>
                <?php } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
                </tr>
            <?php } ?>
            </table>
            <div class="tool-panel"><input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" /><input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" /><input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" /><input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" /><input type="submit" name="thumb" value="<?php echo $this->translate->_('Generate thumbs') ?>" /></div>
        </form>
    </div>
</div>

<div class="overlay" id="update_book">
    <div id="thumb"></div>
    <div class="details">
        <h1><?php echo $this->translate->_('Book information') ?></h1>
        <div id="form"><?php echo $this->form ?></div>
    </div>
</div>
