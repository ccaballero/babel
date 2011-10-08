var height=function(){
    if(window.innerHeight){
        return window.innerHeight;
    }else{
        return document.documentElement.clientHeight;
    }};
var width=function(){
    if(window.innerWidth){
        return window.innerWidth;
    }else{
        return document.documentElement.clientWidth;
    }};
var resize=function(){
    $('#wrapper').css('height',height()+'px');
    $('#main').css('height',(height()-60)+'px');
    $('#wrapper').css('width',width()+'px');
    $('#main').css('width',(width()-20)+'px');
    $('#wall').css('width',(width()-35)+'px');
    $('#column3').css('width',(width() - (50 + $('#column1').width() + $('#column2').width()))+'px');
};

$(window).resize(resize);
$(document).ready(resize);

$(document).ready(function(){
    $('#menubar a.main').hover(
        function(){
            $(this).animate({top:'1.0em'},100);
        },function(){
            $(this).animate({top:'0.5em'},100);
        });

    $('#wall a.list').hover(
        function(){
            $(this).animate({'margin-left':'0.4em'},100);
        },function(){
            $(this).animate({'margin-left':'0.9em'},100);
        });

    $('input[type="text"].focus').focus();
    $('.closeable').click(function(){$(this).parent().fadeOut();});
    $('input[class="groupall"]').click(function(){if ($(this).attr('checked') == 'checked') {$('input[class="check"]').attr('checked', 'checked');} else {$('input[class="check"]').removeAttr('checked');}});

    $('#catalogs_menu').click(function(){$('#menubar .catalogs').fadeIn(1000);$('#menubar .users').fadeOut(950);$('#menubar .books').fadeOut(950);return false;});
    $('#users_menu').click(function(){$('#menubar .catalogs').fadeOut(950);$('#menubar .users').fadeIn(1000);$('#menubar .books').fadeOut(950);return false;});
    $('#books_menu').click(function(){$('#menubar .catalogs').fadeOut(950);$('#menubar .users').fadeOut(950);$('#menubar .books').fadeIn(1000);return false;});

    var book='';
    $('.update_file').click(function(){book=$(this).attr('name');});
    $('.update_file').overlay({
        onBeforeLoad:function(){
            $.getJSON('/books/'+book.substring(5)+'/info.json',function(json){
                $('#bookstore option').each(function() {
                    if($(this).attr('label')==json.book.bookstore){
                        $(this).attr('selected','selected');
                    }else{
                        $(this).removeAttr('selected');
                    }});
                $('#bookstore').focus();$('#directory').attr('value',json.book.directory);
                $('#file').attr('value',json.book.file);
                $('#form_file').attr('action','/books/collection/'+book.substring(5)+'/edit');
            });
        }});
    $('.update_book').click(function(){book=$(this).attr('name');});
    $('.update_book').overlay({
        onBeforeLoad:function(){
            $.getJSON('/books/'+book.substring(5)+'/info.json',function(json){
                $('#title').focus();$('#title').attr('value',json.book.title);
                $('#author').attr('value',json.book.author);
                $('#publisher').attr('value',json.book.publisher);
                $('#language').attr('value',json.book.language);
                $('#year').attr('value',json.book.year);
                $('#form_book').attr('action','/books/shared/'+book.substring(5)+'/edit');$('#thumb').attr('src','/books/'+book.substring(5)+'/thumb/1');
            });
        }});
    $('div.book').click(function(){book=$(this).attr('name');});
    $('div.book').overlay({
        onBeforeLoad:function(){
            $.getJSON('/books/'+book.substring(5)+'/info.json',function(json){
                $('#thumb').attr('src','/media/img/books/'+book.substring(5)+'.png');
                $('#book_title').html(json.book.title);
                $('#book_author').html(json.book.author);
                $('#book_publisher').html(json.book.publisher);
                $('#book_language').html(json.book.language);
                $('#book_year').html(json.book.year);
                $('#book_download').attr('href',json.book.url.download);
                $('#book_catalog').attr('href',json.book.url.catalog);
            });
        }});
    $('#catalog_new').overlay({left:'center',top:90});
});
