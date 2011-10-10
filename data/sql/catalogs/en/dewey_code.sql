DELETE FROM `babel_catalogs`;
INSERT INTO `babel_catalogs` (`root`, `parent`, `code`, `level`, `label`) VALUES
/* ENGLISH TRADUCTION */
(NULL, NULL, 'dewey-decimal-clasification', 0, 'Dewey Decimal clasification'),
(1,  1, '0',  1, 'Computer science, information & general works'),
(1,  1, '1',  1, 'Philosophy and psychology'),
(1,  1, '2',  1, 'Religion'),
(1,  1, '3',  1, 'Social sciences'),
(1,  1, '4',  1, 'Language'),
(1,  1, '5',  1, 'Science'),
(1,  1, '6',  1, 'Technology'),
(1,  1, '7',  1, 'Arts'),
(1,  1, '8',  1, 'Literature'),
(1,  1, '9',  1, 'History, geography, (& biography)'),
(1,  2, '00', 2, 'Computer science, knowledge & systems'),
(1,  2, '01', 2, 'Bibliographies'),
(1,  2, '02', 2, 'Library & information sciences'),
(1,  2, '03', 2, 'Encyclopedias & books of facts'),
(1,  2, '05', 2, 'Magazines, journals & serials'),
(1,  2, '06', 2, 'Associations, organizations & museums'),
(1,  2, '07', 2, 'News media, journalism & publishing'),
(1,  2, '08', 2, 'General collections'),
(1,  2, '09', 2, 'Manuscripts & rare books'),
(1,  3, '10', 2, 'Philosophy'),
(1,  3, '11', 2, 'Metaphysics'),
(1,  3, '12', 2, 'Epistemology, causation, humankind'),
(1,  3, '13', 2, 'Paranormal phenomena'),
(1,  3, '14', 2, 'Specific philosophical schools'),
(1,  3, '15', 2, 'Psychology'),
(1,  3, '16', 2, 'Logic'),
(1,  3, '17', 2, 'Ethics (Moral philosophy)'),
(1,  3, '18', 2, 'Ancient, medieval, Oriental philosophy'),
(1,  3, '19', 2, 'Modern Western philosophy (19th-century, 20th-century)'),
(1,  4, '20', 2, 'Religion'),
(1,  4, '21', 2, 'Natural theology'),
(1,  4, '22', 2, 'Bible'),
(1,  4, '23', 2, 'Christian theology'),
(1,  4, '24', 2, 'Christian moral & devotional theology'),
(1,  4, '25', 2, 'Christian orders & local church'),
(1,  4, '26', 2, 'Christian social theology'),
(1,  4, '27', 2, 'Christian church history'),
(1,  4, '28', 2, 'Christian denominations & sects'),
(1,  4, '29', 2, 'Other & comparative religions'),
(1,  5, '30', 2, 'Social sciences, sociology & anthropology'),
(1,  5, '31', 2, 'General statistics'),
(1,  5, '32', 2, 'Political science'),
(1,  5, '33', 2, 'Economics'),
(1,  5, '34', 2, 'Law'),
(1,  5, '35', 2, 'Public administration'),
(1,  5, '36', 2, 'Social services; association'),
(1,  5, '37', 2, 'Education'),
(1,  5, '38', 2, 'Commerce, communications, transport'),
(1,  5, '39', 2, 'Customs, etiquette, folklore'),
(1,  6, '40', 2, 'Language'),
(1,  6, '41', 2, 'Linguistics'),
(1,  6, '42', 2, 'English & Old English'),
(1,  6, '43', 2, 'Germanic languages; German'),
(1,  6, '44', 2, 'Romance languages; French'),
(1,  6, '45', 2, 'Italian, Romanian, Rhaeto-Romanic'),
(1,  6, '46', 2, 'Spanish & Portuguese languages'),
(1,  6, '47', 2, 'Italic languages; Latin'),
(1,  6, '48', 2, 'Hellenic languages; Classical Greek'),
(1,  6, '49', 2, 'Other languages'),
(1,  7, '50', 2, 'Sciences'),
(1,  7, '51', 2, 'Mathematics'),
(1,  7, '52', 2, 'Astronomy & allied sciences'),
(1,  7, '53', 2, 'Physics'),
(1,  7, '54', 2, 'Chemistry & allied sciences'),
(1,  7, '55', 2, 'Earth sciences'),
(1,  7, '56', 2, 'Paleontology; Paleozoology'),
(1,  7, '57', 2, 'Life sciences'),
(1,  7, '58', 2, 'Plants'),
(1,  7, '59', 2, 'Zoological sciences/Animals'),
(1,  8, '60', 2, 'Technology (Applied sciences)'),
(1,  8, '61', 2, 'Medical sciences; Medicine'),
(1,  8, '62', 2, 'Engineering & Applied operations'),
(1,  8, '63', 2, 'Agriculture'),
(1,  8, '64', 2, 'Home economics & family living'),
(1,  8, '65', 2, 'Management & auxiliary services'),
(1,  8, '66', 2, 'Chemical engineering'),
(1,  8, '67', 2, 'Manufacturing'),
(1,  8, '68', 2, 'Manufacture for specific uses'),
(1,  8, '69', 2, 'Buildings'),
(1,  9, '70', 2, 'Arts'),
(1,  9, '71', 2, 'Civic & landscape art'),
(1,  9, '72', 2, 'Architecture'),
(1,  9, '73', 2, 'Plastic arts; Sculpture'),
(1,  9, '74', 2, 'Drawing & decorative arts'),
(1,  9, '75', 2, 'Painting & paintings'),
(1,  9, '76', 2, 'Graphic arts; Printmaking & prints'),
(1,  9, '77', 2, 'Photography & photographs'),
(1,  9, '78', 2, 'Music'),
(1,  9, '79', 2, 'Recreational & performing arts'),
(1, 10, '80', 2, 'Literature rhetoric & criticism'),
(1, 10, '81', 2, 'American literature in English'),
(1, 10, '82', 2, 'English & Old English literatures'),
(1, 10, '83', 2, 'Literatures of Germanic languages'),
(1, 10, '84', 2, 'Literatures of Romance languages'),
(1, 10, '85', 2, 'Italian, Romanian, Rhaeto-Romanic'),
(1, 10, '86', 2, 'Spanish & Portuguese literatures'),
(1, 10, '87', 2, 'Italic literatures; Latin'),
(1, 10, '88', 2, 'Hellenic literatures; Classical Greek'),
(1, 10, '89', 2, 'Literatures of other languages'),
(1, 11, '90', 2, 'History'),
(1, 11, '91', 2, 'Geography & travel'),
(1, 11, '92', 2, 'Biography, genealogy, insignia'),
(1, 11, '93', 2, 'History of ancient world'),
(1, 11, '94', 2, 'General history of Europe'),
(1, 11, '95', 2, 'General history of Asia; Far East'),
(1, 11, '96', 2, 'General history of Africa'),
(1, 11, '97', 2, 'General history of North America'),
(1, 11, '98', 2, 'General history of South America'),
(1, 11, '99', 2, 'General history of other areas');