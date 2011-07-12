
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
    `code`              varchar(8)                                                  NOT NULL,
    `level`             int unsigned                                                NOT NULL,
    `description`       text                                                        NOT NULL DEFAULT '',
    `avatar`            boolean                                                     NOT NULL DEFAULT FALSE,
    `tsregister`        int unsigned                                                NOT NULL,
    `parent`            int unsigned                                                NULL,
    PRIMARY KEY (`ident`),
    INDEX (`parent`),
    FOREIGN KEY (`parent`) REFERENCES `babel_catalogs`(`ident`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

INSERT INTO `babel_catalogs` (`parent`, `code`, `level`, `label`) VALUES
(NULL, 'dewey-clasificacion', 0, 'Dewey clasification'),
( 1, '0',  1, 'Computer science, information & general works'),
( 1, '1',  1, 'Philosophy and psychology'),
( 1, '2',  1, 'Religion'),
( 1, '3',  1, 'Social sciences'),
( 1, '4',  1, 'Language'),
( 1, '5',  1, 'Science'),
( 1, '6',  1, 'Technology'),
( 1, '7',  1, 'Arts'),
( 1, '8',  1, 'Literature'),
( 1, '9',  1, 'History, geography, (& biography)'),
( 2, '00', 2, 'Computer science, knowledge & systems'),
( 2, '01', 2, 'Bibliographies'),
( 2, '02', 2, 'Library & information sciences'),
( 2, '03', 2, 'Encyclopedias & books of facts'),
( 2, '05', 2, 'Magazines, journals & serials'),
( 2, '06', 2, 'Associations, organizations & museums'),
( 2, '07', 2, 'News media, journalism & publishing'),
( 2, '08', 2, 'General collections'),
( 2, '09', 2, 'Manuscripts & rare books'),
( 3, '10', 2, 'Philosophy'),
( 3, '11', 2, 'Metaphysics'),
( 3, '12', 2, 'Epistemology, causation, humankind'),
( 3, '13', 2, 'Paranormal phenomena'),
( 3, '14', 2, 'Specific philosophical schools'),
( 3, '15', 2, 'Psychology'),
( 3, '16', 2, 'Logic'),
( 3, '17', 2, 'Ethics (Moral philosophy)'),
( 3, '18', 2, 'Ancient, medieval, Oriental philosophy'),
( 3, '19', 2, 'Modern Western philosophy (19th-century, 20th-century)'),
( 4, '20', 2, 'Religion'),
( 4, '21', 2, 'Natural theology'),
( 4, '22', 2, 'Bible'),
( 4, '23', 2, 'Christian theology'),
( 4, '24', 2, 'Christian moral & devotional theology'),
( 4, '25', 2, 'Christian orders & local church'),
( 4, '26', 2, 'Christian social theology'),
( 4, '27', 2, 'Christian church history'),
( 4, '28', 2, 'Christian denominations & sects'),
( 4, '29', 2, 'Other & comparative religions'),
( 5, '30', 2, 'Social sciences, sociology & anthropology'),
( 5, '31', 2, 'General statistics'),
( 5, '32', 2, 'Political science'),
( 5, '33', 2, 'Economics'),
( 5, '34', 2, 'Law'),
( 5, '35', 2, 'Public administration'),
( 5, '36', 2, 'Social services; association'),
( 5, '37', 2, 'Education'),
( 5, '38', 2, 'Commerce, communications, transport'),
( 5, '39', 2, 'Customs, etiquette, folklore'),
( 6, '40', 2, 'Language'),
( 6, '41', 2, 'Linguistics'),
( 6, '42', 2, 'English & Old English'),
( 6, '43', 2, 'Germanic languages; German'),
( 6, '44', 2, 'Romance languages; French'),
( 6, '45', 2, 'Italian, Romanian, Rhaeto-Romanic'),
( 6, '46', 2, 'Spanish & Portuguese languages'),
( 6, '47', 2, 'Italic languages; Latin'),
( 6, '48', 2, 'Hellenic languages; Classical Greek'),
( 6, '49', 2, 'Other languages'),
( 7, '50', 2, 'Sciences'),
( 7, '51', 2, 'Mathematics'),
( 7, '52', 2, 'Astronomy & allied sciences'),
( 7, '53', 2, 'Physics'),
( 7, '54', 2, 'Chemistry & allied sciences'),
( 7, '55', 2, 'Earth sciences'),
( 7, '56', 2, 'Paleontology; Paleozoology'),
( 7, '57', 2, 'Life sciences'),
( 7, '58', 2, 'Plants'),
( 7, '59', 2, 'Zoological sciences/Animals'),
( 8, '60', 2, 'Technology (Applied sciences)'),
( 8, '61', 2, 'Medical sciences; Medicine'),
( 8, '62', 2, 'Engineering & Applied operations'),
( 8, '63', 2, 'Agriculture'),
( 8, '64', 2, 'Home economics & family living'),
( 8, '65', 2, 'Management & auxiliary services'),
( 8, '66', 2, 'Chemical engineering'),
( 8, '67', 2, 'Manufacturing'),
( 8, '68', 2, 'Manufacture for specific uses'),
( 8, '69', 2, 'Buildings'),
( 9, '70', 2, 'Arts'),
( 9, '71', 2, 'Civic & landscape art'),
( 9, '72', 2, 'Architecture'),
( 9, '73', 2, 'Plastic arts; Sculpture'),
( 9, '74', 2, 'Drawing & decorative arts'),
( 9, '75', 2, 'Painting & paintings'),
( 9, '76', 2, 'Graphic arts; Printmaking & prints'),
( 9, '77', 2, 'Photography & photographs'),
( 9, '78', 2, 'Music'),
( 9, '79', 2, 'Recreational & performing arts'),
(10, '80', 2, 'Literature rhetoric & criticism'),
(10, '81', 2, 'American literature in English'),
(10, '82', 2, 'English & Old English literatures'),
(10, '83', 2, 'Literatures of Germanic languages'),
(10, '84', 2, 'Literatures of Romance languages'),
(10, '85', 2, 'Italian, Romanian, Rhaeto-Romanic'),
(10, '86', 2, 'Spanish & Portuguese literatures'),
(10, '87', 2, 'Italic literatures; Latin'),
(10, '88', 2, 'Hellenic literatures; Classical Greek'),
(10, '89', 2, 'Literatures of other languages'),
(11, '90', 2, 'History'),
(11, '91', 2, 'Geography & travel'),
(11, '92', 2, 'Biography, genealogy, insignia'),
(11, '93', 2, 'History of ancient world'),
(11, '94', 2, 'General history of Europe'),
(11, '95', 2, 'General history of Asia; Far East'),
(11, '96', 2, 'General history of Africa'),
(11, '97', 2, 'General history of North America'),
(11, '98', 2, 'General history of South America'),
(11, '99', 2, 'General history of other areas');
