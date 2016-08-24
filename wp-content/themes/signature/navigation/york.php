<?php
$signature_options = signature_get_options('signature_wp');
?>
    
    <header class="masthead signature-york white-bg">
      <div class="container"> 
        <div class="row">
          
            <article class="col-md-12 text-center">
              <a href="<?php echo esc_url(home_url( '/' )); ?>">
                <img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="main-logo img-responsive" src="<?php echo esc_url($signature_options['york-nav-logo']['url']); ?>"/>
              </a>
            </article>

        </div>
      </div>
    </header>
    <!-- end : masthead -->

    <nav class="corner-nav mastnav signature-york">
      <?php
        signature_york_nav();
      ?>
    </nav>

    

<?php 

function signature_york_nav(){
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

  if(!isset($locations['primary']))
  {
    $return = '<h6 class="clearfix font3light dark '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h6>';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['primary']);

    $return = '';

    if(empty($menu))
    {
      $return = '<h6 class="clearfix font3light dark '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h6>';
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
            $menu_pos_class = '';
            
            if($menu_count == 1)
              $menu_pos_class = 'fixed-border-nav-top-left';
            if($menu_count == 2)
              $menu_pos_class = 'fixed-border-nav-top-right';
            if($menu_count == 3)
              $menu_pos_class = 'fixed-border-nav-bottom-left';
            if($menu_count == 4)
              $menu_pos_class = 'fixed-border-nav-bottom-right';

            if($menu_count < 5)
            {
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

              $return .='<div class="fixed-border-nav '.esc_attr($menu_pos_class).'">';
              $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="font3light dark '.esc_attr($identifyClass.$parent_link_class).'">'. esc_html($men->title) .'</a>';
              $return .= '</div>' . "\n";  
            }
        }
      }

      unset($menunu);

      
    }
  }
  echo $return;
}

?>