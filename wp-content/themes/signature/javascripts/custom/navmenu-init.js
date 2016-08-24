 jQuery(document).ready(function($) {
    
// Mobile Navigation
$('.mobile-toggle').click(function() {
    if ($('.main-nav').hasClass('open-nav')) {
        $('.main-nav').removeClass('open-nav');
        $('.masthead').removeClass('revealed');
        //$('.mobile-toggle span').removeClass('white-color');
                    $('.sub-nav-holder').fadeOut('fast');
                                $('.menu-panel').fadeOut('slow');



    } else {
        //$('.mobile-toggle span').addClass('white-color');
        $('.main-nav').addClass('open-nav');
        $('.masthead').addClass('revealed');
       $('.menu-panel').fadeIn('slow');
    }
});


$('.masthead, .mastwrap').click(function(){
        $('.main-nav').removeClass('open-nav');
        $('.masthead').removeClass('revealed');
        //$('.mobile-toggle span').removeClass('white-color');
            
                $('.sub-nav-holder').fadeOut('fast');
                                $('.menu-panel').fadeOut('slow');


});

    //Navigation Sub Menu Triggering on hover
    $('.trigger-sub-nav a').mouseenter(function(){
        $('.sub-nav').hide();
        $('.trigger-sub-nav a').removeClass('current-main-nav');
        $(this).addClass('current-main-nav');
        $('.sub-nav-holder').show();
        var subnavIndex = $(this).attr('data-sub-nav-target');
        $('.sub-nav-'+subnavIndex).show();
    });
    //Navigation Sub Menu Triggering on click
    $('.trigger-sub-nav a').click(function(){
        $('.sub-nav').hide();
        $('.trigger-sub-nav a').removeClass('current-main-nav');
        $(this).addClass('current-main-nav');
        $('.sub-nav-holder').show();
        var subnavIndex = $(this).attr('data-sub-nav-target');
        $('.sub-nav-'+subnavIndex).show();
    });
});    
