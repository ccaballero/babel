<?php

class Search_CronController extends Babel_Action
{
    public function indexAction() {
        $index = Zend_Search_Lucene::create(APPLICATION_PATH . '/../data/lucene');

        $model_books = new Books();
        $books = $model_books->fetchAll();

        foreach ($books as $book) {
            $doc = new Zend_Search_Lucene_Document();

            $doc->addField(Zend_Search_Lucene_Field::Text('title', $book->title));

            $index->addDocument($doc);
        }

        $index->optimize();
    }
}
