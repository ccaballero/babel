DELETE FROM `babel_catalogs`;
INSERT INTO `babel_catalogs` (`tsregister`, `mode`, `type`, `root`, `parent`, `code`, `level`, `label`, `owner`) VALUES
(UNIX_TIMESTAMP(), 'close', 't', NULL, NULL, 'clasificacion-decimal-dewey', 0, 'Clasificación Decimal Dewey', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '0',  1, 'Generalidades', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '1',  1, 'Filosofía y disciplinas relacionadas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '2',  1, 'Religion', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '3',  1, 'Ciencias sociales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '4',  1, 'Lenguas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '5',  1, 'Ciencias puras', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '6',  1, 'Tecnología (ciencias aplicadas)', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '7',  1, 'Arte', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '8',  1, 'Literatura', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  1, '9',  1, 'Historia y geografía general', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '00', 2, 'Generalidades', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '01', 2, 'Bibliografía', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '02', 2, 'Bibliotecnología e informática', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '03', 2, 'Enciclopedias generales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '05', 2, 'Publicaciones en serie', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '06', 2, 'Organizaciones y museografía', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '07', 2, 'Periodismo, editoriales, diarios', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '08', 2, 'Colecciones generales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  2, '09', 2, 'Manuscritos y libros raros', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '10', 2, 'Filosofía', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '11', 2, 'Metafísica', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '12', 2, 'Conocimiento, causa, fin, hombre', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '13', 2, 'Parapsicología, ocultismo', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '14', 2, 'Puntos de vista filosóficos', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '15', 2, 'Psicología', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '16', 2, 'Lógica', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '17', 2, 'Ética (filosofía moral)', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '18', 2, 'Filosofía antigua, medieval, oriental', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  3, '19', 2, 'Filosofía moderna occidental', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '20', 2, 'Religion', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '21', 2, 'Religión natural', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '22', 2, 'Biblia', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '23', 2, 'Teología cristiana', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '24', 2, 'Moral y prácticas cristianas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '25', 2, 'Iglesia local y órdenes religiosas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '26', 2, 'Teología social y eclesiología', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '27', 2, 'Historia y geografía de la iglesia', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '28', 2, 'Credos de la iglesia cristiana', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  4, '29', 2, 'Otras religiones', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '30', 2, 'Ciencias sociales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '31', 2, 'Estadística', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '32', 2, 'Ciencia política', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '33', 2, 'Economía', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '34', 2, 'Derecho', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '35', 2, 'Administración pública', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '36', 2, 'Patología y servicio sociales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '37', 2, 'Educación', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '38', 2, 'Comercio', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  5, '39', 2, 'Costumbres y folklore', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '40', 2, 'Lenguas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '41', 2, 'Lingüística', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '42', 2, 'Inglés y anglosajón', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '43', 2, 'Lenguas germánicas; alemán', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '44', 2, 'Lenguas romances; francés', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '45', 2, 'Italiano, rumano, rético', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '46', 2, 'Español y portugués', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '47', 2, 'Lenguas itálicas; latín', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '48', 2, 'Lenguas helénicas; griego clásico', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  6, '49', 2, 'Otras lenguas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '50', 2, 'Ciencias puras', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '51', 2, 'Matemáticas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '52', 2, 'Astronomía y ciencias afines', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '53', 2, 'Física', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '54', 2, 'Química y ciencias afines', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '55', 2, 'Geociencias', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '56', 2, 'Paleontología', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '57', 2, 'Ciencias biológicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '58', 2, 'Ciencias botánicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  7, '59', 2, 'Ciencias zoológicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '60', 2, 'Tecnología (ciencias aplicadas)', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '61', 2, 'Ciencias médicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '62', 2, 'Ingeniería y operaciones afines', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '63', 2, 'Agricultura y tecnologías afines', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '64', 2, 'Economía doméstica', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '65', 2, 'Servicios administrativos empresariales', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '66', 2, 'Química industrial', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '67', 2, 'Manufacturas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '68', 2, 'Manufacturas varias', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  8, '69', 2, 'Construcciones', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '70', 2, 'Arte', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '71', 2, 'Urbanismo y arquitectura del paisaje', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '72', 2, 'Arquitectura', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '73', 2, 'Artes plásticas; escultura', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '74', 2, 'Dibujo, artes decorativas y menores', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '75', 2, 'Pintura y pinturas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '76', 2, 'Artes gráficas; grabados', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '77', 2, 'Fotografía y fotografías', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '78', 2, 'Música', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1,  9, '79', 2, 'Entretenimiento', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '80', 2, 'Literatura', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '81', 2, 'Literatura americana en inglés', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '82', 2, 'Literatura inglesa y anglosajona', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '83', 2, 'Literaturas germánicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '84', 2, 'Literaturas de las lenguas romances', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '85', 2, 'Literaturas italiana, rumana', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '86', 2, 'Literaturas española y portuguesa', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '87', 2, 'Literaturas de las lenguas itálicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '88', 2, 'Literaturas de las lenguas helénicas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 10, '89', 2, 'Literaturas de otras lenguas', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '90', 2, 'Historia', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '91', 2, 'Geografía; viajes', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '92', 2, 'Biografía y genealogía', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '93', 2, 'Historia del mundo antiguo', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '94', 2, 'Historia de Europa', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '95', 2, 'Historia de Asia', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '96', 2, 'Historia de áfrica', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '97', 2, 'Historia de América del Norte', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '98', 2, 'Historia de América del Sur', 1),
(UNIX_TIMESTAMP(), 'open', 't', 1, 11, '99', 2, 'Historia de otras regiones', 1);
