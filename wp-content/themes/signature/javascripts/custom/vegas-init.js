 jQuery(document).ready(function($) {
    $('.signature-claus-fullscreen-slider').each(function(){
    	$(this).vegas({
	          preload:true,
	          overlay:true,
	          cover:true,
	          transition: 'swirlRight',
	          transitionDuration: 3000,
	          slides: slider_images
	    });
    });
});