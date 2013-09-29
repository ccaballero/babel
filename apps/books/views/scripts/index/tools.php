<?php if ($this->user->role == 'admin') { ?>
<div class="tool-panel">
    <input type="submit" name="add" value="<?php echo $this->translate->_('Add to collection') ?>" />
    <input type="submit" name="delete" value="<?php echo $this->translate->_('Remove from collection') ?>" />
    <input type="submit" name="publish" value="<?php echo $this->translate->_('Publish the book') ?>" />
    <input type="submit" name="unpublish" value="<?php echo $this->translate->_('Unpublish the book') ?>" />
    <input type="submit" name="thumb" value="<?php echo $this->translate->_('Generate thumbs') ?>" />
</div>
<?php } ?>