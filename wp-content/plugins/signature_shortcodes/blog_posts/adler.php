<?php


function adler_blog($item_no, $pagination_opt, $customclass)
{
	$adler_blog_markup = '<section class="journal signature-adler container-fluid '.esc_attr($customclass).'">
							<div class="row">';

	$adler_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $i = 0;
						        $bg_class = 'white-bg';
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						        $i++;
						        if ($i % 2 == 0)
						        	$bg_class = ($bg_class == 'white-bg') ? 'silver-bg' : 'white-bg';
						        

						        $adler_blog_list .= '<article class="col-md-6 no-pad text-left news-block signature-adler">
								                      <a href="'. esc_url(get_the_permalink()) .'">
								                        <div class="news-head '. esc_attr($bg_class) .'">
								                            <h2 class="font3bold dark">'. get_the_time('d M').'</h2>
								                            <div class="liner-small color-bg"></div>
								                            <h3 class="font3 dark">'.get_the_title().'</h3>
								                        </div>
								                      </a>
								                    </article>';



						    	endwhile;
	
	$adler_blog_markup .= $adler_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$adler_blog_markup .= '<div class="row adler-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$adler_blog_markup .= '</section>';

	wp_reset_postdata();


	return $adler_blog_markup;
}


?>