<?php

class Babel_Utils_DirectoryScanner {

    public function scan_collection($bookstore, &$adapters = null, &$warnings = null, &$metas = null) {
        $model_collection = new Books_Collection();
        $model_meta = new Books_Meta();

        $scan = array();
        $dict_books = array();
        $hashes = array();

        $books = $model_collection->fetchAll();
        foreach ($books as $book) {
            $dict_books[$book->hash] = $book;
        }

        $files = $this->scan_files($bookstore);
        foreach ($files as $file) {
            if (isset($dict_books[$file['hash']])) {
                $book = $dict_books[$file['hash']];
                if ($book->getPath() <> "{$file['directory']}/{$file['file']}") {
                    $book = $model_collection->createRow($file);
                    $warnings[$book->getPath()] = $dict_books[$file['hash']]->getPath();
                }
            } else {
                $book = $model_collection->createRow($file);
            }

            $scan[] = $book;
            $hashes[] = $file['hash'];

            if (isset($adapters)) {
                $adapters[$book->hash] = $book;
            }
        }

        if (isset($metas) && count($hashes) <> 0) {
            $_metas = $model_meta->fetchAll($model_meta->select()->where('book IN (?)', $hashes));
            foreach ($_metas as $meta) {
                $metas[$meta->book] = $meta;
            }
        }

        return $scan;
    }

    public function scan_files($directory) {
        $files = array();
        $config = Zend_Registry::get('Config');

        $subdirectories = @scandir($directory);
        if ($subdirectories) {
            foreach ($subdirectories as $file) {
                if (($file <> '.') && ($file <> '..')) {
                    $path = "$directory/$file";
                    if (is_dir($path)) {
                        $files = @array_merge($files, $this->scan_files($path));
                    } else if (is_file($path)) {
                        if (substr(strtolower($file), -3) == 'pdf') {
                            $files[] = array(
                                'directory' => $directory,
                                'file' => $file,
                                'size' => filesize($path),
                                'hash' => hash_file($config->babel->properties->algo, $path),
                            );
                        }
                    }
                }
            }
        }

        return $files;
    }
}
