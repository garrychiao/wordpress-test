<?php
get_header();
$signature_options = signature_get_options('signature_wp');
?>

<section id="blog-list-page" <?php post_class('signature-single-post inner-page second-page add-top-half'); ?> >
  <div class="container">

<?php

      $blog_post_list = '';
      
      if ( have_posts() ) while ( have_posts() ) : the_post();

        $post_icon = '';

        if(is_sticky())
          $post_icon = '<i class="post-icon ion-pin"></i>';
        

        $featured_image = '';
        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
           $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
           $featured_image_src = $thumb_img_src[0];
           $featured_image = '<img alt="'.get_the_title().'" title="'.get_the_title().'" class="img-responsive" src="'.esc_url($featured_image_src).'"/>';
        }

        
        if($signature_options['disable-sidebar'] != 1)
        {
        echo '<section class="row">
                <div class="col-md-8  blog-list-wrap blog-content-wrap journal signature-gozzo">';
                echo '<div class="news-list-item signature-gozzo">
                        <h2 class="news-date  font3thin">'. get_the_time('d M Y') .'<span class="font3">'.esc_html__('by', 'signature').' '.get_the_author().'</span> '.wp_kses($post_icon, array( 'i' => array( 'class' => array() ))).'</h2>
                        <h4 class="news-heading dark font2">'.get_the_title().'</h4>
                        '.$featured_image.'
                        <div class="dark">';
                        the_content();
                        echo '</div>
                        <div class="signature-post-categorires">'.esc_html__('Categories', 'signature').': ';
                        the_category(' / ');
                        echo '</div>
                        <div class="signature-post-tags">'.esc_html__('Tags', 'signature').': ';
                        the_tags(' ', ' ', ''); 
                        echo'</div>
                    </div>';
        echo '</div>
                <div class="col-md-4">';
                get_sidebar();
          echo '</div>
              </section>';
        }
        else
        {
          echo '<section class="row">
                  <div class="col-md-12  blog-list-wrap blog-content-wrap">';
                echo '<div class="news-list-item signature-gozzo">
                        <h2 class="news-date  font3thin">'. get_the_time('d M Y') .'<span class="font3">'.esc_html__('by', 'signature').' '.get_the_author().'</span> '.wp_kses($post_icon, array( 'i' => array( 'class' => array() ))).'</h2>
                        <h4 class="news-heading dark font2">'.get_the_title().'</h4>
                        '.$featured_image.'
                        <div class="dark">';
                        the_content();
                        echo '</div>
                        <div class="signature-post-categorires">'.esc_html__('Categories', 'signature').': ';
                        the_category(' / ');
                        echo '</div>
                        <div class="signature-post-tags">'.esc_html__('Tags', 'signature').': ';
                        the_tags(' ', ' ', ''); 
                        echo'</div>
                    </div>';
            echo '</div>
                </section>';
        }
        

      endwhile;

      

      if(comments_open())
      {
    ?>
        <!-- inner-section : starts -->
        <section class="inner-section text-left signature-comments-wrap pad-top-half pad-bottom-half silver-bg">
          <div class="dark">
            <?php comments_template( '', true ); ?>
          </div>
        </section>
      <?php
      }
      ?>

      <div class="page-nav pad-top-half pad-bottom-half dark-bg">
        <div class="signature-single-post-pagination text-center">
          <?php previous_post_link('%link',esc_html__('Previous Post', 'signature')); ?>
          <?php next_post_link('%link',esc_html__('Next Post', 'signature')); ?>
          <div class="float-clear"></div>
        </div>
      
      </div>

      <div class="hidden"><?php the_post_thumbnail(); ?></div>


  </div>
</section>

<?php
get_footer();

?>
