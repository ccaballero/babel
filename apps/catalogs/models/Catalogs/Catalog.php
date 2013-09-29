<?php

class Catalogs_Catalog extends Zend_Db_Table_Row_Abstract
{
    private $_stats = null;

    public function getUrlPhoto() {
        $url_base = '/media/img/thumbnails/catalogs/' . $this->ident . '.jpg';
       if (file_exists(APPLICATION_PATH . '/../public' . $url_base)) {
            return $url_base;
        } else {
            return '/babel-small.png';
        }
    }

    public function getStats() {
        if ($this->_stats == null) {
            $model_stats = new Catalogs_Stats();
            $stats = $model_stats->findByCatalog($this->ident);

            if (empty($stats)) {
                $stats = $model_stats->createRow();
                $stats->catalog = $this->ident;
                $stats->books = 0;
                $stats->save();
            }

            $this->_stats = $stats;
        }
        return $this->_stats;
    }
}
