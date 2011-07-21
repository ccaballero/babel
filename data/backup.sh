#!/bin/bash

USER='carlos'
PASSWORD='asdf'
CHARACTER_SET='utf8'
DATABASE='babel'

DATE=$(date +%Y%m%d)

mysqldump --user=$USER --password=$PASSWORD --default-character-set=$CHARACTER_SET $DATABASE > $DATE.sql
tar -cz --remove-files --file backup/$DATE.tar.gz $DATE.sql

