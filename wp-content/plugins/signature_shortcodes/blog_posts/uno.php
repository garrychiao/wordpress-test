<?php


function uno_blog($item_no, $pagination_opt, $customclass)
{
	$uno_blog_markup = '<section class="journal signature-gozzo '.esc_attr($customclass).'">
							<div class="row">';

	$uno_blog_list = '';						    
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						        $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $item_no, 'paged' => $paged));
						        
						        while ($loop->have_posts()) : $loop->the_post(); 
						        
						    	$featured_image = '';
							    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
							       $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', true, '' );
							       $featured_image_src = $thumb_img_src[0];
							       $featured_image = '<img alt="'.get_the_title().'" title="'.get_the_title().'" class="img-responsive" src="'.esc_url($featured_image_src).'"/>';
							    }

						        $uno_blog_list .= '<div class="news-list-item signature-gozzo">
										                <h2 class="news-date  font3thin color">'. get_the_time('d M Y') .'<span class="font4 white">'.__('by', 'signaturelang').' '.get_the_author().'</span></h2>
										                <h4 class="news-heading white-border white font2">'.get_the_title().'</h4>
										                '.$featured_image.'
										                <p class="white">'.signature_clean(get_the_content(), 200).'</p>
										                <a class="btn btn-signature btn-signature-gozzo btn-signature-color" href="'. esc_url(get_the_permalink()) .'">'.__('Read Full', 'signaturelang').'</a>
										            </div>';



						    	endwhile;
	
	$uno_blog_markup .= $uno_blog_list.'</div>';

	if($pagination_opt == 'yes')
	{
		$uno_blog_markup .= '<div class="row gozzo-blog-list-pagination add-top-quarter">
					            <span class="prev-entries">'. get_next_posts_link( '&larr; Older Posts', $loop->max_num_pages ).'</span>           
					            <span class="next-entries">'. get_previous_posts_link( 'Newer Posts &rarr;', $loop->max_num_pages ).'</span>
					           </div>';
	}

	$uno_blog_markup .= '</section>';

	wp_reset_postdata();


	return $uno_blog_markup;
}


?>