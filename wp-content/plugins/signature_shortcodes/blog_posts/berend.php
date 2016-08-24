<?php


function berend_blog($item_no, $pagination_opt, $customclass)
{
	$berend_blog_markup = '<section class="journal signature-berend '.esc_attr($customclass).'">';

	$berend_blog_list = '';						    
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
    
    while ($loop->have_posts()) : $loop->the_post(); 
    
    $featured_image_src = '';
    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
       $featured_image_src = $thumb_img_src[0];
    }

    $berend_blog_list .= '<section class="news-block signature-berend img-bg pad-top pad-bottom" data-hover-image="'.esc_url($featured_image_src).'">
          
					          <div class="container">
					            <div class="row">
					              <article class="col-md-8 col-md-offset-2 text-center">
					                <a href="'. esc_url(get_the_permalink()) .'">
					                    <h3 class="font2 black">'. get_the_time('d M').'</h3>
					                    <div class="signature-liner liner-large color-bg"></div>
					                    <h1 class="main-heading font2 dark">'.get_the_title().'</h1>
					                </a>
					              </article>
					            </div>
					          </div>

					      </section>';



	endwhile;
	
	$berend_blog_markup .= $berend_blog_list;

	if($pagination_opt == 'yes')
	{
		$berend_blog_markup .= '<section class="ash-bg">
									<div class="container">
										<div class="row berend-blog-list-pagination pad-top-half pad-bottom-half text-center">
								            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
								            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
							            </div>
							        </div>
						        </section>';
	}

	$berend_blog_markup .= '</section>';

	wp_reset_postdata();


	return $berend_blog_markup;
}


?>