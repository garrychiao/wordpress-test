<?php
$signature_options = signature_get_options('signature_wp');
?>


<footer class="mastfoot signature-zircon" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container-fluid mastfoot-inner">
    <div class="row">
      <article class="col-md-3 text-left">
        <a href="<?php echo esc_url(home_url( '/' )); ?>">
          <img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="foot-logo img-responsive" src="<?php echo esc_url($signature_options['signature-footer-logo']['url']); ?>"/>
        </a>
        <p class="add-top-quarter add-bottom-quarter grey">
          <?php 
            echo wp_kses($signature_options['zircon-footer-text'], array(
                        'a' => array(
                            'href' => array(),
                            'title' => array(),
                            'target' => array()
                        ),
                        'br' => array(),
                        'img' => array(
                            'src' => array(),
                            'title' => array()
                          ),

                        ));
          ?>
        </p>
        <ul class="social">
          <?php
            if(isset($signature_options['signature-social-media-icons']) && !empty($signature_options['signature-social-media-icons']))
            {
              $social_icons = $signature_options['signature-social-media-icons'];

              foreach ($social_icons as $social_icon) {
                $title = $social_icon['title'];
                $icon_url = $social_icon['url'];
                $icon = $social_icon['image'];

                echo '<li><a href="'.esc_url($icon_url).'"><img data-no-retina alt="'.esc_attr($title).'" title="'.esc_attr($title).'" src="'.esc_url($icon).'"/></a></li>';
              }
            }
          ?>
        </ul>
        <p class="font3">
          <?php 
            echo wp_kses($signature_options['signature-footer-copy'], array(
                        'a' => array(
                            'href' => array(),
                            'title' => array(),
                            'target' => array()
                        ),
                        'br' => array(),
                        'img' => array(
                            'src' => array(),
                            'title' => array()
                          ),

                        ));
          ?>
        </p>
      </article>
      <article class="col-md-3 text-left">
        <h6 class="font3bold dark"><?php signature_zircon_foot_nav1_title(); ?></h6>
        <ul class="footer-sub-links font3"><?php signature_zircon_foot_nav1(); ?></ul>
      </article>
      <article class="col-md-3 text-left">
        <h6 class="font3bold dark"><?php signature_zircon_foot_nav2_title(); ?></h6>
        <ul class="footer-sub-links font3"><?php signature_zircon_foot_nav2(); ?></ul>
      </article>
      <article class="col-md-3 text-left">
        <h6 class="font3bold dark">
          <?php 
            echo esc_html($signature_options['zircon-flickr-gal-name']);
          ?>
        </h6>
        <div id="flickrPull" class="flickr-grid">
          <!-- flickr feed here -->
        </div>
      </article>
    </div>
  </div>

</footer>


<?php
    wp_enqueue_script('flickr-tiles');
    wp_enqueue_script('flickr-tiles-init');

    wp_localize_script('flickr-tiles-init', 'user_id', $signature_options['zircon-flickr-user-id']);




function signature_zircon_foot_nav1_title(){
  $locations = get_nav_menu_locations();
  $is_home = signature_is_home_page();

  
  if(!isset($locations['footer_nav_1']))
  {
    $return = '';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['footer_nav_1']);

    $return = '';

    if(empty($menu))
    {
      $return = '';
    }
    else
    {
      $return = $menu->name; 
    }
  }
  echo $return;
}
    

function signature_zircon_foot_nav1(){
  $locations = get_nav_menu_locations();
  $is_home = signature_is_home_page();

  if ($is_home == false)
  {
    $nav_class = " ";
    $root_url = site_url().'/';
    $scroll_class = '';
  }
  else
  {
    $nav_class = " front-page";
    $root_url = '';
    $scroll_class = 'scroll';
  }

  if(!isset($locations['footer_nav_1']))
  {
    $return = '';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['footer_nav_1']);

    $return = '';

    if(empty($menu))
    {
      $return = '';
    }

    else
    {
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      _wp_menu_item_classes_by_context( $menu_items );

     

      $menunu = array();
      foreach((array)$menu_items as $key => $menu_item )
      {
        $menunu[ (int) $menu_item->db_id ] = $menu_item;
      }
      unset($menu_items);

      $menu_count = 0;

      foreach ( $menunu as $i => $men ){
        if($men->menu_item_parent == '0')
        {
            //Specific additions
            $menu_count ++;
            $has_sub_menu = 0;
            $parent_class = '';
            $parent_link_class = '';
            

            
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
              $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class=" '.esc_attr($identifyClass.$parent_link_class).'">'. esc_html($men->title) .'</a>';
              $return .= '</li>' . "\n";  
            
        }
      }

      unset($menunu);

      
    }
  }
  echo $return;
}


function signature_zircon_foot_nav2_title(){
  $locations = get_nav_menu_locations();
  $is_home = signature_is_home_page();

  
  if(!isset($locations['footer_nav_2']))
  {
    $return = '';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['footer_nav_2']);

    $return = '';

    if(empty($menu))
    {
      $return = '';
    }
    else
    {
      $return = $menu->name; 
    }
  }
  echo $return;
}

function signature_zircon_foot_nav2(){
  $locations = get_nav_menu_locations();
  $is_home = signature_is_home_page();

  if ($is_home == false)
  {
    $nav_class = " ";
    $root_url = site_url().'/';
    $scroll_class = '';
  }
  else
  {
    $nav_class = " front-page";
    $root_url = '';
    $scroll_class = 'scroll';
  }

  if(!isset($locations['footer_nav_2']))
  {
    $return = '';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['footer_nav_2']);

    $return = '';

    if(empty($menu))
    {
      $return = '';
    }

    else
    {
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      _wp_menu_item_classes_by_context( $menu_items );

     

      $menunu = array();
      foreach((array)$menu_items as $key => $menu_item )
      {
        $menunu[ (int) $menu_item->db_id ] = $menu_item;
      }
      unset($menu_items);

      $menu_count = 0;

      foreach ( $menunu as $i => $men ){
        if($men->menu_item_parent == '0')
        {
            //Specific additions
            $menu_count ++;
            $has_sub_menu = 0;
            $parent_class = '';
            $parent_link_class = '';
            

            
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
              $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class=" '.esc_attr($identifyClass.$parent_link_class).'">'. esc_html($men->title) .'</a>';
              $return .= '</li>' . "\n";  
            
        }
      }

      unset($menunu);

      
    }
  }
  echo $return;
}



?>


