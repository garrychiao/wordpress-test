<?php

/**
 * Plugin Name: Ultimate Media Background
 * Plugin URI: http://theefarmer.com/
 * Description: Display amazing full screen backgrounds by using videos, images, patterns, and/or colors. Support's
 *                videos from YouTube, Vimeo, Dailymotion, Wistia, and HTML5.
 * Version: 1.4.3
 * Author: TheeFarmer
 * Author URI: http://theefarmer.com
 * Text Domain: umbg
 * Domain Path: /languages/
 *
 * Last Updated: 2016-03-02 - Fix media end fade-out function.
 *                          - Change default mediaLink value to ''.
 *               2016-02-27 - Enhance $autoplay initialization variable for versions before 1.4.0.
 *                          - Fix Page Visability Pause and autoplay.
 *               2016-02-25 - Fix autoplay on image slideshow.
 *                          - Fix UMBG-Slider script not loading with some EU mobile providers.
 *               2015-12-04 - Add Custom Post Type support.
 *                          - Add WooCommerce Product Tags support via custom post type.
 *                          - Add plugin functions file.
 *                          - Add autoplay option.
 *                          - Add capability to link the media background.
 *                          - Change plugin's folder structure to limit unnecessary code loading.
 *                          - Change plugin's menu position to be closer to the Media menu.
 *                          - Enhance uninstall code.
 *                          - Fix backgrounds not displaying when proper author of post/page.
 *               2015-11-01 - Fix YouTube API change causing looping issue with Safari on jquery.umbg.js.
 *               2015-10-18 - Change default value of Disable On Mobile Video Only from 1 to 0.
 *               2015-10-14 - Change transition duration minimum limit from 500 to 0.
 *               2015-09-22 - Add WooCommerce product page support.
 *                          - Add start video with audio muted.
 *                          - Add FIO (Fade-In-Out) for page content.
 *                          - Add Media End Fade-Out (MEFO).
 *                          - Fix custom column Type link.
 *                          - Add new Append To multi-select boxes to UI.
 *                          - Add transition duration option to image type background.
 *               2015-07-21 - Added 'step' property to video Start At & End At input box.
 *                          - Enhance code for video quality detection.
 *               2015-07-06 - Clean up the controls and PUD code.
 *                            Address compatibility with PHP 5.3/5.2.
 *               2015-06-29 - Fix YouTube play button sometimes not working.
 *                            Fix uninstall action not deleting 4 of the option settings from DB tables.
 *                            Reactivation no longer resets global settings.
 *               2015-06-23 - Add disableOnMobilePhonesOnly option to Admin settings page.
 *                            Add Wistia doNotTrack option.
 *                            Fix sprintf error on line 440.
 *                            Update some help documentation and spanish translation.
 *               2015-06-16 - Add disableOnMobileAll and disableOnMobileVideoOnly option to Admin settings page.
 *               2015-05-25 - Initial release.
 **/

defined( 'ABSPATH' ) or die( "No script kiddies please!" );


/**---------------------------------------------------------------------------------------------------------------------
 *
 * UMBG Plugin Data, Internationalization, Constants, & Includes
 *
 * -------------------------------------------------------------------------------------------------------------------*/

// Get UMBG plugin data.
require_once ABSPATH . 'wp-admin/includes/plugin.php';
$umbg_plugin_data = get_plugin_data( __FILE__ );
$umbg_version     = $umbg_plugin_data['Version'];

// Internationalization
load_plugin_textdomain( 'umbg', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

// Define Constants
define( 'UMBG_VERSION', $umbg_version );
define( 'UMBG_SHORT', 'UMBG' );
define( 'UMBG_LONG', 'Ultimate Media Background' );
define( 'UMBG_LOGO', plugins_url( 'admin/images/umbg-logo.png', __FILE__ ) );

// Includes
require_once dirname( __file__ ) . '/includes/umbg-functions.php';


/**---------------------------------------------------------------------------------------------------------------------
 *
 * UMBG Custom Post Type
 *
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 *
 * Register UMBG Media Background Custom Post Type.
 *
 */
function register_umbg() {
	$labels = array(
		'name'               => UMBG_LONG,
		'singular_name'      => UMBG_LONG,
		'menu_name'          => UMBG_SHORT,
		'name_admin_bar'     => UMBG_SHORT,
		'add_new'            => _x( 'Add New', 'add new background', 'umbg' ),
		'add_new_item'       => sprintf( __( 'Add New %s Background', 'umbg' ), UMBG_SHORT ),
		'edit_item'          => sprintf( __( 'Edit %s Background', 'umbg' ), UMBG_SHORT ),
		'new_item'           => sprintf( __( 'New %s Background', 'umbg' ), UMBG_SHORT ),
		'view_item'          => sprintf( __( 'View %s Background', 'umbg' ), UMBG_SHORT ),
		'search_items'       => sprintf( __( 'Search %s Backgrounds', 'umbg' ), UMBG_SHORT ),
		'not_found'          => sprintf( __( 'No %s backgrounds found', 'umbg' ), UMBG_SHORT ),
		'not_found_in_trash' => sprintf( __( 'No %s backgrounds found in Trash', 'umbg' ), UMBG_SHORT ),
		'parent_item_colon'  => __( 'Parent Background:', 'umbg' )
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => true,
		'description'         => __( 'Add a media background to any page.', 'umbg' ),
		'supports'            => array( 'title', 'revisions', 'author' ),
		//'taxonomies' => array( 'genres' ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10, //40
		'menu_icon'           => 'dashicons-format-video',
		'capability_type'     => 'post',
		'capabilities'        => array(
			'edit_post'          => 'edit_pages',
			'read_post'          => 'edit_pages',
			'delete_post'        => 'edit_pages',
			'delete_posts'       => 'edit_pages',
			'edit_posts'         => 'edit_pages',
			'edit_others_posts'  => 'edit_pages',
			'publish_posts'      => 'edit_pages',
			'read_private_posts' => 'edit_pages'
		),
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => false //array( 'slug' => 'book' )
	);

	register_post_type( 'umbg_post_type', $args );
}

add_action( 'init', 'register_umbg' );

/**
 *
 * If in admin area, then include admin pages/code.
 *
 */
if ( is_admin() ) {

	require_once dirname( __file__ ) . '/admin/umbg-admin.php';

}

/**
 *
 * If not in admin area, then include public/frontend code.
 *
 */
if ( ! is_admin() ) {

	require_once dirname( __file__ ) . '/public/umbg-public.php';

}

/**
 * UMBG Activation
 *
 * Function runs when the plugin is activated and it adds default admin options values.
 */
function umbg_activation() {

	global $wp_version;
	if ( version_compare( $wp_version, '4.0', '<' ) ) {
		wp_die( 'This plugin requires WordPress version 4.0 or higher. Please upgrade WordPress or deactivate the plugin.' );
	}

	// Custom Post Types & Categories to be added to wp_options table.
	$_umbg_custom_post_types      = array();
	$_umbg_custom_post_categories = array();

	$custom_post_types      = umbg_get_custom_post_types();
	$custom_post_categories = umbg_get_custom_post_categories();

	// Add each custom post types.
	foreach ( $custom_post_types as $cpt_key => $cpt_value ) {
		$a                         = '_umbg_allow_cpt_' . $cpt_value;
		$b                         = '_umbg_cpt_' . $cpt_value . '_strength';
		$_umbg_custom_post_types[] = $a;
		$_umbg_custom_post_types[] = $b;

		// If option does not exists add it.
		foreach ( $_umbg_custom_post_types as $cpt ) {
			if ( get_option( $cpt ) === false ) {
				update_option( $cpt, 0 );
			}
		}

		unset( $cpt );

	}

	// Add each custom post categories.
	foreach ( $custom_post_categories as $cpc_key => $cpc_value ) {
		$c                              = '_umbg_allow_cpc_' . $cpc_value;
		$d                              = '_umbg_cpc_' . $cpc_value . '_strength';
		$_umbg_custom_post_categories[] = $c;
		$_umbg_custom_post_categories[] = $d;

		// If option does not exists add it.
		foreach ( $_umbg_custom_post_categories as $cpc ) {
			if ( get_option( $cpc ) === false ) {
				update_option( $cpc, 0 );
			}
		}

		unset( $cpc );
	}

	// Array of UMBG options and values to add to wp_options table.
	$option_name = array(
		'option_name'          => array(
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
		),

		'option_default_value' => array(
			1, //_umbg_allow_authors
			1, //_umbg_allow_categories
			1, //_umbg_allow_posts
			1, //_umbg_allow_pages
			0, //_umbg_allow_wc_categories
			0, //_umbg_allow_wc_products

			4, //_umbg_author_strength
			2, //_umbg_post_strength
			1, //_umbg_post_strength
			3, //_umbg_page_strength
			0, //_umbg_wc_category_strength
			0, //_umbg_wc_product_strength

			'date', //_umbg_order_by
			'umbg-br',
			'rgba(239, 239, 239, 0.9)',
			'rgba(39, 173, 211, 0.78)',
			1, //_umbg_page_pause
			1, //_umbg_allow_pud
			'#page', //_umbg_pud_element

			1, //_umbg_allow_fio
			'#page', //_umbg_fio_element

			0, //_umbg_disable_mobile_all
			0, //_umbg_disable_mobile_video
			0, //_umbg_disable_mobile_phone
			1  //_umbg_show_previews
		)
	);

	// If option does not exists add it.
	foreach ( $option_name['option_name'] as $key => $value ) {
		if ( get_option( $value ) === false ) {
			update_option( $value, $option_name['option_default_value'][$key] );
		}
	}

	// Break the reference with the last element of the array.
	unset( $key );
	unset( $value );

	// Work around to send user to UMBG about page.
	add_option( 'Activated_UMBG', 'Plugin-UMBG' );
}

register_activation_hook( __FILE__, 'umbg_activation' );

// After activation redirect to about page.
function load_plugin() {
	global $blog_id;
	if ( is_admin() && get_option( 'Activated_UMBG' ) == 'Plugin-UMBG' ) {

		delete_option( 'Activated_UMBG' );

		// Do stuff once right after activation.
		wp_redirect( get_admin_url( $blog_id, 'edit.php?post_type=umbg_post_type&page=umbg-about' ) );
		exit;
	}
}

add_action( 'admin_init', 'load_plugin' );


/**
 * UMBG De-activation
 *
 * Function runs when UMBG plugin is de-activated.
 */
function umbg_deactivation() {
	//
}

register_deactivation_hook( __FILE__, 'umbg_deactivation' );
