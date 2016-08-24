<?php


function zircon_blog($item_no, $pagination_opt, $customclass)
{
	$zircon_blog_markup = '<section class="journal signature-ebert container-fluid '.esc_attr($customclass).'">
							<div class="row">';

	$zircon_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	$featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							    }

						        $zircon_blog_list .= '<article class="col-md-6 text-center no-pad">
									                  <section class="news-block signature-ebert zircon-news-block img-bg" style="background-image:url('.esc_url($featured_image_src).');">
									                      <a class="valign" href="'. esc_url(get_the_permalink()) .'">
									                          <h3 class="font2 white">'. get_the_time('d F') .'</h3>
									                          <div class="liner-large color-bg"></div>
									                          <h1 class="main-heading font2 white">'.get_the_title().'</h1>
									                      </a>
									                  </section>
										            </article>';



						    	endwhile;
	
	$zircon_blog_markup .= $zircon_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$zircon_blog_markup .= '<div class="row ebert-blog-list-pagination silver-bg zircon-blog-pagination">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$zircon_blog_markup .= '</section>';

	wp_reset_postdata();


	return $zircon_blog_markup;
}


?>