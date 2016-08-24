<?php
$signature_options = signature_get_options('signature_wp');
?>
    
    <nav class="mastnav signature-hans dark-bg text-center clearfix">

      <?php
        if($signature_options['navigation_opt'] == "0")
        {
          $nav_args = array(
            'theme_location'  => 'primary',
            'container'       => false,
            'menu_class'      => 'main-menu signature-hans default-wp-nav',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu'
          );

          wp_nav_menu( $nav_args );
        }
        else
        {
          signature_hans_nav();
        }
      ?>
    </nav>

    <header class="masthead signature-hans" style="background: <?php echo esc_attr($signature_options['hans-nav-bg-color']);?>">
      <div class="container-fluid"> 
        <div class="row">
          
            <article class="col-md-6">
              <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="nav-logo img-responsive" src="<?php echo esc_url($signature_options['hans-nav-bar-logo']['url']); ?>"/></a>
            </article>
            <article class="col-md-6 notification-icon-wrap">
                  <div class="menu-notification">
                      <a class="font3bold" href="#"><span class="ion-android-menu black"></span></a>
                  </div>
                  <div class="menu-close-notification">
                      <a class="font3bold" href="#"><span class="ion-android-close black"></span></a>
                  </div>                  
                  
                  
            </article>

        </div>
      </div>
    </header>


    

    

<?php 

function signature_hans_nav(){
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
    $return = '<h5 class="clearfix white '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['primary']);

    $return = '';

    if(empty($menu))
    {
      $return = '<h5 class="clearfix white '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
    }

    else
    {
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      _wp_menu_item_classes_by_context( $menu_items );

      $return = '<ul class="main-menu signature-hans '.esc_attr($nav_class).'">' . "\n";

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
            $parent_class = '';
            $parent_link_class = '';
            foreach ( $menunu as $submenu )
            {
              if($submenu->menu_item_parent == $men->ID)
              {
                $has_sub_menu = 1;
                $parent_class = 'menu-item-has-children';
                $parent_link_class = ' sub-menu-trigger';
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

            $return .='<li class="'.esc_attr($parent_class).'">';
            $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="main-link font3bold white '.esc_attr($identifyClass.$parent_link_class).'">'. esc_html($men->title) .'</a>';



            if($has_sub_menu == 1)
            {
              $return .= '<ul class="sub-menu dark-bg">' . "\n";

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
                  $return .= '<li><a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="font3 white '.esc_attr($identifyClass).'">'. esc_html($submenu->title) .'</a></li>';

                }
              }
              $return .= '</ul>' . "\n";
            }
          $return .= '</li>' . "\n";
        }
      }

      unset($menunu);

      if (function_exists('icl_get_languages')) {
        $lang_list = icl_get_languages();

        $return .= '<li>';
        
        foreach ($lang_list as $lang) {
            if($lang['active'] == '1'):
            $return .= '<a href="'.esc_url($lang['url']).'">'.esc_html($lang['native_name']).' ('.esc_html($lang['translated_name']).')</a>';
            endif;
        }
        $return .= "<ul>";

        foreach ($lang_list as $lang) {
            if($lang['active'] == '0'):
            $return .= "<li>";
            $return .= '<a href="'.esc_url($lang['url']).'">'.esc_html($lang['native_name']).' ('.esc_html($lang['translated_name']).')</a>';
            $return .= "</li>";
            endif;
        }

        $return .= "</ul>";
        $return .= "</li>";
      }

      $return .= '</ul>' . "\n";
    }
  }
  echo $return;
}

?>