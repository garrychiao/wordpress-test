<?php

/**
 * UMBG Public/Frontend Screen Code.
 *
 * @package    UMBG
 * @subpackage Public
 * @since      1.4.0
 *
 * Last Updated: 2016-02-27 - Enhance $autoplay initialization variable for versions before 1.4.0.
 * 				 2015-12-04 - Created.
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

/**---------------------------------------------------------------------------------------------------------------------
 *
 * UMBG Plugin Initialization & Front End Display
 *
 *--------------------------------------------------------------------------------------------------------------------*/

/**
 * Display the correct UMBG background for the current page/post.
 */
function umbg_scripts() {
	global $post;

	if ( $post ) {

		//Get the value where UMBG is allowed to be displayed.
		$allow_author_display      = get_option( '_umbg_allow_authors' );
		$allow_category_display    = get_option( '_umbg_allow_categories' );
		$allow_post_display        = get_option( '_umbg_allow_posts' );
		$allow_page_display        = get_option( '_umbg_allow_pages' );
		$allow_wc_category_display = get_option( '_umbg_allow_wc_categories' );
		$allow_wc_product_display  = get_option( '_umbg_allow_wc_products' );

		// Get priority level values for allowed display types.
		$author_strength      = get_option( '_umbg_author_strength' );
		$category_strength    = get_option( '_umbg_category_strength' );
		$post_strength        = get_option( '_umbg_post_strength' );
		$page_strength        = get_option( '_umbg_page_strength' );
		$wc_category_strength = get_option( '_umbg_wc_category_strength' );
		$wc_product_strength  = get_option( '_umbg_wc_product_strength' );


		// Get the 'order by' value from admin options.
		$umbg_order_by = get_option( '_umbg_order_by' );

		// Define variables.
		$umbg_array     = array();
		$is_author      = false;
		$is_category    = false;
		$is_post        = false;
		$is_page        = false;
		$is_wc_category = false;
		$is_wc_product  = false;

		$author_umbg_post_id      = '';
		$category_umbg_post_id    = '';
		$post_umbg_post_id        = '';
		$page_umbg_post_id        = '';
		$wc_category_umbg_post_id = '';
		$wc_product_umbg_post_id  = '';

		$post_types = array( 'post', 'page' );

		// WooCommerce check.
		if ( class_exists( 'WooCommerce' ) ) {
			$is_woocommerce = true;
			$wc_post_types  = array( 'product', 'product_page' );
		} else {
			$is_woocommerce = false;
		}

		// Get the author ID of current post.
		if ( is_singular( $post_types ) ) {
			$author_id = $post->post_author;
			$post_id   = $post->ID;
		} else {
			$author_id = null;
			$post_id   = null;
		}

		// Get all UMBG post type in DB.
		$posts_args = array(
			'post_type' => 'umbg_post_type',
			'nopaging'  => true,
			'orderby'   => $umbg_order_by,
			'order'     => 'ASC'
		);
		$umbg_posts = get_posts( $posts_args );

		// Author- Check if display authors is on, then check if it's an author.
		if ( $allow_author_display ) {

			foreach ( $umbg_posts as $umbg_post ) {
				$author_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_author', true );

				if ( is_array( $author_to_append ) && in_array( $author_id, $author_to_append ) ) {

					$this_author = true;

					if ( ( is_author( $author_to_append ) || $this_author ) && ! is_home() && ! is_page() &&
						! is_category() && ! is_search() && ! is_front_page() && ! is_admin() && is_singular( $post_types )
					) {
						$is_author           = true;
						$author_umbg_post_id = $umbg_post->ID;
					}
				}

			}

		} //End - Author.

		// Category - Check if display category is on, then check if it's a category.
		if ( $allow_category_display ) {

			foreach ( $umbg_posts as $umbg_post ) {
				$cat_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_category', true );

				if ( ( $cat_to_append > 0 && is_category( $cat_to_append ) || in_category( $cat_to_append ) ) &&
					! is_home() && ! is_front_page() && ! is_admin() && ! is_search() && is_singular( $post_types )
				) {
					$is_category           = true;
					$category_umbg_post_id = $umbg_post->ID;
				}

			}

		} // End - Category.

		// Post - Check if display post is on, then check if it's a post.
		if ( $allow_post_display ) {

			foreach ( $umbg_posts as $umbg_post ) {
				$post_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_post', true );
				if ( is_array( $post_to_append ) && in_array( $post_id, $post_to_append ) && ! is_home() &&
					! is_page() && ! is_search() && ! is_front_page()
				) {
					$is_post           = true;
					$post_umbg_post_id = $umbg_post->ID;
				}
			}

		} //End - Post.

		// Page - Check if display page is on, then check if it's a page.
		if ( $allow_page_display ) {

			// Returns either 'posts' or 'page'.
			//$front_page_posts     = get_option( 'show_on_front' );

			// Returns the ID of the static page assigned to the front page.
			$front_static_page_id = get_option( 'page_on_front' );

			// Returns the ID of the static page assigned to the blog posts index (posts page)
			$front_blog_page_id = get_option( 'page_for_posts' );

			foreach ( $umbg_posts as $umbg_post ) {
				$page_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_page', true );

				if ( is_front_page() && is_home() && is_array( $page_to_append ) && in_array( 'home-wp-default', $page_to_append ) ) {

					// default homepage
					$is_page           = true;
					$page_umbg_post_id = $umbg_post->ID;

				} elseif ( is_front_page() && is_array( $page_to_append ) && in_array( $front_static_page_id, $page_to_append ) ) {

					// static homepage
					$is_page           = true;
					$page_umbg_post_id = $umbg_post->ID;

				} elseif ( is_home() && is_array( $page_to_append ) && in_array( $front_blog_page_id, $page_to_append ) ) {

					// blog page
					$is_page           = true;
					$page_umbg_post_id = $umbg_post->ID;

				} else {

					if ( ( $page_to_append > 0 && is_page( $page_to_append ) ) &&
						! is_home() && ! is_front_page() && ( ! is_front_page() && ! is_home() ) &&
						is_singular( $post_types ) && ! is_admin() && ! is_search()
					) {
						$is_page           = true;
						$page_umbg_post_id = $umbg_post->ID;
					}

				}//End if

			} //End foreach

		} // End - Page.

		// WooCommerce Category - Check if display category is on, then check if it's a category.
		if ( $is_woocommerce ) {

			if ( $allow_wc_product_display || $allow_category_display ) {
				$wc_shortcode = umbg_get_wc_shortcode_product_id();
			} else {
				$wc_shortcode = 0;
			}

			if ( $allow_wc_category_display ) {

				foreach ( $umbg_posts as $umbg_post ) {
					$wc_cat_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_wc_category', true );

					//WooCommerce categories check.
					//Get categories of the UMBG background and WC.
					$umbg_wc_cats = $wc_cat_to_append;
					$cat_terms    = get_the_terms( $post->ID, 'product_cat' );

					//If its categories are arrays and is on WC product page then continue to check.
					if ( is_array( $umbg_wc_cats ) && is_array( $cat_terms ) && is_product() ) {

						foreach ( $umbg_wc_cats as $wc_cat ) {
							foreach ( $cat_terms as $cat_term ) {

								//If background's category equals a WC category then display UMBG.
								if ( $cat_term->term_id == $wc_cat ) {
									$is_wc_category           = true;
									$wc_category_umbg_post_id = $umbg_post->ID;
								}

							}//End foreach.
						}//End foreach.

					} else {

						$wc_cats = get_the_terms( $wc_shortcode, 'product_cat' );
						if ( $wc_cats ) {

							foreach ( $wc_cats as $wc_cat ) {
								if ( is_array( $wc_cat_to_append ) && in_array( $wc_cat->term_id, $wc_cat_to_append ) &&
									( is_singular( $wc_post_types ) || is_singular( $post_types ) ) && ! is_home() &&
									! is_front_page() && ( ! is_front_page() && ! is_home() )
								) {
									$is_wc_category           = true;
									$wc_category_umbg_post_id = $umbg_post->ID;
								}

							}

						}// End if.

					}// End if.

				}//End foreach.

			} // End - WC Category.

			// WooCommerce Post - Check if display post is on, then check if it's a post.
			if ( $allow_wc_product_display ) {

				foreach ( $umbg_posts as $umbg_post ) {
					$product_post_to_append = get_post_meta( $umbg_post->ID, '_umbg_append_to_wc_product', true );

					if ( ( is_array( $product_post_to_append ) && in_array( $post->ID, $product_post_to_append ) ) &&
						! is_home() && ! is_search() && ! is_front_page() && ( ! is_home() && ! is_front_page() ) &&
						! is_admin() && ! is_search() && is_singular( $wc_post_types )
					) {

						$is_wc_product           = true;
						$wc_product_umbg_post_id = $umbg_post->ID;
					} else {

						if ( is_array( $product_post_to_append ) && in_array( $wc_shortcode, $product_post_to_append ) &&
							! is_home() && ! is_search() && ! is_front_page() && ( ! is_home() && ! is_front_page() ) &&
							! is_admin() && ! is_search() && is_singular()
						) {
							$is_wc_product           = true;
							$wc_product_umbg_post_id = $umbg_post->ID;
						}

					}

				} //End foreach.

			} //End - WC Post.

		} //End if $woocommerce.

		// Custom Post Types
		$umbg_custom_post_types      = umbg_get_custom_post_types();
		$umbg_custom_post_categories = umbg_get_custom_post_categories();

		foreach ( $umbg_custom_post_types as $cpt_key => $cpt_value ) {

			// Get the value where UMBG is allowed to be displayed.
			$allow_cpt_display[$cpt_key] = get_option( '_umbg_allow_cpt_' . $cpt_value );

			// Get priority level values for allowed display types.
			$cpt_strength[$cpt_key] = get_option( '_umbg_cpt_' . $cpt_value . '_strength' );

			// Define variables.
			$is_cpt[$cpt_key]           = false;
			$cpt_umbg_post_id[$cpt_key] = '';

			// Custom Post - Check if display post is on, then check if it's a custom post.
			if ( $allow_cpt_display[$cpt_key] ) {

				foreach ( $umbg_posts as $umbg_post ) {

					$cpt_to_append[$cpt_key] = get_post_meta( $umbg_post->ID, '_umbg_append_to_cpt_' . $cpt_value, true );

					if ( is_array( $cpt_to_append[$cpt_key] ) && in_array( $post->ID, $cpt_to_append[$cpt_key] ) &&
						! is_home() && ! is_search() && ! is_front_page()
					) {
						$is_cpt[$cpt_key]           = true;
						$cpt_umbg_post_id[$cpt_key] = $umbg_post->ID;
					}
				}

			} //End - Custom Post.

			// Add to priority level array.
			$umbg_array[$cpt_strength[$cpt_key]] = array(
				'display' => $is_cpt[$cpt_key],
				'umbg'    => $cpt_umbg_post_id[$cpt_key]
			);

		}// End - Custom Post Types

		// Custom Post Categories
		foreach ( $umbg_custom_post_categories as $cpc_key => $cpc_value ) {

			// Get the value where UMBG is allowed to be displayed.
			$allow_cpc_display[$cpc_key] = get_option( '_umbg_allow_cpc_' . $cpc_value );

			// Get priority level values for allowed display types.
			$cpc_strength[$cpc_key] = get_option( '_umbg_cpc_' . $cpc_value . '_strength' );

			// Define variables.
			$is_cpc[$cpc_key]           = false;
			$cpc_umbg_post_id[$cpc_key] = '';

			// Custom Categories - Check if display post is on, then check if it's a custom category.
			if ( $allow_cpc_display[$cpc_key] ) {

				foreach ( $umbg_posts as $umbg_post ) {

					$cpc_to_append[$cpc_key] = get_post_meta( $umbg_post->ID, '_umbg_append_to_cpc_' . $cpc_value, true );
					$cpc_terms               = wp_get_post_terms( $post->ID, get_taxonomies() ); //get_the_terms( $post->ID, 'topic-tag' );

					//If its categories are arrays then continue to check.
					if ( is_array( $cpc_to_append[$cpc_key] ) && is_array( $cpc_terms ) ) {

						foreach ( $cpc_to_append[$cpc_key] as $cpc_append ) {
							foreach ( $cpc_terms as $cpc_term ) {

								//If background's category equals a CPC then display UMBG.
								if ( $cpc_term->term_id == $cpc_append ) {
									$is_cpc[$cpc_key]           = true;
									$cpc_umbg_post_id[$cpc_key] = $umbg_post->ID;
								}

							}//End foreach.
						}//End foreach.

					}//End if.

				}//End foreach.

			} //End - Custom Categories.

			// Add to priority level array
			$umbg_array[$cpc_strength[$cpc_key]] = array(
				'display' => $is_cpc[$cpc_key],
				'umbg'    => $cpc_umbg_post_id[$cpc_key]
			);

		}// End - Custom Post Categories


		// Array for UMBG display priority levels.
		$umbg_array[$author_strength]      = array(
			'display' => $is_author,
			'umbg'    => $author_umbg_post_id
		);
		$umbg_array[$category_strength]    = array(
			'display' => $is_category,
			'umbg'    => $category_umbg_post_id
		);
		$umbg_array[$post_strength]        = array(
			'display' => $is_post,
			'umbg'    => $post_umbg_post_id
		);
		$umbg_array[$page_strength]        = array(
			'display' => $is_page,
			'umbg'    => $page_umbg_post_id
		);
		$umbg_array[$wc_category_strength] = array(
			'display' => $is_wc_category,
			'umbg'    => $wc_category_umbg_post_id
		);
		$umbg_array[$wc_product_strength]  = array(
			'display' => $is_wc_product,
			'umbg'    => $wc_product_umbg_post_id
		);

		// Sort array by key.
		ksort( $umbg_array );

		// Remove the first record of array as it is empty and not needed.
		unset( $umbg_array[0] );

		// Display UMBG media base on priority levels.
		foreach ( $umbg_array as $pl_key => $pl_value ) {

			if ( isset( $umbg_array[$pl_key] ) && $umbg_array[$pl_key]['display'] ) {
				umbg( $umbg_array[$pl_key]['umbg'] );
				break;
			}

		}

	}

}

add_action( 'wp_enqueue_scripts', 'umbg_scripts' );

/** UMBG JS Scripts & CSS Stylesheets
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Add the necessary UMBG CSS stylesheets to the pages with UMBG backgrounds.
 */
function umbg_styles() {
	wp_register_style( 'umbg-style', plugins_url( 'css/umbg.css', __FILE__ ), array(), UMBG_VERSION );
	wp_enqueue_style( 'umbg-style' );

	// Font-awesome is now being imported from umbg.css.
	//wp_register_style( 'umbg-fonts', plugins_url( 'css/font-awesome/css/font-awesome.min.css', __FILE__ ), array(), '4.3.0' );
	//wp_enqueue_style( 'umbg-fonts' );
}

add_action( 'wp_enqueue_scripts', 'umbg_styles' );

/**
 * Load all necessary JS files and initialize UMBG.
 *
 * @param int $id
 */
function umbg( $id ) {

	wp_enqueue_script( 'jquery' );
	wp_register_script( 'umbg_core', plugins_url( 'js/jquery.umbg.js', __FILE__ ), array(), UMBG_VERSION );
	wp_enqueue_script( 'umbg_core' );
	wp_register_script( 'umbg_init', plugins_url( 'js/umbg.initialize.js', __FILE__ ), array(), UMBG_VERSION );
	wp_enqueue_script( 'umbg_init' );

	$media_player_type    = get_post_meta( $id, '_umbg_media_player_type', true );
	$media_id             = get_post_meta( $id, '_umbg_media_id', true );
	$media_link           = get_post_meta( $id, '_umbg_media_link', true );
	$media_link_target    = get_post_meta( $id, '_umbg_media_link_target', true );
	$media_poster         = get_post_meta( $id, '_umbg_media_poster', true );
	$video_quality        = get_post_meta( $id, '_umbg_quality', true );
	$media_aspect_ratio   = get_post_meta( $id, '_umbg_aspect_ratio', true );
	$wistia_tracking      = get_post_meta( $id, '_umbg_wistia_tracking', true );
	$autoplay             = get_post_meta( $id, '_umbg_autoplay', true );
	$loop                 = get_post_meta( $id, '_umbg_loop', true );
	$rewind_to_start_at   = get_post_meta( $id, '_umbg_rewind_to_start_at', true );
	$mefo                 = get_post_meta( $id, '_umbg_mefo', true );
	$start_at             = get_post_meta( $id, '_umbg_start_at', true );
	$end_at               = get_post_meta( $id, '_umbg_end_at', true );
	$duration             = get_post_meta( $id, '_umbg_image_duration', true );
	$transition           = get_post_meta( $id, '_umbg_image_transition_duration', true );
	$effect               = get_post_meta( $id, '_umbg_image_effect', true );
	$easing               = get_post_meta( $id, '_umbg_image_easing', true );
	$overlay              = get_post_meta( $id, '_umbg_overlay', true );
	$overlay_css          = get_post_meta( $id, '_umbg_overlay_css', true );
	$overlay_color        = get_post_meta( $id, '_umbg_overlay_color', true );
	$controls             = get_post_meta( $id, '_umbg_controls', true );
	$audio                = get_post_meta( $id, '_umbg_audio', true );
	$start_audio_muted    = get_post_meta( $id, '_umbg_start_audio_muted', true );
	$volume_level         = get_post_meta( $id, '_umbg_volume', true );
	$page_pause           = get_option( '_umbg_page_pause', true ) == 1 ? 1 : 0;
	$place_controls       = get_option( '_umbg_place_controls', true );
	$control_color        = get_option( '_umbg_control_color', true );
	$control_bgcolor      = get_option( '_umbg_control_bgcolor', true );
	$pud_allowed          = get_option( '_umbg_allow_pud', true );
	$pud                  = get_post_meta( $id, '_umbg_pud', true );
	$pud_down             = get_post_meta( $id, '_umbg_pud_down', true );
	$pud_up               = get_post_meta( $id, '_umbg_pud_up', true );
	$pud_element          = get_option( '_umbg_pud_element', true );
	$pud_show             = get_post_meta( $id, '_umbg_pud_show', true );
	$fio_allowed          = get_option( '_umbg_allow_fio', true );
	$fio                  = get_post_meta( $id, '_umbg_fio', true );
	$fio_start            = get_post_meta( $id, '_umbg_fio_start', true );
	$fio_end              = get_post_meta( $id, '_umbg_fio_end', true );
	$fio_opacity          = get_post_meta( $id, '_umbg_fio_opacity', true );
	$fio_element          = get_option( '_umbg_fio_element', true );
	$enlarge_by           = get_post_meta( $id, '_umbg_enlarge_by', true );
	$delay_by             = get_post_meta( $id, '_umbg_delay_by', true );
	$disable_mobile_all   = get_option( '_umbg_disable_mobile_all', true );
	$disable_mobile_video = get_option( '_umbg_disable_mobile_video', true );
	$disable_mobile_phone = get_option( '_umbg_disable_mobile_phone', true );

	// Set autoplay for versions before 1.4.0.
	//$autoplay = ( $autoplay !== 0 || 1 ) ? 1 : $autoplay;
	$autoplay = ( ! is_numeric( $autoplay )  ) ? 1 : $autoplay;

	$config_array = array(
		'mediaAspectRatio'            => $media_aspect_ratio,
		'videoQuality'                => $video_quality,
		'mediaPlayerType'             => $media_player_type,
		'mediaId'                     => $media_id,
		'mediaLink'                   => $media_link,
		'mediaLinkTarget'             => $media_link_target,
		'mediaPoster'                 => $media_poster,
		'mediaOverlay'                => $overlay,
		'mediaOverlayCss'             => $overlay_css,
		'mediaOverlayColor'           => $overlay_color,
		'autoPlay'                    => $autoplay,
		'loop'                        => $loop,
		'wistiaDoNotTrack'            => $wistia_tracking,
		'rewindToStartAt'             => $rewind_to_start_at,
		'mediaEndFadeOut'             => $mefo,
		'startAt'                     => $start_at,
		'endAt'                       => $end_at,
		'slideShowDuration'           => $duration,
		'slideShowTransitionDuration' => $transition,
		'slideShowEffect'             => $effect,
		'slideShowEasing'             => $easing,
		'audio'                       => $audio,
		'startAudioMuted'             => $start_audio_muted,
		'volumeLevel'                 => $volume_level,
		'displayControls'             => $controls,
		'placeControls'               => $place_controls,
		'controlColor'                => $control_color,
		'controlBgColor'              => $control_bgcolor,
		'pudAllowed'                  => $pud_allowed,
		'pud'                         => $pud,
		'pudDown'                     => $pud_down,
		'pudUp'                       => $pud_up,
		'pudElement'                  => $pud_element,
		'pudShow'                     => $pud_show,
		'fioAllowed'                  => $fio_allowed,
		'fio'                         => $fio,
		'fioStart'                    => $fio_start,
		'fioEnd'                      => $fio_end,
		'fioOpacity'                  => $fio_opacity,
		'fioElement'                  => $fio_element,
		'enlargeBy'                   => $enlarge_by,
		'delayBy'                     => $delay_by,
		'pageVisibilityPause'         => $page_pause,
		'disableOnMobileAll'          => $disable_mobile_all,
		'disableOnMobileVideoOnly'    => $disable_mobile_video,
		'disableOnMobilePhonesOnly'   => $disable_mobile_phone
	);

	wp_localize_script( 'umbg_init', 'umbg_setting', $config_array );
}
