<?php


function orwin_blog($item_no, $pagination_opt, $customclass)
{
	$orwin_blog_markup = '<section class="news-list-wrap signature-orwin '.esc_attr($customclass).'">';

	$orwin_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $bg_class = 'light-silver-bg';
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	$featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							       
							    }

							    if($bg_class == 'light-silver-bg')
							    	$bg_class = 'white-bg';
							    else
							    	$bg_class = 'light-silver-bg';

						        $orwin_blog_list .= '<section class="news-list signature-orwin '.esc_attr($bg_class).'">  
														<a href="'. esc_url(get_the_permalink()) .'">
														  <div class="container">
														    <div class="row">
														            <div class="col-md-8 col-md-offset-2 text-center">
														                <h3 class="font1 black">'.get_the_title().'</h3>
														            <div class="liner-large-medium add-top-quarter color-bg"></div>
														                <p class="font3bold bold">'. get_the_time('F d, Y.') .'</p>
														            </div>
														    </div>
														  </div>
														</a>
													</section>';



						    	endwhile;
	
	$orwin_blog_markup .= $orwin_blog_list;

	if($pagination_opt == 'yes')
	{
		$orwin_blog_markup .= '<div class="row orwin-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$orwin_blog_markup .= '</section>';

	wp_reset_postdata();


	return $orwin_blog_markup;
}


?>