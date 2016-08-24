<?php


function dierk_blog($item_no, $pagination_opt, $customclass)
{
	$dierk_blog_markup = '<section class="journal signature-dierk container-fluid no-pad '.esc_attr($customclass).'">
							<div class="row">';

	$dierk_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        	$featured_image_src = '';
								    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
								       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
								       $featured_image_src = $thumb_img_src[0];
								    }

							        $dierk_blog_list .= '<article class="col-md-4 no-pad text-center news-block signature-dierk">
									                      <a href="'. esc_url(get_the_permalink()) .'">
									                        <img alt="'.esc_attr(get_the_title()).'" title="'.esc_attr(get_the_title()).'" class="img-responsive" src="'.esc_url($featured_image_src).'"/>
									                        <div class="news-head silver-bg">
									                        	<div class="valign">
										                            <h2 class="font3bold dark">'. get_the_time('d M') .'</h2>
										                            <div class="liner-small color-bg"></div>
										                            <h3 class="font3 dark">'.get_the_title().'</h3>
									                            </div>
									                        </div>
									                      </a>
									                    </article>';

								endwhile;
	
	$dierk_blog_markup .= $dierk_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$dierk_blog_markup .= '<div class="row dierk-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$dierk_blog_markup .= '</section>';

	wp_reset_postdata();


	return $dierk_blog_markup;
}


?>