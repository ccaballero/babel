
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

INSERT INTO `babel_users` (`fullname`, `username`, `password`) VALUES
('Carlos Caballero',  'jacobian', '63ca26f56c5730ede6b21c7b681b917e2fb37765');

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
    PRIMARY KEY (`ident`)
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_shared`;
CREATE TABLE `babel_books_shared` (
    `book`              int unsigned                                                NOT NULL,
    `title`             varchar(1024)                                               NOT NULL,
    `author`            varchar(1024)                                               NOT NULL,
    `publisher`         varchar(1024)                                               NOT NULL,
    `language`          varchar(1024)                                               NOT NULL,
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
    INDEX (`book`),
    FOREIGN KEY (`book`) REFERENCES `babel_books_collection`(`ident`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_books_stats`;
CREATE TABLE `babel_books_stats` (
    `book`              int unsigned                                                NOT NULL,
    `downloads`         int unsigned                                                NOT NULL DEFAULT 0,
    INDEX (`book`),
    FOREIGN KEY (`book`) REFERENCES `babel_books_collection`(`ident`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

DROP TABLE IF EXISTS `babel_catalogs`;
CREATE TABLE `babel_catalogs` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `label`             varchar(128)                                                NOT NULL,
    `url`               varchar(128)                                                NOT NULL,
    `description`       text                                                        NOT NULL DEFAULT '',
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
    `tsregister`        int unsigned                                                NOT NULL,
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`label`),
    UNIQUE INDEX (`url`)
) DEFAULT CHARACTER SET UTF8;

INSERT INTO `babel_catalogs` (`label`, `url`, `description`) VALUES
('Sistema de clasificacion decimal Dewey', 'sistema-de-clasificacion-decimal-dewey', '');
