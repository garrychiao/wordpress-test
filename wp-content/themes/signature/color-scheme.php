<?php
$signature_options = signature_get_options('signature_wp');
 


$main_highlight = $signature_options['highlight_color'];
$contrast = $signature_options['contrast_color'];


$rgb_code = signature_get_rgb($signature_options['highlight_color']);
$rgb = $rgb_code[0].','.$rgb_code[1].','.$rgb_code[2];

$colorRGBA = 'rgba('.$rgb.',0.8)';

$color = $main_highlight;
$white = '#FFFFFF';
$off_white = '#F2F2F2';
$silver = '#F0F4F4';
$off_silver = '#f7f7f7';
$dark_silver = '#EBEBEB';
$grey = '#999999';
$light_grey = '#CCCCCC';
$dark = '#292929';
$black = '#121212';
$ash = '#f0f0f0';
$light_brown = '#efece7';
$light_silver = '#dddee0';


$signature_color_scheme = '
.color{
	color:'.$color.';
}
.white{
	color:'.$white.';
}
.offwhite{
	color: '.$off_white.';
}
.silver{
	color:'.$silver.';
}
.off-sliver{
	color:'.$off_silver.';
}
.dark-silver{
	color:'.$dark_silver.';
}
.grey{
	color:'.$grey.';
}
.light-grey{
	color:'.$light_grey.';
}
.dark{
	color:'.$dark.';
}
.black{
	color:'.$black.';
}
.light-brown{
	color:'.$light_brown.';
}
.color-bg{
	background-color:'.$color.';
}
.white-bg{
	background-color:'.$white.';
}
.offwhite-bg{
	background-color: '.$off_white.';
}
.silver-bg{
	background-color:'.$silver.';
}
.off-silver-bg{
	background-color:'.$off_silver.';
}
.dark-silver-bg{
	background-color:'.$dark_silver.';
}
.grey-bg{
	background-color:'.$grey.';
}
.light-grey-bg{
	background-color:'.$light_grey.';
}
.dark-bg{
	background-color:'.$dark.';
}
.black-bg{
	background-color:'.$black.';
}
.ash-bg{
	background-color:'.$ash.';
}
.light-brown-bg{
	background-color:'.$light_brown.';
}
.light-silver-bg{
	background-color:'.$light_silver.';
}

.white-border{
	border-color: '.$white.';
}

a{
	color:'.$color.';
}
a:hover, nav.mastnav.signature-ebert .menu-credits p a:hover{
	color:'.$color.';
}
::selection {
  background: '.$color.';
  color:'.$contrast.' !important;
}
::-moz-selection {
  background: '.$color.';
  color:'.$contrast.' !important;
}

body, p{
	color: '.$dark.';
}
.btn-signature-color{
	background-color:'.$color.' !important;
	color:'.$contrast.' !important;
}
.btn-signature-color:hover{
	background-color:'.$black.' !important;
	color:'.$white.' !important;
}
.btn-signature-dark:hover, .btn-signature-white:hover {
	background-color:'.$color.' !important;
	color:'.$contrast.' !important;
}
.btn-signature-dark{
	color:'.$white.' !important;
}

.btn-signature-gozzo.btn-signature-dark{
	color:'.$dark.' !important;
}
.btn-signature-dark:hover{
	color:'.$dark.' !important;
}
.btn-signature-gozzo.btn-signature-dark:hover{
	color:'.$white.' !important;
}

.btn-signature-white{
	color:'.$dark.' !important;
}
.btn-signature-white:hover{
	color:'.$white.' !important;
}
.btn-signature-gozzo.btn-signature-color{
	color: '.$color.' !important;
	border: '.$color.' solid 2px !important;
	background: transparent !important;
	-webkit-transition: all 0.4s ease-in-out 0s;
     -moz-transition: all 0.4s ease-in-out 0s;
    -ms-transition: all 0.4s ease-in-out 0s;
     -o-transition: all 0.4s ease-in-out 0s;
      transition: all 0.4s ease-in-out 0s;
}
.btn-signature-gozzo.btn-signature-color:hover{
	color:'.$contrast.' !important;
	background: '.$color.' !important;
}

nav.mastnav.signature-adler {
	border-color:'.$dark.';
}

.works-filter.signature-adler li a{
	color:'.$white.';
}
.works-filter.signature-adler li a:hover{
	color:'.$color.';
}
.filter-notification,
.filter-notification:visited{
	color: '.$black.' !important;
}
.works-thumbnails-view .works-item-inner p > span {
	border-color:'.$white.';
}
.team-block.signature-adler .team-overlay{
	border-color:'.$white.';
}


.call-to-action.signature-adler{
	border-color:'.$dark.';
}

.main-link:hover, .sub-menu a:hover{
	color:'.$color.' !important;
}
.signature-berend .sub-menu a{
	color:'.$black.';
}

.project-nav-icon-wrap li:hover{
  background-color: '.$color.';
}
.filter-active span{
	color:'.$color.';
}
.signature-berend-sub-heading.sub-heading span.color{
	color:'.$color.';
	border-color:'.$color.';
}
.signature-berend-sub-heading.sub-heading span.white{
	color:'.$white.';
	border-color:'.$white.';
}
.signature-berend-sub-heading.sub-heading span.dark{
	color:'.$dark.';
	border-color:'.$dark.';
}
.signature-berend-sub-heading.sub-heading span.black{
	color:'.$black.';
	border-color:'.$black.';
}
.signature-berend-sub-heading.sub-heading span.gery{
	color:'.$grey.';
	border-color:'.$grey.';
}
.signature-berend-sub-heading.sub-heading span.silver{
	color:'.$silver.';
	border-color:'.$silver.';
}
.signature-berend.clients-wrap .client-logo{border-color:'.$color.' !important;}
.signature-berend .works-item-inner{ background: '.$color.' !important;}
.signature-franz .works-item-inner{
	 background: '.$color.' !important;
}
nav.mastnav.signature-claus ul li a{
	color:'.$black.';
}
nav.mastnav.signature-claus .sub-menu a{
	color:'.$grey.';
}
.works-filter.signature-claus li a{
	color:'.$black.';
}
.intro-carousel.signature-hans .owl-nav div{
  background-color: '.$color.' !important;
}
nav.mastnav.signature-hans .sub-menu a:hover{
	background-color: '.$color.' !important;
	color:'.$black.' !important;
}
.features-slider-triggers.signature-igor a.features-triggered{
	border-color: '.$color.' !important;
	color:  '.$color.' !important;
}
.cd-headline.loading-bar .cd-words-wrapper::after{
	background-color: '.$color.' !important;
}
.works-item.signature-karl .works-item-inner h3 span{ 
	border-bottom: '.$color.' solid 2px;
    
}
nav.mastnav.signature-leon ul.main-menu.signature-leon{
	border-color: '.$color.';
}
.news-block.signature-leon:hover{
	border: solid 15px '.$color.';
}
.works-thumbnails-view.signature-leon .works-item-inner p span{
	border-bottom: '.$color.' solid 5px;
}
nav.mastnav.signature-moritz ul.main-menu{
	border-bottom: '.$color.' solid 5px;
}
.signature-nemo.works-thumbnails-view .works-item-inner{
	background-color: '.$color.' !important;
}
.process-carousel.signature-orwin .features-slider-triggers.signature-orwin a{
	color: '.$color.';
	border: solid 1px '.$color.';
}
.process-carousel.signature-orwin.process-carousel-white .features-slider-triggers.signature-orwin a:hover, .process-carousel.signature-orwin.process-carousel-white .features-slider-triggers.signature-orwin a.features-triggered{
	color: '.$white.';
	border: solid 1px '.$white.';
}
.process-carousel.signature-orwin.process-carousel-dark .features-slider-triggers.signature-orwin a:hover, .process-carousel.signature-orwin.process-carousel-dark .features-slider-triggers.signature-orwin a.features-triggered{
	color: '.$black.';
	border: solid 1px '.$black.';
}
.parallax-showcase.signature-orwin:hover .orwin-parallax-showcase-overlay.trans-white-bg{
	background-color: rgba(255,255,255,0.3) !important;
}
.parallax-showcase.signature-orwin:hover .orwin-parallax-showcase-overlay.trans-dark-bg{
	background-color: rgba(0,0,0,0.3) !important;
}
.parallax-showcase.signature-orwin:hover .orwin-parallax-showcase-overlay.trans-color-bg{
	background-color: rgba('.$rgb.',0.3) !important;
}
.trans-color-bg{
	background-color: rgba('.$rgb.',0.8) !important;
}

.mobile-toggle span{
	background: '.$color.' !important;
}
.mastfoot.signature-quartz .foot-text a{
	color: '.$color.' ;
}
.signature-price-table.price.price-table-white, .signature-price-table.price-table-white .price-specs{
	border-color: '.$white.';
}
.signature-price-table.price.price-table-black, .signature-price-table.price-table-black .price-specs{
	border-color: '.$black.';
}
.signature-price-table.price.price-table-dark, .signature-price-table.price-table-dark .price-specs{
	border-color: '.$dark.';
}
.signature-price-table.price.price-table-color, .signature-price-table.price-table-color .price-specs{
	border-color: '.$color.';
}
.journal.signature-stefan .news-block:hover{
	border: '.$color.' solid 15px;
}
.works-item.signature-theo a.border-dark{
    border: '.$dark.' double 8px;
}
.works-item.signature-theo a.border-white{
    border: '.$white.' double 8px;
}
.works-item.signature-theo a.border-color{
    border: '.$color.' double 8px;
}
.works-item.signature-theo .works-item-inner p span.dark{
	border-top: '.$dark.' solid 1px;
}
.works-item.signature-theo .works-item-inner p span.white{
	border-top: '.$white.' solid 1px;
}
.works-item.signature-theo .works-item-inner p span.color{
	border-top: '.$color.' solid 1px;
}
.features-slider-triggers.signature-theo a.features-triggered .white-on-active{
	color: '.$white.';
}
.features-slider-triggers.signature-theo a.features-triggered .dark-on-active{
	color: '.$dark.';
}
.dropit-submenu{ background-color: '.$black.';}
.dropit-submenu a:hover{
	color: '.$white.' !important;
	background-color: '.$color.';
}
.mastfoot.signature-velten{
	border-color: '.$color.' !important;
}
.velten-filter a.active span, .velten-filter a:hover{
	color: '.$white.' !important;
}
nav.mastnav.signature-wilmar .sub-menu a{
	color: '.$grey.' !important;
}
nav.mastnav.signature-wilmar .sub-menu a:hover{
	color: '.$color.' !important;
}
.team-block.signature-xaver .team-overlay{
	background-color: '.$color.';
}
.works-item.signature-york .works-item-inner{
	background-color:'.$colorRGBA.';
}
nav.main-nav-dropdown.signature-zircon ul.dropit-submenu{
	background-color:'.$black.';
}
nav.main-nav-dropdown.signature-zircon ul.dropit-submenu li a:hover{
	background-color: '.$color.';
}
footer.mastfoot.signature-zircon .footer-sub-links li a:hover{
	color: '.$color.';
}
.woocommerce ul.products li.product .price .amount, .woocommerce ul.products li.product .price ins{
	color: '.$color.';
}
.woocommerce ul.products li.product .price del .amount{
	color: '.$grey.' !important;
}
.woocommerce span.onsale{
	background-color: '.$color.' !important;
}
.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{
	background-color: '.$color.' !important;
	color: '.$white.' !important;
	border-color: '.$color.' !important;
}
.woocommerce div.product .product_title, .woocommerce div.product .related.products h2, .woocommerce-tabs h2, .woocommerce-tabs h3{
	background-color:'.$silver.';
}
.woocommerce div.product p.price, .woocommerce div.product span.price{
	color: '.$color.';
	border-color: '.$color.' !important;
}
.zircon-filter a:hover, .zircon-filter a.active{
	color: '.$color.';
}
.shop-cart-dropdown-trigger .header_cart{
	color: '.$white.' !important;
}
.signature-sidebar .widget ul li a:hover{
	color: '.$color.';
}
#wp-calendar tbody
td#today {
color:'.$color.';
border-color:'.$color.';
}
#wp-calendar tbody td
a,#wp-calendar tfoot td#prev a:hover,#wp-calendar tfoot td#next a:hover {
color:'.$color.';
}
.respond h3, .respond textarea{
	color: '.$dark.';
}
.signature-adler.default-wp-nav a, .main-menu.signature-adler a{
	color: '.$dark.';
}
.signature-adler.default-wp-nav a:hover{
	color: '.$color.';
}
.signature-adler.default-wp-nav .sub-menu a, .main-menu.signature-adler .sub-menu a{
	color: '.$grey.';
} 
.signature-post-tags a{
	background:'.$dark.';
	color: '.$white.';
}
.signature-post-tags a:hover{
	background:'.$color.';
	color: '.$white.';
}
nav.mastnav.signature-ebert a{
	color: '.$dark.';
}
nav.mastnav.signature-franz a{
	color: '.$dark.';
}
.signature-gozzo.navigation a{
	color: '.$dark.';
}
.page-content-wrap-signature-gozzo a{
	color: '.$dark.';
}
.page-content-wrap-signature-gozzo a:hover{
	color: '.$color.';
}
.works-filter.signature-gozzo li a{
	color: '.$white.';
}

.mastfoot.signature-hans a{
	color: '.$dark.';
}
.mastfoot.signature-hans a:hover{
	color: '.$color.';
}
.trans-dark-overlay{
	background:rgba(0,0,0,.6) !important;
}
.mastfoot.signature-igor .social-nav li a {
    color: '.$black.';
}
.mastfoot.signature-igor .social-nav li a:hover{
    color: '.$color.';
}
.filter-notification.signature-claus a{
	color: '.$dark.';
}
.filter-notification.signature-claus a:hover{
	color: '.$color.';
}
footer.mastfoot.signature-leon .foot-social li a{
	color: '.$black.';
}
footer.mastfoot.signature-leon .foot-social li a:hover{
	color: '.$color.';
}
nav.mastnav.signature-leon .sub-menu a{
	color: '.$dark.';
}
nav.mastnav.signature-leon .sub-menu a:hover{
	color: '.$color.';
}
nav.mastnav.signature-moritz a{
	color: '.$white.';
}
.works-filter.signature-nemo li a, nav.mastnav.signature-nemo a{
	color: '.$white.';
}
.mastfoot.signature-igor .social-nav.orwin-social-icons li a {
    color: '.$white.';
}
.mastfoot.signature-igor .social-nav.orwin-social-icons li a:hover {
    color: '.$color.';
}
nav.mastnav.signature-igor .orwin-nav a{
	color: '.$white.';
}
.main-nav-menu.signature-quartz li a{
	color: '.$white.';
}
nav.mastnav.signature-rein .sub-menu li a{
	color: '.$dark.';
}
nav.mastnav.signature-stefan a{
	color: '.$white.';
}
nav.mastnav.signature-theo a{
	color: '.$white.';
}
.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo .news-date{
	color: '.$color.';
}
.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo .news-date span{
	color: '.$white.';
}
.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo .news-heading{
	color: '.$white.';
}
.mastwrap.signature-uno .blog-list-wrap.journal.signature-gozzo .news-list-item.signature-gozzo p{
	color: '.$white.';
}
.mastwrap.signature-uno .signature-sidebar, .mastwrap.signature-uno .signature-sidebar a{
	color: '.$white.';
}
.mastwrap.signature-uno .signature-sidebar .widget-heading{
	background-color: '.$color.';
}
nav.mastnav.signature-xaver ul li a{
	color: '.$white.';
}
nav.mastnav.signature-xaver ul li a:hover{
	color: '.$color.';
}
nav.mastnav.signature-xaver a{
	color: '.$color.';
}
.mastfoot.signature-xaver a{
	color: '.$color.';
}
footer.mastfoot a:hover{
	color: '.$dark.';
}
nav.mastnav.signature-amor .sub-menu a{
	color:'.$grey.';
}
footer.mastfoot.signature-amor a{
	color:'.$dark.';
}
footer.mastfoot.signature-amor a:hover{
	color:'.$color.';
}
';




if(isset($signature_options['load-animation']['url']))
{
	$signature_color_scheme .= '#status{
		background-image: url('.esc_url($signature_options['load-animation']['url']).');
		background-size: '.$signature_options['load-animation']['width'].'px '.$signature_options['load-animation']['height'].'px;
	}';
}

if(isset($signature_options['load-animation2x']['url']))
{
	$signature_color_scheme .= '@media all and (-webkit-min-device-pixel-ratio: 1.5) {
	#status{
		background-image: url('.esc_url($signature_options['load-animation2x']['url']).');
		background-size: '.$signature_options['load-animation']['width'].'px '.$signature_options['load-animation']['height'].'px;
	}
}';
}    


if(isset($signature_options['mob-nav-logo']['url']))
{
	$signature_color_scheme .= '.menu-collapser{
		background-image: url('.esc_url($signature_options['mob-nav-logo']['url']).') !important;
		background-size: '.$signature_options['mob-nav-logo']['width'].'px '.$signature_options['mob-nav-logo']['height'].'px !important;
	}';
}

if(isset($signature_options['mob-nav-logo2x']['url']))
{
	$signature_color_scheme .= '@media all and (-webkit-min-device-pixel-ratio: 1.5) {
	.menu-collapser{
		background-image: url('.esc_url($signature_options['mob-nav-logo2x']['url']).') !important;
		background-size: '.$signature_options['mob-nav-logo']['width'].'px '.$signature_options['mob-nav-logo']['height'].'px !important;
	}
}';
}

if(isset($signature_options['berend-nav-bg-image']['url']))
{
	$signature_color_scheme .= '.mastnav.signature-berend .mastnav-inner-left{
		background-image: url('.esc_url($signature_options['berend-nav-bg-image']['url']).');
	}';
}

if(signature_get_main_class() == 'signature-ebert')
{
	if($signature_options['ebert-layout'] == '1')
		$signature_color_scheme .= 'body{
			border-left: 70px solid #fff;
    		border-right: 70px solid #fff;
		}';
}


?>