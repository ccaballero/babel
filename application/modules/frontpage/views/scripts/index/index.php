<div id="central">
    <img class="switcher" src="" alt="" title="" />
    <div id="form"><?php echo $this->form ?></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $.getJSON('/image.json',function(json){
        var image=json.image;
        $('img.switcher').attr('src',image).animate({opacity: 1.0},3500);
    });
});
</script>
