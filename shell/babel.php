<?php

include_once('__header.php');

class Shell_Babel extends Yachay_Console
{
    public $override = false;
    public $directory = '';
    public $files = array();
    
    public $regex_type = 0;
    public $regex = array(
        '', // because fuck you, that's why                             // 0
        '/(?<title>.*)\.pdf/',                                          // 1
        '/(?<title>.*) \(ISBN - (?<isbn>[0-9X]*)\)\.pdf/',              // 2
        '/(?<author>.*) - (?<title>.*)\.pdf/',                          // 3
        '/\((?<year>[0-9]{4})\) (?<author>.*) - (?<title>.*)\.pdf/',    // 4
    );

    protected $specific_options = array(
        'index|i'       => 'lucene indexation for books.',
        'override|o'    => 'override setting meta-information in books',
        'directory|d=s' => 'set directory for scanning',
        'regex|r=i'     => 'set the regex type for use',
        'generate|g'    => 'generation meta books.',
        'metas|m=s'     => 'set of metas in collection',
        'thumbs|t'      => 'generation thumbnails.',
        'publish|p'     => 'publish the books',
        'font|f=s'      => 'generation of figlet',
        'figlet|l=s'    => 'generation of figlet',
    );
    
    public $path_font = null; 

    public function index() {
        try {
            echo str_pad('indexing the books', $this->count, $this->separator);
            
            $config = Zend_Registry::get('config');
            $index = Zend_Search_Lucene::create($config->babel->properties->lucene);

            $model_collection = new Books_Collection();
            $books = $model_collection->selectWithMetas();

            foreach ($books as $book) {
                if ($book->inDisk()) {
                    $doc = new Zend_Search_Lucene_Document();

                    // Common terms
                    $doc->addField(Zend_Search_Lucene_Field::unIndexed('book', $book->hash));

                    // English terms
                    $doc->addField(Zend_Search_Lucene_Field::Text('title',     $book->title, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('author',    $book->author, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('publisher', $book->publisher, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('language',  $book->language, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('year',      $book->year));
                    $doc->addField(Zend_Search_Lucene_Field::Text('filename',  $book->file));

                    // Spanistan terms
                    $doc->addField(Zend_Search_Lucene_Field::Text('titulo',    $book->title, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('autor',     $book->author, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('editorial', $book->publisher, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('idioma',    $book->language, 'utf-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('año',       $book->year));
                    $doc->addField(Zend_Search_Lucene_Field::Text('archivo',   $book->file));

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
    
    public function override() {
        $this->override = true;
        echo str_pad('Set the override behavior', $this->count, $this->separator);
        
        echo $this->ok;
        return true;
    }

    public function directory($getopt) {
        $this->directory = realpath($getopt->getOption('directory'));
        echo str_pad('Set the directory to: ' . $this->directory, $this->count, $this->separator);


        $adapters = array();
        $warnings = array();
        $metas = array();

        $scanner = new Babel_Utils_DirectoryScanner();
        $this->files = $scanner->scan_collection($this->directory, $adapters, $warnings, $metas);
        
        echo $this->ok;
        return true;
    }

    public function regex($getopt) {
        $this->regex_type = intval($getopt->getOption('regex'));
        echo str_pad('Set the regex to: ' . $this->regex[$this->regex_type], $this->count, $this->separator);
        
        echo $this->ok;
        return true;
    }

    // Directory and regex required
    public function generate() {
        try {
            echo str_pad('Setting metabook information', $this->count, $this->separator);
            $regex = $this->regex[$this->regex_type];

            $model_meta = new Books_Meta();
            echo $this->ok;

            foreach ($this->files as $file) {
                $split = array();
                preg_match($regex, $file->file, $split);

                $title = $split['title'];
                $author = isset($split['author']) ? $split['author'] : null;
                $year = isset($split['year']) ? $split['year'] : null;

                $label = iconv('UTF8', 'ASCII//TRANSLIT', $title);
                echo str_pad($label, $this->count, $this->separator);

                $hash = $file->hash;

                $meta = $model_meta->findByHash($hash);
                if (empty($meta)) {
                    $meta = $model_meta->createRow();
                    $meta->book = $hash;
                }

                if ($this->override || empty($meta->title)) {
                    $meta->title = $title;

                    if ($this->override || (empty($meta->author) && !empty($author))) {
                        $meta->author = $author;
                    }

                    if ($this->override || (empty($meta->year) && !empty($year))) {
                        $meta->year = $year;
                    }

                    $meta->save();
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

    // Directory required
    public function metas($getopt) {
        try {
            $metas = $getopt->getOption('metas');

            echo str_pad('Setting metas in collection', $this->count, $this->separator);
            echo $this->ok;

            $json = json_decode($metas);
            foreach($json as $property => $value) {
                echo "    $property -> $value" . PHP_EOL;
            }

            $model_meta = new Books_Meta();

            foreach ($this->files as $file) {
                $label = iconv('UTF8', 'ASCII//TRANSLIT', $file->file);
                echo str_pad('Setting metas for ' . $label, $this->count, $this->separator);

                $hash = $file->hash;

                $meta = $model_meta->findByHash($hash);
                if (empty($meta)) {
                    $meta = $model_meta->createRow();
                    $meta->book = $hash;
                }

                foreach($json as $property => $value) {
                    if ($this->override || empty($meta->{$property})) {
                        $meta->{$property} = $value;
                    }
                }
                $meta->save();

                echo $this->ok;
            }

            return true;
        } catch (Exception $e) {
            $this->messages[] = $e->getMessage();
        }

        $this->__dump();
        return false;
    }

    // Directory required
    public function thumbs() {
        try {
            echo str_pad('Generate of thumbnails', $this->count, $this->separator);
            echo $this->ok;

            foreach ($this->files as $file) {
                $label = iconv('UTF8', 'ASCII//TRANSLIT', $file->file);
                echo str_pad('Thumbnail for ' . $label, $this->count, $this->separator);

                if ($this->override || !$file->hasThumb()) {
                    try {
                        $image = new Imagick($file->getPath() . '[0]');

                        $image->setImageFormat('jpeg');
                        $image->setImageType (imagick::IMGTYPE_TRUECOLOR);
                        $image->thumbnailImage(0, 390);
                        $image->writeImage(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg');

                        $thumbnail = new Yachay_Helpers_Thumbnail();
                        $thumbnail->thumbnail(APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '.jpg',
                                              APPLICATION_PATH . '/../public/media/img/thumbnails/books/' . $file->hash . '-small.jpg', 0, 100);
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
    
    // Directory required
    public function publish() {
        try {
            echo str_pad('Publish the books', $this->count, $this->separator);
            echo $this->ok;

            foreach ($this->files as $file) {
                $label = iconv('UTF8', 'ASCII//TRANSLIT', $file->file);
                echo str_pad('Publish ' . $label, $this->count, $this->separator);
                
                if (!$file->published) {
                    $file->tsregister = time();
                    $file->published = true;
                    $file->save();
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
    
    public function figlet($getopt) {
        $font_default = APPLICATION_PATH . '/../data/utils/figlet/mini.flf';
        if (!empty($this->font)) {
            $font_default = $this->font;
        }

        echo str_pad('Generating figlet', $this->count, $this->separator);

        $figlet = new Zend_Text_Figlet(array(
            'font' => $font_default,
        ));
        echo $figlet->render($getopt->getOption('figlet'));

        echo $this->ok;
        return true;
    }

    public function font($getopt) {
        $this->font = $getopt->getOption('font');
        return true;
    }
}

$command = new Shell_Babel();
$command->__setup()->__run();
