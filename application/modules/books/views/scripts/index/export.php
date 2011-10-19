<div id="classic">
    <h1><?php echo $this->translate->_('Export metabooks') ?></h1>
    <div id="form">
        <form method="post" action="">
            <select name="bookstore">
                <option value="-1"><?php echo $this->translate->_('All bookstores') ?></option>
            <?php foreach($this->bookstores as $i => $bookstore) { ?>
                <option value="<?php echo $i ?>"><?php echo $bookstore ?></option>
            <?php } ?>
            </select>
            <input type="submit" value="<?php echo $this->translate->_('Export') ?>" />
        </form>
    </div>
</div>
