DROP TABLE IF EXISTS `babel_search_keywords`;
CREATE TABLE `babel_search_keywords` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `keyword`           varchar(1024)                                               NOT NULL,
    `tsregister`        int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`ident`),
    INDEX (`keyword`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_users`;
CREATE TABLE `babel_users` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `role`              enum('user','admin')                                        NOT NULL,
    `username`          varchar(128)                                                NOT NULL,
    `password`          varchar(40)                                                 NOT NULL,
    `fullname`          varchar(128)                                                NOT NULL DEFAULT '',
    `tsregister`        int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`username`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_collection`;
CREATE TABLE `babel_books_collection` (
    `hash`              char(64)                                                    NOT NULL,
    `size`              int unsigned                                                NOT NULL,
    `directory`         varchar(2048)                                               NOT NULL,
    `file`              varchar(2048)                                               NOT NULL,
    `published`         boolean                                                     NOT NULL DEFAULT FALSE,
    `tsregister`        int unsigned                                                NOT NULL DEFAULT 0,
    `tsupdated`         int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`hash`),
    INDEX (`directory`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_stats`;
CREATE TABLE `babel_books_stats` (
    `book`              char(32)                                                    NOT NULL,
    `downloads`         int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`book`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_meta`;
CREATE TABLE `babel_books_meta` (
    `book`              char(32)                                                    NOT NULL,
    `title`             varchar(1024)                                               NULL,
    `author`            varchar(1024)                                               NULL,
    `publisher`         varchar(1024)                                               NULL,
    `language`          varchar(1024)                                               NULL,
    `year`              varchar(4)                                                  NULL,
    PRIMARY KEY (`book`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_catalogs`;
CREATE TABLE `babel_catalogs` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `label`             varchar(128)                                                NOT NULL,
    `code`              varchar(8)                                                  NOT NULL DEFAULT '',
    `level`             int unsigned                                                NOT NULL,
    `description`       text                                                        NOT NULL DEFAULT '',
    `tsregister`        int unsigned                                                NOT NULL,
    `parent`            int unsigned                                                NULL,
    `root`              int unsigned                                                NULL,
    `books`             int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`ident`),
    INDEX (`parent`),
    FOREIGN KEY (`parent`) REFERENCES `babel_catalogs`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_catalogs_stats`;
CREATE TABLE `babel_catalogs_stats` (
    `catalog`           int unsigned                                                NOT NULL,
    `books`             int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`catalog`),
    INDEX (`catalog`),
    FOREIGN KEY (`catalog`) REFERENCES `babel_books_catalogs`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_catalogs`;
CREATE TABLE `babel_books_catalogs` (
    `book`              char(32)                                                NOT NULL,
    `catalog`           int unsigned                                                NOT NULL,
    PRIMARY KEY (`book`, `catalog`),
    INDEX (`book`),
    FOREIGN KEY (`book`) REFERENCES `babel_books_collection`(`hash`) ON UPDATE CASCADE ON DELETE CASCADE,
    INDEX (`catalog`),
    FOREIGN KEY (`catalog`) REFERENCES `babel_catalogs`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;
