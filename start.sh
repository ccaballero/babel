#!/bin/bash

USER=$1
DATABASE=$2
PASSWORD=$3

cp gitignore-dist .gitignore
cp application/configs/application-dist.ini application/configs/application.ini

cd data/sql/
mysql --user=$USER --database=$2 --password=$3 --default-character-set=utf8 < install.sql
cd -

cd shell/
php babel.php --index
cd -

chmod 777 data/lucene
chmod 777 data/upload
chmod 777 public/media/img/thumbnails/users
chmod 777 public/media/img/thumbnails/catalogs
chmod 777 public/media/img/thumbnails/books
