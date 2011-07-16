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

    $.getJSON('/images.json',function(json){
        var images=json.images;
        var image=images[Math.floor(Math.random()*images.length)];
        $('img.switcher').attr('src',image).animate({opacity: 1.0},3500);
    });

    $('input[type="text"].focus').focus();
    $('.closeable').click(function(){$(this).parent().fadeOut();});
    $('input[name="groupall"]').click(function(){$('input[class="'+$(this).attr('class')+'"]').attr('checked',$(this).attr('checked'));});

    $('#catalogs_menu').click(function(){$('#menubar .catalogs').fadeIn(1000);$('#menubar .users').fadeOut(950);$('#menubar .books').fadeOut(950);return false;});
    $('#users_menu').click(function(){$('#menubar .catalogs').fadeOut(950);$('#menubar .users').fadeIn(1000);$('#menubar .books').fadeOut(950);return false;});
    $('#books_menu').click(function(){$('#menubar .catalogs').fadeOut(950);$('#menubar .users').fadeOut(950);$('#menubar .books').fadeIn(1000);return false;});

    var book='';
    $('.update_file').click(function(){book=$(this).attr('name');});
    $('.update_file').overlay({
        left:'center',top:90,
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
        left:'center',top:90,
        onBeforeLoad:function(){
            $.getJSON('/books/'+book.substring(5)+'/info.json',function(json){
                $('#title').focus();$('#title').attr('value',json.book.title);
                $('#author').attr('value',json.book.author);
                $('#publisher').attr('value',json.book.publisher);
                $('#language').attr('value',json.book.language);
                $('#form_book').attr('action','/books/shared/'+book.substring(5)+'/edit');$('#thumb').attr('src','/books/'+book.substring(5)+'/thumb/1');
            });
        }});
    $('div.book').click(function(){book=$(this).attr('name');});
    $('div.book').overlay({
        left:'center',top:90,
        onBeforeLoad:function(){
            $.getJSON('/books/'+book.substring(5)+'/info.json',function(json){
                $('#thumb').attr('src','/media/img/books/'+book.substring(5)+'.png');
                $('#book_title').html(json.book.title);
                $('#book_author').html(json.book.author);
                $('#book_publisher').html(json.book.publisher);
                $('#book_language').html(json.book.language);
                $('#book_downloads_number').html(json.book.downloads);
                $('#book_download').attr('href','/books/'+book.substring(5)+'/download');
            });
        }});
    $('#catalog_new').overlay({left:'center',top:90});
});
