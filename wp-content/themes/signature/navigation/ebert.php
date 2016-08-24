<?php
  $signature_options = signature_get_options('signature_wp');
?>
<!-- Header -->
    <header class="masthead signature-ebert" style="background: <?php echo esc_attr($signature_options['ebert-nav-bg-color']);?>">
      <div class="masthead-inner container-fluid">
        <div class="row">
          <article class="col-md-6 text-left">
            <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="main-logo img-responsive" src="<?php echo esc_url($signature_options['ebert-nav-bar-logo']['url']); ?>"/></a>
          </article>
          <article class="col-md-6 text-right">
            <a class="menu-trigger" href="#"><span class="ion-navicon black"></span></a>
          </article>
        </div>
      </div>
    </header>

    <!-- end : masthead -->


    <!-- Main Navigation -->
    <nav class="mastnav signature-ebert fullheight">

        <div class="menu-close-notification">
            <a class="font2" href="#"><span class="ion-android-close black"></span></a>
        </div>
        <div class="mastnav-inner-left fullheight text-center" style="background: <?php echo esc_attr($signature_options['ebert-nav-bg-color']); ?>;">
          <div class="valign">
            <?php
              if($signature_options['navigation_opt'] == "0")
              {
                $nav_args = array(
                  'theme_location'  => 'primary',
                  'container'       => false,
                  'menu_class'      => 'main-menu signature-ebert default-wp-nav',
                  'echo'            => true,
                  'fallback_cb'     => 'wp_page_menu'
                );

                wp_nav_menu( $nav_args );
              }
              else
              {
                signature_ebert_nav();
              }
            ?>  
          </div>
        </div>

        <div class="mastnav-inner-right fullheight img-bg covered-bg" style="background: url(<?php echo esc_url($signature_options['ebert-nav-bg-image']['url']); ?>);">
          <div class="valign">
            
          


            <div class="menu-credits text-center">
              <p class="font1" style="color: <?php echo esc_attr($signature_options['ebert-nav-content-color']); ?>;">
                <?php 
                  echo wp_kses($signature_options['ebert-nav-content'], array(
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
            </div>

          </div>
          </div>
        </nav>

    <!-- end : mastnav -->
        <div class="first-fold"></div>
    <?php 

function signature_ebert_nav(){
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
    $return = '<h5 class="clearfix dark '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
  }
  else
  {
    $menu = wp_get_nav_menu_object($locations['primary']);

    $return = '';

    if(empty($menu))
    {
      $return = '<h5 class="clearfix dark '.esc_attr($nav_class).'">'.esc_html__('Please configure the navigation menu','signature').'</h5>';
    }

    else
    {
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      _wp_menu_item_classes_by_context( $menu_items );

      $return = '<ul class="main-menu signature-ebert '.esc_attr($nav_class).'">' . "\n";

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
            $return .= '<a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="main-link font3bold '.esc_attr($identifyClass.$parent_link_class).'">'. esc_html($men->title) .'</a>';



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
                  $return .= '<li><a href="'. esc_url($href) .'" '.esc_attr($link_target).' class="font2 '.esc_attr($identifyClass).'">'. esc_html($submenu->title) .'</a></li>';

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