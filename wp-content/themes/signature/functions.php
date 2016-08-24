<?php

//Metaboxes
require_once get_template_directory() . "/admin/metabox.php";

/*---------------------------------------
--------POST TYPE SORTING---------
-----------------------------------------*/
$custom_post_types['objects'] = array();

array_push($custom_post_types['objects'], "page", "post", "signature-portfolio");
update_option( 'hicpo_options', $custom_post_types );


/*---------------------------------------
---------Signature Initialiszation---------
-----------------------------------------*/
function signature_setup() 
  {
		
		

    if(signature_get_navigation_style() == 'Zircon')
    {
      register_nav_menu('left_nav', esc_html__( 'Left Navigation', 'signature'));
      register_nav_menu('right_nav', esc_html__( 'Right Navigation', 'signature'));
    }
    else{
      register_nav_menu('primary', esc_html__( 'Primary Navigation', 'signature'));
    }

    if(signature_get_footer_style() == 'Zircon')
    {
      register_nav_menu('footer_nav_1', esc_html__( 'Footer Navigation 1', 'signature'));
      register_nav_menu('footer_nav_2', esc_html__( 'Footer Navigation 2', 'signature'));
    }
		
		add_theme_support('post-thumbnails' );
		
    add_theme_support( "title-tag" );

    add_theme_support( 'custom-header' );

    add_theme_support( "custom-background");

    

    		
		set_post_thumbnail_size( 300, 300, true ); // Standard Size Thumbnails
    
    //Feed links
		add_theme_support( 'automatic-feed-links' );
		
    //Content width
    if ( ! isset( $content_width ) ) $content_width = 900;


    
    

    //Load the text domain
		load_theme_textdomain('signature', get_template_directory() . '/languages');
  }

add_action( 'after_setup_theme', 'signature_setup' );



add_filter( 'body_class', 'signature_body_class' );
function signature_body_class( $classes ) {
  $classes[] = signature_get_main_class().'-body';
  return $classes;
}


//Sidebar
  function signature_sidebar_init(){
    $args = array(
    'name'          => esc_html__( 'Signature Sidebar', 'signature' ),
    'id'            => 'signature_side',
    'description'   => 'Sidebar for premium theme Signature',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s side_block">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-heading font3bold">',
    'after_title'   => '</h4>' );
    register_sidebar( $args ); 
  }

add_action( 'widgets_init', 'signature_sidebar_init' );


if ( class_exists( 'ReduxFramework' ) ) {
       
    require_once get_template_directory() . '/admin/theme-options.php';
}


//WooCommerce Compatibility ---- Begins

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'signature_shop_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'signature_shop_wrapper_end', 10);

function signature_shop_wrapper_start() {
  echo '<section id="main-shop">';
}

function signature_shop_wrapper_end() {
  echo '</section>';
}

add_theme_support( 'woocommerce' );

//WooCommerce Compatibility ---- Ends

//does woocommerce function exists?
if(function_exists("is_woocommerce")){
    //include woocommerce configuration

    //Sidebar
    $woocom_widget_args = array(
    'name'          => esc_html__( 'Woocommerce Header Widget', 'signature' ),
    'id'            => 'signature_shop_sidebar',
    'description'   => '',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s side_block">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="sub-heading"><span class="highlight-txt">',
    'after_title'   => '</span></h4>' );
    register_sidebar( $woocom_widget_args );
    
    
}




function signature_get_options($opt_name){
  require_once get_template_directory().'/admin/default-options.php';

  if ( class_exists( 'ReduxFramework' ) ) {
    return get_option('signature_wp');
  }
  else
  {
    global $signature_default_options;
    return $signature_default_options;
  }
}


function signature_get_footer_style(){
  $signature_options = signature_get_options('signature_wp');

  $footer_style_url = $signature_options['footer-style'];
  $footer_styles = explode('/', $footer_style_url);
  $footer_style = end($footer_styles);
  $footer_style = substr($footer_style, 0, -4);

  return $footer_style;
}


function signature_get_navigation_style(){
  $signature_options = signature_get_options('signature_wp');

  $navigation_style_url = $signature_options['navigation-style'];
  $navigation_styles = explode('/', $navigation_style_url);
  $navigation_style = end($navigation_styles);
  $navigation_style = substr($navigation_style, 0, -4);

  return $navigation_style;
}

function signature_get_main_class()
{
  $main_class = 'signature-'.strtolower(signature_get_navigation_style());
  return $main_class;
}

/*---------------------------------------
--------Script and Style Enqueue---------
-----------------------------------------*/

if (!is_admin()) 
{ 

    add_action( 'wp_enqueue_scripts', 'signature_scripts' );
    add_action( 'wp_enqueue_scripts', 'signature_register_scripts' );
    add_action( 'wp_enqueue_scripts', 'signature_styles' );

}
else{
    add_action( 'admin_enqueue_scripts', 'signature_admin_scripts' );
    add_action( 'admin_enqueue_scripts', 'signature_admin_styles' );
}




if ( is_singular() ) wp_enqueue_script( "comment-reply" );


function signature_scripts() 
{ 

    

    
    
    wp_enqueue_script("signature-common-script", get_template_directory_uri(). "/javascripts/libs/common.js",array('jquery'),false,true);
    wp_enqueue_script("isotope", get_template_directory_uri(). "/javascripts/libs/isotope.js",array('jquery'),false,true);
    wp_enqueue_script("bootstrap", get_template_directory_uri(). "/javascripts/libs/bootstrap.min.js",array(),false,true);
    wp_enqueue_script("signature-ebert-multiscroll-script", get_template_directory_uri(). "/javascripts/libs/jquery.multiscroll.min.js",array(),false,true);
    wp_enqueue_script("mutate-events", get_template_directory_uri(). "/javascripts/libs/events.min.js",array(),false,true);
    wp_enqueue_script("mutate", get_template_directory_uri(). "/javascripts/libs/mutate.min.js",array(),false,true);
    wp_enqueue_script("bxslider", get_template_directory_uri(). "/javascripts/libs/jquery.bxslider.min.js",array(),false,true);
    wp_enqueue_script("signature-animatedheaders-script", get_template_directory_uri(). "/javascripts/libs/animatedheaders.js",array(),false,true);
    wp_enqueue_script("signature-main-script", get_template_directory_uri(). "/javascripts/custom/main.js",array(),false,true);
    wp_enqueue_script("signature-adler-elements-script", get_template_directory_uri(). "/javascripts/custom/elements.js",array(),false,true);
    wp_enqueue_script("signature-gmap-api-script", "https://maps.googleapis.com/maps/api/js?sensor=false",array(),false,true);
    
    
    
}



function signature_register_scripts()
{
    wp_register_script("modal-plugin", get_template_directory_uri(). "/javascripts/libs/modalEffects.js",array(),false,true);
    wp_register_script("form-validation", get_template_directory_uri(). "/javascripts/custom/form-validation.js",array(),false,true);
    wp_register_script("map-init", get_template_directory_uri(). "/javascripts/custom/map-init.js",array(),false,true);
    wp_register_script("map-init2", get_template_directory_uri(). "/javascripts/custom/map-init2.js",array(),false,true);
    wp_register_script("map-init3", get_template_directory_uri(). "/javascripts/custom/map-init3.js",array(),false,true);
    wp_register_script("vegas-init", get_template_directory_uri(). "/javascripts/custom/vegas-init.js",array(),false,true);
    wp_register_script("amor-vegas-init", get_template_directory_uri(). "/javascripts/custom/amor-vegas-init.js",array(),false,true);
    wp_register_script("split-scroll-init", get_template_directory_uri(). "/javascripts/custom/split-scroll-init.js",array(),false,true);
    wp_register_script("navmenu-init", get_template_directory_uri(). "/javascripts/custom/navmenu-init.js",array(),false,true);

    wp_register_script("imagesloaded", get_template_directory_uri(). "/javascripts/libs/imagesloaded.pkgd.min.js",array(),false,true);
    wp_register_script("packery", get_template_directory_uri(). "/javascripts/libs/packery.pkgd.min.js",array(),false,true);
    wp_register_script("packery-parallax-init", get_template_directory_uri(). "/javascripts/custom/packery-parallax-init.js",array(),false,true);
    
    wp_register_script("flickr-jquery-ui", get_template_directory_uri(). "/javascripts/libs/jquery-ui.min.js",array(),false,true);
    wp_register_script("flickr-api", get_template_directory_uri(). "/javascripts/libs/FlickrAPI.js",array(),false,true);
    wp_register_script("flickr-gallery", get_template_directory_uri(). "/javascripts/libs/Flickr.Gallery.min.js",array(),false,true);
    wp_register_script("flickr-init", get_template_directory_uri(). "/javascripts/custom/flickr-init.js",array(),false,true);

    wp_register_script("flickr-tiles", get_template_directory_uri(). "/javascripts/libs/flickr.tiles.js",array(),false,true);
    wp_register_script("flickr-tiles-init", get_template_directory_uri(). "/javascripts/custom/flickr-tiles-init.js",array(),false,true);


    wp_register_script("backstretch-init", get_template_directory_uri(). "/javascripts/custom/backstretch-init.js",array(),false,true);
}


function signature_admin_scripts()
{  
  wp_enqueue_script("admin-cmb", get_template_directory_uri(). "/admin/js/cmb-field-folding.js",array(),false,true);
}



function signature_styles() 
{
  

  wp_enqueue_style("ion-icons-custom", get_template_directory_uri(). "/ionicons/css/ionicons.css");
  wp_enqueue_style("ion-icons-custom-old", get_template_directory_uri(). "/stylesheets/ionicons.min.css");
  wp_enqueue_style("custom-fonts", get_template_directory_uri(). "/fonts/fonts.css");

  wp_enqueue_style("bootstrap", get_template_directory_uri(). "/stylesheets/bootstrap.css");
  wp_enqueue_style("isotope", get_template_directory_uri(). "/stylesheets/isotope.css");
  wp_enqueue_style("venobox", get_template_directory_uri(). "/stylesheets/venobox.css");
  wp_enqueue_style("vegas", get_template_directory_uri(). "/stylesheets/vegas.css");
  wp_enqueue_style("sinister", get_template_directory_uri(). "/stylesheets/sinister.css");
  wp_enqueue_style("slimmenu", get_template_directory_uri(). "/stylesheets/slimmenu.css");
  wp_enqueue_style("navmenu", get_template_directory_uri(). "/stylesheets/navmenu.css");
  wp_enqueue_style("owl-carousel", get_template_directory_uri(). "/stylesheets/owl.carousel.css");

  wp_enqueue_style("modal-custom",get_template_directory_uri()."/stylesheets/md_modal.css");
  wp_enqueue_style("adler-elements", get_template_directory_uri(). "/stylesheets/elements.css");
  wp_enqueue_style("jquery-multiscroll", get_template_directory_uri(). "/stylesheets/jquery.multiscroll.css");
  wp_enqueue_style("split-scroll", get_template_directory_uri(). "/stylesheets/split-scroll.css");

  wp_enqueue_style("bxslider", get_template_directory_uri(). "/stylesheets/jquery.bxslider.css");
  wp_enqueue_style("animatedheaders", get_template_directory_uri(). "/stylesheets/animatedheaders.css");

  wp_enqueue_style("flickr-gallery", get_template_directory_uri(). "/stylesheets/flickergallery.css");

  wp_enqueue_style("dropit", get_template_directory_uri(). "/stylesheets/dropit.css");
  
  wp_enqueue_style("custom-main", get_template_directory_uri(). "/stylesheets/main.css");
  wp_enqueue_style("signature-navigation-styles", get_template_directory_uri(). "/stylesheets/navigation-styles.css");
  wp_enqueue_style("signature-footer-styles", get_template_directory_uri(). "/stylesheets/footer-styles.css");
  wp_enqueue_style("custom-style", get_template_directory_uri(). "/style.css");
  wp_enqueue_style("main-responsive", get_template_directory_uri(). "/stylesheets/main-responsive.css");
  
  
  
  if( function_exists( 'Vc_Manager' ) ) {
    wp_enqueue_style("js_composer_front");
  }

  

  
  
  
}
function signature_admin_styles()
{
 
  wp_enqueue_style("metastyles", get_template_directory_uri(). "/admin/css/meta-styles.css");  
  wp_enqueue_style("farbtastic-style", get_template_directory_uri(). "/admin/css/farbtastic.css");
  wp_enqueue_style("ion-icons", get_template_directory_uri(). "/ionicons/css/ionicons-admin.css");  
    
  
}







//Icon Set
require_once get_template_directory().'/admin/icon-set.php';


function signature_is_home_page(){
    if(is_front_page())
    {
      if(is_page_template('the-onepage.php'))
      { 
          $is_home = true;
      }
      else
      {
        $is_home = false;
      }
    }
    else
    {
      $is_home = false;
    }

    return $is_home;
}





function signature_vc_element_styles(){

    if(signature_is_home_page())
    {
        $signature_countpages = wp_count_posts('page')->publish;
        $signature_pages = get_pages( 'sort_order=asc&sort_column=menu_order');
        
        foreach($signature_pages as $signature_page)
        {

            setup_postdata($signature_page);

            $post_custom_css = get_post_meta( $signature_page->ID, '_wpb_post_custom_css', true );
            if ( ! empty( $post_custom_css ) ) {
                echo '<style type="text/css" data-type="vc_custom-css">';
                echo esc_html($post_custom_css);
                echo '</style>';
            }

            $shortcodes_custom_css = get_post_meta( $signature_page->ID, '_wpb_shortcodes_custom_css', true );
            if ( ! empty( $shortcodes_custom_css ) ) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo esc_html($shortcodes_custom_css);
                echo '</style>';
            }

            

        } 
        
        wp_reset_postdata();

        

        

        
    } 

}

function signature_custom_css(){
    $signature_options = signature_get_options('signature_wp');
    wp_enqueue_style('custom-style',get_template_directory_uri() . '/stylesheets/custom-style.css');
    require_once get_template_directory().'/color-scheme.php';
    require_once get_template_directory().'/font-scheme.php';
    
    $signature_custom_css = esc_html($signature_color_scheme).' '.$signature_font_scheme.' '.esc_html($signature_options['additional_css']);

  
    
    wp_add_inline_style( 'custom-style', $signature_custom_css );
}   

add_action( 'wp_enqueue_scripts', 'signature_custom_css' );


function signature_vc_custom_style($post){
  if( function_exists( 'Vc_Manager' ) ) {
    $post_custom_css = get_post_meta( $post->ID, '_wpb_post_custom_css', true );
    if ( ! empty( $post_custom_css ) ) {
      echo '<style type="text/css" data-type="vc_custom-css">';
      echo esc_html($post_custom_css);
      echo '</style>';
    }

    $shortcodes_custom_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
    if ( ! empty( $shortcodes_custom_css ) ) {
      echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
      echo esc_html($shortcodes_custom_css);
      echo '</style>';
    }
  }
}

function signature_vc_active_class(){
  if( function_exists( 'Vc_Manager' ) ) {
    $return_class = 'signature-vc-active';
  }
  else
  {
    $return_class = 'signature-vc-inactive';
  }
  return $return_class;
}


function signature_get_the_slug( $id=null ){
  global $post;
  $post = get_post($id);
  if( empty($post) )
    return ''; // No global $post var available.
  $slug = $post->post_name;
  return $slug;
}



function signature_clean($excerpt, $substr) {
    $string = strip_tags(do_shortcode($excerpt));
    if ($substr>0) {
      $string = substr($string, 0, $substr);
    }
    return $string.' [...]';
}


function signature_get_rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}


function signature_add_editor_styles() {
    add_editor_style( get_template_directory_uri(). "/stylesheets/custom-editor-style.css" );
}
add_action( 'admin_init', 'signature_add_editor_styles' );





function signature_mobile_nav()
{
  

  $locations = get_nav_menu_locations();
  $is_home = signature_is_home_page();

  if ($is_home == false)
  { 
    $nav_class = " inner-page"; 
    $root_url = site_url();
    $scroll_class = '';
  } 
  else
  { 
    $nav_class = " front-page"; 
    $root_url = '';
    $scroll_class = 'scroll';
  }

  if(!isset($locations['primary']))
  {
    $return = '<h5 class="clearfix dark text-center '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['primary']);

    $return = '';

    if(empty($menu))
    {
      $return = '<h5 class="clearfix dark text-center '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
    }

    else
    {
      $menu_items = wp_get_nav_menu_items($menu->term_id);
      
      _wp_menu_item_classes_by_context( $menu_items );

      $return = '<ul class="slimmenu '.esc_attr($nav_class).'">' . "\n";
      
      $menunu = array();
      foreach((array)$menu_items as $key => $menu_item )
      {
        $menunu[ (int) $menu_item->db_id ] = $menu_item;
      }
      unset($menu_items);
      
      foreach ( $menunu as $i => $men ){
        if($men->menu_item_parent == '0')
        {
            //Specific additions
            
            $has_sub_menu = 0;
            foreach ( $menunu as $submenu )
            {
              if($submenu->menu_item_parent == $men->ID)
              {
                $has_sub_menu = 1;
                
              }
            }

            if(( 'page' == $men->object ))
            {
                    $incl_onepage = get_post_meta($men->object_id,'_signature_one_page',true);
                    $small_title  = signature_get_the_slug($men->object_id);

                if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
                {
                  $href =  $root_url.'#'.$small_title;
                  $identifyClass = $scroll_class." is_onepage";
                  $link_target = '';
                }
                else
                {
                   $href = $men->url;
                   $identifyClass = "not_onepage";
                   if($men->target != '')
                    {
                      $link_target = 'target="_blank"';
                    }
                    else{
                      $link_target = '';
                    }
                }       
            } 
            else 
            {
              $href =  $men->url;
              $identifyClass = "not_onepage";
              $small_title  = strtolower(preg_replace('/\s+/', '-', $men->title));
              if($men->target != '')
                          {
                            $link_target = 'target="_blank"';
                          }
                          else{
                            $link_target = '';
                          }
            }
            $return .='<li>';
            $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="'.esc_attr($identifyClass).'">'. $men->title .'</a>';
            
            
            
            if($has_sub_menu == 1)
            {
              $return .= '<ul class="sub-menu">' . "\n";
            
              foreach ( $menunu as $submenu )
              {
                if($submenu->menu_item_parent == $men->ID)
                {
                  if(( 'page' == $submenu->object ))
                  {
                          $incl_onepage = get_post_meta($submenu->object_id,'_signature_one_page',true);
                          $small_title  = signature_get_the_slug($submenu->object_id);

                              if($incl_onepage == 'yes' OR $incl_onepage == 'Yes')
                              {
                      $href =  $root_url.'#'.$small_title;
                      $identifyClass = $scroll_class." is_onepage";
                      $link_target = '';
                      }
                      else
                      {
                                 $href = $submenu->url;
                                 $identifyClass = "not_onepage";
                                 if($men->target != '')
                                  {
                                    $link_target = 'target="_blank"';
                                  }
                                  else{
                                    $link_target = '';
                                  }
                      }       
                  } 
                  else 
                  {
                    $href =  $submenu->url;
                    $identifyClass = "not_onepage";
                    $small_title  = strtolower(preg_replace('/\s+/', '-', $submenu->title));
                    if($men->target != '')
                                {
                                  $link_target = 'target="_blank"';
                                }
                                else{
                                  $link_target = '';
                                }
                  }
                  $return .= '<li><a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="'.esc_attr($identifyClass).'">'. $submenu->title .'</a></li>';
                  
                }
              }
              $return .= '</ul>' . "\n";
            }
          $return .= '</li>' . "\n";
        }
      }
      
      unset($menunu); 
        $return .= '</ul>' . "\n";
    }
  }
  echo $return;
}





/* PAGINATION */
  
  add_filter('next_posts_link_attributes', 'signature_posts_panination_link_attributes');
  add_filter('previous_posts_link_attributes', 'signature_posts_panination_link_attributes');


  function signature_posts_panination_link_attributes() {
      return 'class="btn btn-signature btn-signature-color"';
  }
  


  function signature_getpagenavi(){
  ?>
  <div class="row">
    <div id="blog_pagination" class="col-md-8 blog_pagination pad-top-half pad-bottom-half silver-bg text-center">
    <?php if(function_exists('wp_pagenavi')) : ?>
    <?php wp_pagenavi(); ?>
    <?php else : ?>
        <div class="archive-pagination-links">
          <span class="prev-entries"><?php next_posts_link(esc_html__('Previous Entries' , 'signature')); ?></span>
          <span class="next-entries"><?php previous_posts_link(esc_html__('Newer Entries', 'signature')); ?></span>
        </div>
        <div class="clear"></div>
    <?php endif; ?>
    
    </div>
  </div>
  <?php
  }

/*---------------------------------------
---------Format comment Callback-----------
-----------------------------------------*/

function signature_format_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="panel clearfix cmntparent <?php
                        $authID = get_the_author_meta('ID');
                                                    
                        if($authID == $comment->user_id)
                           echo esc_attr("cmntbyauthor");
                       else
                           echo "";
                        ?>">
      <div class="comment">


                    <div class="avatarbox">
                      <?php 
                                $defimg = get_stylesheet_directory_uri(). "/assets/img/human.png";
                                if(get_avatar($comment)):
                                  echo get_avatar($comment,$size='75');
                                else:
                                ?>
                                <img src="<?php echo esc_url($defimg); ?>"  alt="avatar" />
                      <?php endif; ?>
                    </div>
                    <div class="cmntbox dark">
                      <?php printf('<h4 class="">%s</h4>', get_comment_author_link()) ?>
                      <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                      
                      <?php edit_comment_link(esc_html__('Edit','signature'),'<span class="edit-comment">', '</span>'); ?>
                                
                                <?php if ($comment->comment_approved == '0') : ?>
                            <div class="alert-box success">
                                <?php _e('Your comment is awaiting moderation.','signature') ?>
                              </div>
                      <?php endif; ?>
                                
                                <div class="comment-content-wrap"><?php comment_text() ?></div>
                                
                                <!-- removing reply link on each comment since we're not nesting them -->
                      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>


      </div>
    </article>

<?php
}





/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'signature_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function signature_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Redux Framework', // The plugin name.
            'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

        ),
        array(
            'name'               => 'CMB 2', // The plugin name.
            'slug'               => 'cmb2', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

        ),
        array(
            'name'               => 'Demo Importer', // The plugin name.
            'slug'               => 'nova_importer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/nova_importer.zip', // The plugin source.
            'version'            => '1.1',
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Signature Shop Header', // The plugin name.
            'slug'               => 'signature_shop_header', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/signature_shop_header.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Intuitive Custom Post Order', // The plugin name.
            'slug'               => 'intuitive-custom-post-order', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

        ),
        array(
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/js_composer.zip', // The plugin source.
            'version'            => '4.11.2.1',
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Signature Shortcodes', // The plugin name.
            'slug'               => 'signature_shortcodes', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/signature_shortcodes.zip', // The plugin source.
            'version'            => '1.1', 
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Signature post Types', // The plugin name.
            'slug'               => 'signature_post_types', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/signature_post_types.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Ultimate Media Background', // The plugin name.
            'slug'               => 'umbg', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/lib/umbg.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'WooCommerce', // The plugin name.
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'               => 'WP Retina 2x', // The plugin name.
            'slug'               => 'wp-retina-2x', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

        ),
        
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => ''                      // Message to output right before the plugins table.
        
    );

    tgmpa( $plugins, $config );

}