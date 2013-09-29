<?php

class Catalogs_View_Helper_Breadcrumb
{
    public function breadcrumb($catalog) {
        $return = array();

        while ($catalog->parent <> NULL) {
            $catalog = $catalog->findParentCatalogs();
            $return[] = $catalog;
        }

        return array_reverse($return);
    }
}
