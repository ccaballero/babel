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
    $('#column2').css('min-height',$('#column1').height()+'px');
    $('#column3').css('min-height',Math.max( $('#columns').height()-22, $('#column2').height() )+'px');

    $('#column3').css('width',($('#columns').width()-$('#column1').width()-$('#column2').width()-20)+'px');

    if(($('#column1').height())==$('#column2').height()){$('#column2').addClass('square');}else{$('#column2').removeClass('square');}
    if(($('#column2').height())==$('#column3').height()){$('#column3').addClass('square');}else{$('#column3').removeClass('square');}
};

$(window).resize(resize);
$(document).ready(resize);

$(document).ready(function(){
    $('#catalogs_menu').click(function(){
        $('#menubar .catalogs_item').fadeIn(1000);
        $('#menubar .users_item').fadeOut(950);
        $('#menubar .books_item').fadeOut(950);
        return false;
    });
    $('#users_menu').click(function(){
        $('#menubar .catalogs_item').fadeOut(950);
        $('#menubar .users_item').fadeIn(1000);
        $('#menubar .books_item').fadeOut(950);
        return false;
    });
    $('#books_menu').click(function(){
        $('#menubar .catalogs_item').fadeOut(950);
        $('#menubar .users_item').fadeOut(950);
        $('#menubar .books_item').fadeIn(1000);
        return false;
    });

    $('#menubar ul li.primary').hover(
        function(){
            $(this).animate({paddingTop:'5px'},100);
        },function(){
            $(this).animate({paddingTop:'0px'},100);
        }
    );

    $('#wall a.list').hover(
        function(){
            $(this).addClass('hover');
        },function(){
            $(this).removeClass('hover');
        });
    $('input[type="text"].focus').focus();
    $('.closeable').click(function(){$(this).parent().fadeOut();});
    $('input[class="groupall"]').click(function(){if($(this).attr('checked')=='checked'){$('input[class="check"]').attr('checked','checked');}else{$('input[class="check"]').removeAttr('checked');}});

    var book='';
    $('.update_file').click(function(){book=$(this).attr('name');});
    $('.update_file').overlay({
        onBeforeLoad:function(){
            $.getJSON(baseUrl+'/books/'+book.substring(5)+'/info.json',function(json){
                $('#directory').focus();
                $('#directory').attr('value',json.book.directory);
                $('#file').attr('value',json.book.file);
                $('#form_file').attr('action',baseUrl+'/books/collection/'+book.substring(5)+'/edit');
            });
        }});
    $('.update_book').click(function(){book=$(this).attr('name');});
    $('.update_book').overlay({
        onBeforeLoad:function(){
            $.getJSON(baseUrl+'/books/'+book.substring(5)+'/info.json',function(json){
                $('#title').focus();
                $('#thumb').css('background-image','url('+baseUrl+'/books/'+book.substring(5)+'/thumb)');
                $('#title').attr('value',json.book.title);
                $('#author').attr('value',json.book.author);
                $('#publisher').attr('value',json.book.publisher);
                $('#language').attr('value',json.book.language);
                $('#year').attr('value',json.book.year);
                $('#return').attr('value',window.location.pathname);
                $('#form_book').attr('action',baseUrl+'/books/shared/'+book.substring(5)+'/edit');
            });
        }});
    $('div.book').click(function(){book=$(this).attr('name');});
    $('div.book').overlay({
        onBeforeLoad:function(){
            $.getJSON(baseUrl+'/books/'+book.substring(5)+'/info.json',function(json){
                $('#thumb').css('background-image','url('+json.book.url.thumb+')');
                $('#book_title').html(json.book.title);
                $('#book_author').html(json.book.author);
                $('#book_publisher').html(json.book.publisher);
                $('#book_language').html(json.book.language);
                $('#book_year').html(json.book.year);
                $('#book_download').attr('href',json.book.url.download);
                $('#book_catalog').attr('href',json.book.url.catalog);
            });
        }});

    $('#catalog_new').overlay({
        onBeforeLoad:function(){
            $('#information-catalog').attr('value','');
            $('#information-mode').children().removeAttr('selected');
            $('#information-mode').children('option[value="open"]').attr('selected','selected');
            $('#information-description').html('');
            $('#information-return').attr('value',window.location.pathname);
            action=window.location.pathname;
            if(action.match('^[/new/?]')==null){$('#form_catalog').attr('action',action);}else{if(action.substring(action.length-1,action.length)=='/'){$('#form_catalog').attr('action',action+'new');}else{$('#form_catalog').attr('action',action+'/new');}}
        },onLoad:function(){$('#catalog').focus();}});

    var catalog='';
    $('.update_catalog').click(function(){catalog=$(this).attr('name');});
    $('.update_catalog').overlay({
        onBeforeLoad:function(){
            $.getJSON(baseUrl+'/catalogs/'+catalog.substring(5)+'/info.json',function(json){
                $('#information-catalog').attr('value',json.catalog.label);
                $('#information-mode').children().removeAttr('selected');
                $('#information-mode').children('option[value="'+json.catalog.mode+'"]').attr('selected','selected');
                $('#information-description').html(json.catalog.description);
                $('#information-return').attr('value',window.location.pathname);
                $('#form_catalog').attr('action',baseUrl+'/catalogs/'+catalog.substring(5)+'/edit');
            });
        },onLoad:function(){$('#information-catalog').focus();}});
});
