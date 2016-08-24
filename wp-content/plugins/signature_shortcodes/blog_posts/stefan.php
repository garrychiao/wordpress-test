<?php


function stefan_blog($item_no, $pagination_opt, $customclass)
{
	$stefan_blog_markup = '<section class="journal signature-stefan container-fluid '.esc_attr($customclass).'">
							<div class="row signature-stefan news-list">';

	$stefan_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $i = 0;
						        $bg_class = 'white-bg';
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						        $i++;
						        if ($i % 2 == 0)
						        	$bg_class = ($bg_class == 'white-bg') ? 'light-brown-bg' : 'white-bg';


						        $featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							       
							    }
						        
 
						        $stefan_blog_list .= '<article class="col-md-6 no-pad text-left news-block '. esc_attr($bg_class) .'" data-bg-image="'.esc_url($featured_image_src).'">
								                        <div class="news-head">
								                            <h2 class="font3light dark">'. get_the_time('d M').'</h2>
								                            <div class="liner-medium color-bg"></div>
								                            <h3 class="font3 dark">'.get_the_title().'</h3>
								                              <div class="news-button">
								                                <a href="'. esc_url(get_the_permalink()) .'" class="btn btn-signature btn-signature-stefan btn-signature-color">'.esc_html__('Read article', 'signaturelang').'</a>
								                              </div>
								                        </div>
								                      </article>';



						    	endwhile;
	
	$stefan_blog_markup .= $stefan_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$stefan_blog_markup .= '<div class="row stefan-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$stefan_blog_markup .= '</section>';

	wp_reset_postdata();


	return $stefan_blog_markup;
}


?>