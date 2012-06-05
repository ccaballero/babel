<h1>Busqueda de libros</h1>

<p>
La pagina principal presenta un campo de texto donde usted puede ingresar algún
criterio de busqueda.
</p>
<div class="img">
<img src="/media/img/help/search.png" alt="Buscador" title="Buscador" />
<p>Campo de texto para busqueda de documentos</p>
</div>
<p>
De ahi podrá ver los resultados asociados a los documentos que se encuentran en
el sistema.
</p>
<div class="img">
<img src="/media/img/help/results.png" alt="Resultados" title="Resultados" />
<p>Campo de texto y su resultado despues de una busqueda</p>
</div>
<p>
Si hace click sobre algun documento entre los resultados, se desplegará la
información relacionada a este.
</p>
<div class="img">
<img src="/media/img/help/book-details.png"
     alt="Detalles del libro" title="Detalles del libro" />
<p>Detalles de un documento de la pagina de resultados</p>
</div>
<p>
Entre los detalles del documento pueden apreciarse dos iconos. El icono 
<img src="/media/img/icons/disk.png" alt="Descargar" title="Descargar" />
descargará el libro; y el icono
<img src="/media/img/icons/tag_blue.png" alt="Descargar" title="Descargar" />
conduce a la pagina para catalogar el libro.
</p>

<h2>Lenguaje de consulta</h2>
<p>
Babel utiliza el motor de busqueda
<a href="http://lucene.apache.org/core/">Lucene</a> implementado por las
librerias Zend, esta provee al usuario un conjunto de funciones adicionales.
A continuación intentamos traducir la documentación al respecto a este motor de
busqueda cuya fuente original se encuentra en
<a href="http://framework.zend.com/manual/en/zend.search.lucene.query-language.html">
Zend Search Lucene Query-Language</a>. Para conocer los detalles respecto a la
implementación de los campos y la forma de busqueda especifica para Babel,
refierase a la pagina
<a href="<?php echo $this->url(array('page' => 'searcher'), 'help_manual') ?>">
Funciones de busqueda</a>.
</p>

<h3>Terminos</h3>
<p>
Una consulta está compuesta de terminos y operadores. Existen tres tipos de
terminos: terminos simples, frases y subconsultas.
</p>
<p>
Un termino simple es un palabra suelta, como "prueba" o "hola".
</p>
<p>
Una frase es un grupo de palabras encerradas entre comillas dobles, como
"hola dolly".
</p>
<p>
Una subconsulta es un consulta encerrada entre parentesis, como "(hola dolly)".
</p>
<p>
Multiples terminos pueden ser combinados entre si por medio de operadores, para
formar consultas complejas (ver mas abajo).
</p>

<h3>Campos</h3>
<p>
Se pueden buscar determinados campos, especificando el nombre del campo seguido
por dos puntos ":", seguido por el termino que estas buscando.
</p>
<p>
Como ejemplo, asumiremos que el motor contiene dos campos: "titulo" y "texto"
con "texto" como campo por omision. Si tu quieres buscar el documento titulado
"La manera correcta" que contenga el texto "de esta manera", tu puedes escribir:
</p>
<blockquote>titulo:"La manera correcta" AND texto:"de esta manera"</blockquote>
<p>ó</p>
<blockquote>titulo:"La manera correcta" AND "de esta manera"</blockquote>
<p>
Como "texto" es el campo por omisión, el indicador de campo no es requerido.
</p>
<p>
Nota: El campo es solo valido para el termino, frase o subconsulta que este
directamente precedido, por ejemplo:
</p>
<blockquote>titulo:La manera correcta</blockquote>
<p>
Unicamente buscará "La" en el campo titulo. Ademas de buscar "manera" y
"correcta" en el campo por omisión (si el campo esta definido) o en todos los
campos indexados (si el campo por omisión no existiese).
</p>

<h3>Comodines</h3>
<p>
Lucene soporta caracteres comodín simples y multiples en terminos simples
(pero no en frases).
</p>
<p>
Para un comodín de un caracter use el simbolo "?".
</p>
<p>
Para un comodín de varios caracteres utilice el simbolo "*".
</p>
<p>
El comodín "?" intenta reemplazar cualquier caracter simple. Por ejemplo, para
buscar "text" ó "test" puedes escribir:
</p>
<blockquote>te?t</blockquote>
<p>
El comodín "*" intenta reemplazar por 0 o más caracteres. Por ejemplo, para
buscar "test", "tests" ó "tester", puedes escribir:
</p>
<blockquote>test*</blockquote>
<p>
Tambien se puede usar "?", "*", o ambos en cualquier lugar del termino:
</p>
<blockquote>*wr?t*</blockquote>
<p>
Buscará por "write", "wrote", "written", "rewrite", "rewrote" y cualquier otra
coincidencia.
</p>

<h3>Modificadores</h3>
<p>
Lucene soporta modificadores para proveer un amplio rango de opciones de
busqueda.
</p>
<p>
El modificador "~" puede ser usado para busquedas difusas en terminos simples.
</p>

<h3>Rangos</h3>
<p>
Las busquedas por rango permiten emparejar documentos o campos entre un termino
inferior y uno superior. Estos dependerán de su posicion lexicografica. Por
ejemplo:
</p>
<blockquote>mod_date:[20020101 TO 20030101]</blockquote>
<p>
Buscará documentos cuyo campo "mod_date" comprenda los valores entre
20020101 y 20030101, incluyendo a estos. Notese que las busquedas por rango no
estan reservadas a campos de tipo fecha. Se pueden también utilizar en otros
tipos de campos:
</p>
<blockquote>titulo:{Aida TO Carmen}</blockquote>
<p>
Esto buscará todos los documentos en los que el campo "titulo" esten
comprendidos entre Aida y Carmen, incluyendo a estos valores.
</p>
<p>
Los rangos inclusivos estan denotados entre corchetes ([, ]). los rangos
exclusivos estan denotados entre llaves ({, }).
</p>
<p>
Si el campo no esta especificado, entonces se buscará entre todos los campos por
omisión.
</p>
<blockquote>{Aida TO Carmen}</blockquote>

<h3>Busquedas difusas</h3>
<p>
Lucene soporta busquedas difusas basadas en la
<a href="http://es.wikipedia.org/wiki/Distancia_de_Levenshtein">Distancia de
Levenshtein</a>. Para realizar busquedas difusas use el caracter "~", al final
del termino simple. Por ejemplo para buscar por un termino similar a "roam"
escriba:
</p>
<blockquote>roam~</blockquote>
<p>
Esta buscará terminos como foam y roams. Adicionalmente puede especificar el
grado de similaridad. El valor debe estar entre 0 y 1, con 1 como el valor para
la mayor similaridad. Por ejemplo:
</p>
<blockquote>roam~0.8</blockquote>
<p>
El valor por omisión utilizado si el parametro no fue definido es 0.5.
</p>

<h3>Busquedas por proximidad</h3>
<p>
Lucene soporta la busqueda de palabras en una frase que estan a una determinada
distancia. Para realizar una busqueda por proximidad use el simbolo "~", al
final de la frase. Por ejemplo para buscar por "Zend" y "Framework" con
10 palabras entre ellas, escriba:
</p>
<blockquote>"Zend Framework"~10</blockquote>

<h3>Relevancia de los terminos</h3>
<p>
Lucene permite establecer el nivel de relevancia en la busqueda de documentos
segun los terminos de busqueda. Para elevar la relevancia de un termino,
se utiliza el simbolo "^", seguido de un factor (un numero) al final del
termino de busqueda. Cuanto mas alto sea el factor de elevación, mas relevante
será el termino en la busqueda.
</p>
<p>
Esto permite controlar el grado de relevancia del termino. Por ejemplo, si tu
estas buscando:
</p>
<blockquote>PHP framework</blockquote>
<p>
y quieres que el termino "PHP" sea mas relevante, se usa el simbolo ^ junto al
factor de relevancia.
</p>
<blockquote>PHP^4 framework</blockquote>
<p>
Esto hará que los documentos con el termino "PHP" tengan mayor relevancia.
Tu puedes tambien elevar la relevancia de una frase o subconsulta, como en el
siguiente ejemplo:
</p>
<blockquote>"PHP framework"^4 "Zend Framework"</blockquote>
<p>
Por omisión, el factor de relevancia es 1. Ademas tal factor debe ser positivo,
pero puede ser menor que 1 (por ejemplo 0.2).
</p>

<h3>Operaciones logicas</h3>
<p>
Los operadores logicos permiten combinar terminos. Lucene soporta los operadores
"AND", "+", "OR", "NOT" y "-".
</p>
<p>
Los operadores AND, OR, y NOT, como tambien los operadores "+", "-" definen dos
diferentes estilos de construccion de consultas. La implementación de Lucene
utilizada no permite combinar tales estilos.
</p>
<p>
Si el estilo AND/OR/NOT es utilizado, entonces los operadores AND ó OR deben
estar presentes entre todos los terminos. Y cada termino puede estar precedido
por el operador NOT. El operador AND tiene mayor precedencia que el operador OR.
</p>

<h3>AND</h3>
<p>
El operador AND dice que todos los terminos en el grupo deben emparejar alguna
parte de los campos de busqueda.
</p>
<p>
Para buscar documentos que contengan "PHP framework" y "Zend Framework" use la
siguiente consulta:
</p>
<blockquote>"PHP framework" AND "Zend Framework"</blockquote>

<h3>OR</h3>
<p>
El operador OR divide la consulta en muchos terminos opcionales.
</p>
<p>
Para buscar los documentos que contengan "PHP framework" ó "Zend Framework" use
la siguiente consulta:
</p>
<blockquote>"PHP framework" OR "Zend Framework"</blockquote>

<h3>NOT</h3>
<p>
El operador NOT excluye los documentos que contengan tal termino. Pero si
un grupo de terminos unidos por un operador AND solo contienen terminos con el
operador NOT, este resultará vacio, en lugar de resultar en todos los documentos
indexados.
</p>
<p>
Para buscar documentos que contengan "PHP framework" pero que no contengan 
"Zend Framework" use la siguiente consulta:
</p>
<blockquote>"PHP framework" AND NOT "Zend Framework"</blockquote>

<h3>Operadores &&, ||, y !</h3>
<p>
&&, ||, y ! pueden ser utilizados en lugar de la notación AND, OR, y NOT.
</p>

<h3>+</h3>
<p>
El simbolo "+" o operador "requerido", estipula que el termino debe estar en el
documento.
</p>
<p>
Para buscar por los documentos que deben contener "Zend" y que pueden contener
"Framework" use la siguiente consulta:
</p>
<blockquote>+Zend Framework</blockquote>

<h3>-</h3>
<p>
El simbolo "-" o operados "prohibido", excluye los documentos que emparejan con
tal termino.
</p>
<p>
Para buscar por los documentos que contienen "PHP framework" pero no
"Zend Framework" use la siguiente consulta:
</p>
<blockquote>"PHP framework" -"Zend Framework"</blockquote>

<h3>Terminos sin operador</h3>
<p>
Si ningun operador es utilizado, entonces el comportamiento de busqueda estará
definido por el operador logico por omisión. Este es el operador "OR".
</p>
<p>
Lo que implica que cada termino es opcional. Este puede estar o no presente en
el documento, pero los documentos que posean el termino poseerán mayor
relevancia.
</p>
<p>
Para buscar los documentos que tengan "PHP framework" y que pueden contener
"Zend Framework" use la siguiente consulta:
</p>
<blockquote>+"PHP framework" "Zend Framework"</blockquote>

<h3>Grupos</h3>
<p>
Lucene soporta el uso de parentesis para agrupar clausulas que conforman una
subconsulta. Esto puede ser util si quieres controlar la precedencia de los
operadores logicos para una consulta o si quisieras mezclar varios estilos de
busqueda con operadores logicos:
</p>
<blockquote>+(framework OR library) +php</blockquote>
<p>
Lucene soporta subconsultas anidadas hasta cualquier nivel.
</p>

<h3>Grupos en campos</h3>
<p>
Lucene tambien soporta el uso de parentesis para agrupar multiples clausulas en
un campo.
</p>
<p>
Para buscar los documentos cuyo campo "titulo" contenga las palabras
"return" y la frase "pink panther" use la siguiente consulta:
</p>
<blockquote>titulo:(+return +"pink panther")</blockquote>

<h3>Escapando caracteres especiales</h3>
<p>
Lucene puede escapar los caracteres especiales utilizados en la sintaxis de la
consulta. Los caracteres especiales son:
</p>
<p>
+ - &amp;&amp; || ! ( ) { } [ ] ^ " ~ * ? : \
</p>
<p>
Los operadores "+" y "-" utilizados dentro de terminos simples son tratados
automaticamente como caracteres ordinarios.
</p>
<p>
Para escapar los caracteres especiales use el simbolo "\" antes del caracter
que tu desees escapar. Por ejemplo para buscar el termino (1+1):2 use la siguiente
consulta:
</p>
<blockquote>\(1\+1\)\:2</blockquote>

<p>&nbsp;</p>
