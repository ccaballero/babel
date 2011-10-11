<?php

include_once('__header.php');

class Shell_Babel extends Yachay_Console
{
    protected $specific_options = array(
        'index|i'   => 'lucene indexation for books.',
    );

    public function index($bootstrap) {
        try {
            echo str_pad('indexing the books', $this->count, $this->separator);
            $index = Zend_Search_Lucene::create(APPLICATION_PATH . '/../data/lucene');

            $model_collection = new Books_Collection();
            $books = $model_collection->selectWithMetas();

            foreach ($books as $book) {
                if ($book->inDisk()) {
                    $doc = new Zend_Search_Lucene_Document();

                    $doc->addField(Zend_Search_Lucene_Field::unIndexed('book', $book->hash));
                    $doc->addField(Zend_Search_Lucene_Field::Text('title', $book->title, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('author', $book->author, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('publisher', $book->publisher, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('language', $book->language, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('year', $book->year));
                    $doc->addField(Zend_Search_Lucene_Field::Text('filename', $book->file));

                    $index->addDocument($doc);
                }
            }

            $index->optimize();

            echo $this->ok;
            return true;
        } catch (Exception $e) {
            $this->messages[] = $e->getMessage();
        }

        $this->__dump();
        return false;
    }
}

$command = new Shell_Babel();
$command->__setup()->__run();
