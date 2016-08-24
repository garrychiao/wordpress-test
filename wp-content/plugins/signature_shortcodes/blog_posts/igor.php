<?php


function igor_blog($item_no, $pagination_opt, $customclass)
{
	$igor_blog_markup = '<section class="news-list-wrap signature-igor '.esc_attr($customclass).'">';

	$igor_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	$featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							       
							    }

						        $igor_blog_list .= '<section class="news-list signature-igor" style="background-image: url('.esc_url($featured_image_src).')">  
														<a href="'. esc_url(get_the_permalink()) .'">
														  <div class="container">
														    <div class="row">
													            <div class="col-md-8 col-md-offset-2 text-center">
													                <div class="news-date">
													                    <h1 class="black font4">'. get_the_time('d M') .'</h1>
													                </div>
													                <h3 class="font2 black">'.get_the_title().'</h3>
													                <p>'.signature_clean(get_the_content(), 200).'</p>
													            </div>
														    </div>
														  </div>
														</a>
													</section>';



						    	endwhile;
	
	$igor_blog_markup .= $igor_blog_list;

	if($pagination_opt == 'yes')
	{
		$igor_blog_markup .= '<div class="row igor-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$igor_blog_markup .= '</section>';

	wp_reset_postdata();


	return $igor_blog_markup;
}


?>