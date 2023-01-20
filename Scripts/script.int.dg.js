!window.jQuery && document.write(unescape('%3Cscript src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.3.min.js"%3E%3C/script%3E'));  
function include(url){ 
document.write('<script src="'+ url + '" type="text/javascript"></script>'); 
}
include('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
include('Scripts/helpers.min.js');

if(Page=='home'){
include('Scripts/fluid_dg.min.js');
}

if(Page=='details'){
}

$(window).load(function(e) {
$('.dd_next').click(function(){
	$(this).next().slideToggle('fast');$(this).toggleClass('dd_next_act');
})
$('.fancybox').fancybox();
$('.mygallery').fancybox({wrapCSS:'fancybox-custom', closeClick:true, openEffect : 'none',helpers : {title : {type : 'inside'},overlay : {css : {'background' : 'rgba(0,0,0,0.6)'}}}});

$("#back-top").hide();	
$(function () {$(window).scroll(function () {if ($(this).scrollTop() > 100) {$('#back-top').fadeIn();} else {$('#back-top').fadeOut();}});
$('#back-top a').click(function () {$('body,htm').animate({scrollTop: 0}, 800);return false;});
});

if(Page=='home'){
$(function(){$('#fluid_dg_wrap_1').fluid_dg({thumbnails: false,height:"39.2%",navigation:'false',minHeight:'100',playPause:'false',loader:'none',hover:'false',time:3000,onLoaded:function(){$('#Page_loader').fadeOut()}});})

$('.owl-example').owlCarousel({items:5,loop:1, autoplay:1400,dots:false,responsive:{0:{items:1,nav:0},600:{items:2,nav:0},768:{items:3,nav:0 },1024:{items:4,nav:0 },1280:{items:5,nav:0 }}});
}
});