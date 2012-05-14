SELECT 'creando las tablas';
\. definition.sql
SELECT 'insertando datos por omision';
\. users/default.sql

/* English */
/* \. catalogs/en/dewey_code.sql */

/* Español */
SELECT 'cargando codificacion dewey';
\. catalogs/es/codificacion_dewey.sql
SELECT 'cargando sistemas';
\. catalogs/es/sistemas.sql
SELECT 'cargando informatica';
\. catalogs/es/informatica.sql
