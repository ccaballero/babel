<div id="classic">
    <h1><?php echo $this->translate->_('Query Language') ?></h1>

    <span class="bold"><?php echo $this->translate->_('source') ?>:</span> <a href="http://framework.zend.com/manual/en/zend.search.lucene.query-language.html">http://framework.zend.com/manual/en/zend.search.lucene.query-language.html</a>

    <h2><?php echo $this->translate->_('Terms') ?></h2>

    <p><?php echo $this->translate->_('A query is broken up into terms and operators. There are three types of terms: Single Terms, Phrases, and Subqueries.') ?></p>
    <p><?php echo $this->translate->_('A Single Term is a single word such as \"test\" or \"hello\".') ?></p>
    <p><?php echo $this->translate->_('A Phrase is a group of words surrounded by double quotes such as \"hello dolly\".') ?></p>
    <p><?php echo $this->translate->_('A Subquery is a query surrounded by parentheses such as \"(hello dolly)\".') ?></p>
    <p><?php echo $this->translate->_('Multiple terms can be combined together with boolean operators to form complex queries (see below).') ?></p>

    <h2><?php echo $this->translate->_('Fields') ?></h2>

    <p><?php echo $this->translate->_('You can search specific fields by typing the field name followed by a colon \":\" followed by the term you are looking for.') ?></p>
    <p><?php echo $this->translate->_('As an example, let\'s assume a Lucene index contains two fields- title and text- with text as the default field. If you want to find the document entitled \"The Right Way\" which contains the text \"don\'t go this way\", you can enter:') ?></p>

    <blockquote>title:"The Right Way" AND text:go</blockquote>

    <p><?php echo $this->translate->_('or') ?></p>

    <blockquote>title:"Do it right" AND go</blockquote>

    <p><?php echo $this->translate->_('Because \"text\" is the default field, the field indicator is not required.') ?></p>
    <p><?php echo $this->translate->_('Note: The field is only valid for the term, phrase or subquery that it directly precedes, so the query') ?></p>

    <blockquote>title:Do it right</blockquote>

    <p><?php echo $this->translate->_('Will only find \"Do\" in the title field. It will find \"it\" and \"right\" in the default field (if the default field is set) or in all indexed fields (if the default field is set to NULL).') ?></p>

    <h2><?php echo $this->translate->_('Wildcards') ?></h2>

    <p><?php echo $this->translate->_('Lucene supports single and multiple character wildcard searches within single terms (but not within phrase queries).') ?></p>
    <p><?php echo $this->translate->_('To perform a single character wildcard search use the \"?\" symbol.') ?></p>
    <p><?php echo $this->translate->_('To perform a multiple character wildcard search use the \"*\" symbol.') ?></p>
    <p><?php echo $this->translate->_('The single character wildcard search looks for string that match the term with the \"?\" replaced by any single character. For example, to search for \"text\" or \"test\" you can use the search:') ?></p>

    <blockquote>te?t</blockquote>

    <p><?php echo $this->translate->_('Multiple character wildcard searches look for 0 or more characters when matching strings against terms. For example, to search for test, tests or tester, you can use the search:') ?></p>

    <blockquote>test*</blockquote>

    <p><?php echo $this->translate->_('You can use \"?\", \"*\" or both at any place of the term:') ?></p>

    <blockquote>*wr?t*</blockquote>

    <p><?php echo $this->translate->_('It searches for \"write\", \"wrote\", \"written\", \"rewrite\", \"rewrote\" and so on.') ?></p>

    <h2><?php echo $this->translate->_('Term Modifiers') ?></h2>

    <p><?php echo $this->translate->_('Lucene supports modifying query terms to provide a wide range of searching options.') ?></p>
    <p><?php echo $this->translate->_('\"~\" modifier can be used to specify proximity search for phrases or fuzzy search for individual terms.') ?></p>

    <h2><?php echo $this->translate->_('Range Searches') ?></h2>

    <p><?php echo $this->translate->_('Range queries allow the developer or user to match documents whose field(s) values are between the lower and upper bound specified by the range query. Range Queries can be inclusive or exclusive of the upper and lower bounds. Sorting is performed lexicographically.') ?></p>

    <blockquote>mod_date:[20020101 TO 20030101]</blockquote>

    <p><?php echo $this->translate->_('This will find documents whose mod_date fields have values between 20020101 and 20030101, inclusive. Note that Range Queries are not reserved for date fields. You could also use range queries with non-date fields:') ?></p>

    <blockquote>title:{Aida TO Carmen}</blockquote>

    <p><?php echo $this->translate->_('This will find all documents whose titles would be sorted between Aida and Carmen, but not including Aida and Carmen.') ?></p>
    <p><?php echo $this->translate->_('Inclusive range queries are denoted by square brackets. Exclusive range queries are denoted by curly brackets.') ?></p>
    <p><?php echo $this->translate->_('If field is not specified then <span class=\"classname\">Zend_Search_Lucene</span> searches for specified interval through all fields by default.') ?></p>

    <blockquote>{Aida TO Carmen}</blockquote>

    <h2><?php echo $this->translate->_('Fuzzy Searches') ?></h2>

    <p><?php echo $this->translate->_('Zend_Search_Lucene as well as Java Lucene supports fuzzy searches based on the Levenshtein Distance, or Edit Distance algorithm. To do a fuzzy search use the tilde, \"~\", symbol at the end of a Single word Term. For example to search for a term similar in spelling to \"roam\" use the fuzzy search:') ?></p>

    <blockquote>roam~</blockquote>

    <p><?php echo $this->translate->_('This search will find terms like foam and roams. Additional (optional) parameter can specify the required similarity. The value is between 0 and 1, with a value closer to 1 only terms with a higher similarity will be matched. For example:') ?></p>

    <blockquote>roam~0.8</blockquote>

    <p><?php echo $this->translate->_('The default that is used if the parameter is not given is 0.5.') ?></p>

    <h2><?php echo $this->translate->_('Proximity Searches') ?></h2>

    <p><?php echo $this->translate->_('Lucene supports finding words from a phrase that are within a specified word distance in a string. To do a proximity search use the tilde, \"~\", symbol at the end of the phrase. For example to search for a \"Zend\" and \"Framework\" within 10 words of each other in a document use the search:') ?></p>

    <blockquote>"Zend Framework"~10</blockquote>

    <h2><?php echo $this->translate->_('Boosting a Term') ?></h2>

    <p><?php echo $this->translate->_('Java Lucene and <span class=\"classname\">Zend_Search_Lucene</span> provide the relevance level of matching documents based on the terms found. To boost the relevance of a term use the caret, \"^\", symbol with a boost factor (a number) at the end of the term you are searching. The higher the boost factor, the more relevant the term will be.') ?></p>
    <p><?php echo $this->translate->_('Boosting allows you to control the relevance of a document by boosting individual terms. For example, if you are searching for') ?></p>

    <blockquote>PHP framework</blockquote>

    <p><?php echo $this->translate->_('and you want the term \"PHP\" to be more relevant boost it using the ^ symbol along with the boost factor next to the term. You would type:') ?></p>

    <blockquote>PHP^4 framework</blockquote>

    <p><?php echo $this->translate->_('This will make documents with the term <acronym class=\"acronym\">PHP</acronym> appear more relevant. You can also boost phrase terms and subqueries as in the example:') ?></p>

    <blockquote>"PHP framework"^4 "Zend Framework"</blockquote>

    <p><?php echo $this->translate->_('By default, the boost factor is 1. Although the boost factor must be positive, it may be less than 1 (e.g. 0.2).') ?></p>

    <h2><?php echo $this->translate->_('Boolean Operators') ?></h2>

    <p><?php echo $this->translate->_('Boolean operators allow terms to be combined through logic operators. Lucene supports AND, \"+\", OR, NOT and \"-\" as Boolean operators. Java Lucene requires boolean operators to be ALL CAPS. Zend_Search_Lucene does not.') ?></p>
    <p><?php echo $this->translate->_('AND, OR, and NOT operators and \"+\", \"-\" defines two different styles to construct boolean queries. Unlike Java Lucene, Zend_Search_Lucene doesn\'t allow these two styles to be mixed.') ?></p>
    <p><?php echo $this->translate->_('If the AND/OR/NOT style is used, then an AND or OR operator must be present between all query terms. Each term may also be preceded by NOT operator. The AND operator has higher precedence than the OR operator. This differs from Java Lucene behavior.') ?></p>

    <h2><?php echo $this->translate->_('AND') ?></h2>

    <p><?php echo $this->translate->_('The AND operator means that all terms in the \"AND group\" must match some part of the searched field(s).') ?></p>
    <p><?php echo $this->translate->_('To search for documents that contain \"PHP framework\" and \"Zend Framework\" use the query:') ?></p>

    <blockquote>"PHP framework" AND "Zend Framework"</blockquote>

    <h2><?php echo $this->translate->_('OR') ?></h2>

    <p><?php echo $this->translate->_('The OR operator divides the query into several optional terms.') ?></p>
    <p><?php echo $this->translate->_('To search for documents that contain \"PHP framework\" or \"Zend Framework\" use the query:') ?></p>

    <blockquote>"PHP framework" OR "Zend Framework"</blockquote>

    <h2><?php echo $this->translate->_('NOT') ?></h2>

    <p><?php echo $this->translate->_('The NOT operator excludes documents that contain the term after NOT. But an \"AND group\" which contains only terms with the NOT operator gives an empty result set instead of a full set of indexed documents.') ?></p>
    <p><?php echo $this->translate->_('To search for documents that contain \"PHP framework\" but not \"Zend Framework\" use the query:') ?></p>

    <blockquote>"PHP framework" AND NOT "Zend Framework"</blockquote>

    <h2><?php echo $this->translate->_('&&, ||, and ! operators') ?></h2>

    <p><?php echo $this->translate->_('&&, ||, and ! may be used instead of AND, OR, and NOT notation.') ?></p>

    <h2><?php echo $this->translate->_('+') ?></h2>

    <p><?php echo $this->translate->_('The \"+\" or required operator stipulates that the term after the \"+\" symbol must match the document.') ?></p>
    <p><?php echo $this->translate->_('To search for documents that must contain \"Zend\" and may contain \"Framework\" use the query:') ?></p>

    <blockquote>+Zend Framework</blockquote>

    <h2><?php echo $this->translate->_('-') ?></h2>

    <p><?php echo $this->translate->_('The \"-\" or prohibit operator excludes documents that match the term after the \"-\" symbol.') ?></p>
    <p><?php echo $this->translate->_('To search for documents that contain \"PHP framework\" but not \"Zend Framework\" use the query:') ?></p>

    <blockquote>"PHP framework" -"Zend Framework"</blockquote>

    <h2><?php echo $this->translate->_('No Operator') ?></h2>

    <p><?php echo $this->translate->_('If no operator is used, then the search behavior is defined by the \"default boolean operator\".') ?></p>
    <p><?php echo $this->translate->_('This is set to \'OR\' by default.') ?></p>
    <p><?php echo $this->translate->_('That implies each term is optional by default. It may or may not be present within document, but documents with this term will receive a higher score.') ?></p>
    <p><?php echo $this->translate->_('To search for documents that requires \"PHP framework\" and may contain \"Zend Framework\" use the query:') ?></p>

    <blockquote>+"PHP framework" "Zend Framework"</blockquote>

    <h2><?php echo $this->translate->_('Grouping') ?></h2>

    <p><?php echo $this->translate->_('Java Lucene and <span class=\"classname\">Zend_Search_Lucene</span> support using parentheses to group clauses to form sub queries. This can be useful if you want to control the precedence of boolean logic operators for a query or mix different boolean query styles:') ?></p>

    <blockquote>+(framework OR library) +php</blockquote>

    <p><?php echo $this->translate->_('Zend_Search_Lucene supports subqueries nested to any level.') ?></p>

    <h2><?php echo $this->translate->_('Field Grouping') ?></h2>

    <p><?php echo $this->translate->_('Lucene also supports using parentheses to group multiple clauses to a single field.') ?></p>
    <p><?php echo $this->translate->_('To search for a title that contains both the word \"return\" and the phrase \"pink panther\" use the query:') ?></p>

    <blockquote>title:(+return +"pink panther")</blockquote>

    <h2><?php echo $this->translate->_('Escaping Special Characters') ?></h2>

    <p><?php echo $this->translate->_('Lucene supports escaping special characters that are used in query syntax. The current list of special characters is:') ?></p>
    <p>+ - && || ! ( ) { } [ ] ^ \" ~ * ? : \</p>
    <p><?php echo $this->translate->_('+ and - inside single terms are automatically treated as common characters.') ?></p>
    <p><?php echo $this->translate->_('For other instances of these characters use the \\ before each special character you\'d like to escape. For example to search for (1+1):2 use the query:') ?></p>

    <blockquote>\(1\+1\)\:2</blockquote>
</div>

<div style="position:absolute; bottom: 0px; right:0px;">
    <img src="/favicon.png" alt="Babel" title="Babel" />
</div>
