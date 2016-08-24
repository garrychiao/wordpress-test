<?php
function igor_in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && igor_in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

 function igor_portfolio($group, $layout, $col_layout, $filter_display_status, $custom_class){

  wp_enqueue_script('imagesloaded');
  wp_enqueue_script('packery');
  wp_enqueue_script('packery-parallax-init');


  $filter_markup = '';
  $filter_list = '';

  $portfolio_loop = new WP_Query( array( 'post_type' => 'signature-portfolio',  'paged'=> false, 'posts_per_page' => '-1','tax_query' => array(
        array(
            'taxonomy' => 'signature-portfolio-group',
            'field' => 'slug',
            'terms' => array( $group )
        ),
    ), ) );
  
  if($filter_display_status == 'yes')
  {
    $filter_items = array();

    $portfolio_categories = get_categories(array('type' => 'signature-portfolio', 'taxonomy' => 'signature-portfolio-filter'));
    

    foreach($portfolio_categories as $category): 
      $categoryClass = $category->slug;   
      while ( $portfolio_loop->have_posts() ) 
          { 
            
            $portfolio_loop->the_post();

            $item_categories = wp_get_post_terms(get_the_ID(), $taxonomy = 'signature-portfolio-filter');
            
            foreach ($item_categories as $index => $project_cat) {
              
              if($categoryClass == $project_cat->slug && !igor_in_array_r($categoryClass, $filter_items))
              {
                array_push($filter_items, array(
                "slug" => $categoryClass, 
                "name" => $category->name
            ));
              }
            }
        }

    endforeach;

    
    $filter_list .= '<li><a href="#" data-filter="*" class="filter-active white active"><span>'.__('All','signaturelang').'</span></a></li>';
    foreach ($filter_items as $index => $filter_item) 
    {
      $filter_list .= '<li><a href="#" class="white" data-filter=".'.esc_attr($filter_item['slug']).'" ><span>'.esc_html($filter_item['name']).'</span></a></li>';
    }

    $filter_markup = '<section id="works-filter-panel" class="works-filter-panel signature-igor dark-bg">
                        <div class="valign">
                          <div class="works-filter-wrap">
                              <ul class="works-filter signature-igor text-center clearfix font3">'.$filter_list.'</ul>
                          </div>
                        </div>
                      </section>';
  }

  $portfolio_items = '';

  $stellar_ratio = array('2', '1.5');
  $stellar_ratio_id = -1;

  while ( $portfolio_loop->have_posts() ) 
    { 
      
      $portfolio_loop->the_post();
      
      $stellar_ratio_id++;
      if($stellar_ratio_id > 1)
        $stellar_ratio_id = 0;

      $item_categories = wp_get_post_terms(get_the_ID(), $taxonomy = 'signature-portfolio-filter');
        $project_categories = '';
        foreach ($item_categories as $project_cat) {
          $project_categories .= strtolower($project_cat->slug).' ';
        }

      $project_title = get_the_title();
        $project_caption = get_post_meta( get_the_ID(),'_signature_project_caption',true);
        $project_thumb = get_post_meta( get_the_ID(),'_signature_portfolio_thumb',true);
        $project_type = get_post_meta( get_the_ID(),'_signature_portfolio_type',true);

        
        $layout_class = '';

        
        

        if($project_type == 'lightbox_single_image')
        {
          $zoom_image = get_post_meta( get_the_ID(),'_signature_portfolio_lightbox_image',true);
          
          if($zoom_image == '')
            $zoom_image = $project_thumb;

          $mouse_icon_class = 'zoom';

          $portfolio_items .='<div data-stellar-ratio="'.esc_attr($stellar_ratio[$stellar_ratio_id]).'" class="works-item signature-igor BackgroundRS '.esc_attr($layout_class).' '.esc_attr($mouse_icon_class).' '.esc_attr($project_categories).'">
                                <img data-no-retina alt="'.esc_attr($project_title).'" title="'.esc_attr($project_title).'" class="img-responsive" src="'.esc_url($project_thumb).'"/>
                                <a  class="venobox" href="'.esc_url($zoom_image).'">
                                    <div class="works-item-inner valign">
                                      <h3 class="dark">'.esc_attr($project_title).'</h3>
                                      <p class="dark"><span class="dark">'.esc_attr($project_caption).'</span></p>
                                    </div>
                                </a>
                              </div>';

        }
        elseif($project_type == 'lightbox_image_gallery')
        {
          $mouse_icon_class = 'zoom';
            $gallery_images = get_post_meta( get_the_ID(),'_signature_portfolio_lightbox_gallery_images',true);
            $image_count = 0;
            $lightbox_image_list = '';
            $rand_id = rand(1000, 9999);
            $gallery_name = 'data-gall="portfolio-gallery-'.esc_attr($rand_id).'"';

            foreach($gallery_images as $gallery_image)
            {
              if($image_count == 0)
              {
                $image_count = 1;
                $zoom_image = $gallery_image;
              }
              else
              {
                $lightbox_image_list .= '<a href="'.esc_url($gallery_image) .'" '.$gallery_name.' class="hidden venobox"></a>';
              }
            }

            if($image_count == 0)
              $zoom_image = $project_thumb;


            $portfolio_items .= '<div data-stellar-ratio="'.esc_attr($stellar_ratio[$stellar_ratio_id]).'" class="works-item signature-igor BackgroundRS '.esc_attr($layout_class).' '.esc_attr($mouse_icon_class).' '.esc_attr($project_categories).'">
                                  <img data-no-retina alt="'.esc_attr($project_title).'" title="'.esc_attr($project_title).'" class="img-responsive" src="'.esc_url($project_thumb).'"/>
                                  <a  class="venobox"  href="'.esc_url($zoom_image).'"  '.$gallery_name.'>
                                      <div class="works-item-inner valign">
                                        <h3 class="dark">'.esc_attr($project_title).'</h3>
                                        <p class="dark"><span class="dark">'.esc_attr($project_caption).'</span></p>
                                      </div>
                                  </a>
                                  '.$lightbox_image_list.'
                                </div>';
        }
        elseif($project_type == 'lightbox_yt_video')
        {
          $mouse_icon_class = 'zoom';
          $video_link = get_post_meta( get_the_ID(),'_signature_lightbox_yt_video',true);
          $portfolio_items .= '<div data-stellar-ratio="'.esc_attr($stellar_ratio[$stellar_ratio_id]).'" class="works-item signature-igor BackgroundRS '.esc_attr($layout_class).' '.esc_attr($mouse_icon_class).' '.esc_attr($project_categories).'">
                                <img data-no-retina alt="'.esc_attr($project_title).'" title="'.esc_attr($project_title).'" class="img-responsive" src="'.esc_url($project_thumb).'"/>
                                <a  class="venobox" data-type="youtube" href="'.esc_url($video_link).'">
                                    <div class="works-item-inner valign">
                                      <h3 class="dark">'.esc_attr($project_title).'</h3>
                                      <p class="dark"><span class="dark">'.esc_attr($project_caption).'</span></p>
                                    </div>
                                </a>
                              </div>';

        }
        elseif($project_type == 'lightbox_vimeo_video')
        {
          $mouse_icon_class = 'zoom';
          $video_link = get_post_meta( get_the_ID(),'_signature_lightbox_vimeo_video',true);
          $portfolio_items .= '<div data-stellar-ratio="'.esc_attr($stellar_ratio[$stellar_ratio_id]).'" class="works-item signature-igor BackgroundRS '.esc_attr($layout_class).' '.esc_attr($mouse_icon_class).' '.esc_attr($project_categories).'">
                                <img data-no-retina alt="'.esc_attr($project_title).'" title="'.esc_attr($project_title).'" class="img-responsive" src="'.esc_url($project_thumb).'"/>
                                <a  class="venobox" data-type="vimeo" href="'.esc_url($video_link).'">
                                    <div class="works-item-inner valign">
                                      <h3 class="dark">'.esc_attr($project_title).'</h3>
                                      <p class="dark"><span class="dark">'.esc_attr($project_caption).'</span></p>
                                    </div>
                                </a>
                              </div>';

        }
        elseif($project_type == 'external_link')
        {
          $mouse_icon_class = 'info';
          $project_url = get_post_meta( get_the_ID(),'_signature_project_link',true);
          $project_url_new_tab = get_post_meta( get_the_ID(),'_signature_project_link_new_tab',true);
          if($project_url_new_tab == 'on')
            $target = 'target="_blank"';
          else
            $target = '';

          $portfolio_items .= '<div data-stellar-ratio="'.esc_attr($stellar_ratio[$stellar_ratio_id]).'" class="works-item signature-igor BackgroundRS '.esc_attr($layout_class).' '.esc_attr($mouse_icon_class).' '.esc_attr($project_categories).'">
                                <img data-no-retina alt="'.esc_attr($project_title).'" title="'.esc_attr($project_title).'" class="img-responsive" src="'.esc_url($project_thumb).'"/>
                                <a  href="'.esc_url($project_url).'" '.$target.'>
                                    <div class="works-item-inner valign">
                                      <h3 class="dark">'.esc_attr($project_title).'</h3>
                                      <p class="dark"><span class="dark">'.esc_attr($project_caption).'</span></p>
                                    </div>
                                </a>
                              </div>';

        }
    }

  $portfolio_markup = '';

  $portfolio_markup .= $filter_markup;
  $portfolio_markup .= '<div id="parallax-random-grid" class="parallax-random-grid signature-igor portfolio-02">
                          <div id="parallax-random-grid-container" class="parallax-grid-container">
                            <div class="gutter-sizer"></div>
                            '.$portfolio_items.'
                          </div>
                        </div>';

  return $portfolio_markup;
 }
?>