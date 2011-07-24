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
    `username`          varchar(128)                                                NOT NULL,
    `password`          varchar(40)                                                 NOT NULL,
    `fullname`          varchar(128)                                                NOT NULL DEFAULT '',
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
    `tsregister`        int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`username`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_collection`;
CREATE TABLE `babel_books_collection` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `size`              int unsigned                                                NOT NULL,
    `md5_file`          varchar(32)                                                 NOT NULL,
    `md5_path`          varchar(32)                                                 NOT NULL,
    `bookstore`         varchar(2048)                                               NOT NULL,
    `directory`         varchar(2048)                                               NOT NULL,
    `file`              varchar(2048)                                               NOT NULL,
    `tsregister`        int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`ident`),
    INDEX (`md5_file`),
    INDEX (`md5_path`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_shared`;
CREATE TABLE `babel_books_shared` (
    `book`              int unsigned                                                NOT NULL,
    `title`             varchar(1024)                                               NOT NULL,
    `author`            varchar(1024)                                               NOT NULL DEFAULT '',
    `publisher`         varchar(1024)                                               NOT NULL DEFAULT '',
    `language`          varchar(1024)                                               NOT NULL,
    `year`              varchar(4)                                                  NOT NULL DEFAULT '',
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
    INDEX (`book`),
    FOREIGN KEY (`book`) REFERENCES `babel_books_collection`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_stats`;
CREATE TABLE `babel_books_stats` (
    `book`              int unsigned                                                NOT NULL,
    `downloads`         int unsigned                                                NOT NULL DEFAULT 0,
    PRIMARY KEY (`book`),
    INDEX (`book`),
    FOREIGN KEY (`book`) REFERENCES `babel_books_collection`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_catalogs`;
CREATE TABLE `babel_catalogs` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `label`             varchar(128)                                                NOT NULL,
    `code`              varchar(8)                                                  NOT NULL DEFAULT '',
    `level`             int unsigned                                                NOT NULL,
    `description`       text                                                        NOT NULL DEFAULT '',
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
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
    `book`              int unsigned                                                NOT NULL,
    `catalog`           int unsigned                                                NOT NULL,
    PRIMARY KEY (`book`, `catalog`),
    INDEX (`book`),
    FOREIGN KEY (`book`)          REFERENCES `babel_books_shared`(`book`) ON UPDATE CASCADE ON DELETE CASCADE,
    INDEX (`catalog`),
    FOREIGN KEY (`catalog`)       REFERENCES `babel_catalogs`(`ident`) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARACTER SET UTF8;

INSERT INTO `babel_users` (`ident`, `fullname`, `username`, `password`, `avatar`) VALUES
(1, 'Carlos Caballero',  'jacobian', '63ca26f56c5730ede6b21c7b681b917e2fb37765', 0);
