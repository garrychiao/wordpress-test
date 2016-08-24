jQuery(document).ready(function($) {


/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

      
$('.signature-ebert.split-slider-wrap').each(function(){
    var sliderWrap = $(this);
    $(this).find('.split-slide-item').each(function(){
        sliderWrap.find('.ms-left').append($(this).find('.left-split').html());
        sliderWrap.find('.ms-right').append($(this).find('.right-split').html());
    });
});
$('html, body').addClass('multi-scroll-active');
$('.mastwrap.signature-ebert').css('padding-top', '0px');

setTimeout(function(){

    $('#myContainer').multiscroll({
                    	// anchors: ['first', 'second', 'third'],
                    	menu: '#menu',
                    	navigation: true,
                    	navigationTooltips: ['', '', ''],
                    	loopBottom: true,
                    	loopTop: true
                    });

    

    $('.ms-section').mouseenter(function(){
        $(this).find('.ms-overlay').fadeIn(1000);
    });
    $('.ms-section').mouseleave(function(){
        $('.ms-overlay').fadeOut(500);
    });
},500);


  
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends

});
