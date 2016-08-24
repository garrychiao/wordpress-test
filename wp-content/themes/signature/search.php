<?php
get_header();
$signature_options = signature_get_options('signature_wp');
?>

<section id="blog-list-page" class="signature-single-post inner-page second-page add-top-half">
  <div class="container">

<?php

      $blog_post_list = '';
      
      if ( have_posts() ) 
      {
        while ( have_posts() ) : the_post();

        $post_icon = '';

        if(is_sticky())
          $post_icon = '<i class="post-icon ion-pin"></i>';
        

        $featured_image = '';
        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
           $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
           $featured_image_src = $thumb_img_src[0];
           $featured_image = '<img alt="'.get_the_title().'" title="'.get_the_title().'" class="img-responsive" src="'.esc_url($featured_image_src).'"/>';
        }

        $blog_post_list .= '<div class="news-list-item signature-gozzo">
                        <h2 class="news-date  font3thin">'. get_the_time('d M Y') .'<span class="font3">'.esc_html__('by', 'signature').' '.get_the_author().'</span> '.wp_kses($post_icon, array( 'i' => array( 'class' => array() ))).'</h2>
                        <h4 class="news-heading dark font2">'.get_the_title().'</h4>
                        '.$featured_image.'
                        <p class="dark">'.signature_clean(get_the_content(), 200).'</p>
                        <a class="btn btn-signature btn-signature-gozzo btn-signature-dark" href="'. esc_url(get_the_permalink()) .'">'.esc_html__('Read Full', 'signature').'</a>
                    </div>';

        

      endwhile;
    

      if($signature_options['disable-sidebar'] != 1)
      {
      echo '<section class="row">
              <div class="col-md-8  blog-list-wrap journal signature-gozzo">'.$blog_post_list.'</div>
              <div class="col-md-4">';
              get_sidebar();
        echo '</div>
            </section>';
      }
      else
      {
        echo '<section class="row">
                <div class="col-md-12  blog-list-wrap">'.$blog_post_list.'</div>
              </section>';
      }
      
      signature_getpagenavi();
    }
    else{
      echo'<div class="row">
              <article class="col-md-8 col-md-offset-2 text-center">
                <div class="halfheight">
                  <div class="valign">
                    <h3 class="dark font3bold search-result-error"><span>'. esc_html__("Sorry, but you are looking for something that isn't here.", "signature") .'</span></h3>
                  </div>
                </div>
              </article>
          </div>';
    }

    


?>
  </div>
</section>

<?php
get_footer();

?>
