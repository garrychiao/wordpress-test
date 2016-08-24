<?php

$signature_options = signature_get_options('signature_wp');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php bloginfo('name'); ?> <?php wp_title("|",true); ?>">


<?php

    wp_head();  
    
    
?>

</head>

<body <?php body_class(); ?>>

<div id="preloader" class="<?php echo esc_attr(signature_get_main_class()); ?>">
    <div id="status"></div>
</div>


<!-- mobile only navigation : starts -->
<nav class="mobile-nav signature-adler">
  <?php
    if($signature_options['navigation_opt'] == "0")
    {
      $nav_args = array(
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'slimmenu',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu'
      );

      wp_nav_menu( $nav_args );
    }
    else
    {
      signature_mobile_nav();
    }
  ?>
</nav>
<!-- mobile only navigation : ends -->
    
<?php
  
  if(function_exists("is_woocommerce"))
    get_template_part('shop-header');


  if(signature_get_navigation_style() == 'Adler')
    get_template_part('navigation/adler');
  elseif(signature_get_navigation_style() == 'Berend')
    get_template_part('navigation/berend');
  elseif(signature_get_navigation_style() == 'Claus')
    get_template_part('navigation/claus');
  elseif(signature_get_navigation_style() == 'Dierk')
    get_template_part('navigation/dierk');
  elseif(signature_get_navigation_style() == 'Ebert')
    get_template_part('navigation/ebert');
  elseif(signature_get_navigation_style() == 'Franz')
    get_template_part('navigation/franz');
  elseif(signature_get_navigation_style() == 'Gozzo')
    get_template_part('navigation/gozzo');
  elseif(signature_get_navigation_style() == 'Hans')
    get_template_part('navigation/hans');
  elseif(signature_get_navigation_style() == 'Igor')
    get_template_part('navigation/igor');
  elseif(signature_get_navigation_style() == 'Johan')
    get_template_part('navigation/johan');
  elseif(signature_get_navigation_style() == 'Karl')
    get_template_part('navigation/karl');
  elseif(signature_get_navigation_style() == 'Leon')
    get_template_part('navigation/leon');
  elseif(signature_get_navigation_style() == 'Moritz')
    get_template_part('navigation/moritz');
  elseif(signature_get_navigation_style() == 'Nemo')
    get_template_part('navigation/nemo');
  elseif(signature_get_navigation_style() == 'Orwin')
    get_template_part('navigation/orwin');
  elseif(signature_get_navigation_style() == 'Phil')
    get_template_part('navigation/phil');
  elseif(signature_get_navigation_style() == 'Quartz')
    get_template_part('navigation/quartz');
  elseif(signature_get_navigation_style() == 'Rein')
    get_template_part('navigation/rein');
  elseif(signature_get_navigation_style() == 'Stefan')
    get_template_part('navigation/stefan');
  elseif(signature_get_navigation_style() == 'Theo')
    get_template_part('navigation/theo');
  elseif(signature_get_navigation_style() == 'Uno')
    get_template_part('navigation/uno');
  elseif(signature_get_navigation_style() == 'Velten')
    get_template_part('navigation/velten');
  elseif(signature_get_navigation_style() == 'Wilmar')
    get_template_part('navigation/wilmar');
  elseif(signature_get_navigation_style() == 'Xaver')
    get_template_part('navigation/xaver');
  elseif(signature_get_navigation_style() == 'York')
    get_template_part('navigation/york');
  elseif(signature_get_navigation_style() == 'Zircon')
    get_template_part('navigation/zircon');
  elseif(signature_get_navigation_style() == 'Amor')
    get_template_part('navigation/amor');
  elseif(signature_get_navigation_style() == 'Boston')
    get_template_part('navigation/boston');
  
?>

    <section class="mastwrap <?php echo esc_attr(signature_get_main_class()); ?>">
      <div class="inner-wrap no-pad">