<?php


function quartz_blog($item_no, $pagination_opt, $customclass)
{
	$quartz_blog_markup = '<section class="journal signature-quartz container-fluid '.esc_attr($customclass).'">
							<div class="row signature-quartz news-list">';

	$quartz_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $i = 0;
						        $bg_class = 'white-bg';
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						        $i++;
						        if ($i % 2 == 0)
						        	$bg_class = ($bg_class == 'white-bg') ? 'offwhite-bg' : 'white-bg';
						        

						        $quartz_blog_list .= '<article class="col-md-6 '. esc_attr($bg_class) .' common-pad text-left news-list-item">
												    	<a href="'. esc_url(get_the_permalink()) .'">
													        <h4 class="dark font2">'.get_the_title().'</h4>
													        <div class="liner-small-medium color-bg"></div>
													        <p>'.signature_clean(get_the_content(), 200).'</p>
													        <h6 class="font4 dark"><span class="font4 color">'. get_the_time('d').'</span> '. get_the_time('F, Y').'</h6>
												        </a>
												    </article>';



						    	endwhile;
	
	$quartz_blog_markup .= $quartz_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$quartz_blog_markup .= '<div class="row quartz-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$quartz_blog_markup .= '</section>';

	wp_reset_postdata();


	return $quartz_blog_markup;
}


?>