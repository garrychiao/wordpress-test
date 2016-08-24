<?php

/**
 * UMBG Admin Screen Code.
 *
 * @package    UMBG
 * @subpackage Admin
 * @since      1.4.0
 *
 * Last Updated: 2015-12-04 - Created.
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

/** UMBG Custom Post Type Columns
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Replace the default columns on the admin UMBG post type edit.php page.
 *
 * @param $columns
 *
 * @return array
 */
function set_umbg_columns( $columns ) {
	return array(
		'cb'            => '<input type="checkbox" />',
		'title'         => __( 'Title', 'umbg' ),
		'media_player'  => __( 'Type', 'umbg' ),
		'date'          => __( 'Date', 'umbg' ),
		'post_modified' => __( 'Modified', 'umbg' ),
		'author'        => __( 'Author', 'umbg' )
	);

	//return $columns;
}

add_filter( 'manage_umbg_post_type_posts_columns', 'set_umbg_columns' );

/**
 * Get the display data for UMBG custom columns.
 *
 * @param $column_name
 * @param $post_id
 */
function manage_umbg_post_type_columns( $column_name, $post_id ) {
	//global $wpdb;
	switch ( $column_name ) {

		case 'post_modified' :
			$terms = get_the_modified_date( 'Y/m/d h:m:s A' );
			echo $terms;
			break;

		case 'media_player' :
			$type = get_post_meta( $post_id, '_umbg_media_player_type', true );
			if ( $type == 'image' ) {
				$media_type = __( 'Image', 'umbg' );
			} elseif ( $type == 'youtube' ) {
				$media_type = 'YouTube';
			} elseif ( $type == 'vimeo' ) {
				$media_type = 'Vimeo';
			} elseif ( $type == 'dailymotion' ) {
				$media_type = 'Dailymotion';
			} elseif ( $type == 'wistia' ) {
				$media_type = 'Wistia';
			} elseif ( $type == 'html5' ) {
				$media_type = 'HTML5';
			} elseif ( $type == 'color' ) {
				$media_type = 'Color';
			} else {
				$media_type = 'N/A';
			}

			$type_link = '<a href="' . admin_url() . 'edit.php?post_type=umbg_post_type&media_player=' .
				$type . '">' . $media_type . '</a>';

			echo $type_link;
			break;

	} // end switch
}

add_action( 'manage_umbg_post_type_posts_custom_column', 'manage_umbg_post_type_columns', 10, 2 );

/**
 * Make the UMBG custom columns sortable.
 *
 * @param $columns
 *
 * @return array
 */
function umbg_sortable_columns( $columns ) {
	$custom = array(
		'media_player'  => 'media_player',
		'post_modified' => 'post_modified'
	);

	//unset( $columns['comments'] );
	return wp_parse_args( $custom, $columns );
}

add_filter( 'manage_edit-umbg_post_type_sortable_columns', 'umbg_sortable_columns' );

/**
 * Tell WP what data to sort on the custom column(s) that need it.
 *
 * @param $vars
 *
 * @return array
 */
function umbg_column_orderby( $vars ) {

	if ( isset( $vars['orderby'] ) && 'media_player' == $vars['orderby'] ) {
		$vars = array_merge(
			$vars, array(
				'meta_key' => '_umbg_media_player_type',
				'orderby'  => 'meta_value'
				//'order'     => 'asc'
			)
		);
	}

	return $vars;
}

add_filter( 'request', 'umbg_column_orderby' );

/**
 * UMBG custom post type list, Type link filter. Clicking on this (filter) link displays a list of UMBG
 * backgrounds of only the clicked on column data link.
 *
 */
function umbg_type_filter() {

	global $pagenow, $post_type;

	if ( 'edit.php' != $pagenow || 'umbg_post_type' != $post_type || ! isset( $_GET['media_player'] ) ) {
		return;
	}

	$meta_group = array(
		'key'   => '_umbg_media_player_type',
		'value' => $_GET['media_player']
	);

	set_query_var( 'meta_query', array( $meta_group ) );
}

add_action( 'parse_query', 'umbg_type_filter' );


/** UMBG Custom Post Type Admin Notification Messages
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * UMBG bulk messages.
 *
 * @param $bulk_messages
 * @param $bulk_counts
 *
 * @return mixed
 */
function my_bulk_post_updated_messages_filter( $bulk_messages, $bulk_counts ) {

	$bulk_messages['umbg_post_type'] = array(
		'updated'   => _n( '%s background updated.', '%s backgrounds updated.', $bulk_counts['updated'] ),
		'locked'    => _n( '%s background not updated, somebody is editing it.', '%s backgrounds not updated, somebody is editing them.', $bulk_counts['locked'] ),
		'deleted'   => _n( '%s background permanently deleted.', '%s backgrounds permanently deleted.', $bulk_counts['deleted'] ),
		'trashed'   => _n( '%s background moved to the Trash.', '%s backgrounds moved to the Trash.', $bulk_counts['trashed'] ),
		'untrashed' => _n( '%s background restored from the Trash.', '%s backgrounds restored from the Trash.', $bulk_counts['untrashed'] ),
	);

	return $bulk_messages;

}

add_filter( 'bulk_post_updated_messages', 'my_bulk_post_updated_messages_filter', 10, 2 );

/**
 * UMBG update messages.
 *
 * See /wp-admin/edit-form-advanced.php
 *
 * @param array $messages Existing post update messages.
 *
 * @return array Amended post update messages with new CPT update messages.
 */
function umbg_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['umbg_post_type'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( '%s background updated.', 'umbg' ), UMBG_SHORT ),
		2  => sprintf( __( '%s custom field updated.', 'umbg' ), UMBG_SHORT ),
		3  => sprintf( __( '%s custom field deleted.', 'umbg' ), UMBG_SHORT ),
		4  => sprintf( __( '%s background updated.', 'umbg' ), UMBG_SHORT ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( '%1$s restored to revision from %2$s', 'umbg' ), UMBG_SHORT, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( '%s background published.', 'umbg' ), UMBG_SHORT ),
		7  => sprintf( __( '%s background saved.', 'umbg' ), UMBG_SHORT ),
		8  => sprintf( __( '%s background submitted.', 'umbg' ), UMBG_SHORT ),
		9  => sprintf(
			__( '%1$s scheduled for: <strong>%2$s</strong>.', 'umbg' ), UMBG_SHORT, +

			// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i', 'umbg' ), strtotime( $post->post_date ) )
		),
		10 => sprintf( __( '%s draft updated.', 'umbg' ), UMBG_SHORT )
	);

	if ( $post_type_object->publicly_queryable ) {
		$permalink = get_permalink( $post->ID );

		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View', 'umbg' ) );
		$messages['umbg_post_type'][1] .= $view_link;
		$messages['umbg_post_type'][6] .= $view_link;
		$messages['umbg_post_type'][9] .= $view_link;

		$preview_permalink = esc_url( add_query_arg( 'preview', 'true', $permalink ) );
		$preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview', 'umbg' ) );
		$messages['umbg_post_type'][8] .= $preview_link;
		$messages['umbg_post_type'][10] .= $preview_link;
	}

	return $messages;
}

add_filter( 'post_updated_messages', 'umbg_updated_messages' );


/** UMBG Custom Post Type Contextual Help Tabs
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Add tabs to the contextual help tab.
 */
function umbg_custom_help_tab() {
	global $blog_id;
	$screen = get_current_screen();

	// Return early if we're not on the UMBG post type.
	if ( 'umbg_post_type' != $screen->post_type ) {
		return;
	}

	// Setup UMBG help tab args.
	if ( $screen->id == 'edit-umbg_post_type' ) {

		$overview_tab       = array(
			'id'      => 'umbg-overview',
			'title'   => __( 'Overview', 'umbg' ),
			'content' =>
				'<h3>' . __( 'Overview', 'umbg' ) . '</h3>' .
				'<p>' . sprintf( __( 'This screen provides access to all of your %s backgrounds. You can customize the display of this screen to suit your workflow as you can on other WordPress screens.', 'umbg' ), UMBG_SHORT ) . '</p>'
		);
		$screen_content_tab = array(
			'id'      => 'umbg-screen-content',
			'title'   => __( 'Screen Content', 'umbg' ),
			'content' =>
				'<h3>' . __( 'Screen Content', 'umbg' ) . '</h3>' .
				'<p>' . __( 'You can customize the display of this screen&#8217;s contents in a number of ways:', 'umbg' ) . '</p>' .
				'<ul>' .
				'<li>' . sprintf( __( 'You can hide/display columns based on your needs and decide how many %s backgrounds to list per screen using the Screen Options tab.', 'umbg' ), UMBG_SHORT ) . '</li>' .
				'<li>' . sprintf( __( 'You can filter the list of %1$s backgrounds by their status using the text links in the upper left to show All, Published, Draft, or Trashed %1$s backgrounds. The default view is to show all %1$s backgrounds.', 'umbg' ), UMBG_SHORT ) . '</li>' .
				'<li>' . sprintf( __( 'You can refine the list to show only %1$s backgrounds from a specific month by using the DropDown menus above the background list. Click the Filter button after making your selection. You also can refine the list by clicking on the %1$s background type or author in the background list.', 'umbg' ), UMBG_SHORT ) .
				'</li>' .
				'</ul>'
		);

		$actions_tab = array(
			'id'      => 'umbg-action-links',
			'title'   => __( 'Available Actions', 'umbg' ),
			'content' =>
				'<h3>' . __( 'Available Actions', 'umbg' ) . '</h3>' .
				'<p>' . sprintf(
					__( 'Hovering over a row in the %s background list will display action links that allow you to manage your background. You can perform the following actions:', 'umbg' ), UMBG_SHORT
				) . '</p>' .
				'<ul>' .
				'<li>' . __( '<strong>Edit</strong> takes you to the editing screen for that background. You can also reach that screen by clicking on the background title.', 'umbg' ) . '</li>' .
				'<li>' . __( '<strong>Quick Edit</strong> provides inline access to the metadata of your background, allowing you to update background details without leaving this screen.', 'umbg' ) . '</li>' .
				'<li>' . __( '<strong>Trash</strong> removes your background from this list and places it in the trash, from which you can permanently delete it.', 'umbg' ) . '</li>' .
				'</ul>'
		);

		$bulk_tab = array(
			'id'      => 'umbg-bulk-actions',
			'title'   => __( 'Bulk Actions', 'umbg' ),
			'content' =>
				'<h3>' . __( 'Bulk Actions', 'umbg' ) . '</h3>' .
				'<p>' . sprintf( __( 'You can also edit or move multiple %s backgrounds to the trash at once. Select the backgrounds you want to act on using the checkboxes, then select the action you want to take from the Bulk Actions menu and click Apply.', 'umbg' ), UMBG_SHORT ) . '</p>' .
				'<p>' . __( 'When using Bulk Edit, you can change the metadata (author or status) for all selected backgrounds at once. To remove a background from the grouping, just click the (x) next to its name in the Bulk Edit area that appears.', 'umbg' ) . '</p>'
		);

		// Add the help tab for the UMBG list page (edit.php page).
		$screen->add_help_tab( $overview_tab );
		$screen->add_help_tab( $screen_content_tab );
		$screen->add_help_tab( $actions_tab );
		$screen->add_help_tab( $bulk_tab );

	} elseif ( $screen->id == 'umbg_post_type' ) {

		$overview_tab = array(
			'id'      => 'umbg_overview',
			'title'   => __( 'Overview', 'umbg' ),
			'content' =>
				'<h3>' . __( 'Overview', 'umbg' ) . '</h3>' .
				'<p>' . sprintf( __( 'Things to remember when adding or editing a %s background:', 'umbg' ), UMBG_SHORT ) . '</p>' .
				'<ul>' .
				'<li>' . sprintf( __( '%1s can be used to accomplish different background effects including for design, marketing, or other imaginative purposes, but remember that it is just one tool to help you with the purpose.', 'umbg' ), UMBG_LONG ) . '</li>' .
				'<li>' . __( 'Remember the shorter the video the better and faster it will load and play for the user. When a video takes too long to load or is too long in duration, it takes longer to buffer and users will loose interest if they have to wait. The same is true for large image files.', 'umbg' ) . '</li>' .
				'<li>' . sprintf( __( 'Select the Authors, Categories, Pages, and/or Posts that the %1s background will be appended to. In the Pages multi-select box you will find the selection of Home Page - WP Default, this refers to the default home page of WordPress when you first install it, which displays the most recent posts. See <a href="http://codex.wordpress.org/Creating_a_Static_Front_Page" target="_blank">Creating a Static Front Page</a> for more information on WordPress static front page.', 'umbg' ), UMBG_SHORT ) . '</li>' .
				'<li>' . __( 'Select the correct media type such as YouTube, Vimeo, Dailymotion, Wistia, HTML5, Image, or Color.', 'umbg' ) . '</li>' .
				'<li>' . __( 'Specify the correct id or location of the media to be played, such as the video id for YouTube, Vimeo, Dailymotion, and Wistia. The video location for HTML5 videos and the image location for Image.', 'umbg' ) . '</li>' .
				'</ul>' .
				'<p>' . sprintf( __( 'If you want to schedule the %s background to be published/displayed in the future:', 'umbg' ), UMBG_SHORT ) .
				'</p>' .
				'<ul>' .
				'<li>' . __( 'Under the Publish module/meta box, click on the Edit link next to Publish.', 'umbg' ) . '</li>' .
				'<li>' . sprintf( __( 'Change the date to the date you actually want to publish this %s background, then click on Ok.', 'umbg' ), UMBG_SHORT ) . '</li>' .
				'</ul>' .
				'<p><strong>' . __( 'For general WordPress information:', 'umbg' ) . '</strong></p>' .
				'<p>' . __( '<a href="http://codex.wordpress.org/Posts" target="_blank">Writing Posts Documentation</a>', 'umbg' ) . '</p>' .
				'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'umbg' ) . '</p>'
		);

		$append_to = '<div class="title"><i class="dropdown icon"></i>' . __( 'Append Background To', 'umbg' ) . '</div>' .
			'<div class="content">' .
			'<p>' . sprintf( __( 'Select the Authors, Categories, Pages, Posts and/or Custom Post Types the %s background will be append/display on.', 'umbg' ), UMBG_SHORT ) .

			'</p>' .
			'<p>' . __( 'The multi-select list on the left are the available items and the multi-select list on the right are the selected items.', 'umbg' ) . '</p>' .
			'<p>' .
			__( '<strong>Keyboard Shortcodes:</strong>', 'umbg' ) . '<br />' .
			__( '[ &nbsp&darr;&nbsp; ]  Down arrow - Select next item in the focused list', 'umbg' ) . '<br />' .
			__( '[ &nbsp&uarr;&nbsp; ]  Up arrow - Select previous item in the focused list', 'umbg' ) .
			'<br />' .
			__( '[ &horbar; ]  Space bar - Add/remove item depending on which list is currently focused', 'umbg' ) .
			'<br />' .
			__( '[ &larr; ]  Left arrow - Focus the previous list', 'umbg' ) . '<br />' .
			__( '[ &rarr; ]  Right arrow - Focus the next list', 'umbg' ) . '<br />' .

			'</p>
			<p>' . sprintf( __( 'With the ability to append/display %1$s backgrounds to multiple items how does %1$s determines which background to display? For example, you created two %1$s backgrounds, one to display video from YouTube for author John Doe and the second to display an HTML5 video for the category Uncategorized. You go to a post where it has author John Doe and category Uncategorized. Which video will play? %1$s uses Priority Levels to determine such a scenario. Priority Level determines which background video willplay. Check your <a href="%2$s">%1$s Settings</a> for your priority levels.', 'umbg' ), UMBG_SHORT, get_admin_url( $blog_id, 'edit.php?post_type=umbg_post_type&page=umbg-settings' ) ) . '</p>' .
			'</div>';

		$media_player_type = '<div class="title"><i class="dropdown icon"></i>' . __( 'Media Type', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Select whether the media is a YouTube, Vimeo, Dailymotion, Wistia, HTML5 video, Image, or Color.', 'umbg' ) . '</p></div>';

		$media_id = '<div class="title"><i class="dropdown icon"></i>' . __( 'Video Id / Video Location', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enter the video ID only if its YouTube, Vimeo, Dailymotion, or Wistia. For most video hosting sites the video id is placed at the end of their url. For HTML5 videos you can select a video uploaded to your WordPress site by clicking the Select Video button or you can enter the video\'s location: i.e. http://mywebsite.com/wp-content/uploads/2015/01/myvideofile.mp4. For cross-browser compatibility for HTML5 videos make sure you have the file versions MP4, WEBM, & OGV in the same location. For more information see <a target="_blank" href="http://diveintohtml5.info/video.html#what-works">HTML5 Video</a>.', 'umbg' ) . '</p>' .
			'</div>';

		$media_link = '<div class="title"><i class="dropdown icon"></i>' . __( 'Media Link URL', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enter the URL to link the media background. You can select to open the link in a new window or the same window.', 'umbg' ) . '</p>' .
			'</div>';

		$image_location = '<div class="title"><i class="dropdown icon"></i>' . __( 'Image', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . sprintf(
				__( 'For images you can select an image uploaded to your WordPress site by clicking the Select Image button (you can select multiple images) or you can enter the image\'s location: i.e. http://mywebsite.com/wp-content/uploads/2015/01/myimagefile.jpg. If entering several images location manually you need to separate each with a comma. When multiple images are selected %1$s displays them as a slide show.', 'umbg' ), UMBG_SHORT
			) . '</p></div>';

		$poster_location = '<div class="title"><i class="dropdown icon"></i>' . __( 'Poster', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . sprintf( __( 'Enter the video\'s poster location with the file extension: i.e. http://mywebsite.com/wp-content/uploads/2015/01/myvideoposter.jpg. %1$s uses the poster to display it to mobile devices instead of the video since they don\'t support auto playback. %1$s also uses the poster to display it to web browsers that do not support HTML5 video nor the video file type. If you leave it blank it will display the page\'s background color. You can use the Remove Poster link to remove the poster image.', 'umbg' ), UMBG_SHORT ) . '</p></div>';

		$overlay = '<div class="title"><i class="dropdown icon"></i>' . __( 'Overlay', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enable or disable displaying an overlay over the media. You can select the pattern for the overlay from the DropDown list. You can also select the color and opacity of the color. Remember that if you prefer no pattern but still want to display a color as an overlay then select Transparent from the pattern DropDown list.', 'umbg' ) . '</p>' .

			'<p>' . __( 'A preview of the overlay pattern can be seen on the preview video/poster. The pattern is not scaled to match the preview video/poster dimensions, it is at a size that you can preview the pattern.', 'umbg' ) . '</p></div>';

		$quality = '<div class="title"><i class="dropdown icon"></i>' . __( 'Quality', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Force a particular playback quality. Auto is recommended because it tries to select the most appropriate playback quality for the user\'s environment. Most video hosting services adjusts the quality of your video stream by the speed of your Internet connection (bandwidth), video player size, and the original video quality.', 'umbg' ) . '</p>
					   <p>' . __( 'Forcing HD with Vimeo videos is not guarantee to work. Vimeo controls this feature from the user\'s settings on their site. See why on their <a href="https://vimeo.com/help/faq/sharing-videos/embedding-videos#can-i-make-my-embedded-videos-default-to-hd" target="_blank">site</a>.', 'umbg' ) . '</p></div>';

		$wistia_tracking = '<div class="title"><i class="dropdown icon"></i>' . __( 'Tracking Views', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'For Wistia videos only. You can enable to track views to this video. All tracking is done by Wistia and can be access from your Wistia account if available.', 'umbg' ) . '</p>
			</div>';

		$autoplay = '<div class="title"><i class="dropdown icon"></i>' . __( 'Autoplay', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Automatically play the media.', 'umbg' ) . '</p></div>';

		$start_end = '<div class="title"><i class="dropdown icon"></i>' . __( 'Start At / End At', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enter the start time and end time, in seconds, that you would like the video to start and/or end. If left at zero the video will play in its entirety from start to finish.', 'umbg' ) . '</p></div>';

		$image_duration = '<div class="title"><i class="dropdown icon"></i>' . __( 'Image Display Duration', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enter the display duration for each image in milliseconds. (1000 ms. = 1 sec.)', 'umbg' ) . '</p></div>';

		$image_transition_duration = '<div class="title"><i class="dropdown icon"></i>' . __( 'Image Transition Duration', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enter the transition duration for the fading effect between images. Should not be more than the Image Display Duration value, you can create some nice effects by going over a little but the play/pause functionally will not function as expected. (1000 ms. = 1 sec.)', 'umbg' ) . '</p></div>';

		$image_effect = '<div class="title"><i class="dropdown icon"></i>' . __( 'Image Effect', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Select the animation effect to display the image.', 'umbg' ) . '</p></div>';

		$images_effect_easing = '<div class="title"><i class="dropdown icon"></i>' . __( 'Image Effect Easing', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Select the image effect easing type for the animation.', 'umbg' ) . '</p></div>';

		$delay = '<div class="title"><i class="dropdown icon"></i>' . sprintf( __( 'Delay Displaying %s By', 'umbg' ), UMBG_SHORT ) .
			'</div>' .
			'<div class="content"><p>' . __( 'Enter the time in milliseconds to delay displaying the background. (1000 ms. = 1 sec.)', 'umbg' ) . '</p></div>';

		$loop = '<div class="title"><i class="dropdown icon"></i>' . __( 'Loop', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enable or disable loop play.', 'umbg' ) .
			'</p>' .
			'<p>' . __( 'You can choose to loop the media or rewind it to the beginning when it stops by using <strong>Rewind To StartAt time</strong>. You can also choose <strong>Media End Fade-Out</strong> to allow for the media to be faded out once playback has ended.', 'umbg' ) . '</p></div>';

		$audio = '<div class="title"><i class="dropdown icon"></i>' . __( 'Audio', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Enable or disable playing the video with audio and/or start playing with the audio muted.', 'umbg' ) . '</p></div>';

		$volume_level = '<div class="title"><i class="dropdown icon"></i>' . __( 'Volume Level', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Adjust the volume level of the video.', 'umbg' ) . '</p></div>';

		$controls = '<div class="title"><i class="dropdown icon"></i>' . __( 'Display Controls', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . sprintf( __( 'Display %2$s, %1$s, play, & audio buttons.', 'umbg' ), 'PUD', 'FIO' ) . '</p></div>';

		$pud = '<div class="title"><i class="dropdown icon"></i>' . sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ) .
			'</div>' .
			'<div class="content"><p>' . sprintf( __( '%1$s allows the page to be scroll up and down to have a better view of the video; i.e. you can use this feature with a marketing video. Start with %1$s down: the page will scroll down when the media playback starts. End with %1$s up: the page will automatically scroll up when the media playback ends or the first loop ends. Use "How much to show..." to keep part of the page in view such as to show the logo and navigation during the %1$s down status.', 'umbg' ), 'PUD' ) . '</p></div>';

		$fio = '<div class="title"><i class="dropdown icon"></i>' . sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ) .
			'</div>' .
			'<div class="content"><p>' . sprintf( __( '%1$s lets you set an opacity (transparency) effect for a better view of the media background. <strong>Fade-Out on start:</strong> the page HTML element will fade out when the media playback starts. <strong>Fade-In on end:</strong> the page HTML element will fade in when the media playback ends or the first loop ends. Use Opacity to set the amount of opacity for the page HTML element. Use <b>Opacity</b> to set the amount of opacity for the page HTML element. You must set the FIO HTML Element in <a href="%2$s">%3$s Settings</a> for FIO to work.', 'umbg' ), 'FIO', get_admin_url( null, 'edit.php?post_type=umbg_post_type&page=umbg-settings' ), UMBG_SHORT ) . '</p></div>';

		$enlarge = '<div class="title"><i class="dropdown icon"></i>' . __( 'Enlarge Media By', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Use with caution, enlarge only what is necessary. Useful for hosted videos such as YouTube and Vimeo to hide unwanted objects. Remember that the more you enlarge the media the more chances it may lead to choppy playback.', 'umbg' ) . '</p></div>';

		$aspect_ratio = '<div class="title"><i class="dropdown icon"></i>' . __( 'Aspect Ratio', 'umbg' ) . '</div>' .
			'<div class="content"><p>' . __( 'Select proper aspect ratio, this affects the way the media will be displayed and re-sized.', 'umbg' ) . '</p></div>';

		$video = array(
			'id'      => 'umbg-video',
			'title'   => _x( 'Video Background', 'title', 'umbg' ),
			'content' => '<h3>' . _x( 'Video Background', 'title', 'umbg' ) . '</h3>' .
				'<div class="ui accordion">' .
				$append_to .
				$media_player_type .
				$media_id .
				$media_link .
				$poster_location .
				$overlay .
				$quality .
				$wistia_tracking .
				$autoplay .
				$start_end .
				$delay .
				$loop .
				$audio .
				$volume_level .
				$controls .
				$pud .
				$fio .
				$enlarge .
				$aspect_ratio .
				'</div>'
		);

		$image = array(
			'id'      => 'umbg-image',
			'title'   => _x( 'Image Background', 'title', 'umbg' ),
			'content' => '<h3>' . _x( 'Image Background', 'title', 'umbg' ) . '</h3>' .
				'<div class="ui accordion">' .
				'<p>' . __( 'Image backgrounds can use more than one image. When more than one is selected the images will display as a slideshow.', 'umbg' ) . '</p>' .
				$append_to .
				$media_player_type .
				$image_location .
				$media_link .
				$overlay .
				$autoplay .
				$image_duration .
				$image_transition_duration .
				$image_effect .
				$images_effect_easing .
				$delay .
				$loop .
				$controls .
				$pud .
				$fio .
				$enlarge .
				$aspect_ratio .
				'</div>'
		);

		$color = array(
			'id'      => 'umbg-color',
			'title'   => _x( 'Color Background', 'title', 'umbg' ),
			'content' => '<h3>' . _x( 'Color Background', 'title', 'umbg' ) . '</h3>' .
				'<div class="ui accordion">' .
				'<p>' . sprintf( __( 'If a video or image background is not desire then try a color background that is beautiful and offers more options than the default WordPress background feature. You can match colors with patterns to create unique backgrounds. Color backgrounds do not use the %s feature.', 'umbg' ), 'PUD' ) . '</p>' .
				$append_to .
				$media_player_type .
				$media_link .
				$overlay .
				$delay .
				//$pud .
				//$fio .
				//$enlarge .
				//$controls .
				'</div>'
		);

		// Add the help tab for UMBG post type pages.
		$screen->add_help_tab( $overview_tab );
		$screen->add_help_tab( $video );
		$screen->add_help_tab( $image );
		$screen->add_help_tab( $color );

	}

	// General UMBG help tabs.
	$sidebar =
		'<p><strong>' . __( 'For more information:', 'umbg' ) . '</strong></p>' .
		'<p><a href="http://www.theefarmer.com/support/" target="_blank">' . sprintf( __( '%s Support', 'umbg' ), UMBG_SHORT ) . '</a></p>';
	// Add the general help tab
	$screen->set_help_sidebar( $sidebar );

}

add_action( 'admin_head', 'umbg_custom_help_tab' );


/** UMBG Custom Post Type Pointers
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 *
 * WP Pointers for UMBG.
 *
 * @param $hook_suffix
 */
function umbg_pointer_load( $hook_suffix ) {

	// Don't run on WP < 4.0
	if ( get_bloginfo( 'version' ) < '4.0' ) {
		return;
	}

	$screen    = get_current_screen();
	$screen_id = $screen->id;

	// Get pointers for this screen
	$pointers = apply_filters( 'umbg_admin_pointers-' . $screen_id, array() );

	if ( ! $pointers || ! is_array( $pointers ) ) {
		return;
	}

	// Get dismissed pointers
	$dismissed      = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
	$valid_pointers = array();

	// Check pointers and remove dismissed ones.
	foreach ( $pointers as $pointer_id => $pointer ) {

		// Sanity check
		if ( in_array( $pointer_id, $dismissed ) || empty( $pointer ) || empty( $pointer_id ) || empty( $pointer['target'] ) || empty( $pointer['options'] ) ) {
			continue;
		}

		$pointer['pointer_id'] = $pointer_id;

		// Add the pointer to $valid_pointers array
		$valid_pointers['pointers'][] = $pointer;
	}

	// No valid pointers? Stop here.
	if ( empty( $valid_pointers ) ) {
		return;
	}

	// Add pointers style to queue.
	wp_enqueue_style( 'wp-pointer' );

	// Add pointers script to queue. Add custom script.
	wp_enqueue_script( 'umbg-pointer', plugins_url( 'js/umbg.wp.pointer.js', __FILE__ ), array( 'wp-pointer' ) );

	// Add pointer options to script.
	wp_localize_script( 'umbg-pointer', 'umbgPointer', $valid_pointers );
}

add_action( 'admin_enqueue_scripts', 'umbg_pointer_load', 1000 );

// Pointer Box 1
/**
 * UMBG pointer box 1.
 *
 * @param $p
 *
 * @return mixed
 */
function umbg_register_pointer_testing( $p ) {
	$p['xyz140'] = array(
		'target'  => '#contextual-help-link-wrap',
		'options' => array(
			//'screen' => 'umbg_post_type',
			'content'  => sprintf(
				'<h3> %s </h3> <p> %s </p>',
				sprintf( __( '%s Documentation', 'umbg' ), UMBG_SHORT ),
				sprintf( __( 'Use this help tab to access the %s documentation.', 'umbg' ), UMBG_SHORT )
			),
			'position' => array(
				'edge'  => 'top', //top, bottom, left, right
				'align' => 'right' //top, bottom, left, right, middle
			)
		)
	);

	return $p;
}

add_filter( 'umbg_admin_pointers-umbg_post_type', 'umbg_register_pointer_testing' );

/**
 * Add links to display on the plugins page.
 *
 * @param string $links
 *
 * @return array
 */
function umbg_action_links( $links ) {
	$links[] = sprintf(
		__( '<a href="%1$s" title="Configure %2$s" >Settings</a>', 'umbg' ),
		get_admin_url( null, 'edit.php?post_type=umbg_post_type&page=umbg-settings' ), UMBG_SHORT
	);
	$links[] = sprintf(
		__( '<a href="%1$s" title="About %2$s" >About</a>', 'umbg' ),
		//get_admin_url( null, 'index.php?page=umbg-about' ), UMBG_SHORT );
		get_admin_url( null, 'edit.php?post_type=umbg_post_type&page=umbg-about' ), UMBG_SHORT
	);

	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'umbg_action_links' );


/** UMBG Quick Edit Box
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 *
 */
function umbg_quick_edit() {
	/**
	 * /wp-admin/edit.php?post_type=post
	 * /wp-admin/edit.php?post_type=page
	 * /wp-admin/edit.php?post_type=umbg_post_type  == umbg in this code
	 */

	global $current_screen;
	if ( 'edit-umbg_post_type' != $current_screen->id ) {
		return;
	}
	?>
	<script type="text/javascript">
		jQuery( document ).ready( function ( $ ) {
			$( 'span:contains(\'Slug\')' ).each( function ( i ) {
				$( this ).parent().remove();
			} );
			//			$('span:contains("Password")').each(function (i) {
			//				$(this).parent().parent().remove();
			//			});
			//			$('span:contains("Date")').each(function (i) {
			//				$(this).parent().remove();
			//			});
			//			$('.inline-edit-date').each(function (i) {
			//				$(this).remove();
			//			});
		} );
	</script>
	<?php
}

add_action( 'admin_head-edit.php', 'umbg_quick_edit' );


/**---------------------------------------------------------------------------------------------------------------------
 *
 * UMBG Custom Post Type Admin Page
 *
 *-------------------------------------------------------------------------------------------------------------------**/


/** UMBG Custom Post Type Admin Page JS Scripts
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Scripts for UMBG custom post type admin page.
 *
 * @param string $hook
 */
function umbg_enqueue( $hook ) {
	global $post_type;

	$screen = get_current_screen();

	// Return early if we're not on the UMBG post type.
	if ( $screen->id != $post_type ) {
		return;
	}

	//if (  'post-new.php' != $hook && 'umbg_post_type' != $post_type ) {
	//	return;
	//}

	wp_enqueue_script( 'umbg-admin-script', plugins_url( 'js/umbg.admin.js', __FILE__ ), array( 'jquery' ), array(), UMBG_VERSION );
	wp_enqueue_script(
		'umbg-admin-script-quicksearch', plugins_url( 'js/jquery.quicksearch.min.js', __FILE__ ), array
	(), '2.0
		.5'
	);
	wp_enqueue_script(
		'umbg-admin-script-multi-select', plugins_url( 'js/jquery.multi-select.js', __FILE__ ), array(),
		'0.9
		.11'
	);
	wp_enqueue_script( 'umbg-admin-script-accordion', plugins_url( 'js/accordion.js', __FILE__ ), array(), '1.6.4' );
	wp_enqueue_script( 'umbg-admin-script-rangeslider', plugins_url( 'js/rangeslider.min.js', __FILE__ ), array(), '0.3.7' );
	wp_enqueue_script( 'umbg-admin-script-spectrum', plugins_url( 'js/spectrum.js', __FILE__ ), array(), '1.5.2' );
	wp_enqueue_style( 'umbg-admin-style', plugins_url( 'css/umbg-admin.css', __FILE__ ), array(), UMBG_VERSION );

	// Using the overlay css styles for the preview thumbs.
	wp_enqueue_style( 'umbg-style', plugins_url( '../public/css/umbg.css', __FILE__ ), array(), UMBG_VERSION );

	// Localize umbg.admin.js file to perform language localization where necessary and a couple other variables to send to UMBG JS file.
	wp_localize_script(
		'umbg-admin-script', 'objectL10n', array(

			'fieldRequired'      => _x( '(required)', 'input field required', 'umbg' ),
			'imageLocationLabel' => __( 'Image', 'umbg' ),
			'colorLocationLabel' => __( 'Color Preview', 'umbg' ),
			'colorImageLocation' => plugins_url( '../public/images/umbg-transparent-100x100.png', __FILE__ ),
			'mediaIdLabel'       => __( 'Media Id', 'umbg' ),
			'mediaIdHtmlLabel'   => __( 'Video Location', 'umbg' ),
			'descVideo'          => 'Enter the video ID only. For most video hosting sites the video id is placed at the end of their url.',
			'descDm'             => sprintf( __( 'Enter the video ID only. Some videos on Dailymotion can only be watch on their website and will not play. The use of Dailymotion ad-free videos is strongly recommended with %s, as their ad supported videos may give unwanted results.', 'umbg' ), UMBG_SHORT ),
			'descHtml5'          => __( 'For HTML5 videos you can select a video uploaded to your WordPress site by clicking the Select Video button or you can enter the video\'s location: i.e. http://mywebsite.com/wp-content/uploads/2015/01/myvideofile.mp4. For cross-browser compatibility for HTML5 videos make sure you have the file versions MP4, WEBM, & OGV in the same location. For more information see <a target="_blank" href="http://diveintohtml5.info/video.html#what-works">HTML5 Video</a>.', 'umbg' ),
			'descImage'          => sprintf( __( 'When multiple images are selected %s displays them as a slide show.', 'umbg' ), UMBG_SHORT ),

		)
	);

}

add_action( 'admin_enqueue_scripts', 'umbg_enqueue' );

/** Meta Box
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Create the meta box for UMBG custom post type.
 */
function umbg_meta_box() {
	add_meta_box(
		'umbg_media_settings', sprintf( __( '%s Settings', 'umbg' ), UMBG_SHORT ), 'umbg_settings_meta_box',
		'umbg_post_type', 'normal', 'high'
	);
	remove_meta_box( 'slugdiv', 'umbg_post_type', 'normal' );
}

add_action( 'add_meta_boxes', 'umbg_meta_box' );

/**
 * UMBG 'Add New' & 'Edit' page settings meta box.
 *
 * @param int $post_id
 */
function umbg_settings_meta_box( $post_id ) {
	global $post;

	// Get the values from the db.
	$umbg_allow_author_display       = get_option( '_umbg_allow_authors' ) ? true : false;
	$umbg_allow_category_display     = get_option( '_umbg_allow_categories' ) ? true : false;
	$umbg_allow_post_display         = get_option( '_umbg_allow_posts' ) ? true : false;
	$umbg_allow_page_display         = get_option( '_umbg_allow_pages' ) ? true : false;
	$umbg_allow_wc_category_display  = get_option( '_umbg_allow_wc_categories' ) ? true : false;
	$umbg_allow_wc_product_display   = get_option( '_umbg_allow_wc_products' ) ? true : false;
	$umbg_show_previews              = get_option( '_umbg_show_previews' ) ? true : false;
	$umbg_allow_pud                  = get_option( '_umbg_allow_pud' ) ? true : false;
	$umbg_allow_fio                  = get_option( '_umbg_allow_fio' ) ? true : false;
	$umbg_append_to_author           = get_post_meta( $post->ID, '_umbg_append_to_author', true );
	$umbg_append_to_category         = get_post_meta( $post->ID, '_umbg_append_to_category', true );
	$umbg_append_to_post             = get_post_meta( $post->ID, '_umbg_append_to_post', true );
	$umbg_append_to_page             = get_post_meta( $post->ID, '_umbg_append_to_page', true );
	$umbg_append_to_wc_category      = get_post_meta( $post->ID, '_umbg_append_to_wc_category', true );
	$umbg_append_to_wc_product       = get_post_meta( $post->ID, '_umbg_append_to_wc_product', true );
	$umbg_media_player_type          = get_post_meta( $post->ID, '_umbg_media_player_type', true );
	$umbg_media_id                   = get_post_meta( $post->ID, '_umbg_media_id', true );
	$umbg_media_id_attachment_id     = get_post_meta( $post->ID, '_umbg_media_id_attachment_id', true );
	$umbg_media_link                 = get_post_meta( $post->ID, '_umbg_media_link', true );
	$umbg_media_link_target          = get_post_meta( $post->ID, '_umbg_media_link_target', true );
	$umbg_media_poster               = get_post_meta( $post->ID, '_umbg_media_poster', true );
	$umbg_media_poster_attachment_id = get_post_meta( $post->ID, '_umbg_media_poster_attachment_id', true );
	$umbg_video_quality              = get_post_meta( $post->ID, '_umbg_quality', true );
	$umbg_wistia_track_views         = get_post_meta( $post->ID, '_umbg_wistia_tracking', true );
	$umbg_autoplay                   = get_post_meta( $post->ID, '_umbg_autoplay', true );
	$umbg_aspect_ratio               = get_post_meta( $post->ID, '_umbg_aspect_ratio', true );
	$umbg_loop                       = get_post_meta( $post->ID, '_umbg_loop', true );
	$umbg_rewind_to_start_at         = get_post_meta( $post->ID, '_umbg_rewind_to_start_at', true );
	$umbg_start_at                   = get_post_meta( $post->ID, '_umbg_start_at', true );
	$umbg_end_at                     = get_post_meta( $post->ID, '_umbg_end_at', true );
	$umbg_image_duration             = get_post_meta( $post->ID, '_umbg_image_duration', true );
	$umbg_transition_duration        = get_post_meta( $post->ID, '_umbg_image_transition_duration', true );
	$umbg_effect                     = get_post_meta( $post->ID, '_umbg_image_effect', true );
	$umbg_easing                     = get_post_meta( $post->ID, '_umbg_image_easing', true );
	$umbg_overlay                    = get_post_meta( $post->ID, '_umbg_overlay', true );
	$umbg_overlay_css                = get_post_meta( $post->ID, '_umbg_overlay_css', true );
	$umbg_overlay_color              = get_post_meta( $post->ID, '_umbg_overlay_color', true );
	$umbg_controls                   = get_post_meta( $post->ID, '_umbg_controls', true );
	$umbg_pud                        = get_post_meta( $post->ID, '_umbg_pud', true );
	$umbg_pud_down                   = get_post_meta( $post->ID, '_umbg_pud_down', true );
	$umbg_pud_up                     = get_post_meta( $post->ID, '_umbg_pud_up', true );
	$umbg_pud_show                   = get_post_meta( $post->ID, '_umbg_pud_show', true );
	$umbg_fio                        = get_post_meta( $post->ID, '_umbg_fio', true );
	$umbg_fio_start                  = get_post_meta( $post->ID, '_umbg_fio_start', true );
	$umbg_fio_end                    = get_post_meta( $post->ID, '_umbg_fio_end', true );
	$umbg_fio_opacity                = get_post_meta( $post->ID, '_umbg_fio_opacity', true );
	$umbg_mefo                       = get_post_meta( $post->ID, '_umbg_mefo', true );
	$umbg_audio                      = get_post_meta( $post->ID, '_umbg_audio', true );
	$umbg_start_audio_muted          = get_post_meta( $post->ID, '_umbg_start_audio_muted', true );
	$umbg_volume_level               = get_post_meta( $post->ID, '_umbg_volume', true );
	$umbg_enlarge_by                 = get_post_meta( $post->ID, '_umbg_enlarge_by', true );
	$umbg_delay_by                   = get_post_meta( $post->ID, '_umbg_delay_by', true );

	// Fill the form with db data or defaults.
	$allow_author_display      = ( $umbg_allow_author_display == 1 ) ? 1 : 0;
	$allow_category_display    = ( $umbg_allow_category_display == 1 ) ? 1 : 0;
	$allow_post_display        = ( $umbg_allow_post_display == 1 ) ? 1 : 0;
	$allow_page_display        = ( $umbg_allow_page_display == 1 ) ? 1 : 0;
	$allow_wc_category_display = ( $umbg_allow_wc_category_display == 1 ) ? 1 : 0;
	$allow_wc_product_display  = ( $umbg_allow_wc_product_display == 1 ) ? 1 : 0;
	$append_to_author          = ( $umbg_append_to_author ) ? $umbg_append_to_author : 0;
	$append_to_category        = ( $umbg_append_to_category ) ? $umbg_append_to_category : 0;
	$append_to_post            = ( $umbg_append_to_post ) ? $umbg_append_to_post : 0;
	$append_to_page            = ( $umbg_append_to_page ) ? $umbg_append_to_page : 0;
	$append_to_wc_category     = ( $umbg_append_to_wc_category ) ? $umbg_append_to_wc_category : 0;
	$append_to_wc_product      = ( $umbg_append_to_wc_product ) ? $umbg_append_to_wc_product : 0;
	$media_player_yt           = ( $umbg_media_player_type == 'youtube' ) ? 'selected' : '';
	$media_player_v            = ( $umbg_media_player_type == 'vimeo' ) ? 'selected' : '';
	$media_player_dm           = ( $umbg_media_player_type == 'dailymotion' ) ? 'selected' : '';
	$media_player_w            = ( $umbg_media_player_type == 'wistia' ) ? 'selected' : '';
	$media_player_h5           = ( $umbg_media_player_type == 'html5' ) ? 'selected' : '';
	$media_player_i            = ( $umbg_media_player_type == 'image' ) ? 'selected' : '';
	$media_player_c            = ( $umbg_media_player_type == 'color' ) ? 'selected' : '';
	$media_id                  = ( $umbg_media_id != '' ) ? $umbg_media_id : 'k7dEsMCFfFw';
	$media_id_attachment_id    = ( $umbg_media_id_attachment_id == '' ) ? '' : $umbg_media_id_attachment_id;
	$media_link                = ( $umbg_media_link != '' ) ? $umbg_media_link : '';
	//$media_link_target          = ( $umbg_media_link_target != '' ) ? $umbg_media_link_target : '_blank';
	$media_link_target_blank    = ( $umbg_media_link_target == '_blank' || $umbg_media_link_target == '' ) ? 'selected' : '';
	$media_link_target_self     = ( $umbg_media_link_target == '_self' ) ? 'selected' : '';
	$media_poster               = ( $umbg_media_poster != '' ) ? $umbg_media_poster : '';
	$media_poster_attachment_id = ( $umbg_media_poster_attachment_id == '' ) ? '' : $umbg_media_poster_attachment_id;
	$video_quality_yt_d         = ( $umbg_video_quality == 'default' || $umbg_video_quality == '' ) ? 'selected' : '';
	$video_quality_yt_hr        = ( $umbg_video_quality == 'highres' ) ? 'selected' : '';
	$video_quality_yt_1080      = ( $umbg_video_quality == 'hd1080' ) ? 'selected' : '';
	$video_quality_yt_720       = ( $umbg_video_quality == 'hd720' ) ? 'selected' : '';
	$video_quality_yt_large     = ( $umbg_video_quality == 'large' ) ? 'selected' : '';
	$video_quality_yt_medium    = ( $umbg_video_quality == 'medium' ) ? 'selected' : '';
	$video_quality_yt_small     = ( $umbg_video_quality == 'small' ) ? 'selected' : '';
	$video_quality_v_d          = ( $umbg_video_quality == 0 || $umbg_video_quality == '' ) ? 'selected' : '';
	$video_quality_v_hd         = ( $umbg_video_quality == 1 ) ? 'selected' : '';
	$video_quality_dm_d         = ( $umbg_video_quality == '' ) ? 'selected' : '';
	$video_quality_dm_240       = ( $umbg_video_quality == '240' ) ? 'selected' : '';
	$video_quality_dm_380       = ( $umbg_video_quality == '380' ) ? 'selected' : '';
	$video_quality_dm_480       = ( $umbg_video_quality == '480' ) ? 'selected' : '';
	$video_quality_dm_720       = ( $umbg_video_quality == '720' ) ? 'selected' : '';
	$video_quality_dm_1080      = ( $umbg_video_quality == '1080' ) ? 'selected' : '';
	$video_quality_w_d          = ( $umbg_video_quality == 'auto' || $umbg_video_quality == '' ) ? 'selected' : '';
	$video_quality_w_sd         = ( $umbg_video_quality == 'sd-only' ) ? 'selected' : '';
	$video_quality_w_md         = ( $umbg_video_quality == 'md' ) ? 'selected' : '';
	$video_quality_w_hd         = ( $umbg_video_quality == 'hd-only' ) ? 'selected' : '';
	$wistia_tracking            = ( $umbg_wistia_track_views == 0 ) ? 'checked' : '';
	$autoplay                   = ( $umbg_autoplay == 1 || $umbg_autoplay == '' ) ? 'checked' : '';
	$loop                       = ( $umbg_loop == 1 || $umbg_loop == '' ) ? 'checked' : '';
	$rewind_to_start_at         = ( $umbg_rewind_to_start_at == 1 ) ? 'checked' : '';
	$start_at                   = ( $umbg_start_at != '' ) ? $umbg_start_at : 0;
	$end_at                     = ( $umbg_end_at != '' ) ? $umbg_end_at : 0;
	$duration                   = ( $umbg_image_duration != '' || 0 ) ? $umbg_image_duration : 5000;
	$transition                 = ( $umbg_transition_duration == '' ) ? 2000 : $umbg_transition_duration;
	$effect_f                   = ( $umbg_effect == 'fade' ) ? 'selected' : '';
	$effect_r                   = ( $umbg_effect == 'random' ) ? 'selected' : '';
	$effect_zi                  = ( $umbg_effect == 'zoomIn' ) ? 'selected' : '';
	$effect_zo                  = ( $umbg_effect == 'zoomOut' ) ? 'selected' : '';
	$effect_pl                  = ( $umbg_effect == 'panLeft' ) ? 'selected' : '';
	$effect_pr                  = ( $umbg_effect == 'panRight' ) ? 'selected' : '';
	$effect_pu                  = ( $umbg_effect == 'panUp' ) ? 'selected' : '';
	$effect_pd                  = ( $umbg_effect == 'panUp' ) ? 'selected' : '';
	$easing_eio                 = ( $umbg_easing == 'ease-in-out' ) ? 'selected' : '';
	$easing_ei                  = ( $umbg_easing == 'ease-in' ) ? 'selected' : '';
	$easing_eo                  = ( $umbg_easing == 'ease-out' ) ? 'selected' : '';
	$easing_e                   = ( $umbg_easing == 'ease' ) ? 'selected' : '';
	$easing_l                   = ( $umbg_easing == 'linear' ) ? 'selected' : '';
	$audio                      = ( $umbg_audio == 1 || $umbg_audio == '' ) ? 'checked' : '';
	$start_audio_muted          = ( $umbg_start_audio_muted == 1 ) ? 'checked' : '';
	$volume_level               = ( $umbg_volume_level != '' ) ? $umbg_volume_level : '100';
	$controls                   = ( $umbg_controls == 1 || $umbg_controls == '' ) ? 'checked' : '';
	$overlay                    = ( $umbg_overlay == 1 || $umbg_overlay == '' ) ? 'checked' : '';
	$overlay_css                = ( $umbg_overlay_css == '' ) ? 'umbg-overlay-square-grid' : $umbg_overlay_css;
	$overlay_color              = ( $umbg_overlay_color == '' ) ? 'rgba(0, 0, 0, 0.4)' : $umbg_overlay_color;
	$pud                        = ( $umbg_pud == 1 || $umbg_pud == '' ) ? 'checked' : '';
	$pud_down                   = ( $umbg_pud_down == 1 ) ? 'checked' : '';
	$pud_up                     = ( $umbg_pud_up == 1 ) ? 'checked' : '';
	$pud_show                   = ( $umbg_pud_show > 0 ) ? $umbg_pud_show : 0;
	$fio                        = ( $umbg_fio == 1 || $umbg_fio == '' ) ? 'checked' : '';
	$fio_start                  = ( $umbg_fio_start == 1 ) ? 'checked' : '';
	$fio_end                    = ( $umbg_fio_end == 1 ) ? 'checked' : '';
	$fio_opacity                = ( $umbg_fio_opacity >= 0 ) ? $umbg_fio_opacity : 0.5;
	$mefo                       = ( $umbg_mefo == 1 ) ? 'checked' : '';
	$enlarge_by                 = ( $umbg_enlarge_by != '' ) ? $umbg_enlarge_by : 0;
	$delay_by                   = ( $umbg_delay_by != '' ) ? $umbg_delay_by : 0;
	$media_aspect_ratio_16_9    = ( $umbg_aspect_ratio == 1.778 ) ? 'selected' : '';
	$media_aspect_ratio_4_3     = ( $umbg_aspect_ratio == 1.333 ) ? 'selected' : '';
	$media_aspect_ratio_19_10   = ( $umbg_aspect_ratio == 1.90 ) ? 'selected' : '';
	$media_aspect_ratio_21_9    = ( $umbg_aspect_ratio == 2.333 ) ? 'selected' : '';
	$media_aspect_ratio_64_27   = ( $umbg_aspect_ratio == 2.370 ) ? 'selected' : '';

	// Overlay style options array.
	$overlay_styles[] = array( 'name' => '3px Tile', 'class' => 'umbg-overlay-3px-tile' );
	$overlay_styles[] = array( 'name' => 'Grid', 'class' => 'umbg-overlay-grid' );
	$overlay_styles[] = array( 'name' => 'Green Fibers', 'class' => 'umbg-overlay-green-fibers' );
	$overlay_styles[] = array( 'name' => 'Dotnoise Light', 'class' => 'umbg-overlay-dotnoise-light-grey' );
	$overlay_styles[] = array( 'name' => 'Fabric Squares', 'class' => 'umbg-overlay-fabric-of-squares' );
	$overlay_styles[] = array( 'name' => 'First Aid Kit', 'class' => 'umbg-overlay-first-aid-kit' );
	$overlay_styles[] = array( 'name' => 'French Stucco', 'class' => 'umbg-overlay-french-stucco' );
	$overlay_styles[] = array( 'name' => 'Graphy Dark', 'class' => 'umbg-overlay-graphy-dark' );
	$overlay_styles[] = array( 'name' => 'Dust & Scratches', 'class' => 'umbg-overlay-green-dust-and-scratches' );
	$overlay_styles[] = array( 'name' => 'Grey Jean', 'class' => 'umbg-overlay-grey-jean' );
	$overlay_styles[] = array( 'name' => 'Grid Noise', 'class' => 'umbg-overlay-grid-noise' );
	$overlay_styles[] = array( 'name' => 'Groovepaper', 'class' => 'umbg-overlay-groovepaper' );
	$overlay_styles[] = array( 'name' => 'Grunge Wall', 'class' => 'umbg-overlay-grunge-wall' );
	$overlay_styles[] = array( 'name' => 'Hexellence', 'class' => 'umbg-overlay-hexellence' );
	$overlay_styles[] = array( 'name' => 'Inflicted', 'class' => 'umbg-overlay-inflicted' );
	$overlay_styles[] = array( 'name' => 'Light Sketch', 'class' => 'umbg-overlay-light-sketch' );
	$overlay_styles[] = array( 'name' => 'Light Wool', 'class' => 'umbg-overlay-light-wool' );
	$overlay_styles[] = array( 'name' => 'Small Diamond', 'class' => 'umbg-overlay-small-diamond' );
	$overlay_styles[] = array( 'name' => 'Subtle Grey', 'class' => 'umbg-overlay-subtle-grey' );
	$overlay_styles[] = array( 'name' => 'Textured Stripes', 'class' => 'umbg-overlay-textured-stripes' );
	$overlay_styles[] = array( 'name' => 'Wave Grid', 'class' => 'umbg-overlay-wave-grid' );
	$overlay_styles[] = array( 'name' => 'Wavecut', 'class' => 'umbg-overlay-wavecut' );
	$overlay_styles[] = array( 'name' => 'White Diamond', 'class' => 'umbg-overlay-white-diamond' );
	$overlay_styles[] = array( 'name' => 'Wine Cork', 'class' => 'umbg-overlay-wine-cork' );
	$overlay_styles[] = array( 'name' => 'Wood Pattern', 'class' => 'umbg-overlay-wood-pattern' );
	$overlay_styles[] = array( 'name' => 'XV Leaves', 'class' => 'umbg-overlay-xv' );
	$overlay_styles[] = array( 'name' => 'Diagonal', 'class' => 'umbg-overlay-diagonal' );
	$overlay_styles[] = array( 'name' => 'Diagonal Wide', 'class' => 'umbg-overlay-diagonal-wide' );
	$overlay_styles[] = array( 'name' => 'Dots 1', 'class' => 'umbg-overlay-dots1' );
	$overlay_styles[] = array( 'name' => 'Dots 2', 'class' => 'umbg-overlay-dots2' );
	$overlay_styles[] = array( 'name' => 'Dots 3', 'class' => 'umbg-overlay-dots3' );
	$overlay_styles[] = array( 'name' => 'Dots 4', 'class' => 'umbg-overlay-dots4' );
	$overlay_styles[] = array( 'name' => 'Dots 5', 'class' => 'umbg-overlay-dots5' );
	$overlay_styles[] = array( 'name' => 'Dots 6', 'class' => 'umbg-overlay-dots6' );
	$overlay_styles[] = array( 'name' => 'Lines', 'class' => 'umbg-overlay-lines' );
	$overlay_styles[] = array( 'name' => 'Pattern 1', 'class' => 'umbg-overlay-pattern1' );
	$overlay_styles[] = array( 'name' => 'Pattern 2a', 'class' => 'umbg-overlay-pattern2-a' );
	$overlay_styles[] = array( 'name' => 'Pattern 2b', 'class' => 'umbg-overlay-pattern2-b' );
	$overlay_styles[] = array( 'name' => 'Pattern 3a', 'class' => 'umbg-overlay-pattern3-a' );
	$overlay_styles[] = array( 'name' => 'Pattern 3b', 'class' => 'umbg-overlay-pattern3-b' );
	$overlay_styles[] = array( 'name' => 'Stairs', 'class' => 'umbg-overlay-stairs' );

	// UMBG overlay design styles - localize.
	$overlay_styles[] = array( 'name' => __( 'Square Grid', 'umbg' ), 'class' => 'umbg-overlay-square-grid' );
	$overlay_styles[] = array( 'name' => __( 'Transparent', 'umbg' ), 'class' => 'umbg-overlay-transparent' );

	// Add an nonce field so we can check for it later.
	$nonce = wp_nonce_field( 'umbg_meta_box_post_save', 'umbg_meta_box_nonce_field' );

	// Required for media upload & selection.
	wp_enqueue_media();

	?>
	<!-- Start - UMBG HTML Page -->
	<div class="wrap">

		<form action="options.php" method="post" name="options" class="form-table">
			<!--'. $nonce .'-->
			<?php echo $nonce; ?>
			<table class="form-table" width="100%" cellpadding="10">
				<tbody>
				<tr>
					<th scope="row">
						<label for="umbg-append-to-author"><?php _e( 'Append Background To', 'umbg' ); ?></label>
					</th>

					<td>

						<div class="ui styled fluid accordion umbg-append-accordion">

							<?php if ( $allow_author_display ) : ?>
								<div id="author">
									<div class="umbg-append-to-author-title title">
										<i class="dropdown icon"></i><?php _e( 'Authors', 'umbg' ); ?>
									</div>
									<div class="umbg-container-for-select content">

										<select id="umbg-append-to-author" class="umbg-form-control umbg-select"
												name="umbg-append-to-author[]" multiple size="5">
											<?php
											$authors = get_users( 'orderby=display_name&order=ASC&who=authors' );
											foreach ( $authors as $author ) {
												$selected_author = ( is_array( $append_to_author ) &&
													in_array( $author->ID, $append_to_author ) ) ? 'selected="selected"' : '';
												$option          = '<option value="' . absint( $author->ID ) .
													'" ' . esc_attr( $selected_author ) . ' >' .
													esc_html( $author->display_name ) . '</option>';
												echo $option;
											}
											?>
										</select>

									</div>
								</div>
							<?php endif; ?>

							<?php if ( $allow_category_display ) : ?>
								<div id="category">
									<div class="umbg-append-to-category-title title">
										<i class="dropdown icon"></i><?php _e( 'Categories', 'umbg' ); ?>
									</div>
									<div class="umbg-container-for-select content">

										<select id="umbg-append-to-category" class="umbg-form-control umbg-select"
												name="umbg-append-to-category[]" multiple size="5">
											<?php

											$taxonomy_cats = 'category';

											$cat_args = array(
												'type'         => 'post',
												'child_of'     => 0,
												//'parent'                   => '',
												'orderby'      => 'name',
												'order'        => 'ASC',
												'hide_empty'   => 0,
												'hierarchical' => 1,
												'taxonomy'     => $taxonomy_cats,
												'pad_counts'   => false

											);

											$categories = get_categories( $cat_args );
											foreach ( $categories as $cat ) {
												$selected_cat = ( is_array( $append_to_category ) &&
													in_array( $cat->term_id, $append_to_category ) ) ? 'selected="selected"' : '';
												$option       = '<option value="' . absint( $cat->term_id ) . '" ' .
													esc_attr( $selected_cat ) . ' >' . esc_html( $cat->name ) .
													'</option>';
												echo $option;
											}
											?>
										</select>

									</div>
								</div>

							<?php endif; ?>

							<?php

							// Display custom post type categories.
							$custom_post_categories = umbg_get_custom_post_categories();
							asort( $custom_post_categories );

							foreach ( $custom_post_categories as $cpc_key => $cpc_value ) {

								$umbg_allow_cpc_display[$cpc_key] = get_option( '_umbg_allow_cpc_' . $cpc_value ) ? true : false;
								$umbg_append_to_cpc[$cpc_key]     = get_post_meta( $post->ID, '_umbg_append_to_cpc_' . $cpc_value, true );
								$allow_cpc_display[$cpc_key]      = ( $umbg_allow_cpc_display[$cpc_key] == 1 ) ? 1 : 0;
								$append_to_cpc[$cpc_key]          = ( $umbg_append_to_cpc[$cpc_key] ) ? $umbg_append_to_cpc[$cpc_key] : 0;

								// Change titles appropriately.
								if ( $cpc_value === 'product_tag' ) {
									$cpc_title = __( 'WooCommerce Product Tags', 'umbg' );
								} else if ( $cpc_value === 'download_category' ) {
									$cpc_title = __( 'EDD Categories', 'umbg' );
								} else if ( $cpc_value === 'download_tag' ) {
									$cpc_title = __( 'EDD Tags', 'umbg' );
								} else if ( $cpc_value === 'topic-tag' ) {
									$cpc_title = __( 'bbPress Tags', 'umbg' );
								} else if ( $cpc_value === 'topic_tag' ) {
									$cpc_title = __( 'bbPress Tags', 'umbg' );
								} else {
									$cpc_title = 'CPC: ' . $cpc_value;
								}

								$cpc_title_id = str_replace( ' ', '-', $cpc_title );
								$cpc_title_id = str_replace( ':', '', $cpc_title_id );
								$cpc_title_id = strtolower( $cpc_title_id );

								// Display select list.
								if ( $allow_cpc_display[$cpc_key] ) {
									?>

									<div id="<?php echo $cpc_title_id; ?>">
										<div class="umbg-append-to-<?php echo $cpc_value; ?>-title title">
											<i class="dropdown icon"></i><?php echo $cpc_title; ?>
										</div>
										<div class="umbg-container-for-select content">

											<select id="umbg-append-to-<?php echo $cpc_value; ?>" class="umbg-form-control umbg-select"
													name="umbg-append-to-<?php echo $cpc_value; ?>[]" multiple size="5">
												<?php

												$cat_args = array(
													'type'         => 'post',
													'child_of'     => 0,
													//'parent'                   => '',
													'orderby'      => 'name',
													'order'        => 'ASC',
													'hide_empty'   => 0,
													'hierarchical' => 1,
													//'exclude'                  => '',
													//'include'                  => '',
													//'number'                   => '',
													'taxonomy'     => $cpc_value,
													'pad_counts'   => false

												);

												$cpc_arr = get_categories( $cat_args );
												foreach ( $cpc_arr as $cpc ) {
													$selected_post = ( is_array( $append_to_cpc[$cpc_key] ) &&
														in_array( $cpc->term_id, $append_to_cpc[$cpc_key] ) ) ?
														'selected="selected"' : '';
													$option        = '<option value="' . absint( $cpc->term_id ) .
														'" ' . esc_attr( $selected_post ) . ' >' .
														esc_html( $cpc->name ) . '</option>';
													echo $option;
												}
												?>
											</select>

										</div>
									</div>
								<?php }; ?>

							<?php }; ?>


							<?php

							// Display custom post types.
							$umbg_custom_post_types = umbg_get_custom_post_types();
							asort( $umbg_custom_post_types );

							foreach ( $umbg_custom_post_types as $cpt_key => $cpt_value ) {

								$umbg_allow_cpt_display[$cpt_key] = get_option( '_umbg_allow_cpt_' . $cpt_value ) ? true : false;
								$umbg_append_to_cpt[$cpt_key]     = get_post_meta( $post->ID, '_umbg_append_to_cpt_' . $cpt_value, true );
								$allow_cpt_display[$cpt_key]      = ( $umbg_allow_cpt_display[$cpt_key] == 1 ) ? 1 : 0;
								$append_to_cpt[$cpt_key]          = ( $umbg_append_to_cpt[$cpt_key] ) ? $umbg_append_to_cpt[$cpt_key] : 0;

								// Change titles appropriately.
								if ( $cpt_value === 'download' ) {
									$cpt_title = __( 'EDD Downloads', 'umbg' );
								} else if ( $cpt_value === 'forum' ) {
									$cpt_title = __( 'bbPress Forums', 'umbg' );
								} else if ( $cpt_value === 'topic' ) {
									$cpt_title = __( 'bbPress Topics', 'umbg' );
								} else {
									$cpt_title = 'CPT: ' . $cpt_value;
								}

								$cpt_title_id = str_replace( ' ', '-', $cpt_title );
								$cpt_title_id = str_replace( ':', '', $cpt_title_id );
								$cpt_title_id = strtolower( $cpt_title_id );

								// Display select list.
								if ( $allow_cpt_display[$cpt_key] ) {
									?>
									<div id="<?php echo $cpt_title_id; ?>">
										<div class="umbg-append-to-<?php echo $cpt_value; ?>-title title">
											<i class="dropdown icon"></i><?php echo $cpt_title; ?>
										</div>
										<div class="umbg-container-for-select content">

											<select id="umbg-append-to-<?php echo $cpt_value; ?>" class="umbg-form-control umbg-select"
													name="umbg-append-to-<?php echo $cpt_value; ?>[]" multiple size="5">
												<?php

												$arg1 = array(
													'posts_per_page'   => - 1,
													'offset'           => 0,
													//'category'         => '',
													//'category_name'    => '',
													'orderby'          => 'title',
													'order'            => 'ASC',
													//'include'          => '',
													//'exclude'          => '',
													//'meta_key'         => '',
													//'meta_value'       => '',
													'post_type'        => $cpt_value,
													//'post_mime_type'   => '',
													//'post_parent'      => '',
													//'author'	   => '',
													'post_status'      => 'publish',
													'suppress_filters' => true
												);

												$cpt_arr = get_posts( $arg1 );
												foreach ( $cpt_arr as $cpt ) {
													$selected_post = ( is_array( $append_to_cpt[$cpt_key] ) &&
														in_array( $cpt->ID, $append_to_cpt[$cpt_key] ) ) ?
														'selected="selected"' : '';
													$option        = '<option value="' . absint( $cpt->ID ) . '" ' .
														esc_attr( $selected_post ) . ' >' .
														esc_html( $cpt->post_title ) . '</option>';
													echo $option;
												}
												?>
											</select>

										</div>
									</div>

								<?php }; ?>

							<?php }; ?>

							<?php if ( $allow_page_display ) : ?>

								<div id="page">
									<div class="umbg-append-to-page-title title">
										<i class="dropdown icon"></i><?php _e( 'Pages', 'umbg' ); ?>
									</div>
									<div class="umbg-container-for-select content">

										<select id="umbg-append-to-page" class="umbg-form-control umbg-select"
												name="umbg-append-to-page[]" multiple size="5">
											<option value="home-wp-default" <?php echo ( is_array( $append_to_page ) &&
												in_array( 'home-wp-default', $append_to_page ) ) ? 'selected="selected"' : '' ?> >
												<?php _e( 'Home Page - WP Default', 'umbg' ); ?>
											</option>
											<?php

											//$pages = get_pages( 'sort_order=ASC&post_type=page' );
											$pages_args = array(
												'sort_order'   => 'asc',
												'sort_column'  => 'post_title',
												'hierarchical' => 1,
												'child_of'     => 0,
												'parent'       => - 1,
												'offset'       => 0,
												'post_type'    => 'page',
												'post_status'  => 'publish'
											);

											$pages = get_pages( $pages_args );

											foreach ( $pages as $page ) {
												$selected_page = ( is_array( $append_to_page ) && in_array(
														$page->ID,
														$append_to_page
													) ) ? 'selected="selected"' : '';
												$option        = '<option value="' . absint( $page->ID ) . '" ' .
													esc_attr( $selected_page ) . ' >' . esc_html( $page->post_title ) .
													'</option>';
												echo $option;
											}
											?>
										</select>

									</div>
								</div>

							<?php endif; ?>

							<?php if ( $allow_post_display ) : ?>
								<div id="post">
									<div class="umbg-append-to-post-title title">
										<i class="dropdown icon"></i><?php _e( 'Posts', 'umbg' ); ?>
									</div>
									<div class="umbg-container-for-select content">

										<select id="umbg-append-to-post" class="umbg-form-control umbg-select"
												name="umbg-append-to-post[]" multiple size="5">
											<?php

											//$posts = get_posts( 'numberposts=-1&orderby=title&order=ASC' );
											$post_args_type = array( 'post' );

											$post_args = array(
												'posts_per_page' => - 1,
												//'offset'           => 0,
												//'category'         => '',
												//'category_name'    => '',
												'orderby'        => 'title',
												'order'          => 'ASC',
												//'include'          => '',
												//'exclude'          => '',
												//'meta_key'         => '',
												//'meta_value'       => '',
												'post_type'      => $post_args_type,
												//'post_mime_type'   => '',
												//'post_parent'      => '',
												//'author'           => '',
												'post_status'    => 'publish',
												//'numberposts'      => -1
												//'suppress_filters' => true
											);

											$posts = get_posts( $post_args );
											foreach ( $posts as $p ) {
												$selected_post = ( is_array( $append_to_post ) &&
													in_array( $p->ID, $append_to_post ) ) ? 'selected="selected"' : '';
												$option        = '<option value="' . absint( $p->ID ) . '" ' .
													esc_attr( $selected_post ) . ' >' . esc_html( $p->post_title ) . '</option>';
												echo $option;
											}
											?>
										</select>

									</div>
								</div>

							<?php endif; ?>

							<?php if ( class_exists( 'WooCommerce' ) ) : ?>

								<?php if ( $allow_wc_category_display ) : ?>

									<div id="wc-category">

										<div class="umbg-append-to-wc-category-title title">
											<i class="dropdown icon"></i><?php _e( 'WooCommerce Categories', 'umbg' ); ?>
										</div>
										<div class="umbg-container-for-select content">
											<select id="umbg-append-to-wc-category" class="umbg-form-control umbg-select"
													name="umbg-append-to-wc-category[]" multiple size="5">
												<?php

												$taxonomy_cats = array( 'product_cat' );

												$cat_args = array(
													//'type'                     => 'post',
													'child_of'     => 0,
													//'parent'                   => '',
													'orderby'      => 'name',
													'order'        => 'ASC',
													'hide_empty'   => 0,
													'hierarchical' => 1,
													'taxonomy'     => $taxonomy_cats,
													'pad_counts'   => false

												);

												$wc_categories = get_categories( $cat_args );
												foreach ( $wc_categories as $wccat ) {
													$selected_wc_cat = ( is_array( $append_to_wc_category ) &&
														in_array( $wccat->term_id, $append_to_wc_category ) ) ?
														'selected="selected"' : '';
													$option          = '<option value="' . absint( $wccat->term_id ) .
														'" ' . esc_attr( $selected_wc_cat ) . ' >' .
														esc_html( $wccat->name ) . '</option>';
													echo $option;
												}
												?>
											</select>
										</div>
									</div>
								<?php endif; ?>

								<?php if ( $allow_wc_product_display ) : ?>

									<div id="wc-product">
										<div class="umbg-append-to-wc-product-title title">
											<i class="dropdown icon"></i><?php _e( 'WooCommerce Products', 'umbg' ); ?>
										</div>
										<div class="umbg-container-for-select content">

											<select id="umbg-append-to-wc-product" class="umbg-form-control umbg-select"
													name="umbg-append-to-wc-product[]" multiple size="5">
												<?php

												$post_args_type = array( 'product' );

												$post_args = array(
													'posts_per_page' => - 1,
													//'offset'           => 0,
													//'category'         => '',
													//'category_name'    => '',
													'orderby'        => 'title',
													'order'          => 'ASC',
													'post_type'      => $post_args_type,
													'post_status'    => 'publish',
													//'numberposts'      => -1
													//'suppress_filters' => true
												);

												$wc_products = get_posts( $post_args );
												foreach ( $wc_products as $wcp ) {
													$selected_wc_product = ( is_array( $append_to_wc_product ) &&
														in_array( $wcp->ID, $append_to_wc_product ) ) ? 'selected="selected"' : '';
													$option              = '<option value="' . absint( $wcp->ID ) .
														'" ' . esc_attr( $selected_wc_product ) . ' >' .
														esc_html( $wcp->post_title ) . '</option>';
													echo $option;
												}
												?>
											</select>

										</div>
									</div>

								<?php endif; ?>

							<?php endif; ?>

						</div>

						<p class="description">
							<br /><?php echo sprintf( __( 'Note: Priority Level (PL) determines which background media will play when Authors, Categories, Posts, Pages, or other Custom Post Types are selected. Check your <a href="%1$s">%2$s Settings</a> for your priority levels.', 'umbg' ), get_admin_url( null, 'edit.php?post_type=umbg_post_type&page=umbg-settings' ), UMBG_SHORT ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="umbg-media-player-type"><?php _e( 'Media Type', 'umbg' ); ?></label>
					</th>
					<td>
						<select id="umbg-media-player-type" name="umbg-media-player-type">
							<option value="youtube" <?php echo esc_attr( $media_player_yt ); ?> >YouTube</option>
							<option value="vimeo" <?php echo esc_attr( $media_player_v ); ?> >Vimeo</option>
							<option value="dailymotion" <?php echo esc_attr( $media_player_dm ); ?> >Dailymotion
							</option>
							<option value="wistia" <?php echo esc_attr( $media_player_w ); ?> >Wistia
							</option>
							<option value="html5" <?php echo esc_attr( $media_player_h5 ); ?> >HTML5</option>
							<option value="image" <?php echo esc_attr( $media_player_i ); ?> >Image</option>
							<option value="color" <?php echo esc_attr( $media_player_c ); ?> >Color</option>

						</select>
					</td>
				</tr>
				<tr id="umbg-media-id-row">
					<th scope="row">
						<label id="umbg-media-id-label"
							   for="umbg-media-id"><?php _e( 'Video Id or Location', 'umbg' ); ?><span
								class="description"><?php _e( '(required)', 'umbg' ); ?></span></label>
					</th>
					<td>
						<input id="umbg-media-id" class="regular-text" type="text" name="umbg-media-id"
							   value="<?php echo esc_attr( $media_id ); ?>" />

						<input id="umbg-media-id-button" class="button" name="umbg-media-id-button" type="button"
							   value="<?php esc_html_e( 'Select Video', 'umbg' ); ?>" />
						<input id="umbg-image-id-button" class="button" name="umbg-image-id-button" type="button"
							   value="<?php esc_html_e( 'Select Images', 'umbg' ); ?>" style="display: none;" />

						<input id="umbg-media-id-attachment-id" name="umbg-media-id-attachment-id" type="hidden"
							   value="<?php echo esc_attr( $media_id_attachment_id ); ?>" />

						<p id="umbg-media-id-description"
						   class="description"><?php _e( 'Enter the video ID only. For most video hosting sites the video id is at the end of the url where the video is hosted.', 'umbg' ); ?>'</p>

						<?php if ( $umbg_show_previews ) : ?>
							<div id="umbg-media-preview" class="clearfix"></div>
						<?php endif; ?>
					</td>
				</tr>

				<tr id="umbg-media-poster-row">
					<th scope="row">
						<label for="umbg-media-poster"><?php _e( 'Poster', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-media-poster" class="regular-text" type="text" name="umbg-media-poster"
							   value="<?php echo esc_html( $media_poster ); ?>" />
						<input id="umbg-media-poster-button" class="button" name="umbg-media-poster-button"
							   type="button" value="<?php esc_html_e( 'Select Poster', 'umbg' ); ?>" />
						<a id="umbg-media-poster-button-remove" href="#" class="submitbox submitdelete"
						   style="margin-left: 20px;"><?php _e( 'Remove Poster', 'umbg' ); ?></a>
						<input id="umbg-media-poster-attachment-id" name="umbg-media-poster-attachment-id" type="hidden"
							   value="<?php echo absint( $media_poster_attachment_id ); ?>" />

						<p class="description"><?php echo sprintf( __( 'Enter the video\'s poster location <b>with</b> the file extension: i.e. http://mywebsite.com/myvideoposter.jpg. %s uses the poster to display it to mobile devices instead of the video since they don\'t support auto playback. If you 	leave it blank it will display the page\'s background color.', 'umbg' ), UMBG_SHORT ); ?></p>
						<?php if ( $umbg_show_previews ) : ?>
							<div id="umbg-poster-preview" class="clearfix"></div>
						<?php endif; ?>
					</td>
				</tr>

				<tr id="umbg-overlay-row">
					<th scope="row"><?php _e( 'Overlay', 'umbg' ); ?></th>
					<td>
						<fieldset class="umbg-overlay-style-list" id="umbg-overlay-style-picker">
							<legend class="screen-reader-text"><span><?php _e( 'Overlay', 'umbg' ); ?></span></legend>

							<label for="umbg-overlay" style="display: block; padding-bottom: 15px;">
								<input id="umbg-overlay" type="checkbox" name="umbg-overlay"
									   value="1" <?php echo esc_attr( $overlay ); ?> />
								<?php _e( 'Display overlay.', 'umbg' ); ?>
							</label>


							<label for="umbg-overlay-css"><?php _e( 'Pattern:', 'umbg' ); ?> </label>
							<select id="umbg-overlay-css" name="umbg-overlay-css">
								<?php
								asort( $overlay_styles );
								foreach ( $overlay_styles as $style ) {
									if ( $overlay_css == $style['class'] ) {
										$overlay_selected = 'selected';
									} else {
										$overlay_selected = '';
									}

									?>
									<option value="<?php echo esc_html( $style['class'] ); ?>" <?php echo esc_attr( $overlay_selected ); ?> >
										<?php echo esc_html( $style['name'] ); ?>
									</option>
									<?php
								}
								?>
							</select>
							<br />
							<br />
							<label for="umbg-overlay-color"><?php _e( 'Color & Opacity:', 'umbg' ); ?> </label>
							<input id="umbg-overlay-color" class="small-text" type="text" name="umbg-overlay-color"
								   value="<?php echo esc_html( $overlay_color ); ?>" />
							<input class="umbg-overlay-color-default button" type="button"
								   value="<?php esc_attr_e( 'Default', 'umbg' ); ?>" />

							<p class="description"><?php _e( 'A preview of the overlay pattern can be seen on the preview video/poster. The pattern is <b>not</b> scaled to match the preview video/poster dimensions, it is at a size that you can preview the pattern.', 'umbg' ); ?></p>
						</fieldset>
					</td>
				</tr>

				<tr id="umbg-media-link-row">
					<th scope="row">
						<label for="umbg-media-link"><?php _e( 'Media Link URL', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-media-link" class="regular-text" type="text" name="umbg-media-link"
							   value="<?php echo esc_html( $media_link ); ?>" />

						<select id="umbg-media-link-target" name="umbg-media-link-target">
							<option value="_blank" <?php echo esc_attr( $media_link_target_blank ); ?>>Open in new window</option>
							<option value="_self" <?php echo esc_attr( $media_link_target_self ); ?>>Open in same window</option>
						</select>

						<p class="description"><?php _e( 'Enter the URL to link the media background too and select to open the link in a new window or the same window.', 'umbg' ); ?></p>

					</td>
				</tr>

				<tr id="umbg-quality-row">
					<th scope="row">
						<label for="umbg-quality"><?php _e( 'Quality', 'umbg' ); ?> </label>
					</th>
					<td>
						<select id="umbg-quality" name="umbg-quality">

							<!-- YouTube -->
							<optgroup label="--- YouTube ---"></optgroup>
							<option value="default" <?php echo esc_attr( $video_quality_yt_d ); ?>>Auto</option>
							<option value="highres" <?php echo esc_attr( $video_quality_yt_hr ); ?>>HD > 1080p</option>
							<option value="hd1080" <?php echo esc_attr( $video_quality_yt_1080 ); ?>>HD 1080p</option>
							<option value="hd720" <?php echo esc_attr( $video_quality_yt_720 ); ?>>HD 720p</option>
							<option value="large" <?php echo esc_attr( $video_quality_yt_large ); ?>>480p</option>
							<option value="medium" <?php echo esc_attr( $video_quality_yt_medium ); ?>>360p</option>
							<option value="small" <?php echo esc_attr( $video_quality_yt_small ); ?>>240p</option>

							<!-- Vimeo -->
							<optgroup label="--- Vimeo ---"></optgroup>
							<option value="0" <?php echo esc_attr( $video_quality_v_d ); ?>>Default</option>
							<option value="1" <?php echo esc_attr( $video_quality_v_hd ); ?>>HD</option>

							<!-- Dailymotion -->
							<optgroup label="--- Dailymotion ---"></optgroup>
							<option value="" <?php echo esc_attr( $video_quality_dm_d ); ?>>Auto</option>
							<option value="240" <?php echo esc_attr( $video_quality_dm_240 ); ?>>240</option>
							<option value="380" <?php echo esc_attr( $video_quality_dm_380 ); ?>>380</option>
							<option value="480" <?php echo esc_attr( $video_quality_dm_480 ); ?>>480</option>
							<option value="720" <?php echo esc_attr( $video_quality_dm_720 ); ?>>HD 720</option>
							<option value="1080" <?php echo esc_attr( $video_quality_dm_1080 ); ?>>HD 1080</option>

							<!-- Wistia -->
							<optgroup label="--- Wistia ---"></optgroup>
							<option value="auto" <?php echo esc_attr( $video_quality_w_d ); ?>>Auto</option>
							<option value="sd-only" <?php echo esc_attr( $video_quality_w_sd ); ?>>Standard</option>
							<option value="md" <?php echo esc_attr( $video_quality_w_md ); ?>>Medium</option>
							<option value="hd-only" <?php echo esc_attr( $video_quality_w_hd ); ?>>HD</option>

						</select>
						<input type="hidden" id="umbg-quality-selected"
							   value="<?php echo esc_html( $umbg_video_quality ); ?>" />

						<p class="description"><?php _e( 'Force a particular playback quality. Auto is recommended because it tries to select the most appropriate playback quality for the user\'s environment. Most video hosting services adjusts the quality of your video stream by the speed of your Internet connection (bandwidth), video player size, and the original video quality.', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-wistia-tracking-row">
					<th scope="row"><?php _e( 'Track Views', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Track Views', 'umbg' ); ?></span>
							</legend>
							<label for="umbg-wistia-tracking">
								<input id="umbg-wistia-tracking" type="checkbox" name="umbg-wistia-tracking"
									   value="0" <?php echo esc_attr( $wistia_tracking ); ?> />
								<?php _e( 'Allow Wistia to track views of this video.', 'umbg' ); ?></label><br>

							<p class="description"><?php _e( 'Views are tracked by Wistia and are accessible on your Wistia account.', 'umbg' ); ?></p>
						</fieldset>
					</td>
				</tr>

				<tr id="umbg-autoplay-row">
					<th scope="row"><?php _e( 'Autoplay', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Autoplay', 'umbg' ); ?></span>
							</legend>
							<label for="umbg-autoplay">
								<input id="umbg-autoplay" type="checkbox" name="umbg-autoplay"
									   value="1" <?php echo esc_attr( $autoplay ); ?> />
								<?php _e( 'Automatically play the media.', 'umbg' ); ?></label><br>

							<p class="description"><?php _e( 'Recommended to autoplay the media.', 'umbg' ); ?></p>
						</fieldset>
					</td>
				</tr>

				<tr id="umbg-start-at-row">
					<th scope="row">
						<label for="umbg-start-at"><?php _e( 'Start At', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-start-at" class="small-text" type="number" step="0.25" name="umbg-start-at" min="0"
							   value="<?php echo abs( $start_at ); ?>" size="2" />
						<span><?php _e( 'sec.', 'umbg' ); ?></span>
					</td>
				</tr>

				<tr id="umbg-endat-row">
					<th scope="row">
						<label for="umbg-end-at"><?php _e( 'End At', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-end-at" class="small-text" type="number" step="0.25" name="umbg-end-at" min="0"
							   value="<?php echo abs( $end_at ); ?>" size="2" />
						<span><?php _e( 'sec.', 'umbg' ); ?></span>
					</td>
				</tr>

				<tr id="umbg-image-duration-row">
					<th scope="row">
						<label for="umbg-image-duration"><?php _e( 'Image Display Duration', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-image-duration" class="small-text" type="number" name="umbg-image-duration"
							   min="500" step="100" value="<?php echo absint( $duration ); ?>" size="2" />
						<span><?php _e( 'ms.', 'umbg' ); ?></span>

						<p class="description"><?php _e( 'Enter the display duration for each image. (1000 ms. = 1 sec.)', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-image-transition-duration-row">
					<th scope="row">
						<label for="umbg-image-transition-duration"><?php _e( 'Image Transition Duration', 'umbg' );
							?></label>
					</th>
					<td>
						<input id="umbg-image-transition-duration" class="small-text" type="number" name="umbg-image-transition-duration"
							   min="0" step="100" value="<?php echo absint( $transition ); ?>" size="2" />
						<span><?php _e( 'ms.', 'umbg' ); ?></span>

						<p class="description"><?php _e( 'Enter the transition duration for the fading effect between images. Should not be more than the <strong>Image Display Duration</strong> value, you can create some nice effects by going over a little but the play/pause functionally will not function as expected. (1000 ms. = 1 sec.)', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-image-effect-row">
					<th scope="row">
						<label for="umbg-image-effect"><?php _e( 'Image Effect', 'umbg' ); ?></label>
					</th>
					<td>
						<select id="umbg-image-effect" name="umbg-image-effect">
							<option value="random" <?php echo esc_attr( $effect_r ); ?>>Random</option>
							<option value="fade" <?php echo esc_attr( $effect_f ); ?>>Fade</option>
							<option value="panLeft" <?php echo esc_attr( $effect_pl ); ?>>Pan Left</option>
							<option value="panRight" <?php echo esc_attr( $effect_pr ); ?>>Pan Right</option>
							<option value="panUp" <?php echo esc_attr( $effect_pu ); ?>>Pan Up</option>
							<option value="panDown" <?php echo esc_attr( $effect_pd ); ?>>Pan Down</option>
							<option value="zoomIn" <?php echo esc_attr( $effect_zi ); ?>>Zoom In</option>
							<option value="zoomOut" <?php echo esc_attr( $effect_zo ); ?>>Zoom Out</option>
						</select>

						<p class="description"><?php _e( 'Animation effect used while displaying the image.', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-image-easing-row">
					<th scope="row">
						<label for="umbg-image-easing"><?php _e( 'Image Effect Easing', 'umbg' ); ?></label>
					</th>
					<td>
						<select id="umbg-image-easing" name="umbg-image-easing">
							<option value="ease-in-out" <?php echo esc_attr( $easing_eio );
							?>>Ease-In-Out
							</option>
							<option value="ease" <?php echo esc_attr( $easing_e ); ?>>Ease</option>
							<option value="ease-in" <?php echo esc_attr( $easing_ei ); ?>>Ease In</option>
							<option value="ease-out" <?php echo esc_attr( $easing_eo ); ?>>Ease Out</option>
							<option value="linear" <?php echo esc_attr( $easing_l ); ?>>Linear</option>
						</select>

						<p class="description"><?php _e( 'Effect easing type for animations.', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label
							for="umbg-delay-by"><?php echo sprintf( __( 'Delay Displaying %s By', 'umbg' ), UMBG_SHORT ); ?></label>
					</th>
					<td>
						<input id="umbg-delay-by" class="small-text" type="number" name="umbg-delay-by" min="0"
							   max="300000"
							   value="<?php echo esc_html( $delay_by ); ?>" size="3" /> ms.
						<p class="description"><?php _e( '(1000 ms. = 1 sec.)', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-loop-row">
					<th scope="row"><?php _e( 'Loop', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Loop', 'umbg' ); ?></span></legend>
							<label for="umbg-loop">
								<input id="umbg-loop" type="checkbox" name="umbg-loop"
									   value="1" <?php echo esc_attr( $loop ); ?> />
								<?php _e( 'Loop play.', 'umbg' ); ?></label><br>

							<label for="umbg-rewind-to-start-at">
								<input id="umbg-rewind-to-start-at" type="checkbox" name="umbg-rewind-to-start-at"
									   value="1" <?php echo esc_attr( $rewind_to_start_at ); ?> />
								<?php _e( 'Rewind to Start At time.', 'umbg' ); ?></label><br>

							<label for="umbg-mefo">
								<input id="umbg-mefo" type="checkbox" name="umbg-mefo"
									   value="1" <?php echo esc_attr( $mefo ); ?> />
								<?php _e( 'Media End Fade-Out.', 'umbg' ); ?></label><br>

							<p class="description"><?php _e( 'You can choose to loop the media or rewind it to the beginning when it stops by using <strong>Rewind To StartAt time</strong>. You can also choose <strong>Media End Fade-Out</strong> to allow for the media to be faded out once playback has ended.', 'umbg' ); ?></p>
						</fieldset>
					</td>
				</tr>

				<tr id="umbg-audio-row">
					<th scope="row"><?php _e( 'Audio', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Audio', 'umbg' ); ?></span></legend>
							<label for="umbg-audio">
								<input id="umbg-audio" type="checkbox" name="umbg-audio"
									   value="1" <?php echo esc_attr( $audio ); ?> />
								<?php _e( 'Play with audio.', 'umbg' ); ?></label><br>


							<label for="umbg-start-audio-muted">
								<input id="umbg-start-audio-muted" type="checkbox" name="umbg-start-audio-muted"
									   value="1" <?php echo esc_attr( $start_audio_muted ); ?> />
								<?php _e( 'Start playing with audio muted.', 'umbg' ); ?></label><br>

						</fieldset>
					</td>
				</tr>

				<tr id="umbg-volume-row">
					<th scope="row">
						<label for="umbg-volume"><?php _e( 'Volume Level', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-volume" name="umbg-volume" type="range" min="1" max="100"
							   value="<?php echo absint( $volume_level ); ?>">
						<output for="umbg-volume" id="umbg-volume-output"
								class="umbg-rangeslider-output"><?php echo absint( $volume_level ); ?></output>

						<p class="description"><?php _e( 'Adjust volume level.', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-controls-row">
					<th scope="row"><?php _e( 'Display Controls', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Display Controls', 'umbg' ); ?></span>
							</legend>
							<label for="umbg-controls">
								<input id="umbg-controls" type="checkbox" name="umbg-controls"
									   value="1" <?php echo esc_attr( $controls ); ?> />
								<?php echo sprintf( __( 'Display %2$s, %1$s, play, &amp; audio buttons.', 'umbg' ), 'PUD', 'FIO' ); ?>
							</label><br>
						</fieldset>
					</td>
				</tr>

				<?php if ( $umbg_allow_pud ) : ?>
					<tr id="umbg-pud-row">
						<th scope="row"><?php echo sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php echo sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ); ?></span>
								</legend>
								<label for="umbg-pud">
									<input id="umbg-pud" type="checkbox" name="umbg-pud"
										   value="1" <?php echo esc_attr( $pud ); ?> />
									<?php echo sprintf( __( 'Play media with %s.', 'umbg' ), 'PUD' ); ?></label><br />

								<label for="umbg-pud-down">
									<input id="umbg-pud-down" type="checkbox" name="umbg-pud-down"
										   value="1" <?php echo esc_attr( $pud_down ); ?> />
									<?php echo sprintf( __( 'Start with %s down.', 'umbg' ), 'PUD' ); ?></label><br />

								<label for="umbg-pud-up">
									<input id="umbg-pud-up" type="checkbox" name="umbg-pud-up"
										   value="1" <?php echo esc_attr( $pud_up ); ?> />
									<?php echo sprintf( __( 'End with %s up.', 'umbg' ), 'PUD' ); ?></label><br />

								<label for="umbg-pud-show"><?php _e( 'How much to show of page when down', 'umbg' ); ?>
									<input id="umbg-pud-show" class="small-text" type="number" name="umbg-pud-show"
										   min="0" max="30000"
										   value="<?php echo esc_html( $pud_show ); ?>" size="3" /> px.
								</label>

								<p class="description"><?php echo sprintf( __( '%1$s allows the page to be scroll up and down to have a better view of the video; i.e. you can use this feature with a marketing video. <b>Start with %1$s down:</b> the page will scroll down when the media playback starts. <b>End with %1$s up:</b> the page will automaticaly scroll up when the media playback ends or the first loop ends. Use <b>"How much to show..."</b> to keep part of the page in view such as the logo and navigation during the %1$s down status.' ), 'PUD' ); ?>
								</p>
							</fieldset>
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( $umbg_allow_fio ) : ?>
					<tr id="umbg-fio-row">
						<th scope="row"><?php echo sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php echo sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ); ?></span>
								</legend>
								<label for="umbg-fio">
									<input id="umbg-fio" type="checkbox" name="umbg-fio"
										   value="1" <?php echo esc_attr( $fio ); ?> />
									<?php echo sprintf( __( 'Play media with %s.', 'umbg' ), 'FIO' ); ?></label><br />

								<label for="umbg-fio-start">
									<input id="umbg-fio-start" type="checkbox" name="umbg-fio-start"
										   value="1" <?php echo esc_attr( $fio_start ); ?> />
									<?php echo sprintf( __( 'Fade-Out on start.', 'umbg' ), 'FIO' ); ?></label><br />

								<label for="umbg-fio-end">
									<input id="umbg-fio-end" type="checkbox" name="umbg-fio-end"
										   value="1" <?php echo esc_attr( $fio_end ); ?> />
									<?php echo sprintf( __( 'Fade-In on end.', 'umbg' ), 'FIO' ); ?></label><br />

								<label for="umbg-fio-opacity"><?php _e( 'Opacity ', 'umbg' ); ?></label>

								<input id="umbg-fio-opacity" name="umbg-fio-opacity" type="range" min="0" max="1"
									   step="0.1"
									   value="<?php echo esc_html( $fio_opacity ); ?>">
								<output for="umbg-fio-opacity" id="umbg-fio-output"
										class="umbg-rangeslider-output"><?php echo esc_html( $fio_opacity ); ?></output>

								<p class="description"><?php echo sprintf( __( '%1$s lets you set an opacity (transparency) effect for a better view of the media background. <strong>Fade-Out on start:</strong> the page HTML element will fade out when the media playback starts. <strong>Fade-In on end:</strong> the page HTML element will fade in when the media playback ends or the first loop ends. Use Opacity to set the amount of opacity for the page HTML element. Use <b>Opacity</b> to set the amount of opacity for the page HTML element. You must set the FIO HTML Element in <a href="%2$s">%3$s Settings</a> for FIO to work.', 'umbg' ), 'FIO', get_admin_url( null, 'edit.php?post_type=umbg_post_type&page=umbg-settings' ), UMBG_SHORT ); ?>
								</p>
							</fieldset>
						</td>
					</tr>
				<?php endif; ?>

				<tr id="umbg-enlarge-by-row">
					<th scope="row">
						<label for="umbg-enlarge-by"><?php _e( 'Enlarge Media By', 'umbg' ); ?></label>
					</th>
					<td>
						<input id="umbg-enlarge-by" name="umbg-enlarge-by" type="range" min="0" max="50"
							   value="<?php echo absint( $enlarge_by ); ?>">
						<output for="umbg-enlarge-by" id="umbg-enlarge-by-output"
								class="umbg-rangeslider-output"><?php echo absint( $enlarge_by ); ?>%
						</output>
						<p class="description"><?php _e( 'Use with caution, enlarge only what is necessary. Useful for hosted videos such as YouTube and Vimeo to hide unwanted objects. Remember that the more you enlarge the media the more chances it may lead to choppy playback.', 'umbg' ); ?></p>
					</td>
				</tr>

				<tr id="umbg-aspect-ratio-row">
					<th scope="row">
						<label for="umbg-aspect-ratio"><?php _e( 'Aspect Ratio', 'umbg' ); ?></label>
					</th>
					<td>
						<select id="umbg-aspect-ratio" name="umbg-aspect-ratio">
							<option value="1.778" <?php echo esc_attr( $media_aspect_ratio_16_9 ); ?> >16:9</option>
							<option value="1.333" <?php echo esc_attr( $media_aspect_ratio_4_3 ); ?> >4:3</option>
							<option value="1.90" <?php echo esc_attr( $media_aspect_ratio_19_10 ); ?> >19:10</option>
							<option value="2.333" <?php echo esc_attr( $media_aspect_ratio_21_9 ); ?> >21:9</option>
							<option value="2.370" <?php echo esc_attr( $media_aspect_ratio_64_27 ); ?> >64:27</option>
							<!--
							1:1
							4:3
							16:9
							16:10
							2.21:1
							2.35:1
							2.39:1
							5:4
							-->
						</select>

						<p class="description"><?php _e( 'Select proper media aspect ratio, this affects the way the media will be displayed and re-sized.', 'umbg' ); ?></p>
					</td>
				</tr>
				</tbody>
			</table>

		</form>
	</div>
	<!-- End - UMBG HTML Page -->
	<?php
}

/**
 * Check & save UMBG Custom Post Type Meta Box settings.
 *
 * @param int $post_id
 */
function umbg_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['umbg_meta_box_nonce_field'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['umbg_meta_box_nonce_field'], 'umbg_meta_box_post_save' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'umbg_post_type' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_pages', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Variables
	$umbg_append_to_author           = ( $_POST['umbg-append-to-author'] );
	$umbg_append_to_category         = ( $_POST['umbg-append-to-category'] );
	$umbg_append_to_post             = ( $_POST['umbg-append-to-post'] );
	$umbg_append_to_page             = ( $_POST['umbg-append-to-page'] );
	$umbg_append_to_wc_category      = ( $_POST['umbg-append-to-wc-category'] );
	$umbg_append_to_wc_product       = ( $_POST['umbg-append-to-wc-product'] );
	$umbg_media_player_type          = ( $_POST['umbg-media-player-type'] );
	$umbg_media_id                   = ( $_POST['umbg-media-id'] );
	$umbg_media_id_attachment_id     = ( $_POST['umbg-media-id-attachment-id'] );
	$umbg_media_link                 = ( $_POST['umbg-media-link'] );
	$umbg_media_link_target          = ( $_POST['umbg-media-link-target'] );
	$umbg_media_poster               = ( $_POST['umbg-media-poster'] );
	$umbg_media_poster_attachment_id = ( $_POST['umbg-media-poster-attachment-id'] );
	$umbg_quality                    = ( $_POST['umbg-quality'] );
	$umbg_loop                       = ( $_POST['umbg-loop'] );
	$umbg_wistia_tracking            = ( $_POST['umbg-wistia-tracking'] );
	$umbg_autoplay                   = ( $_POST['umbg-autoplay'] );
	$umbg_rewind_to_start_at         = ( $_POST['umbg-rewind-to-start-at'] );
	$umbg_start_at                   = ( $_POST['umbg-start-at'] );
	$umbg_end_at                     = ( $_POST['umbg-end-at'] );
	$umbg_image_duration             = ( $_POST['umbg-image-duration'] );
	$umbg_image_transition_duration  = ( $_POST['umbg-image-transition-duration'] );
	$umbg_image_effect               = ( $_POST['umbg-image-effect'] );
	$umbg_image_easing               = ( $_POST['umbg-image-easing'] );
	$umbg_audio                      = ( $_POST['umbg-audio'] );
	$umbg_start_audio_muted          = ( $_POST['umbg-start-audio-muted'] );
	$umbg_volume                     = ( $_POST['umbg-volume'] );
	$umbg_controls                   = ( $_POST['umbg-controls'] );
	$umbg_pud                        = ( $_POST['umbg-pud'] );
	$umbg_pud_down                   = ( $_POST['umbg-pud-down'] );
	$umbg_pud_up                     = ( $_POST['umbg-pud-up'] );
	$umbg_pud_show                   = ( $_POST['umbg-pud-show'] );
	$umbg_fio                        = ( $_POST['umbg-fio'] );
	$umbg_fio_start                  = ( $_POST['umbg-fio-start'] );
	$umbg_fio_end                    = ( $_POST['umbg-fio-end'] );
	$umbg_fio_opacity                = ( $_POST['umbg-fio-opacity'] );
	$umbg_mefo                       = ( $_POST['umbg-mefo'] );
	$umbg_overlay                    = ( $_POST['umbg-overlay'] );
	$umbg_overlay_color              = ( $_POST['umbg-overlay-color'] );
	$umbg_overlay_css                = ( $_POST['umbg-overlay-css'] );
	$umbg_enlarge_by                 = ( $_POST['umbg-enlarge-by'] );
	$umbg_delay_by                   = ( $_POST['umbg-delay-by'] );
	$umbg_aspect_ratio               = ( $_POST['umbg-aspect-ratio'] );

	// Check if input fields are properly filled.
	if ( ! isset( $umbg_append_to_author ) ) {
		$umbg_append_to_author = '';
	}

	if ( ! isset( $umbg_append_to_category ) ) {
		$umbg_append_to_category = '';
	}

	if ( ! isset( $umbg_append_to_post ) ) {
		$umbg_append_to_post = '';
	}

	if ( ! isset( $umbg_append_to_page ) ) {
		$umbg_append_to_page = '';
	}

	if ( ! isset( $umbg_append_to_wc_category ) ) {
		$umbg_append_to_wc_category = '';
	}

	if ( ! isset( $umbg_append_to_wc_product ) ) {
		$umbg_append_to_wc_product = '';
	}

	if ( ! isset( $umbg_media_player_type ) ) {
		$umbg_media_player_type = 'color';
	}

	if ( ! isset( $umbg_media_id ) || $umbg_media_player_type == 'color' ) {
		$umbg_media_id = plugins_url( 'images/umbg-transparent-100x100.png', __FILE__ );
	}

	if ( ! isset( $umbg_media_id_attachment_id ) || $umbg_media_player_type == 'color' ) {
		$umbg_media_id_attachment_id = '';
	}

	if ( ! isset( $umbg_media_link ) ) {
		$umbg_media_link = '';
	}

	if ( ! isset( $umbg_media_link_target ) ) {
		$umbg_media_link_target = '_blank';
	}

	if ( ! isset( $umbg_media_poster ) || $umbg_media_poster == '' ) {
		$umbg_media_poster               = '';
		$umbg_media_poster_attachment_id = '';

	} elseif ( ! isset( $umbg_media_poster_attachment_id ) ) {
		$umbg_media_poster_attachment_id = '';

	}

	if ( ! isset( $umbg_quality ) || $umbg_quality == '' ) {
		if ( $umbg_media_player_type == 'html5' || $umbg_media_player_type == 'image' || $umbg_media_player_type == 'color' ) {
			$umbg_quality = '';
		} else {
			$umbg_quality = 'auto';
		}
	}

	if ( ! isset( $umbg_wistia_tracking ) ) {
		$umbg_wistia_tracking = 1;
	}

	if ( ! isset( $umbg_autoplay ) || $umbg_autoplay == '' ) {
		$umbg_autoplay = 0;
	}

	if ( ! isset( $umbg_loop ) ) {
		$umbg_loop = 0;
	}

	if ( ! isset( $umbg_rewind_to_start_at ) ) {
		$umbg_rewind_to_start_at = 0;
	}

	if ( ! isset( $umbg_mefo ) ) {
		$umbg_mefo = 0;
	}

	if ( ! isset( $umbg_start_at ) ) {
		$umbg_start_at = 0;
	}

	if ( ! isset( $umbg_end_at ) ) {
		$umbg_end_at = 0;
	}
	if ( ! isset( $umbg_image_duration ) || $umbg_image_duration == '' ) {
		$umbg_image_duration = 6000;
	} elseif ( $umbg_image_duration < 1000 ) {
		$umbg_image_duration = 1000;
	}
	if ( ! isset( $umbg_image_transition_duration ) || $umbg_image_transition_duration == '' ) {
		$umbg_image_transition_duration = 2000;
	} elseif ( $umbg_image_transition_duration < 0 ) {
		$umbg_image_transition_duration = 0;
	}
	if ( ! isset( $umbg_image_effect ) ) {
		$umbg_image_effect = 'random';
	}
	if ( ! isset( $umbg_image_easing ) ) {
		$umbg_image_easing = 'ease-in-out';
	}
	if ( ! isset( $umbg_audio ) || $umbg_audio == '' ) {
		$umbg_audio = 0;
	}

	if ( ! isset( $umbg_start_audio_muted ) || $umbg_start_audio_muted == '' ) {
		$umbg_start_audio_muted = 0;
	}

	if ( ! isset( $umbg_volume ) ) {
		$umbg_volume = get_post_meta( $post_id, '_umbg_volume', true );
	}
	if ( ! isset( $umbg_controls ) ) {
		$umbg_controls = 0;
	}

	if ( ! isset( $umbg_overlay ) ) {
		$umbg_overlay = 0;
	}

	if ( ! isset( $umbg_overlay_color ) ) {
		$umbg_overlay_color = get_post_meta( $post_id, '_umbg_overlay_color', true );
	}

	if ( ! isset( $umbg_overlay_css ) ) {
		$umbg_overlay_css = get_post_meta( $post_id, '_umbg_overlay_css', true );
	}

	if ( ! isset( $umbg_pud ) || $umbg_media_player_type == 'color' ) {
		$umbg_pud = 0;
	}
	if ( ! isset( $umbg_pud_down ) ) {
		$umbg_pud_down = 0;
	}
	if ( ! isset( $umbg_pud_up ) ) {
		$umbg_pud_up = 0;
	}

	if ( ! isset( $umbg_pud_show ) ) {
		$umbg_pud_show = 0;
	}
	if ( ! isset( $umbg_fio ) || $umbg_media_player_type == 'color' ) {
		$umbg_fio = 0;
	}
	if ( ! isset( $umbg_fio_start ) ) {
		$umbg_fio_start = 0;
	}
	if ( ! isset( $umbg_fio_end ) ) {
		$umbg_fio_end = 0;
	}
	if ( ! isset( $umbg_fio_opacity ) ) {
		$umbg_fio_opacity = 0.5;
	}

	if ( ! isset( $umbg_enlarge_by ) || $umbg_media_player_type == 'color' ) {
		$umbg_enlarge_by = 0;
	}
	if ( ! isset( $umbg_delay_by ) ) {
		$umbg_delay_by = 0;
	}

	if ( ! isset( $umbg_aspect_ratio ) ) {
		$umbg_aspect_ratio = ( 16 / 9 );
	}

	// Update the meta field in the database.
	update_post_meta( $post_id, '_umbg_append_to_author', $umbg_append_to_author );
	update_post_meta( $post_id, '_umbg_append_to_category', $umbg_append_to_category );
	update_post_meta( $post_id, '_umbg_append_to_post', $umbg_append_to_post );
	update_post_meta( $post_id, '_umbg_append_to_page', $umbg_append_to_page );
	update_post_meta( $post_id, '_umbg_append_to_wc_category', $umbg_append_to_wc_category );
	update_post_meta( $post_id, '_umbg_append_to_wc_product', $umbg_append_to_wc_product );
	update_post_meta( $post_id, '_umbg_media_player_type', $umbg_media_player_type );
	update_post_meta( $post_id, '_umbg_media_id', $umbg_media_id );
	update_post_meta( $post_id, '_umbg_media_id_attachment_id', $umbg_media_id_attachment_id );
	update_post_meta( $post_id, '_umbg_media_link', $umbg_media_link );
	update_post_meta( $post_id, '_umbg_media_link_target', $umbg_media_link_target );
	update_post_meta( $post_id, '_umbg_media_poster', $umbg_media_poster );
	update_post_meta( $post_id, '_umbg_media_poster_attachment_id', $umbg_media_poster_attachment_id );
	update_post_meta( $post_id, '_umbg_quality', $umbg_quality );
	update_post_meta( $post_id, '_umbg_wistia_tracking', $umbg_wistia_tracking );
	update_post_meta( $post_id, '_umbg_autoplay', $umbg_autoplay );
    update_post_meta( $post_id, '_umbg_loop', $umbg_loop );
	update_post_meta( $post_id, '_umbg_rewind_to_start_at', $umbg_rewind_to_start_at );
	update_post_meta( $post_id, '_umbg_mefo', $umbg_mefo );
	update_post_meta( $post_id, '_umbg_start_at', $umbg_start_at );
	update_post_meta( $post_id, '_umbg_end_at', $umbg_end_at );
	update_post_meta( $post_id, '_umbg_image_duration', $umbg_image_duration );
	update_post_meta( $post_id, '_umbg_image_transition_duration', $umbg_image_transition_duration );
	update_post_meta( $post_id, '_umbg_image_effect', $umbg_image_effect );
	update_post_meta( $post_id, '_umbg_image_easing', $umbg_image_easing );
	update_post_meta( $post_id, '_umbg_audio', $umbg_audio );
	update_post_meta( $post_id, '_umbg_start_audio_muted', $umbg_start_audio_muted );
	update_post_meta( $post_id, '_umbg_volume', $umbg_volume );
	update_post_meta( $post_id, '_umbg_controls', $umbg_controls );
	update_post_meta( $post_id, '_umbg_overlay', $umbg_overlay );
	update_post_meta( $post_id, '_umbg_overlay_color', $umbg_overlay_color );
	update_post_meta( $post_id, '_umbg_overlay_css', $umbg_overlay_css );
	update_post_meta( $post_id, '_umbg_pud', $umbg_pud );
	update_post_meta( $post_id, '_umbg_pud_down', $umbg_pud_down );
	update_post_meta( $post_id, '_umbg_pud_up', $umbg_pud_up );
	update_post_meta( $post_id, '_umbg_pud_show', $umbg_pud_show );
	update_post_meta( $post_id, '_umbg_fio', $umbg_fio );
	update_post_meta( $post_id, '_umbg_fio_start', $umbg_fio_start );
	update_post_meta( $post_id, '_umbg_fio_end', $umbg_fio_end );
	update_post_meta( $post_id, '_umbg_fio_opacity', $umbg_fio_opacity );
	update_post_meta( $post_id, '_umbg_enlarge_by', $umbg_enlarge_by );
	update_post_meta( $post_id, '_umbg_delay_by', $umbg_delay_by );
	update_post_meta( $post_id, '_umbg_aspect_ratio', $umbg_aspect_ratio );

	// Custom Post Types & Categories
	$umbg_custom_post_types      = umbg_get_custom_post_types();
	$umbg_custom_post_categories = umbg_get_custom_post_categories();

	foreach ( $umbg_custom_post_types as $cpt_key => $cpt_value ) {

		// Variable
		$umbg_append_to_cpt[$cpt_key] = ( $_POST['umbg-append-to-' . $cpt_value] );

		// Check if input fields are properly filled.
		if ( ! isset( $umbg_append_to_cpt[$cpt_key] ) ) {
			$umbg_append_to_cpt[$cpt_key] = '';
		}

		// Update the meta field in the database.
		update_post_meta( $post_id, '_umbg_append_to_cpt_' . $cpt_value, $umbg_append_to_cpt[$cpt_key] );

	}

	foreach ( $umbg_custom_post_categories as $cpc_key => $cpc_value ) {

		// Variable
		$umbg_append_to_cpc[$cpc_key] = ( $_POST['umbg-append-to-' . $cpc_value] );

		// Check if input fields are properly filled.
		if ( ! isset( $umbg_append_to_cpc[$cpc_key] ) ) {
			$umbg_append_to_cpc[$cpc_key] = '';
		}

		// Update the meta field in the database.
		update_post_meta( $post_id, '_umbg_append_to_cpc_' . $cpc_value, $umbg_append_to_cpc[$cpc_key] );

	}

}

add_action( 'save_post', 'umbg_save_meta_box_data' );


/**---------------------------------------------------------------------------------------------------------------------
 *
 * UMBG Admin Settings Page
 *
 * -------------------------------------------------------------------------------------------------------------------*/

/** Menu Pages, Links, JS, Styles, & Contextual Help
 * -------------------------------------------------------------------------------------------------------------------*/
function umbg_menu_pages() {

	// Add About UMBG page to dashboard group menu.
	$hook_suffix = add_submenu_page( 'edit.php?post_type=umbg_post_type', sprintf( __( '%s Settings', 'umbg' ), UMBG_SHORT ), __( 'Settings', 'umbg' ), 'manage_options', 'umbg-settings', 'umbg_admin_settings' );

	// Use the hook suffix to compose the hook and register an action executed when the plugin's options page is loaded.
	// Add the scripts needed on the admin settings page.
	add_action( 'load-' . $hook_suffix, 'umbg_admin_scripts' );

	// Add About UMBG page to UMBG menu.
	add_submenu_page( 'edit.php?post_type=umbg_post_type', sprintf( __( 'About %s', 'umbg' ), UMBG_SHORT ), sprintf( __( 'About %s', 'umbg' ), UMBG_SHORT ), 'edit_pages', 'umbg-about', 'umbg_about_page' );

	// Call the register settings function.
	add_action( 'admin_init', 'register_umbg_settings' );
}

function umbg_admin_scripts() {
	//Enqueue styles and scripts
	wp_enqueue_script( 'umbg-admin-script', plugins_url( 'js/umbg.admin.settings.page.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'umbg-admin-script-quicksearch', plugins_url( 'js/jquery.quicksearch.min.js', __FILE__ ), array(), '2.0.5' );
	wp_enqueue_script( 'umbg-admin-script-multi-select', plugins_url( 'js/jquery.multi-select.js', __FILE__ ), array(), '0.9.11' );
	wp_enqueue_script( 'umbg-admin-script-accordion', plugins_url( 'js/accordion.js', __FILE__ ), array(), '1.6.4' );
	wp_enqueue_script( 'umbg-admin-script-sortable', plugins_url( 'js/sortable.min.js', __FILE__ ) );
	wp_enqueue_script( 'umbg-admin-script-spectrum', plugins_url( 'js/spectrum.js', __FILE__ ) );
	wp_enqueue_style( 'umbg-admin-style', plugins_url( 'css/umbg-admin.css', __FILE__ ), array(), UMBG_VERSION );

	// Variables for custom post types.
	$umbg_custom_posts      = array();
	$umbg_custom_cats       = array();
	$custom_post_types      = umbg_get_custom_post_types();
	$custom_post_categories = umbg_get_custom_post_categories();

	// Add each custom post types.
	foreach ( $custom_post_types as $cpt_key => $cpt_value ) {
		$umbg_custom_posts[] = 'cpt_' . $cpt_value;
	}

	// Add each custom post categories.
	foreach ( $custom_post_categories as $cpc_key => $cpc_value ) {
		$umbg_custom_cats[] = 'cpc_' . $cpc_value;
	}

	// Send to JS file.
	wp_localize_script( 'umbg-admin-script', 'CustomPostTypes', $umbg_custom_posts );
	wp_localize_script( 'umbg-admin-script', 'CustomPostCats', $umbg_custom_cats );

}

// Hook for adding admin menus
add_action( 'admin_menu', 'umbg_menu_pages' );

// Include About page.
require_once dirname( __file__ ) . '/umbg-about.php';

// Admin Contextual Help
// Add tabs for contextual help text.
function umbg_settings_custom_help_tab() {

	//global $hook_suffix;

	// Return early if we're not on the UMBG post type.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( $screen->id == 'umbg_post_type_page_umbg-settings' ) {

		// Setup UMBG help tab args.
		$contextual_help = array(
			'id'      => 'umbg_global_settings', //unique id for the tab
			'title'   => __( 'Overview', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . sprintf( __( '%s Global Settings Overview', 'umbg' ), UMBG_SHORT ) . '</h3>' .
				'<p>
' . sprintf( __( 'In this screen you can change %s global settings.', 'umbg' ), UMBG_SHORT ) . '</p>' .
				'<p>' . sprintf( __( 'These settings affect all of the %s backgrounds you create, including any that have already been created.', 'umbg' ), UMBG_SHORT ) . '</p>'
		);

		$allowed = array(
			'id'      => 'umbg_allowed_to', //unique id for the tab
			'title'   => __( 'Allow To Display On', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . __( 'Allow To Display On', 'umbg' ) . '</h3>' .
				'<p>' . sprintf(
					__( 'Drag each item into the Allowed On area to allow %s backgrounds to be display on such items or drag each item into the Disallowed On section to disallow them (mobile friendly drag gable functionality). PL is the Priority Level of the item.', 'umbg' )
					, UMBG_SHORT
				) . '</p>' .
				'<dl>' .
				'<dt>' . __( 'Priority Level (PL)', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'To set the Priority Level (PL) sort each item into the order you prefer by dragging them (top is the highest priority). Priority Level sets the importance of the %1$s background among the other %1$s backgrounds created for the same Allowed On item (i.e. Lets say you have Priority Level of Author=1 & Category=2 and you have created different %1$s backgrounds for author John and for category Uncategorized. You browse to the post by John in category Uncategorized then the %1$s background that will be displayed is the one for John since item Authors have a higher Priority Level than item Categories).', 'umbg' ), UMBG_SHORT ) . '</dd>' .

				'<dt>WooCommerce</dt>' .
				'<dd>' . __( 'Also supports pages and posts with these product shortcodes:', 'umbg' ) . '</dd>' .
				'<dd>[product id="1"]</dd>' .
				'<dd>[product_page id="1"]</dd>' .
				'</dl>'
		);

		$play_by = array(
			'id'      => 'umbg_play_by', //unique id for the tab
			'title'   => sprintf( __( 'Play %s By', 'umbg' ), UMBG_SHORT ), //unique visible title for the tab
			'content' => '<h3>' . sprintf( __( 'Play %s By', 'umbg' ), UMBG_SHORT ) . '</h3>' .
				'<p>' . sprintf( __( 'When %s detects multiple videos for an item it selects one of them to play.', 'umbg' ), UMBG_SHORT ) . '</p>' .
				'<dl>' .
				'<dt>' . __( 'Latest Published', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'Plays most recently published %s for the item.', 'umbg' ), UMBG_SHORT ) . '</dd>' .
				'<dt>' . __( 'Latest Modified', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'Plays most recently modified (updated) %s for the item.', 'umbg' ), UMBG_SHORT ) . '</dd>' .
				'<dt>' . __( 'Random', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'Randomly selects one of the %s for the item to play.', 'umbg' ), UMBG_SHORT ) . '</dd>' .
				'</dl>'
		);

		$controls = array(
			'id'      => 'umbg_controls', //unique id for the tab
			'title'   => __( 'Place Controls', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . __( 'Place Controls', 'umbg' ) . '</h3>' .
				'<p>' . sprintf( __( 'You have several options for the controls used on %1$s backgrounds. The controls consist of the %2$s button, play button, and audio button.', 'umbg' ), UMBG_SHORT, 'PUD' )
				. '</p>' .

				'<p>' . sprintf( __( 'You can select to place %s controls on the bottom right, bottom left, top right, or top left of the page.', 'umbg' ), UMBG_SHORT ) . '</p>' .

				'<dl>' .
				'<dt>' . __( 'Icon Color', 'umbg' ) . '</dt>' .
				'<dd>' . __( 'You can change the color of the control buttons, which are represented by icons. Just click on the color box and select the new color along with any opacity. You can always go back to the default color by clicking on the Default button.', 'umbg' ) . '</dd>' .

				'<dt>' . __( 'Background Color', 'umbg' ) . '</dt>' .
				'<dd>' . __( 'You can change the color of the control buttons background. Just click on the color box and select the new color along with any opacity. You can always go back to the default background color by clicking on the Default button.', 'umbg' ) . '</dd>' .
				'</dl>'
		);

		$visibility_pause = array(
			'id'      => 'umbg_page_pause', //unique id for the tab
			'title'   => __( 'Page Visibility Pause', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . __( 'Page Visibility Pause', 'umbg' ) . '</h3>' .
				'<p>' . __( 'Pause the player when the user minimizes the browser or moves to another window tab.', 'umbg' ) . '</p>',
		);

		$pud = array(
			'id'      => 'umbg_pud', //unique id for the tab
			'title'   => sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ), //unique visible title for the tab
			'content' => '<h3>' . sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ) . '</h3>' .
				'<p>' . sprintf( __( '%1$s allows the page where a %2$s background is displayed on to be scroll up and down to have a better view of the video or image. You can use this feature with a marketing video, Ad images, etc. Use the %1$s HTML Element input box to enter the HTML element id name or class name to use with %1$s. This element will be what gets scrolled up and down when %1$s is enabled.', 'umbg' ), 'PUD', UMBG_SHORT ) . '</p>' .
				'<p>' . __( 'The default is #page, which is the HTML element id for WordPress default themes.', 'umbg' ) . '</p>' .
				'<p>' . __( 'For Twenty-Fifteen theme you can also use #primary with good results. Other effects can be achieved by editing your theme CSS files, such as adding a low opacity value to make necessary sections transparent. Remember to use proper WordPress techniques such as child themes so that theme updates don\'t delete your CSS changes.', 'umbg' ) . '</p>',
		);

		$fio = array(
			'id'      => 'umbg_fio', //unique id for the tab
			'title'   => sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ), //unique visible title for the tab
			'content' => '<h3>' . sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ) . '</h3>' .
				'<p>' . sprintf( __( '%1$s allows the page where a %2$s background is displayed to have an opacity (transperancy) effect to give a better view of the video. Use <strong>%1$s Html Element</strong>o to enter the HTML element id name or class name to use with %1$s. This element will be what gets the opacity applied too when %1$s is enabled. The default is #page, which is the HTML element id for WordPress default themes. For Twenty-Fifteen theme you can also use #primary with good results.', 'umbg' ), 'FIO', UMBG_SHORT ) . '</p>' .
				'<p>' . __( 'The default is #page, which is the HTML element id for WordPress default themes.', 'umbg' ) . '</p>' .
				'<p>' . __( 'For Twenty-Fifteen theme you can also use #primary with good results.', 'umbg' ) . '</p>',
		);

		$disable_on_mobile = array(
			'id'      => 'umbg_disable_mobile', //unique id for the tab
			'title'   => __( 'Mobile Devices', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . __( 'Mobile Devices', 'umbg' ) . '</h3>' .
				'<p>' . sprintf( __( 'Mobile devices do not autoplay videos and %1$s replaces them with a poster image that you select in the \'Add New\' or \'Edit\' page. You may choose not to display video backgrounds on mobile devices by enabling \'Disable video backgrounds only\'. Image and color backgrounds will display on mobile devices unless you enable \'Disable all backgrounds\'. You may also choose to disable only on mobile phones by enabling \'Disable on mobile phones only\'.', 'umbg' ), UMBG_SHORT ) . '</p>' .

				'<dl>' .
				'<dt>' . __( 'Disable all backgrounds', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'Do not allow any of your %s backgrounds to be display on any mobile device.', 'umbg' ), UMBG_SHORT ) . '</dd>' .
				'<dt>' . __( 'Disable video backgrounds only', 'umbg' ) . '</dt>' .
				'<dd>' . __( 'Choose not to display video backgrounds on mobile devices by enabling this feature. Image and color backgrounds will still play on mobile devices.', 'umbg' ) . '</dd>' .
				'<dt>' . __( 'Disable on mobile phones only', 'umbg' ) . '</dt>' .
				'<dd>' . sprintf( __( 'Enable this feature to disable %s backgrounds only on mobile phones. They will continue to display on tablet devices. You can enable this feature together with \'Disable video backgrounds only\'.', 'umbg' ), UMBG_SHORT ) . '</dd>' .
				'</dl>',
		);

		$previews = array(
			'id'      => 'umbg_previews', //unique id for the tab
			'title'   => __( 'Preview Thumbnails', 'umbg' ), //unique visible title for the tab
			'content' => '<h3>' . __( 'Preview Thumbnails', 'umbg' ) . '</h3>' .
				'<p>' . __( 'Show the video and poster preview thumbnails on the \'Add New\' and \'Edit\' pages by enabling this feature. The media preview and poster preview will be display as a thumbnail size.', 'umbg' ) . '</p>',
		);

		$version = array(
			'id'      => 'umbg_version', //unique id for the tab
			'title'   => sprintf( __( '%s Version', 'umbg' ), UMBG_SHORT ), //unique visible title for the tab
			'content' => '<h3>' . sprintf( __( '%s Version', 'umbg' ), UMBG_SHORT ) . '</h3>' .
				'<p>' . sprintf( __( 'This is the current version of %s you have installed in your WordPress site.', 'umbg' ), UMBG_SHORT ) . '</p>' .
				'<p>' . sprintf( __( 'Currently you have version %s.', 'umbg' ), UMBG_VERSION ) . '</p>',
		);

		// Add the help tab for the UMBG list page (edit.php page).
		$screen->add_help_tab( $contextual_help );
		$screen->add_help_tab( $allowed );
		$screen->add_help_tab( $play_by );
		$screen->add_help_tab( $controls );
		$screen->add_help_tab( $visibility_pause );
		$screen->add_help_tab( $pud );
		$screen->add_help_tab( $fio );
		$screen->add_help_tab( $disable_on_mobile );
		$screen->add_help_tab( $previews );
		$screen->add_help_tab( $version );
	}

}

add_action( 'admin_head', 'umbg_settings_custom_help_tab' );

/**
 * Add a link to UMBG About Page to the admin bar (toolbar), under the WP logo.
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function umbg_toolbar_links( $wp_admin_bar ) {

	// If user must have the right capabilities.
	if ( ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// Add a link to About UMBG page to the admin bar (toolbar), under the WP logo.
	$umbg_about = array(
		'parent' => 'wp-logo',
		'id'     => 'umbg-about',
		'title'  => sprintf( __( 'About %s', 'umbg' ), UMBG_SHORT ),
		'href'   => esc_url(
			add_query_arg(
				array(
					'post_type' => 'umbg_post_type',
					'page'      => 'umbg-about'
				), get_admin_url( null, 'edit.php' )
			)
		)
	);

	// Add a link to UMBG edit.php page to the admin bar (toolbar), under the WP site name.
	$umbg_list = array(
		'id'     => 'umbg-page',
		'title'  => UMBG_SHORT,
		'href'   => esc_url( add_query_arg( array( 'post_type' => 'umbg_post_type' ), get_admin_url( null, 'edit.php' ) ) ),
		'parent' => 'site-name'
	);

	$wp_admin_bar->add_node( $umbg_about );
	$wp_admin_bar->add_node( $umbg_list );

}

add_action( 'admin_bar_menu', 'umbg_toolbar_links', 999 );

/** UMBG Global Settings Page
 * -------------------------------------------------------------------------------------------------------------------*/

/**
 * Register the admin settings group to be able to save them.
 */
function register_umbg_settings() {

	// Register our settings.
	$register_options = umbg_settings_options_list();
	foreach ( $register_options as $option ) {
		register_setting( 'umbg-admin-settings-group', $option );
	}

}

/**
 * UMBG Admin Settings Page
 */
function umbg_admin_settings() {

	// Array variable for page options update fields.
	$page_options = umbg_settings_options_list( 'string' );

	// Fill the form with db data or defaults.
	$allow_for_authors       = ( get_option( '_umbg_allow_authors' ) == 1 ) ? 1 : 0;
	$allow_for_categories    = ( get_option( '_umbg_allow_categories' ) == 1 ) ? 1 : 0;
	$allow_for_posts         = ( get_option( '_umbg_allow_posts' ) == 1 ) ? 1 : 0;
	$allow_for_pages         = ( get_option( '_umbg_allow_pages' ) == 1 ) ? 1 : 0;
	$allow_for_wc_categories = ( get_option( '_umbg_allow_wc_categories' ) == 1 ) ? 1 : 0;
	$allow_for_wc_products   = ( get_option( '_umbg_allow_wc_products' ) == 1 ) ? 1 : 0;
	$author_strength         = ( get_option( '_umbg_author_strength' ) ) ? get_option( '_umbg_author_strength' ) : 0;
	$category_strength       = ( get_option( '_umbg_category_strength' ) ) ? get_option( '_umbg_category_strength' ) : 0;
	$post_strength           = ( get_option( '_umbg_post_strength' ) ) ? get_option( '_umbg_post_strength' ) : 0;
	$page_strength           = ( get_option( '_umbg_page_strength' ) ) ? get_option( '_umbg_page_strength' ) : 0;
	$wc_category_strength    = ( get_option( '_umbg_wc_category_strength' ) ) ? get_option( '_umbg_wc_category_strength' ) : 0;
	$wc_product_strength     = ( get_option( '_umbg_wc_product_strength' ) ) ? get_option( '_umbg_wc_product_strength' ) : 0;
	$order_umbg_by_d         = ( get_option( '_umbg_order_by' ) == 'date' ) ? 'selected' : '';
	$order_umbg_by_m         = ( get_option( '_umbg_order_by' ) == 'modified' ) ? 'selected' : '';
	$order_umbg_by_r         = ( get_option( '_umbg_order_by' ) == 'rand' ) ? 'selected' : '';
	$place_controls_br       = ( get_option( '_umbg_place_controls' ) == 'umbg-br' ) ? 'checked' : '';
	$place_controls_bl       = ( get_option( '_umbg_place_controls' ) == 'umbg-bl' ) ? 'checked' : '';
	$place_controls_tr       = ( get_option( '_umbg_place_controls' ) == 'umbg-tr' ) ? 'checked' : '';
	$place_controls_tl       = ( get_option( '_umbg_place_controls' ) == 'umbg-tl' ) ? 'checked' : '';
	$control_color           = ( get_option( '_umbg_control_color' ) == '' ) ? 'rgba(239, 239, 239, 0.9)' :
		get_option( '_umbg_control_color' );
	$control_bgcolor         = ( get_option( '_umbg_control_bgcolor' ) == '' ) ? 'rgba(39, 173, 211, 0.78)' :
		get_option( '_umbg_control_bgcolor' );
	$page_pause              = ( get_option( '_umbg_page_pause' ) == 1 ) ? 'checked' : '';
	$allow_pud               = ( get_option( '_umbg_allow_pud' ) == 1 ) ? 'checked' : '';
	$pud_element             = ( get_option( '_umbg_pud_element' ) ? get_option( '_umbg_pud_element' ) : '#page' );
	$allow_fio               = ( get_option( '_umbg_allow_fio' ) == 1 ) ? 'checked' : '';
	$fio_element             = ( get_option( '_umbg_fio_element' ) ? get_option( '_umbg_fio_element' ) : '#page' );
	$disable_mobile_all      = ( get_option( '_umbg_disable_mobile_all' ) == 1 ) ? 'checked' : '';
	$disable_mobile_video    = ( get_option( '_umbg_disable_mobile_video' ) == 1 ) ? 'checked' : '';
	$disable_mobile_phone    = ( get_option( '_umbg_disable_mobile_phone' ) == 1 ) ? 'checked' : '';
	$allow_show_previews     = ( get_option( '_umbg_show_previews' ) == 1 ) ? 'checked' : '';


	// WooCommerce check - if no WC then do not display titles and update values to 0.
	if ( class_exists( 'WooCommerce' ) ) {
		$umbg_admin_options_array[] = array(
			'priority' => $wc_category_strength,
			'title'    => __( 'WooCommerce Categories', 'umbg' ),
			'id'       => 'umbg_wc_categories_draggable',
			'allowed'  => $allow_for_wc_categories
		);
		$umbg_admin_options_array[] = array(
			'priority' => $wc_product_strength,
			'title'    => __( 'WooCommerce Products', 'umbg' ),
			'id'       => 'umbg_wc_products_draggable',
			'allowed'  => $allow_for_wc_products
		);
	} else {
		update_option( '_umbg_allow_wc_categories', 0 );
		update_option( '_umbg_wc_category_strength', 0 );
		update_option( '_umbg_allow_wc_products', 0 );
		update_option( '_umbg_wc_product_strength', 0 );
	}
	// End - WooCommerce check.

	$umbg_admin_options_array[] = array(
		'priority' => $author_strength,
		'title'    => __( 'Authors', 'umbg' ),
		'id'       => 'umbg_authors_draggable',
		'allowed'  => $allow_for_authors
	);

	$umbg_admin_options_array[] = array(
		'priority' => $category_strength,
		'title'    => __( 'Categories', 'umbg' ),
		'id'       => 'umbg_categories_draggable',
		'allowed'  => $allow_for_categories
	);
	$umbg_admin_options_array[] = array(
		'priority' => $post_strength,
		'title'    => __( 'Posts', 'umbg' ),
		'id'       => 'umbg_posts_draggable',
		'allowed'  => $allow_for_posts
	);
	$umbg_admin_options_array[] = array(
		'priority' => $page_strength,
		'title'    => __( 'Pages', 'umbg' ),
		'id'       => 'umbg_pages_draggable',
		'allowed'  => $allow_for_pages
	);


	// Custom Post Types & Categories
	$custom_post_types      = umbg_get_custom_post_types();
	$custom_post_categories = umbg_get_custom_post_categories();
	$umbg_unused_options    = umbg_get_all_cp_options();

	// Get active CPT.
	foreach ( $custom_post_types as $cpt_key => $cpt_value ) {

		$allow_for_cpt[$cpt_key] = ( get_option( '_umbg_allow_cpt_' . $cpt_value ) == 1 ) ? 1 : 0;
		$cpt_strength[$cpt_key]  = ( get_option( '_umbg_cpt_' . $cpt_value . '_strength' ) ) ?
			get_option( '_umbg_cpt_' . $cpt_value . '_strength' ) : 0;

		// If CPT is active then remove from $umbg_unused_options array.
		if ( is_array( $umbg_unused_options ) && in_array( '_umbg_allow_cpt_' . $cpt_value, $umbg_unused_options ) ) {

			$umbg_unused_options = array_diff( $umbg_unused_options, array( '_umbg_allow_cpt_' . $cpt_value, '_umbg_cpt_' . $cpt_value . '_strength' ) );

		}

		// Change titles appropriately.
		if ( $cpt_value === 'download' ) {
			$cpt_title = __( 'EDD Downloads', 'umbg' );
		} else if ( $cpt_value === 'forum' ) {
			$cpt_title = __( 'bbPress Forums', 'umbg' );
		} else if ( $cpt_value === 'topic' ) {
			$cpt_title = __( 'bbPress Topics', 'umbg' );
		} else {
			$cpt_title = 'CPT: ' . $cpt_value;
		}

		// Add to array
		$umbg_admin_options_array[] = array(
			'priority' => $cpt_strength[$cpt_key],
			'title'    => $cpt_title,
			'id'       => 'umbg_cpt_' . $cpt_value . '_draggable',
			'allowed'  => $allow_for_cpt[$cpt_key]
		);

	}

	// get active CPC.
	foreach ( $custom_post_categories as $cpc_key => $cpc_value ) {

		$allow_for_cpc[$cpc_key] = ( get_option( '_umbg_allow_cpc_' . $cpc_value ) == 1 ) ? 1 : 0;
		$cpc_strength[$cpc_key]  = ( get_option( '_umbg_cpc_' . $cpc_value . '_strength' ) ) ?
			get_option( '_umbg_cpc_' . $cpc_value . '_strength' ) : 0;

		// If CPC is active then remove from $umbg_unused_options array.
		if ( is_array( $umbg_unused_options ) && in_array( '_umbg_allow_cpc_' . $cpc_value, $umbg_unused_options ) ) {

			$umbg_unused_options = array_diff( $umbg_unused_options, array( '_umbg_allow_cpc_' . $cpc_value, '_umbg_cpc_' . $cpc_value . '_strength' ) );

		}

		// Change titles appropriately.
		if ( $cpc_value === 'product_tag' ) {
			$cpc_title = __( 'WooCommerce Product Tags', 'umbg' );
		} else if ( $cpc_value === 'download_category' ) {
			$cpc_title = __( 'EDD Categories', 'umbg' );
		} else if ( $cpc_value === 'download_tag' ) {
			$cpc_title = __( 'EDD Tags', 'umbg' );
		} else if ( $cpc_value === 'topic-tag' ) {
			$cpc_title = __( 'bbPress Tags', 'umbg' );
		} else if ( $cpc_value === 'topic_tag' ) {
			$cpc_title = __( 'bbPress Tags', 'umbg' );
		} else {
			$cpc_title = 'CPC: ' . $cpc_value;
		}

		// Add to array
		$umbg_admin_options_array[] = array(
			'priority' => $cpc_strength[$cpc_key],
			'title'    => $cpc_title,
			'id'       => 'umbg_cpc_' . $cpc_value . '_draggable',
			'allowed'  => $allow_for_cpc[$cpc_key]
		);

	}

	// Update all unused CPT & CPC options values to 0.
	foreach ( $umbg_unused_options as $umbg_option ) {
		update_option( $umbg_option, 0 );
	}

	// Sort array by value asc order.
	asort( $umbg_admin_options_array );

	// Create security nonce.
	$nonce = wp_nonce_field( 'umbg_admin_settings_form_save', 'umbg_admin_settings_nonce_field' );

	?>
	<!--  Start UMBG Global Settings HTML page -->
	<div class="wrap">
		<form action="options.php" method="post" name="options">
			<h2><?php echo sprintf( __( ' %s Global Settings', 'umbg' ), UMBG_SHORT ); ?></h2>
			<?php
			echo $nonce;
			settings_fields( 'umbg-admin-settings-group' );
			do_settings_sections( 'umbg-admin-settings-group' );
			?>
			<table class="form-table">
				<tbody>

				<input id="_umbg_allow_authors" name="_umbg_allow_authors" type="hidden"
					   value="<?php echo absint( $allow_for_authors ); ?>" />
				<input id="_umbg_allow_categories" name="_umbg_allow_categories" type="hidden"
					   value="<?php echo absint( $allow_for_categories ); ?>" />
				<input id="_umbg_allow_posts" name="_umbg_allow_posts" type="hidden"
					   value="<?php echo absint( $allow_for_posts ); ?>" />
				<input id="_umbg_allow_pages" name="_umbg_allow_pages" type="hidden"
					   value="<?php echo absint( $allow_for_pages ); ?>" />
				<input id="_umbg_allow_wc_categories" name="_umbg_allow_wc_categories" type="hidden"
					   value="<?php echo absint( $allow_for_wc_categories ); ?>" />
				<input id="_umbg_allow_wc_products" name="_umbg_allow_wc_products" type="hidden"
					   value="<?php echo absint( $allow_for_wc_products ); ?>" />

				<input id="_umbg_author_strength" name="_umbg_author_strength" type="hidden"
					   value="<?php echo absint( $author_strength ); ?>">
				<input id="_umbg_category_strength" name="_umbg_category_strength" type="hidden"
					   value="<?php echo absint( $category_strength ); ?>">
				<input id="_umbg_post_strength" name="_umbg_post_strength" type="hidden"
					   value="<?php echo absint( $post_strength ); ?>">
				<input id="_umbg_page_strength" name="_umbg_page_strength" type="hidden"
					   value="<?php echo absint( $page_strength ); ?>">
				<input id="_umbg_wc_category_strength" name="_umbg_wc_category_strength" type="hidden"
					   value="<?php echo absint( $wc_category_strength ); ?>">
				<input id="_umbg_wc_product_strength" name="_umbg_wc_product_strength" type="hidden"
					   value="<?php echo absint( $wc_product_strength ); ?>">

				<tr>
					<th scope="row"><?php _e( 'Allow To Display On', 'umbg' ); ?></th>

					<td>

						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Allow To Display On', 'umbg' ); ?></span></legend>

							<div class="umbg-container">

								<div data-force="38" class="layer umbg-block disallowed-list">
									<div class="layer umbg-title"><?php _e( 'Disallowed On', 'umbg' ); ?></div>
									<ul id="bar" class="umbg-block-list umbg-block-list-words">
										<?php
										foreach ( $umbg_admin_options_array as $aod ) {
											if ( absint( $aod['allowed'] ) == 0 ) {
												echo '<li id="' . esc_attr( $aod['id'] ) . '" role="option">' .
													esc_html( $aod['title'] ) . '<span class="umbg-priority-level"
													style="display: none;">PL = ' . absint( $aod['priority'] ) .
													'</span></li>';
											}
										}
										?>
									</ul>
								</div>

								<div data-force="76" class="layer umbg-block allowed-list">
									<div class="layer umbg-title umbg-green"><?php _e( 'Allowed On', 'umbg' ); ?></div>
									<ul id="foo" class="umbg-block-list umbg-block-list-words umbg-block-list-allowed">
										<?php
										foreach ( $umbg_admin_options_array as $ao ) {
											if ( absint( $ao['allowed'] ) == 1 ) {
												echo '<li id="' . esc_attr( $ao['id'] ) . '" role="option"><span>' . esc_html( $ao['title'] ) . '</span><span class="umbg-priority-level">PL = ' . absint( $ao['priority'] ) . '</span></li>';
											}
										}
										?>
									</ul>
								</div>


							</div>

							<p class="description" style="margin-top: 10px;"><?php echo sprintf( __( '<strong>Allow To Display:</strong> Drag each item into the Allowed On section to allow %1$s to be display on such items or drag each item into the Disallowed On section to disallow. (Mobile friendly draggable) *', 'umbg' ), UMBG_SHORT ); ?></p>

							<p class="description" style="margin-top: 10px;"><?php echo sprintf( __( '<strong>CPT:</strong> Custom Post Types. Custom post types installed on your WordPress site.<br /><strong>CPC:</strong> Custom Post Categories. These are categories, terms, and/or taxonomies of custom post types.', 'umbg' ), UMBG_SHORT ); ?></p>

							<p class="description"><?php echo sprintf( __( '<strong>*</strong> Please note that %1$s will render some custom post types titles by their name, i.e. bbPress forum post type will render as \'bbPress Forums\' instead of \'CPT: forum\' and \'Easy Digital Downloads download_tag\' as \'EDD Tags\'.', 'umbg' ), UMBG_SHORT ); ?></p>

							<p class="description" style="margin-top: 10px;"><?php echo sprintf( __( '<strong>Priority Level (PL): </strong> Drag/Sort each item into the order you prefer to set the Priority Level (Top is the highest). Priority Level sets the importance when a %1$s background has been created for at least two of the Allowed On items (i.e. Lets say you have Priority Level of Author=1 & Category=2 and you have created different %1$s backgrounds for author John and category Uncategorized. You browse to the post by John in category Uncategorized then the %1$s background that will play will be the one for John since Authors have a higher Priority Level).', 'umbg' ), UMBG_SHORT ); ?></p>

						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="_umbg_order_by"><?php echo sprintf( __( 'Play %s By', 'umbg' ), UMBG_SHORT );
							?></label>
					</th>
					<td>
						<select id="_umbg_order_by" name="_umbg_order_by">

							<option value="date" <?php echo esc_attr( $order_umbg_by_d ); ?>>
								<?php _e( 'Latest Published', 'umbg' ); ?></option>
							<option value="modified" <?php echo esc_attr( $order_umbg_by_m ); ?>>
								<?php _e( 'Latest Modified', 'umbg' ); ?></option>
							<option value="rand" <?php echo esc_attr( $order_umbg_by_r ); ?>>
								<?php _e( 'Random', 'umbg' ); ?></option>

						</select>

						<p class="description"><?php echo sprintf( __( 'When %1$s detects multiple videos for an item it selects one of them to play. Latest Published: Plays most recently published %1$s for the item. Latest Modified: Plays most recently modified (updated) %1$s for the item. Random: Randomly selects one of the %1$s for the item to play.', 'umbg' ), UMBG_SHORT ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Place Controls', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Place Controls', 'umbg' ); ?></span>
							</legend>
							<label><input type="radio" <?php echo esc_attr( $place_controls_br ); ?> value="umbg-br"
										  name="_umbg_place_controls">
								<span><?php _e( 'Bottom Right', 'umbg' ); ?></span></label><br>
							<label><input type="radio" <?php echo esc_attr( $place_controls_bl ); ?> value="umbg-bl"
										  name="_umbg_place_controls">
								<span><?php _e( 'Bottom Left', 'umbg' ); ?></span></label><br>
							<label><input type="radio" <?php echo esc_attr( $place_controls_tr ); ?> value="umbg-tr"
										  name="_umbg_place_controls"> <span><?php _e( 'Top Right', 'umbg' ); ?></span></label><br>
							<label><input type="radio" <?php echo esc_attr( $place_controls_tl ); ?> value="umbg-tl"
										  name="_umbg_place_controls">
								<span><?php _e( 'Top Left', 'umbg' ); ?></span></label><br>
						</fieldset>
						<br />

						<fieldset>
							<legend class="screen-reader-text"><span><?php _e( 'Place Controls', 'umbg' ); ?></span>
							</legend>
							<label for="_umbg_control_color"><?php _e( 'Icon Color:', 'umbg' ); ?> </label>
							<input id="_umbg_control_color" class="small-text" type="text" name="_umbg_control_color"
								   value="<?php echo esc_html( $control_color ); ?>" />
							<input class="_umbg_control_color_default button" type="button"
								   value="<?php _e( 'Default', 'umbg' ); ?>" />
							<br /><br />
							<label for="_umbg_control_bgcolor"><?php _e( 'Background Color:', 'umbg' ); ?> </label>
							<input id="_umbg_control_bgcolor" class="small-text" type="text"
								   name="_umbg_control_bgcolor" value="<?php echo esc_html( $control_bgcolor ); ?>" />
							<input class="_umbg_control_bgcolor_default button" type="button"
								   value="<?php _e( 'Default', 'umbg' ); ?>" />
						</fieldset>
						<br>

					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Page Visibility Pause', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Page Visibility Pause', 'umbg' ); ?></span></legend>
							<label for="_umbg_page_pause">
								<input id="_umbg_page_pause" type="checkbox" name="_umbg_page_pause"
									   value="1" <?php echo esc_attr( $page_pause ); ?> />
								<?php _e( 'Pause the player when the user minimizes the browser or moves to another window tab.', 'umbg' ); ?>
							</label><br>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ); ?></th>
					<td>
						<fieldset>
							<legend
								class="screen-reader-text">
								<span><?php echo sprintf( __( 'Page-Up-Down %s', 'umbg' ), '(PUD)' ); ?></span></legend>
							<label for="_umbg_allow_pud">
								<input id="_umbg_allow_pud" type="checkbox" name="_umbg_allow_pud"
									   value="1" <?php echo esc_attr( $allow_pud ); ?> />
								<?php echo sprintf( __( 'Allow Page-Up-Down %s', 'umbg' ), '(PUD)' ); ?></label><br />

							<label
								for="_umbg_pud_element"><?php echo sprintf( __( '%s Html Element:', 'umbg' ), 'PUD' ); ?>
								<input id="_umbg_pud_element" type="text" name="_umbg_pud_element"
									   value="<?php echo esc_html( $pud_element ); ?>" size="20" />
							</label>

							<p class="description"><?php echo sprintf( __( '%1$s allows the page where a %2$s background is displayed to be scroll up and down to have a better view of the video. You can use this feature with a marketing video, etc. Use %1$s Html Element to enter the HTML element id name or class name to use with %1$s. This element will be what gets scrolled up and down when %1$s is enabled. The default is #page, which is the HTML element id for WordPress default themes. For Twenty-Fifteen theme you can also use #primary with good results. Other effects can be achieve by editing your theme CSS files. Remember to use proper WordPress techniques such as <a href="http://codex.wordpress.org/Child_Themes" target="_blank">child themes</a> so that theme updates don\'t delete your CSS changes.', 'umbg' ), 'PUD', UMBG_SHORT ); ?></p>

						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php echo sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ); ?></th>
					<td>
						<fieldset>
							<legend
								class="screen-reader-text">
								<span><?php echo sprintf( __( 'Fade-In-Out %s', 'umbg' ), '(FIO)' ); ?></span></legend>
							<label for="_umbg_allow_fio">
								<input id="_umbg_allow_fio" type="checkbox" name="_umbg_allow_fio"
									   value="1" <?php echo esc_attr( $allow_fio ); ?> />
								<?php echo sprintf( __( 'Allow Fade-In-Out %s', 'umbg' ), '(FIO)' ); ?></label><br />

							<label
								for="_umbg_fio_element"><?php echo sprintf( __( '%s Html Element:', 'umbg' ), 'FIO' ); ?>
								<input id="_umbg_fio_element" type="text" name="_umbg_fio_element"
									   value="<?php echo esc_html( $fio_element ); ?>" size="20" />
							</label>

							<p class="description"><?php echo sprintf( __( '%1$s allows the page where a %2$s background is displayed to have an opacity (transperancy) effect to give a better view of the video. Use %1$s Html Element to enter the HTML element id name or class name to use with %1$s. This element will be what gets the opacity applied too when %1$s is enabled. The default is #page, which is the HTML element id for WordPress default themes. For Twenty-Fifteen theme you can also use #primary with good results. Other effects can be achieve by editing your theme CSS files and/or selectiong other elements. Remember to use proper WordPress techniques such as <a href="http://codex.wordpress.org/Child_Themes" target="_blank">child themes</a> when using custom CSS styles so theme updates don\'t delete your CSS changes.', 'umbg' ), 'FIO', UMBG_SHORT ); ?></p>

						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php echo __( 'Mobile Devices', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend
								class="screen-reader-text"><span><?php echo __( 'Mobile Devices', 'umbg' ); ?></span>
							</legend>
							<label for="_umbg_disable_mobile_all_2">
								<input id="_umbg_disable_mobile_all_2" type="checkbox" name="_umbg_disable_mobile_all_2"
									   value="1" <?php echo esc_attr( $disable_mobile_all ); ?> />
								<?php echo __( 'Disable all backgrounds', 'umbg' ); ?></label><br />

							<label for="_umbg_disable_mobile_video_2">
								<input id="_umbg_disable_mobile_video_2" type="checkbox"
									   name="_umbg_disable_mobile_video_2"
									   value="1" <?php echo esc_attr( $disable_mobile_video ); ?> />
								<?php echo __( 'Disable video backgrounds only', 'umbg' ); ?></label><br />

							<label for="_umbg_disable_mobile_phone_2">
								<input id="_umbg_disable_mobile_phone_2" type="checkbox"
									   name="_umbg_disable_mobile_phone_2"
									   value="1" <?php echo esc_attr( $disable_mobile_phone ); ?> />
								<?php echo __( 'Disable on mobile phones only', 'umbg' ); ?></label>

							<input id="_umbg_disable_mobile_all" type="hidden" name="_umbg_disable_mobile_all"
								   value="1" />
							<input id="_umbg_disable_mobile_video" type="hidden" name="_umbg_disable_mobile_video"
								   value="1" />
							<input id="_umbg_disable_mobile_phone" type="hidden" name="_umbg_disable_mobile_phone"
								   value="1" />

							<p class="description"><?php echo sprintf( __( 'Mobile devices do not autoplay videos and %1$s replaces them with a poster image that you select in the \'Add New\' or \'Edit\' page. You may choose not to display video backgrounds on mobile devices by enabling \'Disable video backgrounds only\'. Image and color backgrounds will display on mobile devices unless you enable \'Disable all backgrounds\'. You may also choose not to display on mobile phones only by enabling \'Disable on mobile phones only\'.', 'umbg' ), UMBG_SHORT ); ?></p>

						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Preview Thumbnails', 'umbg' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Preview Thumbnails', 'umbg' ); ?></span></legend>
							<label for="_umbg_show_previews">
								<input id="_umbg_show_previews" type="checkbox" name="_umbg_show_previews"
									   value="1" <?php echo esc_attr( $allow_show_previews ); ?> />
								<?php _e( 'Show video and poster preview thumbnails', 'umbg' ); ?></label>

							<p class="description"><?php _e( 'Show the video and poster preview thumbnails on the \'Add New\' and \'Edit\' pages by enabling this feature.', 'umbg' ); ?></p>

						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo sprintf( __( '%s Version', 'umbg' ), UMBG_SHORT ); ?></th>

					<td>
						<p><?php echo UMBG_VERSION; ?></p>
					</td>
				</tr>

				</tbody>
			</table>

			<!-- Start Custom Post Hidden Fields -->
			<?php foreach ( $custom_post_types as $cpt_key => $value ) : ?>

				<input id="_umbg_allow_cpt_<?php echo $value; ?>" name="_umbg_allow_cpt_<?php echo $value; ?>" type="hidden"
					   value="<?php echo absint( $allow_for_cpt[$cpt_key] ); ?>">

				<input id="_umbg_cpt_<?php echo $value; ?>_strength" name="_umbg_cpt_<?php echo $value; ?>_strength" type="hidden"
					   value="<?php echo absint( $cpt_strength[$cpt_key] ); ?>">

			<?php endforeach; ?>

			<?php foreach ( $custom_post_categories as $cpc_key => $value ) : ?>

				<input id="_umbg_allow_cpc_<?php echo $value; ?>" name="_umbg_allow_cpc_<?php echo $value; ?>" type="hidden"
					   value="<?php echo absint( $allow_for_cpc[$cpc_key] ); ?>">

				<input id="_umbg_cpc_<?php echo $value; ?>_strength" name="_umbg_cpc_<?php echo $value; ?>_strength" type="hidden"
					   value="<?php echo absint( $cpc_strength[$cpc_key] ); ?>">

			<?php endforeach; ?>
			<!-- End Custom Post Hidden Fields -->

			<input type="hidden" name="action" value="update" />

			<input type="hidden" name="page_options" value="<?php echo $page_options; ?>" />

			<input class="button button-primary" type="submit" name="Submit" value="Save Changes" />
		</form>
	</div>
	<!--  End UMBG Global Settings HTML page -->
	<?php
}
