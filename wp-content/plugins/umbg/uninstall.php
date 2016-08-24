<?php

/**
 * UMBG options uninstall file.
 *
 * Cleans the database of all UMBG created tables/data.
 *
 * @package    UMBG
 * @subpackage Uninstall
 * @since      1.0
 *
 * Last Updated: 2015-12-04 - Add Custom Post Types options.
 *                          - Change to array list of options.
 */

// If uninstall not called from WordPress exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Includes
require_once dirname( __file__ ) . '/includes/umbg-functions.php';

// Delete all UMBG Custom Post Types & Categories options from wp_options table.
$delete_options = umbg_settings_options_list();
foreach ( $delete_options as $option ) {
	delete_option( $option );
}

// Delete all custom post meta data and custom posts.
global $wpdb;
$cptName       = 'umbg_post_type';
$tablePostMeta = $wpdb->prefix . 'postmeta';
$tablePosts    = $wpdb->prefix . 'posts';

$postMetaDeleteQuery = "DELETE FROM $tablePostMeta" .
	" WHERE post_id IN" .
	" (SELECT ID FROM $tablePosts WHERE post_type='$cptName')";
$postDeleteQuery     = "DELETE FROM $tablePosts WHERE post_type='$cptName'";

$wpdb->query( $postMetaDeleteQuery );
$wpdb->query( $postDeleteQuery );