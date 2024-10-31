jQuery(document).ready(function($) {
	$(window).scroll(function() {
	    if ($(this).scrollTop() > 100) {
	        $('.'+options.style).fadeIn();
	    } else {
	        $('.'+options.style).fadeOut();
	    }
	});
	$('.'+options.style).click(function(e){
e.preventDefault();
	if (options.custom_scroll != '' && $(options.custom_scroll).length) {
		wcpscrollto = $(options.custom_scroll).offset().top
	} else {
		wcpscrollto = 0;
	}
    	$('html, body').animate({scrollTop:wcpscrollto}, parseInt(options.speed));
	});
});