<?php


function theo_blog($item_no, $pagination_opt, $customclass)
{
	$theo_blog_markup = '<section class="news-list-wrap signature-theo row '.esc_attr($customclass).'">';

	$theo_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $bg_class = 'off-silver-bg';
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	
							    if($bg_class == 'white-bg')
							    	$bg_class = 'off-silver-bg';
							    else
							    	$bg_class = 'white-bg';

						        $theo_blog_list .= '<section class="news-list signature-theo '.esc_attr($bg_class).'">  
														<a href="'. esc_url(get_the_permalink()) .'">
														  <div class="container">
														    <div class="row">
														            <div class="col-md-8 col-md-offset-2 text-center">
														                <div class="news-date">
														                    <h1 class="color-bg white font3">'. get_the_time('d M') .'</h1>
														                </div>
														                <h3 class="font2 black">'.get_the_title().'</h3>
														                <p class="font3light">'.signature_clean(get_the_content(), 200).'</p>
														            </div>
														    </div>
														  </div>
														</a>
													</section>';



						    	endwhile;
	
	$theo_blog_markup .= $theo_blog_list;

	if($pagination_opt == 'yes')
	{
		$theo_blog_markup .= '<div class="row theo-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$theo_blog_markup .= '</section>';

	wp_reset_postdata();


	return $theo_blog_markup;
}


?>