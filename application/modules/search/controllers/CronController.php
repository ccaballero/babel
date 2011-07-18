<?php

class Search_CronController extends Babel_Action
{
    public function indexAction() {
        $this->requireLogin();

        $index = Zend_Search_Lucene::create(APPLICATION_PATH . '/../data/lucene');

        $model_books = new Books();
        $books = $model_books->fetchAll();

        foreach ($books as $book) {
            $doc = new Zend_Search_Lucene_Document();

            $doc->addField(Zend_Search_Lucene_Field::unIndexed('book', $book->book));
            $doc->addField(Zend_Search_Lucene_Field::Text('title', $book->title, 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('author', $book->author, 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('publisher', $book->publisher, 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('language', $book->language, 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('year', $book->year));
            $doc->addField(Zend_Search_Lucene_Field::unIndexed('avatar', $book->avatar));

            $index->addDocument($doc);
        }

        $index->optimize();

        $this->_helper->flashMessenger->addMessage('Indexation done');
        $this->_helper->redirector('index', 'index', 'frontpage');
    }
}
