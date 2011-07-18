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

    public function increaseBook($catalog) {
        $model_catalogs = new Catalogs();

        do {
            $stats = $catalog->getStats();
            $stats->books += 1;
            $stats->save();
        } while (($catalog->parent <> NULL) && ($catalog = $model_catalogs->findByIdent($catalog->parent)));
    }

    public function decreaseBook($catalog) {
        $model_catalogs = new Catalogs();

        do {
            $stats = $catalog->getStats();
            $stats->books -= 1;
            $stats->save();
        } while (($catalog->parent <> NULL) && ($catalog = $model_catalogs->findByIdent($catalog->parent)));
    }
}
