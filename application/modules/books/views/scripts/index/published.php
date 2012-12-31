<div id="columns">
    <div id="column3">
        <h1><?php echo $this->translate->_('Books published') ?></h1>
        <form method="post" action="" accept-charset="utf-8">
            <div class="tool-panel">
                <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
            </div>
            <table>
                <tr>
                    <th style="width:20px;"><input type="checkbox" class="groupall" /></th>
                    <th><?php echo $this->translate->_('Title') ?></th>
                    <th><?php echo $this->translate->_('Author') ?></th>
                    <th><?php echo $this->translate->_('Publisher') ?></th>
                    <th style="width:50px;"><?php echo $this->translate->_('Year') ?></th>
                    <th><?php echo $this->translate->_('Language') ?></th>
                    <th><?php echo $this->translate->_('Path') ?></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/database.png') ?>" alt="<?php echo $this->translate->_('File in disk') ?>" title="<?php echo $this->translate->_('File in disk') ?>" /></th>
                    <th style="width:20px;"><img src="<?php echo $this->baseUrl('/media/img/icons/photo.png') ?>" alt="<?php echo $this->translate->_('Thumbnail generate') ?>" title="<?php echo $this->translate->_('Thumbnail generate') ?>" /></th>
                    <th style="width:20px;">&nbsp;</th>
                    <th style="width:20px;">&nbsp;</th>
                </tr>
                <?php foreach ($this->books as $book) { ?>
                    <tr class="<?php echo $this->cycle(array("even", "odd"))->next()?>">
                        <td class="text-center"><input type="checkbox" class="check" name="books[]" value="<?php echo $book->hash ?>" /></td>
                        <td class="text-left"><?php echo $book->title ?></td>
                        <td class="text-left"><?php echo $book->author ?></td>
                        <td class="text-center"><?php echo $book->publisher ?></td>
                        <td class="text-center"><?php echo $book->year ?></td>
                        <td class="text-center"><?php echo $book->language ?></td>
                        <td class="text-left"><?php echo $book->getPath() ?></td>
                        <td class="text-center">
                        <?php if ($book->inDisk()) { ?>
                            <img src="<?php echo $this->baseUrl('/media/img/icons/tick.png') ?>" alt="" title="" />
                        <?php } else { ?>
                            <img src="<?php echo $this->baseUrl('/media/img/icons/cross.png') ?>" alt="" title="" />
                        <?php } ?>
                        </td>
                        <td class="text-center">
                        <?php if ($book->hasThumb()) { ?>
                            <img src="<?php echo $this->baseUrl('/media/img/icons/tick.png') ?>" alt="" title="" />
                        <?php } ?>
                        </td>
                        <td><a class="update_book" name="edit_<?php echo $book->hash ?>" rel="#update_book"><img src="<?php echo $this->baseUrl('/media/img/icons/pencil.png') ?>" alt="<?php echo $this->translate->_('Edit') ?>" title="<?php echo $this->translate->_('Edit') ?>" /></a></td>
                        <td><a href="<?php echo $this->url(array('book' => $book->hash), 'books_book_catalog') ?>"><img src="<?php echo $this->baseUrl('/media/img/icons/tag_blue.png') ?>" alt="<?php echo $this->translate->_('Catalogs') ?>" title="<?php echo $this->translate->_('Catalogs') ?>" /></a></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="tool-panel">
                <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
            </div>
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
