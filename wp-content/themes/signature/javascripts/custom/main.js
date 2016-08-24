/*
 * basic - A signature theme from Designova
 * Author: Designova, http://www.designova.net
 * Copyright (C) 2015 Designova
 * This is a premium product. For licensing queries please contact info@designova.net
 */

 jQuery(document).ready(function($) {

/*global $:false */
/*global window: false */
(function() {
    "use strict";
    $(function($) {

        //Detecting viewpot dimension
        var vH = $(window).height();
        var vW = $(window).width();
        //Adjusting Intro Components Spacing based on detected screen resolution
        // $('.fullwidth').css('width', vW);
        // $('.fullheight').css('height', vH);
        // $('.halfwidth').css('width', vW / 2);
        // $('.halfheight').css('height', vH / 2);

        
     var AssignGlobeWidth = null;
     var AssignGlobeWidthR = null;
  
    $(window).load(function() {
        
        if(vW > vH){
         $('.intro.signature-quartz .globe').css('height',vH/2.5);
         $('.intro.signature-quartz .globe').css('width',vH/2.5);
         AssignGlobeWidth = $('.intro.signature-quartz .globe').width();
         $('.intro.signature-quartz .globe h1').css('font-size', AssignGlobeWidth/3.5);
        }
        else{
         $('.intro.signature-quartz .globe').css('height',vW/2.5);
         $('.intro.signature-quartz .globe').css('width',vW/2.5);
         AssignGlobeWidth = $('.intro.signature-quartz .globe').width();
         $('.intro.signature-quartz .globe h1').css('font-size', AssignGlobeWidth/3.5);
        }

    });

    $(window).resize(function() {
         var vHr = $(window).height();
         var vWr = $(window).width();
        
         if(vWr > vHr){
         $('.intro.signature-quartz .globe').css('height',vHr/2.5);
         $('.intro.signature-quartz .globe').css('width',vHr/2.5);
         AssignGlobeWidthR = $('.intro.signature-quartz .globe').width();
         $('.intro.signature-quartz .globe h1').css('font-size', AssignGlobeWidthR/3.5);
        }
        else{
         $('.intro.signature-quartz .globe').css('height',vWr/2.5);
         $('.intro.signature-quartz .globe').css('width',vWr/2.5);
         AssignGlobeWidthR = $('.intro.signature-quartz .globe').width();
         $('.intro.signature-quartz .globe h1').css('font-size', AssignGlobeWidthR/3.5);
        }

    });

    $(window).scroll(function() {
        var st = $(this).scrollTop(),
            wh = $(window).height(),
            sf = 1 + st / (10 * wh);
        $('.quartz-page-header .filter-overlay').css({
            'opacity': (1.4 - st / 200)
        });
        if ($(window).scrollTop() > ($(window).height() + 50)) {
            $('body.signature-quartz-body .backstretch').hide();
        } else {
            $('body.signature-quartz-body .backstretch').show();
        }
    });
    var st = $(this).scrollTop(),
        wh = $(window).height(),
        sf = 1.2 - st / (10 * wh);
    $('.quartz-page-header .filter-overlay').css({
        'opacity': (1.4 - st / 200)
    });

        
        $('.news-block.signature-adler .news-head, .news-block.signature-berend .news-head, .news-block.signature-claus .news-head, .news-block.signature-hans .news-head').setAllToMaxHeight();
        //Mobile Only Navigation (multi level)
                $('ul.slimmenu').slimmenu({
                    resizeWidth: '992',
                    collapserTitle: '',
                    easingEffect: 'easeInOutQuint',
                    animSpeed: 'medium',
                });

                $('div.slimmenu > ul').slimmenu({
                    resizeWidth: '992',
                    collapserTitle: '',
                    easingEffect: 'easeInOutQuint',
                    animSpeed: 'medium',
                });

                $('.slimmenu li a:not(.sub-collapser)').on('click',function(){
                            $('ul.slimmenu').removeClass('expanded').slideUp();
                });


        //PRELOADER
        $('body, html').addClass('preloader-running');
        // $('.mastwrap, header, nav').css('opacity', '0');
        $(window).load(function() {

            $("#status").fadeOut();
            $("#preloader").delay(1000).fadeOut(1000);
            $('body, html').removeClass('preloader-running');
            $('body, html').addClass('preloader-done');
            // $(".mastwrap, header, nav").delay(1000).css('opacity',
            //     '1');
        });

//Sub Menu Trigger

        $('.default-wp-nav li.menu-item-has-children > a').addClass('sub-menu-trigger');
        $('.default-wp-nav ul.children').addClass('sub-menu');

        $('.main-menu li.menu-item-has-children a.sub-menu-trigger, .default-wp-nav li.page_item_has_children > a').on('mouseenter', function(){
            $(this).next('.sub-menu').stop().slideDown(1000);
        });
        $('.main-menu li.menu-item-has-children, .default-wp-nav li.page_item_has_children').on('mouseleave', function(){
            $('.sub-menu').stop().slideUp(1000);
        });

//Main Menu Trigger
        (function( $ ){
           $.fn.berendMenuPanelTrigger = function() {
                if($("body.signature-berend-body .mastnav-inner-left").hasClass("slide-to-left"))
                {
                    $('body.signature-berend-body .mastnav').fadeOut();
                    $('body.signature-berend-body .mastnav-inner-left').removeClass("slide-to-left");
                    $('body.signature-berend-body .mastnav-inner-right').removeClass("slide-to-right");
                }
                else{
                    $('body.signature-berend-body .mastnav').fadeIn();
                    $('body.signature-berend-body .mastnav-inner-left').addClass("slide-to-left");
                    $('body.signature-berend-body .mastnav-inner-right').addClass("slide-to-right");
                }
           }; 
        })( jQuery );
        $('body.signature-berend-body a.menu-trigger, body.signature-berend-body .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().berendMenuPanelTrigger();
        });
        $('body.signature-berend-body .mastwrap').on('click', function(){
            $('body.signature-berend-body .mastnav').removeClass("slide-to-left");
        });   

        

        //Main Menu Trigger
        (function( $ ){
           $.fn.dierkMenuPanelTrigger = function() {
                if($("body.signature-dierk-body .mastnav").is(":hidden"))
                {
                    $('body.signature-dierk-body .mastnav').slideDown();
                }
                else{
                    $('body.signature-dierk-body .mastnav').slideUp();
                }
           }; 
        })( jQuery );
        $('body.signature-dierk-body .menu-notification a, body.signature-dierk-body .menu-close-notification a').on('click', function(){
            $().dierkMenuPanelTrigger();
            return false;
        });    


        (function( $ ){
           $.fn.ebertMenuPanelTrigger = function() {
                if($(".mastnav-inner-left").hasClass("slide-to-left"))
                {
                    $('.mastnav-inner-left').removeClass("slide-to-left");
                    $('.mastnav-inner-right').removeClass("slide-to-right");
                    $('.mastnav').fadeOut();
                }
                else{
                    $('.mastnav').fadeIn();
                    $('.mastnav-inner-left').addClass("slide-to-left");
                    $('.mastnav-inner-right').addClass("slide-to-right");
                }
           }; 
        })( jQuery );
        $('.masthead.signature-ebert a.menu-trigger, .mastnav.signature-ebert .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().ebertMenuPanelTrigger();
        });
        $('.mastwrap.signature-ebert').on('click', function(){
            $('.mastnav.signature-ebert').removeClass("slide-to-left");
        });


        (function( $ ){
           $.fn.franzMenuPanelTrigger = function() {
                if($(".mastnav-inner-left").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-franz').fadeOut();
                    $('.mastnav.signature-franz .mastnav-inner-left').removeClass("slide-to-left");
                    $('.mastnav.signature-franz .mastnav-inner-right').removeClass("slide-to-right");
                }
                else{
                    $('.mastnav.signature-franz').fadeIn();
                    $('.mastnav.signature-franz .mastnav-inner-left').addClass("slide-to-left");
                    $('.mastnav.signature-franz .mastnav-inner-right').addClass("slide-to-right");
                }
           }; 
        })( jQuery );
        $('.mastnav.signature-franz .mastnav-inner-left').on('click', function(event){
            event.preventDefault();
            $().franzMenuPanelTrigger();
        });
        $('.masthead.signature-franz a.menu-trigger, .mastnav.signature-franz .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().franzMenuPanelTrigger();
        });
        $('.mastwrap.signature-franz').on('click', function(){
            $('.mastnav.signature-franz').removeClass("slide-to-left");
        });


        //Sub Menu Trigger
        $('nav.mastnav.signature-hans .main-menu > li').on('mouseenter', function(){
            $(this).find('.sub-menu').stop().slideDown(1000);
        });
        $('nav.mastnav.signature-hans .main-menu > li').on('mouseleave', function(){
            $('.sub-menu').stop().slideUp(600);
        });


//Main Menu Trigger
        (function( $ ){
           $.fn.hansMenuPanelTrigger = function() {
                if($(".mastnav.signature-hans").is(":hidden"))
                {
                    $('.mastnav.signature-hans').slideDown(500);
                    $('.masthead.signature-hans .menu-notification').fadeOut();
                    setTimeout(function(){
                        $('.masthead.signature-hans .menu-close-notification').fadeIn();
                    },400);
                    
                }
                else{
                    $('.mastnav.signature-hans').slideUp(500);
                    $('.masthead.signature-hans .menu-close-notification').fadeOut();
                    setTimeout(function(){
                        $('.masthead.signature-hans .menu-notification').fadeIn();
                    },400);
                }
           }; 
        })( jQuery );
        $('.masthead.signature-hans .menu-notification a, .masthead.signature-hans .menu-close-notification a').on('click', function(){
            $().hansMenuPanelTrigger();
        });


        (function( $ ){
           $.fn.igorMenuPanelTrigger = function() {
                if($(".mastnav.signature-igor").is(":hidden"))
                {
                    $('.mastnav.signature-igor').fadeIn(1000);
                }
                else{
                    $('.mastnav.signature-igor').fadeOut(1000);
                }
           }; 
        })( jQuery );
        $('header.masthead.signature-igor .menu-notification a, .mastnav.signature-igor .menu-close-notification a').on('click', function(){
            $().igorMenuPanelTrigger();
            return false;
        });

        $('.main-menu.signature-igor li.menu-item-has-children a.sub-menu-trigger').on('mouseenter', function(){
            $(this).next('.sub-menu').stop().slideDown(300);
        });
        $('.main-menu.signature-igor li.menu-item-has-children').on('mouseleave', function(){
            $('.sub-menu').stop().slideUp(300);
        });

        if($('.works-filter-panel.signature-igor').length !=0 )
        {
            $('.masthead.signature-igor .notification-icon-wrap').append('<div class="filter-notification signature-igor"><a class="font3bold" href="#"><span class="ion-shuffle dark"></span></a></div>');
        }



        $('.mastnav.signature-johan .main-menu li a.sub-menu-trigger').on('mouseenter', function(){
            $(this).next('.mastnav.signature-johan .sub-menu').stop().slideDown(700);
        });
        $('.mastnav.signature-johan .main-menu > li').on('mouseleave', function(){
            $('.mastnav.signature-johan .sub-menu').stop().slideUp(300);
        });


//Main Menu Trigger
        (function( $ ){
           $.fn.johanMenuPanelTrigger = function() {
                if($(".mastnav.signature-johan").is(":hidden"))
                {
                    $('.mastnav.signature-johan').slideDown(500);
                    $('.masthead.signature-johan .menu-notification').fadeOut();
                }
                else{
                    $('.mastnav.signature-johan').slideUp(500);
                    $('.masthead.signature-johan .menu-notification').fadeIn();
                }
           }; 
        })( jQuery );
        $('.masthead.signature-johan .menu-notification a, .mastnav.signature-johan .menu-close-notification a').on('click', function(){
            $().johanMenuPanelTrigger();
            return false;
        });

        if($('.works-filter-panel.signature-hans').length !=0 )
        {
            $('.masthead.signature-johan .notification-icon-wrap').append('<div class="filter-notification signature-hans"><a class="font3bold" href="#"><span class="ion-shuffle black"></span></a></div>');
        }



        
        (function( $ ){
           $.fn.karlMenuPanelTrigger = function() {
                if($(".mastnav.signature-karl").is(":hidden"))
                {
                    $('.mastnav.signature-karl').slideDown();
                }
                else{
                    $('.mastnav.signature-karl').slideUp();
                }
           }; 
        })( jQuery );

        $('.masthead.signature-karl .menu-notification a, .mastnav.signature-karl .menu-close-notification a').on('click', function(){
            $().karlMenuPanelTrigger();
            return false;
        });

        if($('.works-filter-panel.signature-karl').length !=0 )
        {
            $('.masthead.signature-karl .notification-icon-wrap').append('<div class="filter-notification signature-karl"><a class="font3bold" href="#"><span class="ion-shuffle black"></span></a></div>');
        }



        (function( $ ){
           $.fn.leonMenuPanelTrigger = function() {
                if($(".mastnav.signature-leon").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-leon').removeClass("slide-to-left");
                }
                else{
                    $('.mastnav.signature-leon').addClass("slide-to-left");
                }
           }; 
        })( jQuery );
        $('header.masthead.signature-leon .menu-notification a, nav.mastnav.signature-leon .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().leonMenuPanelTrigger();
        });
        $('.mastwrap').on('click', function(){
            $('nav.mastnav.signature-leon').removeClass("slide-to-left");
        });

        $(window).load(function() {
            $('.first-fold').next().waypoint(function (direction) {
                  if (direction === 'down') {
                    $('header.masthead.signature-leon').addClass('header-highlighted').removeClass('leon-trans-header');

                  } 
                  else {
                    $('header.masthead.signature-leon').removeClass('header-highlighted').addClass('leon-trans-header');
                  }
            }, { offset: '-35%' });
        });
        if($('.works-filter-panel.signature-leon').length !=0 )
        {
            $('.masthead.signature-leon .notification-icon-wrap, .masthead.signature-xaver .notification-icon-wrap').append('<div class="filter-notification signature-leon"><a class="font3bold" href="#"><span class="ion-shuffle white"></span></a></div>');
        }


        (function( $ ){
           $.fn.moritzMenuPanelTrigger = function() {
                if($(".mastnav.signature-moritz").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-moritz').removeClass("slide-to-left");
                }
                else{
                    $('.mastnav.signature-moritz').addClass("slide-to-left");
                }
           }; 
        })( jQuery );
        $('header.masthead.signature-moritz .menu-notification a, nav.mastnav.signature-moritz .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().moritzMenuPanelTrigger();
        });
        $('.mastwrap').on('click', function(){
            $('nav.mastnav.signature-moritz').removeClass("slide-to-left");
        });

        $(window).load(function() {
            $('.first-fold').next().waypoint(function (direction) {
                  if (direction === 'down') {
                    $('header.masthead.signature-moritz').addClass('header-highlighted').removeClass('moritz-trans-header');

                  } 
                  else {
                    $('header.masthead.signature-moritz').removeClass('header-highlighted').addClass('moritz-trans-header');
                  }
            }, { offset: '-35%' });
        });
        if($('.works-filter-panel.signature-leon').length !=0 )
        {
            $('.masthead.signature-moritz .notification-icon-wrap').append('<div class="filter-notification signature-leon"><a class="font3bold" href="#"><span class="ion-shuffle white"></span></a></div>');
        }


        (function( $ ){
           $.fn.nemoMenuPanelTrigger = function() {
                if($(".mastnav.signature-nemo").is(":hidden"))
                {
                    $('.mastnav.signature-nemo').fadeIn(1000);
                }
                else{
                    $('.mastnav.signature-nemo').fadeOut(1000);
                }
           }; 
        })( jQuery );
        $('.masthead.signature-nemo .menu-notification a, .mastnav.signature-nemo .menu-close-notification a').on('click', function(){
            $().nemoMenuPanelTrigger();
            return false;
        });
        // $('.mastnav.signature-nemo').on('mouseleave', function(){
        //     $().nemoMenuPanelTrigger();
        // });
        if($('.works-filter-panel.signature-nemo').length !=0 )
        {
            $('.masthead.signature-nemo .notification-icon-wrap').append('<div class="filter-notification signature-leon"><a class="font3bold" href="#"><span class="ion-shuffle dark"></span></a></div>');
        }


        (function( $ ){
           $.fn.reinMenuPanelTrigger = function() {
                if($(".mastnav-inner-left").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-rein').fadeOut();
                    $('.mastnav-inner-left').removeClass("slide-to-left");
                    $('.mastnav-inner-right').removeClass("slide-to-right");
                }
                else{
                    $('.mastnav.signature-rein').fadeIn();
                    $('.mastnav-inner-left').addClass("slide-to-left");
                    $('.mastnav-inner-right').addClass("slide-to-right");
                }
           }; 
        })( jQuery );
        $('.mastnav-inner-left.signature-rein').on('click', function(event){
            event.preventDefault();
            $().reinMenuPanelTrigger();
        });
        $('.masthead.signature-rein a.menu-trigger, .mastnav.signature-rein .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().reinMenuPanelTrigger();
        });
        $('.mastwrap.signature-rein').on('click', function(){
            $('.mastnav.signature-rein').removeClass("slide-to-left");
        });


        (function( $ ){
           $.fn.stefanMenuPanelTrigger = function() {
                if($(".mastnav.signature-stefan").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-stefan').removeClass("slide-to-left");
                }
                else{
                    $('.mastnav.signature-stefan').addClass("slide-to-left");
                }
           }; 
        })( jQuery );
        $('.masthead.signature-stefan .menu-notification a, .mastnav.signature-stefan .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().stefanMenuPanelTrigger();
        });
        $('.mastwrap.signature-stefan').on('click', function(){
            $('.mastnav.signature-stefan').removeClass("slide-to-left");
        });

        if($('.works-filter-panel.signature-stefan').length !=0 )
        {
            $('.masthead.signature-stefan .notification-icon-wrap').append('<div class="filter-notification signature-stefan"><a class="font3bold" href="#"><span class="ion-shuffle white"></span></a></div>');
        }




        (function( $ ){
           $.fn.theoMenuPanelTrigger = function() {
                if($(".mastnav.signature-theo").is(":hidden"))
                {
                    $('.mastnav.signature-theo').slideDown(1000);
                }
                else{
                    $('.mastnav.signature-theo').slideUp(1000);
                }
           }; 
        })( jQuery );
        $('.masthead.signature-theo .menu-notification a, .mastnav.signature-theo .menu-close-notification a').on('click', function(){
            $().theoMenuPanelTrigger();
            return false;
        });

        if($('.works-filter-panel.signature-theo').length !=0 )
        {
            $('.masthead.signature-theo .notification-icon-wrap').append('<div class="filter-notification signature-theo"><a class="font3bold" href="#"><span class="ion-shuffle black"></span></a></div>');
        }

        (function( $ ){
           $.fn.theoFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-theo").is(":hidden"))
                {
                    $('.works-filter-panel.signature-theo').slideDown();
                }
                else{
                    $('.works-filter-panel.signature-theo').slideUp();
                }
           }; 
        })( jQuery );
        $('.masthead.signature-theo .filter-notification a').on('click', function(){
            $().theoFilterPanelTrigger();
            return false;
        });
        $('.works-filter-panel.signature-theo').on('mouseleave', function(){
            $().theoFilterPanelTrigger();
        });

        $('nav.signature-velten .menu, .main-menu.signature-zircon').dropit({
            action: 'mouseenter'
        });

        
        (function( $ ){
           $.fn.xaverMenuPanelTrigger = function() {
                if($(".mastnav.signature-xaver").hasClass("slide-to-left"))
                {
                    $('.mastnav.signature-xaver').removeClass("slide-to-left");
                }
                else{
                    $('.mastnav.signature-xaver').addClass("slide-to-left");
                }
           }; 
        })( jQuery );
        $('.masthead.signature-xaver .menu-notification a, .mastnav.signature-xaver .menu-close-notification a').on('click', function(event){
            event.preventDefault();
            $().xaverMenuPanelTrigger();
        });
        $('.mastwrap.signature-xaver').on('click', function(){
            $('.mastnav.signature-xaver').removeClass("slide-to-left");
        });


        $('body.signature-xaver-body .first-fold').waypoint(function (direction) {
              if (direction === 'down') {
                $('.masthead.signature-xaver').addClass('header-highlighted');
              } 
              else {
                $('.masthead.signature-xaver').removeClass('header-highlighted');
              }
        }, { offset: '-50%' });



        (function( $ ){
           $.fn.bostonMenuPanelTrigger = function() {
                if($(".mastnav.signature-boston").is(":hidden"))
                {
                    $('.mastnav.signature-boston').fadeIn(1000);
                }
                else{
                    $('.mastnav.signature-boston').fadeOut(1000);
                }
           }; 
        })( jQuery );

        $('.masthead.signature-boston .menu-notification a, .mastnav.signature-boston .menu-close-notification a').on('click', function(){
            $().bostonMenuPanelTrigger();
            return false;
        });
        

        if($('.works-filter-panel.signature-nemo').length !=0 )
        {
            $('.masthead.signature-boston .notification-icon-wrap').append('<div class="filter-notification signature-leon"><a class="font3bold" href="#"><span class="ion-shuffle white"></span></a></div>');
        }

//COMMON UX
    $('.signature-adler.team-block').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.signature-adler.team-block').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });

    $('.signature-dierk.team-block').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.signature-dierk.team-block').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });

    $('.team-block.signature-johan').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.team-block.signature-johan').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });

    $('.team-block.signature-leon').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.team-block.signature-leon').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });

    $('.team-block.signature-moritz').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.team-block.signature-moritz').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });


    $('.team-block.signature-stefan').on('mouseenter', function(){
        $(this).find('.team-overlay').slideDown();
    });
    $('.team-block.signature-stefan').on('mouseleave', function(){
        $(this).find('.team-overlay').slideUp();
    });


    $('.team-block.signature-xaver').on('mouseenter', function(){
        $(this).find('.team-overlay').fadeIn();
    });
    $('.team-block.signature-xaver').on('mouseleave', function(){
        $(this).find('.team-overlay').fadeOut();
    });


    $('.equal-height-wrap').each(function(){
        var split_section_height = $(this).find('.dierk-split-content-section').outerHeight();
        $(this).find('.dierk-split-image-section').css('height', split_section_height+'px');
    });

//PORTFOLIO UX
        (function( $ ){
           $.fn.filterPanelTrigger = function() {
                if($(".works-filter-panel").is(":hidden"))
                {
                    $('.works-filter-panel').slideDown();
                    $('.filter-notification a').empty().append( $('.filter-notification a').data('hide-txt') );
                }
                else{
                    $('.works-filter-panel').slideUp();
                    $('.filter-notification a').empty().append( $('.filter-notification a').data('show-txt') );
                }
           }; 
        })( jQuery );
        $('.filter-notification.signature-adler a, .filter-notification.signature-claus a').on('click', function(){
            $().filterPanelTrigger();
            return false;
        });
        $('.works-filter-panel.signature-adler').append('<span class="close-panel">X</span>');
        $('.works-filter-panel.signature-adler span.close-panel').on('click',function(){
            $().filterPanelTrigger();
            return false;
        });

        $('.works-filter li a').on('click', function(){
            $('.works-filter li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            
        });

        $('.works-filter.signature-adler li a').on('click', function(){
            $('html, body').animate({
                scrollTop: $("#works-container").offset().top-100
            }, 1000);
        });
        
        
        if($('.works-filter-panel.signature-dierk').length !=0 )
        {
            $('.masthead.signature-dierk .notification-icon-wrap').append('<div class="filter-notification signature-dierk"><a class="font3bold" href="#"><span class="ion-shuffle white"></span></a></div>');
        }

        $('.filter-notification.signature-dierk a').on('click', function(){
            if($(".works-filter-panel").is(":hidden"))
            {
                $('.works-filter-panel').slideDown();
            }
            else{
                $('.works-filter-panel').slideUp();
            }
            return false;
        });


        (function( $ ){
           $.fn.hansFilterPanelTrigger = function() {
                if($(".works-filter-panel").is(":hidden"))
                {
                    $('.works-filter-panel').slideDown();
                }
                else{
                    $('.works-filter-panel').slideUp();
                }
           }; 
        })( jQuery );
        
        $('.works-filter-panel.signature-hans').on('mouseleave', function(){
            $().hansFilterPanelTrigger();
        });
        $('.works-filter.signature-hans li a').on('click', function(){
            $('.works-filter.signature-hans li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            $('html, body').animate({
                scrollTop: $('#works-container').offset().top
            }, 1000);
            $().hansFilterPanelTrigger();
        });

        if($('.works-filter-panel.signature-hans').length !=0 )
        {
            $('.masthead.signature-hans .notification-icon-wrap').append('<div class="filter-notification signature-hans"><a class="font3bold" href="#"><span class="ion-shuffle black"></span></a></div>');
        }

        $('.filter-notification.signature-hans a').on('click', function(){
            $().hansFilterPanelTrigger();
        });



        (function( $ ){
           $.fn.igorFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-igor").is(":hidden"))
                {
                    $('.works-filter-panel.signature-igor').slideDown();
                }
                else{
                    $('.works-filter-panel.signature-igor').slideUp();
                }
           }; 
        })( jQuery );
        $('.masthead.signature-igor .filter-notification a').on('click', function(){
            $().igorFilterPanelTrigger();
        });
        $('.works-filter-panel.signature-igor').on('mouseleave', function(){
            $().igorFilterPanelTrigger();
        });

        
        (function( $ ){
           $.fn.karlFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-karl").is(":hidden"))
                {
                    $('.works-filter-panel.signature-karl').slideDown();
                    $('html, body').animate({
                        scrollTop: $("#works-container").offset().top-100
                    }, 1000);
                }
                else{
                    $('.works-filter-panel.signature-karl').slideUp();
                }
           }; 
        })( jQuery );
        $('.filter-notification a').on('click', function(){
            $().karlFilterPanelTrigger();
            return false;
        });
        // $('.works-filter-panel').on('mouseleave', function(){
        //     $().filterPanelTrigger();
        // });
        $('.works-filter.signature-karl li a').on('click', function(){
            $('.works-filter.signature-karl li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            // $('html, body').animate({
            //     scrollTop: $("#works-container").offset().top-100
            // }, 1000);
            return false;
        });


        (function( $ ){
           $.fn.leonFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-leon").hasClass('slide-to-right'))
                {
                    $('.works-filter-panel.signature-leon').removeClass('slide-to-right');
                }
                else{
                    $('.works-filter-panel.signature-leon').addClass('slide-to-right');
                }
           }; 
        })( jQuery );
        $('.filter-notification.signature-leon a').on('click', function(){
            $().leonFilterPanelTrigger();
        });
        $('.works-filter-panel.signature-leon').on('mouseleave', function(){
            $().leonFilterPanelTrigger();
        });
        $('.works-filter.signature-leon li a').on('click', function(){
            $('.works-filter.signature-leon li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            $('html, body').animate({
                scrollTop: $("#works-container").offset().top-100
            }, 1000);
        });


        (function( $ ){
           $.fn.nemoFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-nemo").is(":hidden"))
                {
                    $('.works-filter-panel.signature-nemo').slideDown();
                }
                else{
                    $('.works-filter-panel.signature-nemo').slideUp();
                }
           }; 
        })( jQuery );
        $('.masthead.signature-nemo .filter-notification a, .masthead.signature-boston .filter-notification a').on('click', function(){
            $().nemoFilterPanelTrigger();
        });
        $('.works-filter-panel.signature-nemo').on('mouseleave', function(){
            $().nemoFilterPanelTrigger();
        });
        $('.works-filter.signature-nemo li a').on('click', function(){
            $('.works-filter.signature-nemo li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            $('html, body').animate({
                scrollTop: $("#works-container").offset().top-120
            }, 1000);
        });


        (function( $ ){
           $.fn.stefanFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-stefan").hasClass('slide-to-right'))
                {
                    $('.works-filter-panel.signature-stefan').removeClass('slide-to-right');
                }
                else{
                    $('.works-filter-panel.signature-stefan').addClass('slide-to-right');
                }
           }; 
        })( jQuery );
        $('.masthead.signature-stefan .filter-notification a').on('click', function(){
            $().stefanFilterPanelTrigger();
        });
        $('.works-filter-panel.signature-stefan').on('mouseleave', function(){
            $().stefanFilterPanelTrigger();
        });
        $('.works-filter.signature-stefan li a').on('click', function(){
            $('.works-filter.signature-stefan li a').removeClass('filter-active');
            $(this).addClass('filter-active');
            $('html, body').animate({
                scrollTop: $("#works-container").offset().top-100
            }, 1000);
        });



        (function( $ ){
           $.fn.wilmarFilterPanelTrigger = function() {
                if($(".works-filter-panel.signature-wilmar").is(":hidden"))
                {
                    $('.works-filter-panel.signature-wilmar').slideDown();
                    $('.filter-notification.signature-wilmar a').empty().append( $('.filter-notification.signature-wilmar a').data('hide-txt') );
                }
                else{
                    $('.works-filter-panel.signature-wilmar').slideUp();
                    $('.filter-notification.signature-wilmar a').empty().append( $('.filter-notification.signature-wilmar a').data('show-txt') );
                }
           }; 
        })( jQuery );
        $('.filter-notification.signature-wilmar a').on('click', function(){
            $().wilmarFilterPanelTrigger();
        });
        
//ISOTOPE
        
        //ISOTOPE GLOBALS
        var $container1 = $('.works-container');


        //ISOTOPE INIT
        $(window).load(function() {

           //checking if all images are loaded
            $container1.imagesLoaded( function() {

                //init isotope once all images are loaded
                $container1.isotope({
                    // options
                    itemSelector: '.works-item',
                    layoutMode: 'masonry',
                    transitionDuration: '0.8s'
                });


                //forcing a perfect masonry layout after initial load
                setTimeout(function() {
                $container1.isotope('layout');
                }, 100);


                // triggering filtering

                $('.works-filter li a').on('click', function() {
                    
                    $('.works-filter li a').removeClass('active');
                    $(this).addClass('active');

                    var selector = $(this).attr('data-filter');
                    $('.works-container').isotope({
                        filter: selector
                    });
                    setTimeout(function() {
                        $container1.isotope('layout');
                    }, 700);
                    return false;
                });


                //Isotope ReLayout on Window Resize event.
                $(window).on('resize', function() {
                    $container1.isotope('layout');
                });

                //Isotope ReLayout on device orientation changes
                window.addEventListener("orientationchange", function() {
                    $container1.isotope('layout');
                }, false);

            });

        });

    //Text Ticker
    $(window).load(function(){
        $('.text-rotator').each(function(){
            
            var text_rotator_content = $(this).html();
            var inline_style = $(this).attr('style');
            $(this).empty();
            $(this).html('<div class="rotator-wrap"></div>')
            var this_item = $(this).children('.rotator-wrap');
            var text_rotator_content_split = text_rotator_content.split(',');
            var item_size = text_rotator_content_split.length;
            nova_text_rotator(text_rotator_content_split, this_item, item_size, inline_style);
        });
        
        function nova_text_rotator(item_array, this_item, item_size, inline_style, my_index){
            
            if(my_index == undefined)
                var my_index = -1;

            my_index++

            if(my_index < item_size)
            {

                this_item.fadeOut(800, function(){
                    this_item.html('<span style="'+inline_style+'">'+ item_array[my_index] +'</span>');
                    this_item.fadeIn(800);
                    
                });
            }
            else
            {
                my_index = -1;
            }

            setTimeout(function() {
                 nova_text_rotator(item_array, this_item, item_size, inline_style, my_index);
            }, 2500);
        }


        if($('.signature-claus-fullscreen-slider').length)
            $('body').addClass('transparent-navigation');

        $('header.signature-claus').waypoint(function (direction) {
              if (direction === 'down') {
                $('body').removeClass('transparent-navigation');
              } 
              else {
                $('body').addClass('transparent-navigation');
              }
        }, { offset: '-50%' });     
    });  


//VENOBOX
    $('.venobox, .image-lightbox-link').venobox({
        numeratio: true,
        infinigall: true
    });   

    $('section.inner-wrap .filter-notification.signature-adler').removeClass('pad-top-quarter pad-bottom-quarter pad-left-quarter');
        

//CAROUSEL
 $(".project-carousel.signature-adler").owlCarousel({
                    loop:true,
                    margin:0,
                    dots:false,
                    nav:true,
                    navText: false,
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:1
                        },
                        1000:{
                            items:1
                        }
                    }
                });

 //SKILLS
    $('.skills').waypoint(function(direction) {
        
        $('.progress-bar').each(function() {
            var progressValue = $(this).attr('data-skills-value');
            $(this).animate({
                            width: progressValue+"%"
                            }, 2500);
        });

    }, { offset: '55%' });

    


 //CLIENTS
    $('.signature-berend.clients-wrap').each(function(){
      var clientsCount = $(this).find('.client-logo').length;
      var reminderItems = clientsCount%3;
      if(reminderItems == 0)
      {
        for(var i= clientsCount; i > clientsCount-3; i--)
        {
          $(this).find('.client-logo:nth-child('+i+')').css('border-bottom','0px');
        }
      }
      else{
        for(var i=clientsCount; i > clientsCount - reminderItems; i--){
          $(this).find('.client-logo:nth-child('+i+')').css('border-bottom','0px');
        }
      }
    });


//JOURNAL

    $('.journal.signature-berend .news-block:nth-child(odd)').addClass('white-bg');
    $('.journal.signature-berend .news-block:nth-child(even)').addClass('silver-bg');

    $(window).load(function(){
        $('.journal.signature-berend .news-block').mouseenter(function(){
            $(this).css('background', 'url("'+$(this).data('hover-image')+'")');
        });

        $('.journal.signature-berend .news-block').mouseleave(function(){
            $(this).attr('style', '');
        });

        
        $('.news-block.signature-ebert:not(.zircon-news-block)').mouseenter(function(){
            $(this).css('background-image', 'url("'+$(this).data('hover-img')+'")');
        });

        $('.news-block.signature-ebert:not(.zircon-news-block)').mouseleave(function(){
            $(this).css('background-image', 'url("")');
        });

        $('.journal.signature-ebert').each(function(){
            var max_height = 0;
            $(this).find('.news-block.signature-ebert').each(function(){
                if($(this).outerHeight() > max_height)
                    max_height = $(this).outerHeight();
            });

            $(this).find('.news-block.signature-ebert').outerHeight(max_height);
            //$(this).find('.news-block.signature-claus').css('height', max_height+'px');
        });
        $('.ebert-blog-list-pagination').addClass('text-center color-bg pad-top-half pad-bottom-half');
        $('.ebert-blog-list-pagination').removeClass('add-top-quarter');
        $('.ebert-blog-list-pagination a').css('margin-top', '0px');
    });

    var older_posts_btn_txt = $('.berend-blog-list-pagination span.prev-entries').html();
    var next_posts_btn_txt = $('.berend-blog-list-pagination span.next-entries').html();

    if(older_posts_btn_txt == '' && next_posts_btn_txt == '')
    {
        $('.berend-blog-list-pagination').closest('section').hide();
    }
    else if(older_posts_btn_txt == ' ' && next_posts_btn_txt == ' ')
    {
        $('.berend-blog-list-pagination').closest('section').hide();
    }

    $('.journal.signature-claus').each(function(){
        var max_height = 0;
        $(this).find('.news-block.signature-claus').each(function(){
            if($(this).outerHeight() > max_height)
                max_height = $(this).outerHeight();
        });

        $(this).find('.news-block.signature-claus').outerHeight(max_height);
        //$(this).find('.news-block.signature-claus').css('height', max_height+'px');
    });

    $('.news-list-wrap.signature-johan .news-block').setAllToMaxHeight();

    $('.news-block.signature-leon').mouseenter(function(){
        $(this).css('background-image', 'url("'+$(this).data('bg-img')+'")');
    });

    $('.news-block.signature-leon').mouseleave(function(){
        $(this).css('background-image', 'url("")');
    });

    $('.news-list-wrap.signature-leon .news-block').setAllToMaxHeight();

    $('.news-list-wrap.signature-nemo').imagesLoaded( function() {
        $('.news-list-wrap.signature-nemo .news-block').setAllToMaxHeight();
    });

    $('.news-list.signature-quartz').imagesLoaded( function() {
        $('.news-list.signature-quartz .news-list-item').setAllToMaxHeight();
    });

    setTimeout(function(){
        $('.journal.signature-stefan').imagesLoaded( function() {
            $('.journal.signature-stefan .news-block').setAllToMaxHeight();
        });
    },1500);

    $('.journal.signature-wilmar').imagesLoaded( function() {
        $('.journal.signature-wilmar .news-block').setAllToMaxHeight();
    });

    $('.journal.signature-stefan .news-block').mouseenter(function(){
        $(this).css('background-image', 'url("'+$(this).data('bg-image')+'")');
    });

    $('.journal.signature-stefan .news-block').mouseleave(function(){
        $(this).css('background-image', 'url("")');
    });


    $('.news-block.signature-xaver').mouseenter(function(){
        $(this).css('background-image', 'url("'+$(this).data('bg-img')+'")');
    });

    $('.news-block.signature-xaver').mouseleave(function(){
        $(this).css('background-image', 'url("")');
    });

    $('.news-list-wrap.signature-xaver .news-block').setAllToMaxHeight();
 //PARALLAX
        //Initialize Each Parallax Layer  
        function parallaxInit() {
            $.stellar({
                positionProperty: 'transform',
                responsive: true,
                horizontalOffset: 0
            });
        }

        if (!device.tablet() && !device.mobile()) {

            //Activating Parallax effect if non-mobile device is detected
            $(window).bind('load', function() {
                //parallaxInit();
                // $('.parallax, .vc_parallax-inner').each(function() {
                //     $(this).parallax('50%', 0.3, true);
                // });

                $('.parallax').attr('data-stellar-background-ratio','0.5');
                $('.parallax').attr('data-stellar-offset-parent','false');
                
                $('.vc_parallax').each(function(){
                    $(this).attr('data-stellar-background-ratio','0.5');
                    $(this).attr('data-stellar-offset-parent','true');
                    $(this).addClass('parallax');
                    $(this).find('.vc_parallax-inner').css('display','none');

                    $(this).css('background-image', 'url('+$(this).data('vc-parallax-image')+')');

                });
              
                setTimeout(function(){
                  parallaxInit();
                },100);

                $('body,html').mutate('scrollHeight',function (element,info){
                    $(window).trigger('resize');
                });
            });


        } else {

            //Dectivate Parallax effect if mobile device is detected (bg image is displayed)
            $('.parallax, .parallax-layer').addClass('no-parallax');
            setTimeout(function(){
                $('.vc_video-bg-container').each(function(){

                    var videoSec_vLink = $(this).attr('data-vc-video-bg');
                    var video_id = videoSec_vLink.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
                    var thumbnail_src = 'http://img.youtube.com/vi/' + video_id + '/hqdefault.jpg';
                    
                    $(this).remove('iframe');
                    $(this).find('.vc_video-bg').addClass('signature-yt-poster-img');
                    $(this).find('.vc_video-bg').css('background-image', 'url('+thumbnail_src+')');

                    
                });

                
            },600);
            

        }   

        if($('.mastfoot.signature-ebert').length != 0)
        {
            $('.mastwrap').addClass('adjust-bottom');
        }


        $('.signature-carousel.dir-type').each(function(){
          $(this).owlCarousel({
              loop:false,
              margin:0,
              dots:false,
              nav:true,
              navText: false,
              navSpeed: 1500,
              responsive:{
                  0:{
                      items:$(this).data('items-mob')
                  },
                  600:{
                      items:$(this).data('items-tab')
                  },
                  1000:{
                      items:$(this).data('items-desk')
                  }
              }
          });
        });

        $('.signature-carousel.bullet-type').each(function(){
          $(this).owlCarousel({
              loop:false,
              margin:0,
              dots:true,
              nav:false,
              navText: false,
              navSpeed: 1500,
              responsive:{
                  0:{
                      items:$(this).data('items-mob')
                  },
                  600:{
                      items:$(this).data('items-tab')
                  },
                  1000:{
                      items:$(this).data('items-desk')
                  }
              }
          });
        });

        $('.intro-carousel.signature-gozzo').owlCarousel({
            margin:0,
            loop:true,
            autoWidth:true,
            items:4,
            nav:true,
            dots:false,
            navText:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:4
                }
            }
        });
        setTimeout(function(){
            

            $('.intro-carousel.signature-gozzo .item').on( "mouseenter", function() {
                $('.intro-carousel.signature-gozzo .item img').stop().animate({
                  opacity: 0.15
                  }, 500, function() {
                  // Animation complete.
                });
                $(this).find('img').stop().animate({
                  opacity: 1
                  }, 500, function() {
                  // Animation complete.
                });
            });
            $('.intro-carousel.signature-gozzo .item').on( "mouseleave", function() {
                $('.intro-carousel.signature-gozzo .item img').stop().animate({
                  opacity: 1
                  }, 500, function() {
                  // Animation complete.
                });
            });
        },600);

        $(".home-carousel.signature-hans").owlCarousel({
            loop:true,
            margin:0,
            dots:false,
            nav:true,
            navText: false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });

        $('.intro-carousel.signature-uno').owlCarousel({
            margin:0,
            loop:true,
            autoHeight:true,
            items:1,
            nav:true,
            dots:false,
            navText:false
        });

        $('.intro-carousel.signature-uno .item').on( "mouseenter", function() {
            $('.intro-carousel .item img').stop().animate({
              opacity: 0.15
              }, 500, function() {
              // Animation complete.
            });
            $(this).find('img').stop().animate({
              opacity: 1
              }, 500, function() {
              // Animation complete.
            });
        });
        $('.intro-carousel.signature-uno .item').on( "mouseleave", function() {
            $('.intro-carousel .item img').stop().animate({
              opacity: 1
              }, 500, function() {
              // Animation complete.
            });
        });

        $('.discography-carousel').owlCarousel({
            margin:20,
            loop:true,
            autoHeight:true,
            items:4,
            nav:true,
            dots:false,
            navText:false,
             responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        });

    $('.discography-carousel .item').on( "mouseenter", function() {
        $('.discography-carousel .item img').stop().animate({
          opacity: 0.15
          }, 500, function() {
          // Animation complete.
        });
        $(this).find('img').stop().animate({
          opacity: 1
          }, 500, function() {
          // Animation complete.
        });
    });
    $('.discography-carousel .item').on( "mouseleave", function() {
        $('.discography-carousel .item img').stop().animate({
          opacity: 1
          }, 500, function() {
          // Animation complete.
        });
    });

        $('.bxslider').bxSlider({
          pagerCustom: '#bx-pager',
          controls: false,
          adaptiveHeight: true
        });

        $('.features-slider-triggers a:first-child').addClass('features-triggered');

        $('.features-slider-triggers a').click(function(){
          $('.features-slider-triggers a').removeClass('features-triggered');
          $(this).addClass('features-triggered');
        });

        $('.woocommerce ul.products li.product a.add_to_cart_button, .woocommerce div.product form.cart button, .button.wc-backward').removeClass('button').addClass('btn btn-small btn-signature btn-signature-dark').prepend('<i class="glyphicon glyphicon-shopping-cart"></i>');

        //$('.woocommerce #review_form #respond .form-submit input').addClass('btn btn-small btn-signature btn-signature-dark');
        $('.woocommerce #review_form #respond .form-submit').prepend('<button class="btn btn-small btn-signature btn-signature-dark">'+$('.woocommerce #review_form #respond .form-submit input').attr('value')+'</button>');
        $('.woocommerce #review_form #respond .form-submit button').on('click', function(){
            $('.woocommerce #review_form #respond .form-submit input').trigger('click');
        });

        $('div.shop-cart-dropdown-trigger').on('click',function(){
            $('.shopping_cart_dropdown').stop().slideToggle(500);
            
        });

        $('div.shopping_cart_header a.header_cart').on('click',function(){
            return false;
        });

        $('.shop-sub-search a, .pop-search button').on('click', function(){
            $('.pop-search').fadeToggle(400);
        });
        $('.shop-sub-close a').on('click', function(){
            $('.shop-sub-header').slideUp(400);
        });

        $('.shop_table .coupon input[name="apply_coupon"], .shop_table input[name="update_cart"]').removeClass('button').addClass('btn btn-small btn-signature btn-signature-dark');
        $('.wc-proceed-to-checkout a').removeClass('button').addClass('btn btn-small btn-signature btn-signature-color');
        $('.woocommerce .address a.edit').addClass('btn btn-small btn-signature btn-signature-dark');
        $('.signature-sidebar form input[type="submit"], .signature-single-post-pagination a').addClass('btn btn-small btn-signature btn-signature-dark');
        $('#wp-calendar td').removeClass('pad');
        $('.signature-single-post-pagination a').addClass('btn btn-small btn-signature btn-signature-color');

        $(window).load(function(){
            setTimeout(function(){
                $('.woocommerce-checkout-payment .form-row.place-order input#place_order').removeClass('button').addClass('btn btn-small btn-signature btn-signature-dark');
            },1000);
        });

        $('.woocommerce div.product form.cart .variations label').addClass('font3thin color');
        $('.woocommerce div.product form.cart .reset_variations').addClass('btn btn-small btn-signature btn-signature-dark');

        if($('#blog_pagination span.prev-entries').html() == '' && $('#blog_pagination span.next-entries').html() == '')
            $('#blog_pagination').addClass('hidden');

        $('.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo a.btn.btn-signature').removeClass('btn-signature-dark').addClass('btn-signature-color');
        $('.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo .news-date span').removeClass('font3').addClass('font4');
        $('.mastwrap.signature-uno .signature-sidebar #searchsubmit').removeClass('btn-signature-dark').addClass('btn-signature-color');
        
        
    }); 
    // $(function ($)  : ends
})();
//  JSHint wrapper $(function ($)  : ends
});