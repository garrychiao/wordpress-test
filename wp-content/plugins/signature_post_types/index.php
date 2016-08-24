<?php
/*
Plugin Name: Signature Post Types
Plugin URI: http://www.designova.net
Description: Plugin to be used with the premium WordPress theme Signature
Author: Designova
Author URI: http://www.designova.net
Version: 1.0
*/

add_action( 'init', 'signature_portfolio_type' );

function signature_portfolio_type() 
{
	/*---Portfolio custom post ----*/
	register_post_type( 'signature-portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio' ,'sevenlang'),
				'singular_name' => __( 'Project' ,'sevenlang'),
				'add_new' => __( 'Add New Project' ,'sevenlang'),
				'add_new_item' => __( 'Add New Project' ,'sevenlang'),
				'edit' => __( 'Edit Project','sevenlang' ),
				'edit_item' => __( 'Edit Project','sevenlang' ),
			),
			'description' => __( 'Projects','sevenlang' ),
			'public' => true,
			'exclude_from_search' => true,
			'supports' => array( 'title'),
			'rewrite' => array( 'slug' => 'view-project', 'with_front' => true ),
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 200,
			'menu_icon' => 'dashicons-screenoptions',
		)
	);


	$portfolio_filter_labels = array(
		'name'              => __( 'Filters', 'taxonomy general name' ),
		'singular_name'     => __( 'Filter', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Filters' ),
		'all_items'         => __( 'All Filters' ),
		'parent_item'       => __( 'Parent Filter' ),
		'parent_item_colon' => __( 'Parent Filter:' ),
		'edit_item'         => __( 'Edit Filter' ),
		'update_item'       => __( 'Update Filter' ),
		'add_new_item'      => __( 'Add New Filter' ),
		'new_item_name'     => __( 'New Filter Name' ),
		'menu_name'         => __( 'Filter' ),
	);
	register_taxonomy( 'signature-portfolio-filter', array( 'signature-portfolio' ),
	array( 'hierarchical' => true, 'labels' => $portfolio_filter_labels,"singular_label" => __('Filter', 'signaturelang') ) );

	$portfolio_group_labels = array(
		'name'              => __( 'Groups', 'taxonomy general name' ),
		'singular_name'     => __( 'Group', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Groups' ),
		'all_items'         => __( 'All Groups' ),
		'parent_item'       => __( 'Parent Group' ),
		'parent_item_colon' => __( 'Parent Group:' ),
		'edit_item'         => __( 'Edit Group' ),
		'update_item'       => __( 'Update Group' ),
		'add_new_item'      => __( 'Add New Group' ),
		'new_item_name'     => __( 'New Group Name' ),
		'menu_name'         => __( 'Group' ),
	);
	register_taxonomy( 'signature-portfolio-group', array( 'signature-portfolio' ),
	array( 'hierarchical' => true, 'labels' => $portfolio_group_labels,"singular_label" => __('Group', 'signaturelang') ) );
	
}


add_filter('manage_edit-signature-portfolio_columns', 'add_portfolio_type', 10, 2);
$post_type = 'signature-portfolio';
function add_portfolio_type($posts_columns, $post_type = 'signature-portfolio')
{
    $posts_columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Project', 'signaturelang' ),
		'portfolio_thumb' => __( 'Project Thumbnail', 'signaturelang' ),
		'portfolio_type' => __( 'Project Type', 'signaturelang' ),
		'date' => __( 'Date', 'signaturelang' )
	);

    return $posts_columns;
}

add_action('manage_posts_custom_column', 'render_add_portfolio_type', 10, 2);
 
function render_add_portfolio_type($column_name, $id) {
    switch ($column_name) {
    case 'portfolio_type':
        // show widget set
        $project_type = get_post_meta( $id, '_signature_portfolio_type', TRUE);
        
          if($project_type == 'lightbox_single_image')
		    echo 'Lightbox Single Image';
		  elseif($project_type == 'lightbox_image_gallery')
		    echo 'Lightbox Image Gallery';
		  elseif($project_type == 'lightbox_yt_video')
		    echo 'Lightbox Youtube Video';
		  elseif($project_type == 'lightbox_vimeo_video')
		    echo 'Lightbox Vimeo Video';
		  elseif($project_type == 'external_link')
		    echo 'Link to External Page';             
        break;
	case 'portfolio_thumb':

    	
    	$project_thumb = wp_get_attachment_image_src( get_post_meta( $id, '_signature_portfolio_thumb_id', 1 ), 'thumbnail' );
    	echo '<img src="'.esc_url($project_thumb[0]).'" class="admin-project-thumbnail" alt="project-thumbnail"/>';
    	break;
    }
}



?>
