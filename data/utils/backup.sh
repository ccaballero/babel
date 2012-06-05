#!/bin/bash

DIRECTORY='/home/carlos/Babel/data'
USER='carlos'
PASSWORD='password'
CHARACTER_SET='utf8'
DATABASE='babel'

DATE=$(date +%Y%m%d)

cd $DIRECTORY
mysqldump --user=$USER --password=$PASSWORD --default-character-set=$CHARACTER_SET $DATABASE > $DATE.sql
tar -cz --remove-files --file $DIRECTORY/backup/$DATE.tar.gz $DATE.sql
