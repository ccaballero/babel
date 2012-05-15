<?php

class Catalogs_Stats extends Babel_Models_Table
{
    protected $_name = 'babel_catalogs_stats';
    protected $_primary = 'catalog';

    protected $_referenceMap    = array(
        'Catalog'               => array(
            'columns'           => 'catalog',
            'refTableClass'     => 'Catalogs',
            'refColumns'        => 'ident',
            'onDelete'          => self::CASCADE,
            'onUpdate'          => self::CASCADE
        ),
    );

    public function findByCatalog($catalog) {
        return $this->fetchRow($this->select()->where('catalog = ?', $catalog));
    }

    public function increaseBook($ident) {
        $model_catalogs = new Catalogs();
        $catalog = $model_catalogs->findByIdent($ident);

        while ($catalog <> null) {
            $stats = $catalog->getStats();
            $stats->catalog = $catalog->ident;
            $stats->books = $stats->books + 1;
            $stats->save();

            if ($catalog->parent == null) {
                $catalog = null;
            } else {
                $catalog = $model_catalogs->findByIdent($catalog->parent);
            }
        }
    }

    public function decreaseBook($ident) {
        $model_catalogs = new Catalogs();
        $catalog = $model_catalogs->findByIdent($ident);

        while ($catalog <> null) {
            $stats = $catalog->getStats();
            $stats->catalog = $catalog->ident;
            $stats->books = $stats->books - 1;
            $stats->save();

            if ($catalog->parent == null) {
                $catalog = null;
            } else {
                $catalog = $model_catalogs->findByIdent($catalog->parent);
            }
        }
    }
}
