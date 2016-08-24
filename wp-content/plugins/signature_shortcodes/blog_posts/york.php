<?php


function york_blog($item_no, $pagination_opt, $customclass)
{
	$york_blog_markup = '<section class="news-list-wrap signature-leon row '.esc_attr($customclass).'">';

	$york_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        $bg_class = 'white-bg';
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	$featured_image_src = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							       
							    }

							    if($bg_class == 'light-brown-bg')
							    	$bg_class = 'white-bg';
							    else
							    	$bg_class = 'light-brown-bg';

						        $york_blog_list .= '<article class="col-md-4 no-pad text-left signature-leon news-block '.esc_attr($bg_class).'" data-bg-img="'.esc_url($featured_image_src).'">
								                        <div class="news-head">
								                            <h2 class="font3light dark">'. get_the_time('d M') .'</h2>
								                            <div class="liner-small color-bg"></div>
								                            <h3 class="font3 dark">'.get_the_title().'</h3>
								                              <div class="news-button">
								                                <a href="'. esc_url(get_the_permalink()) .'" class="btn btn-signature btn-signature-leon btn-signature-color">'.__('Read article','signaturelang').'</a>
								                              </div>
								                        </div>
								                    </article>';



						    	endwhile;
	
	$york_blog_markup .= $york_blog_list;

	if($pagination_opt == 'yes')
	{
		$york_blog_markup .= '<div class="row leon-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$york_blog_markup .= '</section>';

	wp_reset_postdata();


	return $york_blog_markup;
}


?>