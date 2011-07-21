#!/bin/bash

DIRECTORY='/home/carlos/Babel/data'
USER='carlos'
PASSWORD='asdf'
CHARACTER_SET='utf8'
DATABASE='babel'

DATE=$(date +%Y%m%d)

mysqldump --user=$USER --password=$PASSWORD --default-character-set=$CHARACTER_SET $DATABASE > $DIRECTORY/$DATE.sql
tar -cz --remove-files --file $DIRECTORY/backup/$DATE.tar.gz $DIRECTORY/$DATE.sql

