<?php

class Catalogs_Catalog extends Zend_Db_Table_Row_Abstract
{
    private $_stats = null;

    public function getUrlPhoto() {
        $file = '/media/img/thumbnails/catalogs/' . $this->ident . '.jpg';
        if (file_exists($file)) {
            return $file;
        } else {
            return '/babel_small.png';
        }
    }

    public function getStats() {
        if ($this->_stats == null) {
            $model_stats = new Catalogs_Stats();
            $stats = $model_stats->findByCatalog($this->ident);
            if (empty($stats)) {
                $stats = $model_stats->createRow();
                $stats->catalog = $this->ident;
                $stats->save();
            }
            $this->_stats = $stats;
        }
        return $this->_stats;
    }
}
