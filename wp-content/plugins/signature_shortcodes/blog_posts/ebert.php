<?php


function ebert_blog($item_no, $pagination_opt, $customclass)
{
	$ebert_blog_markup = '<section class="journal signature-ebert container-fluid '.esc_attr($customclass).'">
							<div class="row">';

	$ebert_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $bg_class = 'white-bg';
						        $i = 0;
						        while ($loop->have_posts()) : $loop->the_post(); 
						        $i++;
						        if ($i % 2 == 0)
						        	$bg_class = ($bg_class == 'white-bg') ? 'silver-bg' : 'white-bg';
						    	$featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							    }

						        $ebert_blog_list .= '<article class="col-md-6 text-center no-pad">
									                  <section class="news-block signature-ebert '. esc_attr($bg_class) .' img-bg pad-top pad-bottom" data-hover-img="'.esc_url($featured_image_src).'">
									                      <a class="valign" href="'. esc_url(get_the_permalink()) .'">
									                          <h3 class="font2 black">'. get_the_time('d F') .'</h3>
									                          <div class="liner-large color-bg"></div>
									                          <h1 class="main-heading font2 dark">'.get_the_title().'</h1>
									                      </a>
									                  </section>
										            </article>';



						    	endwhile;
	
	$ebert_blog_markup .= $ebert_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$ebert_blog_markup .= '<div class="row ebert-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$ebert_blog_markup .= '</section>';

	wp_reset_postdata();


	return $ebert_blog_markup;
}


?>