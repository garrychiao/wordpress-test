<?php

/**
 * UMBG functions.
 *
 * Used throughout UMBG code files.
 *
 * @package    UMBG
 * @subpackage Functions
 * @since      1.4.0
 *
 * Last Updated: 2015-12-04 - Created.
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

/**
 * Get the WC shortcode product ID from page.
 *
 * @return int Product ID
 */
function umbg_get_wc_shortcode_product_id() {

	global $post;
	$tags = array( 'product', 'product_page' );

	preg_match_all( '/' . get_shortcode_regex() . '/s', $post->post_content, $matches );
	$out = array();

	if ( isset( $matches[2] ) && count( $matches[2] ) === 1 ) {

		foreach ( (array) $matches[2] as $key => $value ) {
			foreach ( $tags as $tag ) {
				if ( $tag === $value ) {
					$out[] = shortcode_parse_atts( $matches[3][$key] );
				}
			}
		}

		if ( array_key_exists( 0, $out ) ) {
			return (int) $out[0]['id'];
		}
	}

}

/**
 * Get list of custom post types to use with UMBG.
 *
 * @return array
 */
function umbg_get_custom_post_types() {

	$arg0               = array(
		'public'   => true,
		'_builtin' => false
	);
	$umbg_custom_posts  = get_post_types( $arg0 );
	$umbg_custom_posts2 = array();
	$umbg_custom_posts3 = array();

	if ( class_exists( 'WooCommerce' ) ) {
		unset( $umbg_custom_posts['product'] );
	}

	foreach ( $umbg_custom_posts as $umbg_custom_post ) {
		$arg = array(
			'posts_per_page'   => - 1,
			'offset'           => 0,
			//'category'         => '',
			//'category_name'    => '',
			//'orderby'          => 'title',
			//'order'            => 'ASC',
			//'include'          => '',
			//'exclude'          => '',
			//'meta_key'         => '',
			//'meta_value'       => '',
			'post_type'        => $umbg_custom_post,
			//'post_mime_type'   => '',
			//'post_parent'      => '',
			//'author'	   => '',
			'post_status'      => 'publish',
			'suppress_filters' => true
		);

		$cpt_type = get_posts( $arg );
		foreach ( $cpt_type as $p ) {
			if ( $p->post_title > '' || $p->post_title > ' ' ) {
				$umbg_custom_posts2[] = $umbg_custom_post;
			}
		}

		$umbg_custom_posts3 = array_unique( $umbg_custom_posts2 );
	}

	return $umbg_custom_posts3;

}

/**
 * Get list of custom post type categories to use with UMBG.
 *
 * @return array
 */
function umbg_get_custom_post_categories() {

	$arg                    = array(
		'public'   => true,
		'_builtin' => false
	);
	$umbg_custom_post_cats1 = get_taxonomies( $arg );
	$umbg_custom_post_cats2 = array();
	$umbg_custom_post_cats3 = array();

	if ( class_exists( 'WooCommerce' ) ) {
		unset( $umbg_custom_post_cats1['product_cat'] );
		//unset( $umbg_custom_post_cats1['product_tag'] );
	}

	foreach ( $umbg_custom_post_cats1 as $umbg_custom_post_cat ) {

		$cat_args = array(
			//'type'                     => 'post',
			'child_of'     => 0,
			//'parent'                   => '',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 0,
			'hierarchical' => 1,
			//'exclude'                  => '',
			//'include'                  => '',
			//'number'                   => '',
			'taxonomy'     => $umbg_custom_post_cat,
			'pad_counts'   => false

		);

		$cpc_cat = get_categories( $cat_args );
		foreach ( $cpc_cat as $c ) {
			$umbg_custom_post_cats2[] = $umbg_custom_post_cat;
		}

		$umbg_custom_post_cats3 = array_unique( $umbg_custom_post_cats2 );
	}

	return $umbg_custom_post_cats3;

}

/**
 * Create an array or string list for UMBG settings options.
 *
 * @param null $type Optional. Use 'string' or null. String returns a string list.
 *
 * @return array|string Return array list or string list.
 */
function umbg_settings_options_list( $type = null ) {

	$page_options_arr = array(

		'_umbg_allow_authors',
		'_umbg_allow_categories',
		'_umbg_allow_posts',
		'_umbg_allow_pages',
		'_umbg_allow_wc_categories',
		'_umbg_allow_wc_products',
		'_umbg_author_strength',
		'_umbg_category_strength',
		'_umbg_post_strength',
		'_umbg_page_strength',
		'_umbg_wc_category_strength',
		'_umbg_wc_product_strength',
		'_umbg_order_by',
		'_umbg_place_controls',
		'_umbg_control_color',
		'_umbg_control_bgcolor',
		'_umbg_page_pause',
		'_umbg_allow_pud',
		'_umbg_pud_element',
		'_umbg_allow_fio',
		'_umbg_fio_element',
		'_umbg_disable_mobile_all',
		'_umbg_disable_mobile_video',
		'_umbg_disable_mobile_phone',
		'_umbg_show_previews'
	);

	// Custom post types variables.
	$umbg_all_cp = umbg_get_all_cp_options();
	foreach ( $umbg_all_cp as $cp ) {
		$page_options_arr[] = $cp;
	}

	// Create string list of custom post types.
	$page_options = array();
	foreach ( $page_options_arr as $item ) {
		$page_options[] = $item;
	}

	// If string list needed then return it, else return array list.
	if ( $type == 'string' ) {
		return join( ', ', $page_options );
	} else {
		return $page_options_arr;
	}

}


/**
 * Get all active custom post types & categories.
 *
 * If a plugin is active then it's CPT & CPC will show here. If it's deactivated they will not.
 *
 * @return array Return array of active cutom post types.
 */
function umbg_get_all_cp_active_options() {

	// Custom post types variables.
	$custom_post_types       = umbg_get_custom_post_types();
	$custom_post_categories  = umbg_get_custom_post_categories();
	$all_custom_post_options = array();

	// Add each custom post type.
	foreach ( $custom_post_types as $cpt_key => $cpt_value ) {
		$cpt_a                     = '_umbg_allow_cpt_' . $cpt_value;
		$cpt_s                     = '_umbg_cpt_' . $cpt_value . '_strength';
		$all_custom_post_options[] = $cpt_a;
		$all_custom_post_options[] = $cpt_s;
	}

	// Add each custom post category.
	foreach ( $custom_post_categories as $cpc_key => $cpc_value ) {
		$cpc_a                     = '_umbg_allow_cpc_' . $cpc_value;
		$cpc_s                     = '_umbg_cpc_' . $cpc_value . '_strength';
		$all_custom_post_options[] = $cpc_a;
		$all_custom_post_options[] = $cpc_s;
	}

	return $all_custom_post_options;

}

/**
 * Get all allowed and strength UMBG options from wp_options table.
 *
 * All options that are 'allow' and 'strength' related will be return even if plugin associated with a custom post tye is deactivated.
 *
 * @return array
 */
function umbg_get_all_cp_options() {

	// Get all UMBG 'Allow To Display On' options from wp_options table.
	$all_options         = wp_load_alloptions();
	$umbg_unused_options = array();

	foreach ( $all_options as $name => $value ) {
		// CPT
		if ( stristr( $name, '_umbg_allow_cpt_' ) ) {
			$umbg_unused_options[] = $name;
		}
		if ( stristr( $name, '_umbg_cpt_' ) ) {
			$umbg_unused_options[] = $name;
		}

		// CPC
		if ( stristr( $name, '_umbg_allow_cpc_' ) ) {
			$umbg_unused_options[] = $name;
		}
		if ( stristr( $name, '_umbg_cpc_' ) ) {
			$umbg_unused_options[] = $name;
		}
	}

	return $umbg_unused_options;

}
