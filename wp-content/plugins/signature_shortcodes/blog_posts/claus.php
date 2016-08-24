<?php


function claus_blog($item_no, $pagination_opt, $customclass)
{
	$claus_blog_markup = '<section class="journal signature-claus container-fluid '.esc_attr($customclass).'">
							<div class="row">';

	$claus_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $bg_class = 'white-bg';
						        $i = 0;
						        while ($loop->have_posts()) : $loop->the_post(); 
						        $i++;
						        if ($i % 2 == 0)
						        	$bg_class = ($bg_class == 'white-bg') ? 'silver-bg' : 'white-bg';
						    
						        $claus_blog_list .= '<article class="col-md-6 no-pad text-left news-block signature-claus">
								                      <a href="'. esc_url(get_the_permalink()) .'">
								                        <div class="news-head '. esc_attr($bg_class) .'">
								                            <h2 class="font3bold dark">'. get_the_time('d / m') .'</h2>
								                            <div class="liner-small color-bg"></div>
								                            <h3 class="font3 dark">'.get_the_title().'</h3>
								                        </div>
								                      </a>
								                    </article>';



						    	endwhile;
	
	$claus_blog_markup .= $claus_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$claus_blog_markup .= '<div class="row claus-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$claus_blog_markup .= '</section>';

	wp_reset_postdata();


	return $claus_blog_markup;
}


?>