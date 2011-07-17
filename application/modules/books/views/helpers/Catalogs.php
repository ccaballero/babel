<?php

class Books_View_Helper_Catalogs
{
    public function catalogs($root, $catalogs) {
        $options = '<option value="0">----------</option>';
        $selected = '';

        $model_catalogs = new Catalogs();

        foreach ($model_catalogs->selectElementsByRoot($root) as $catalog) {
            if (in_array($catalog->ident, $catalogs)) {
                $selected = ' selected="selected"';
            } else {
                $selected = '';
            }

            $options .= '<option value="' . $catalog->ident . '"' . $selected . '>' . $catalog->code . ' - ' . $catalog->label . '</option>';
        }
        return '<select name="catalogs[]">' . $options . '</select>';
    }
}
