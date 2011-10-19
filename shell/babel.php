<?php

include_once('__header.php');

class Shell_Babel extends Yachay_Console
{
    public $directory = '';
    public $regex_type = 0;
    public $regex = array(
        '/(?<title>.*).pdf/',
        '/(?<title>.*) \(ISBN - (?<isbn>[0-9X]*)\).pdf/',
    );

    protected $specific_options = array(
        'index|i'    => 'lucene indexation for books.',
        'directory|d=s' => 'set directory for scanning',
        'regex|r=i' => 'set the regex type for use',
        'generate|g' => 'generation meta books.',
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

    public function directory($bootstrap, $getopt) {
        $this->directory = $getopt->getOption('directory');
        return true;
    }

    public function regex($bootstrap, $getopt) {
        $this->regex_type = $this->regex[$getopt->getOption('regex')];
        return true;
    }

    public function generate() {
        try {
            echo str_pad('Setting metabook information', $this->count, $this->separator);

            $directory = $this->directory;
            $regex = $this->regex_type;

            $adapters = array();
            $warnings = array();
            $metas = array();

            $model_meta = new Books_Meta();
            $scanner = new Babel_Utils_DirectoryScanner();
            $files = $scanner->scan_collection($directory, $adapters, $warnings, $metas);
            echo $this->ok;

            foreach ($files as $file) {
                $split = array();
                preg_match($regex, $file->file, $split);
                echo str_pad($split['title'], $this->count * 2, $this->separator);

                $hash = $file->hash;

                $file->tsregister = time();
                $file->published = true;
                $file->save();

                $meta = $model_meta->findByHash($hash);
                if (empty($meta)) {
                    $meta = $model_meta->createRow();
                    $meta->book = $hash;
                    $meta->title = $split['title'];
                    $meta->save();
                }

                if (!$file->hasThumb()) {
                    try {
                        $image = new Imagick($file->getPath() . '[0]');
                        $image->setImageFormat('jpg');
                        $image->thumbnailImage(0, 390);
                        $image->writeImage(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg');

                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg',
                                              APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.small.jpg', 0, 100);
                    } catch (Exception $e) {
                    }
                }

                echo $this->ok;
            }

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
