<h1>Query Language</h1>
source: http://framework.zend.com/manual/en/zend.search.lucene.query-language.html

<h2>Terms</h2>
<p>A query is broken up into terms and operators. There are three types of terms: Single Terms, Phrases, and Subqueries.</p>
<p>A Single Term is a single word such as "test" or "hello".</p>
<p>A Phrase is a group of words surrounded by double quotes such as "hello dolly".</p>
<p>A Subquery is a query surrounded by parentheses such as "(hello dolly)".</p>
<p>Multiple terms can be combined together with boolean operators to form complex queries (see below).</p>

<h2>Fields</h2>
<p>You can search specific fields by typing the field name followed by a colon ":" followed by the term you are looking for.</p>
<p>As an example, let's assume a Lucene index contains two fields- title and text- with text as the default field. If you want to find the document entitled "The Right Way" which contains the text "don't go this way", you can enter:</p>

<div class="programlisting querystring">
    <div class="querystringcode">
        <div style="font-family: monospace;">
            <ol>
                <li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;">
                    <div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">title:"The Right Way" AND text:go</div></li></ol></div></div></div>

<p>or</p>

<div class="programlisting querystring">
    <div class="querystringcode">
        <div style="font-family: monospace;">
            <ol>
                <li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;">
                    <div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">title:"Do it right" AND go</div></li></ol></div></div></div>

<p>Because "text" is the default field, the field indicator is not required.</p>
<p>Note: The field is only valid for the term, phrase or subquery that it directly precedes, so the query</p>

<div class="programlisting querystring">
    <div class="querystringcode">
        <div style="font-family: monospace;">
            <ol>
                <li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;">
                    <div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">title:Do it right</div></li></ol></div></div></div>

<p>
Will only find "Do" in the title field. It will find "it" and "right" in the default
field (if the default field is set) or in all indexed fields (if the default field is
set to <b><tt>NULL</tt></b>).
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.wildcard" name="zend.search.lucene.query-language.wildcard"><div class="info"><h1 class="title">Wildcards</h1></div>


<p class="para">
Lucene supports single and multiple character wildcard searches within single terms (but
not within phrase queries).
</p>

<p class="para">
To perform a single character wildcard search use the "?" symbol.
</p>

<p class="para">
To perform a multiple character wildcard search use the "*" symbol.
</p>

<p class="para">
The single character wildcard search looks for string that match the term with the "?"
replaced by any single character. For example, to search for "text" or "test" you can
use the search:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">te?t</div></li></ol></div></div></div>


<p class="para">
Multiple character wildcard searches look for 0 or more characters when matching strings
against terms. For example, to search for test, tests or tester, you can use the search:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">test*</div></li></ol></div></div></div>


<p class="para">
You can use "?", "*" or both at any place of the term:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">*wr?t*</div></li></ol></div></div></div>


<p class="para">
It searches for "write", "wrote", "written", "rewrite", "rewrote" and so on.
</p>

<p class="para">
Starting from ZF 1.7.7 wildcard patterns need some non-wildcard prefix. Default prefix
length is 3 (like in Java Lucene). So "*", "te?t", "*wr?t*" terms will cause an
exception

<a href="#fnid1" name="fn1"><sup>[1]</sup></a>
<span class="classname">Zend_Search_Lucene_Search_QueryParserException</span><span class="classname">Zend_Search_Lucene_Exception</span>
.
</p>

<p class="para">
It can be altered using
<span class="methodname">Zend_Search_Lucene_Search_Query_Wildcard::getMinPrefixLength()</span>
and
<span class="methodname">Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength()</span>
methods.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.modifiers" name="zend.search.lucene.query-language.modifiers"><div class="info"><h1 class="title">Term Modifiers</h1></div>


<p class="para">
Lucene supports modifying query terms to provide a wide range of searching options.
</p>

<p class="para">
"~" modifier can be used to specify proximity search for phrases or fuzzy search for
individual terms.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.range" name="zend.search.lucene.query-language.range"><div class="info"><h1 class="title">Range Searches</h1></div>


<p class="para">
Range queries allow the developer or user to match documents whose field(s) values are
between the lower and upper bound specified by the range query. Range Queries can be
inclusive or exclusive of the upper and lower bounds. Sorting is performed
lexicographically.
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">mod_date:[20020101 TO 20030101]</div></li></ol></div></div></div>


<p class="para">
This will find documents whose mod_date fields have values between 20020101 and
20030101, inclusive. Note that Range Queries are not reserved for date fields. You could
also use range queries with non-date fields:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">title:{Aida TO Carmen}</div></li></ol></div></div></div>


<p class="para">
This will find all documents whose titles would be sorted between Aida and Carmen, but
not including Aida and Carmen.
</p>

<p class="para">
Inclusive range queries are denoted by square brackets. Exclusive range queries are
denoted by curly brackets.
</p>

<p class="para">
If field is not specified then <span class="classname">Zend_Search_Lucene</span> searches for
specified interval through all fields by default.
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">{Aida TO Carmen}</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.fuzzy" name="zend.search.lucene.query-language.fuzzy"><div class="info"><h1 class="title">Fuzzy Searches</h1></div>


<p class="para">
<span class="classname">Zend_Search_Lucene</span> as well as Java Lucene supports fuzzy searches
based on the Levenshtein Distance, or Edit Distance algorithm. To do a fuzzy search use
the tilde, "~", symbol at the end of a Single word Term. For example to search for a
term similar in spelling to "roam" use the fuzzy search:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">roam~</div></li></ol></div></div></div>


<p class="para">
This search will find terms like foam and roams. Additional (optional) parameter can
specify the required similarity. The value is between 0 and 1, with a value closer to 1
only terms with a higher similarity will be matched. For example:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">roam~0.8</div></li></ol></div></div></div>


<p class="para">
The default that is used if the parameter is not given is 0.5.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.matched-terms-limitations" name="zend.search.lucene.query-language.matched-terms-limitations"><div class="info"><h1 class="title">Matched terms limitation</h1></div>


<p class="para">
Wildcard, range and fuzzy search queries may match too many terms. It may cause
incredible search performance downgrade.
</p>

<p class="para">
So <span class="classname">Zend_Search_Lucene</span> sets a limit of matching terms per query
(subquery). This limit can be retrieved and set using
<span class="methodname">Zend_Search_Lucene::getTermsPerQueryLimit()</span> and
<span class="methodname">Zend_Search_Lucene::setTermsPerQueryLimit($limit)</span> methods.
</p>

<p class="para">
Default matched terms per query limit is 1024.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.proximity-search" name="zend.search.lucene.query-language.proximity-search"><div class="info"><h1 class="title">Proximity Searches</h1></div>


<p class="para">
Lucene supports finding words from a phrase that are within a specified word distance in
a string. To do a proximity search use the tilde, "~", symbol at the end of the phrase.
For example to search for a "Zend" and "Framework" within 10 words of each other in a
document use the search:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"Zend Framework"~10</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boosting" name="zend.search.lucene.query-language.boosting"><div class="info"><h1 class="title">Boosting a Term</h1></div>


<p class="para">
Java Lucene and <span class="classname">Zend_Search_Lucene</span> provide the relevance level of
matching documents based on the terms found. To boost the relevance of a term use the
caret, "^", symbol with a boost factor (a number) at the end of the term you are
searching. The higher the boost factor, the more relevant the term will be.
</p>

<p class="para">
Boosting allows you to control the relevance of a document by boosting individual terms.
For example, if you are searching for
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">PHP framework</div></li></ol></div></div></div>


<p class="para">
and you want the term "PHP" to be more relevant boost it using the ^ symbol along with
the boost factor next to the term. You would type:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">PHP^4 framework</div></li></ol></div></div></div>


<p class="para">
This will make documents with the term <acronym class="acronym">PHP</acronym> appear more relevant. You
can also boost phrase terms and subqueries as in the example:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"PHP framework"^4 "Zend Framework"</div></li></ol></div></div></div>


<p class="para">
By default, the boost factor is 1. Although the boost factor must be positive,
it may be less than 1 (e.g. 0.2).
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.boolean" name="zend.search.lucene.query-language.boolean"><div class="info"><h1 class="title">Boolean Operators</h1></div>


<p class="para">
Boolean operators allow terms to be combined through logic operators.
Lucene supports AND, "+", OR, NOT and "-" as Boolean operators.
Java Lucene requires boolean operators to be ALL CAPS.
<span class="classname">Zend_Search_Lucene</span> does not.
</p>

<p class="para">
AND, OR, and NOT operators and "+", "-" defines two different styles to construct
boolean queries. Unlike Java Lucene, <span class="classname">Zend_Search_Lucene</span> doesn't
allow these two styles to be mixed.
</p>

<p class="para">
If the AND/OR/NOT style is used, then an AND or OR operator must be present between all
query terms. Each term may also be preceded by NOT operator. The AND operator has higher
precedence than the OR operator. This differs from Java Lucene behavior.
</p>

<div class="section" id="zend.search.lucene.query-language.boolean.and" name="zend.search.lucene.query-language.boolean.and"><div class="info"><h1 class="title">AND</h1></div>


<p class="para">
The AND operator means that all terms in the "AND group" must match some part of the
searched field(s).
</p>

<p class="para">
To search for documents that contain "PHP framework" and "Zend Framework" use the
query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"PHP framework" AND "Zend Framework"</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boolean.or" name="zend.search.lucene.query-language.boolean.or"><div class="info"><h1 class="title">OR</h1></div>


<p class="para">
The OR operator divides the query into several optional terms.
</p>

<p class="para">
To search for documents that contain "PHP framework" or "Zend Framework" use the
query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"PHP framework" OR "Zend Framework"</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boolean.not" name="zend.search.lucene.query-language.boolean.not"><div class="info"><h1 class="title">NOT</h1></div>


<p class="para">
The NOT operator excludes documents that contain the term after NOT. But an "AND
group" which contains only terms with the NOT operator gives an empty result set
instead of a full set of indexed documents.
</p>

<p class="para">
To search for documents that contain "PHP framework" but not "Zend Framework" use
the query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"PHP framework" AND NOT "Zend Framework"</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boolean.other-form" name="zend.search.lucene.query-language.boolean.other-form"><div class="info"><h1 class="title">&amp;&amp;, ||, and ! operators</h1></div>


<p class="para">
&amp;&amp;, ||, and ! may be used instead of AND, OR, and NOT notation.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.boolean.plus" name="zend.search.lucene.query-language.boolean.plus"><div class="info"><h1 class="title">+</h1></div>


<p class="para">
The "+" or required operator stipulates that the term after the "+" symbol must
match the document.
</p>

<p class="para">
To search for documents that must contain "Zend" and may contain "Framework" use the
query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">+Zend Framework</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boolean.minus" name="zend.search.lucene.query-language.boolean.minus"><div class="info"><h1 class="title">-</h1></div>


<p class="para">
The "-" or prohibit operator excludes documents that match the term after the "-"
symbol.
</p>

<p class="para">
To search for documents that contain "PHP framework" but not "Zend Framework" use
the query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">"PHP framework" -"Zend Framework"</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.boolean.no-operator" name="zend.search.lucene.query-language.boolean.no-operator"><div class="info"><h1 class="title">No Operator</h1></div>


<p class="para">
If no operator is used, then the search behavior is defined by the "default boolean
operator".
</p>

<p class="para">
This is set to 'OR' by default.
</p>

<p class="para">
That implies each term is optional by default. It may or may not be present within
document, but documents with this term will receive a higher score.
</p>

<p class="para">
To search for documents that requires "PHP framework" and may contain "Zend
Framework" use the query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">+"PHP framework" "Zend Framework"</div></li></ol></div></div></div>


<p class="para">
The default boolean operator may be set or retrieved with the
<span class="classname">Zend_Search_Lucene_Search_QueryParser::setDefaultOperator($operator)</span>
and
<span class="classname">Zend_Search_Lucene_Search_QueryParser::getDefaultOperator()</span>
methods, respectively.
</p>

<p class="para">
These methods operate with the
<span class="classname">Zend_Search_Lucene_Search_QueryParser::B_AND</span> and
<span class="classname">Zend_Search_Lucene_Search_QueryParser::B_OR</span> constants.
</p>
</div>
</div>

<div class="section" id="zend.search.lucene.query-language.grouping" name="zend.search.lucene.query-language.grouping"><div class="info"><h1 class="title">Grouping</h1></div>


<p class="para">
Java Lucene and <span class="classname">Zend_Search_Lucene</span> support using parentheses to
group clauses to form sub queries. This can be useful if you want to control the
precedence of boolean logic operators for a query or mix different boolean query styles:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">+(framework OR library) +php</div></li></ol></div></div></div>


<p class="para">
<span class="classname">Zend_Search_Lucene</span> supports subqueries nested to any level.
</p>
</div>

<div class="section" id="zend.search.lucene.query-language.field-grouping" name="zend.search.lucene.query-language.field-grouping"><div class="info"><h1 class="title">Field Grouping</h1></div>


<p class="para">
Lucene also supports using parentheses to group multiple clauses to a single field.
</p>

<p class="para">
To search for a title that contains both the word "return" and the phrase "pink panther"
use the query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">title:(+return +"pink panther")</div></li></ol></div></div></div>

</div>

<div class="section" id="zend.search.lucene.query-language.escaping" name="zend.search.lucene.query-language.escaping"><div class="info"><h1 class="title">Escaping Special Characters</h1></div>


<p class="para">
Lucene supports escaping special characters that are used in query syntax. The current
list of special characters is:
</p>

<p class="para">
+ - &amp;&amp; || ! ( ) { } [ ] ^ " ~ * ? : \
</p>

<p class="para">
+ and - inside single terms are automatically treated as common characters.
</p>

<p class="para">
For other instances of these characters use the \ before each special character you'd
like to escape. For example to search for (1+1):2 use the query:
</p>

<div class="programlisting querystring"><div class="querystringcode"><div style="font-family: monospace;"><ol><li style="font-family: 'Courier New',Courier,monospace; color: black; font-weight: normal; font-style: normal;"><div style="font-family: 'Courier New',Courier,monospace; font-weight: normal;">\(1\+1\)\:2</div></li></ol></div></div></div>

</div>
<div class="footnote"><a name="fnid1" href="#fn1"><sup>[1]</sup></a><span class="para footnote">
Please note, that it's not a
, but a
. It's thrown during query
rewrite (execution) operation.
</span></div>
