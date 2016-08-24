<?php

/**
 * UMBG Admin about page code.
 *
 * @package    UMBG
 * @subpackage Admin
 * @since      1.4.0
 *
 * Last Updated: 2015-12-04 - Created.
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

// HTML for Dashboard About Page.
function umbg_about_page() {

	if ( isset( $_GET['tab'] ) ) {
		$active_tab = $_GET['tab'];
	} else {
		$active_tab = 'display_new';
	}

	$active_features = ( $active_tab == 'display_features' ) ? 'nav-tab-active' : '';
	$active_new      = ( $active_tab == 'display_new' ) ? 'nav-tab-active' : '';
	$active_credits  = ( $active_tab == 'display_credits' ) ? 'nav-tab-active' : '';
	$active_help     = ( $active_tab == 'display_help' ) ? 'nav-tab-active' : '';

	?>
	<div class="wrap about-wrap">
		<h1><?php echo sprintf( __( 'Welcome to %1$s %2$s', 'umbg' ), UMBG_SHORT, UMBG_VERSION ); ?></h1>

		<div
			class="about-text"><?php echo sprintf( __( 'Thank you for installing! %1$s version %2$s adds new features to display and manage full screen media backgrounds.', 'umbg' ), UMBG_SHORT, UMBG_VERSION ); ?>
		</div>

		<div class="wp-badge" style="background: url( <?php echo UMBG_LOGO; ?> )
			no-repeat scroll center 24px / 85px 85px #007D3C; color: #fff;"><?php echo sprintf( __( 'Version %s', 'umbg' ), UMBG_VERSION );
			?>
		</div>

		<h2 class="nav-tab-wrapper">
			<a href="?post_type=umbg_post_type&page=umbg-about&tab=display_new"
			   class="nav-tab <?php echo $active_new; ?>">
				<?php _e( 'What\'s New', 'umbg' ); ?>
			</a><a href="?post_type=umbg_post_type&page=umbg-about&tab=display_features"
				   class="nav-tab <?php echo $active_features; ?>">
				<?php _e( 'Features', 'umbg' ); ?>
			</a><a href="?post_type=umbg_post_type&page=umbg-about&tab=display_credits"
				   class="nav-tab <?php echo $active_credits; ?>">
				<?php _e( 'Credits', 'umbg' ); ?>
			</a><a href="?post_type=umbg_post_type&page=umbg-about&tab=display_help"
				   class="nav-tab <?php echo $active_help; ?>">
				<?php _e( 'Help', 'umbg' ); ?>
			</a>
		</h2>

		<?php if ( $active_tab === 'display_new' ) : ?>
			<div class="changelog">
				<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: center;"><?php _e( 'Full support for Custom Post Types is here!', 'umbg' );
					?></h2>
				<br />

				<div class="feature-section two-col">
					<div class="col">
						<img src="<?php echo plugins_url( 'images/docs/umbg-custom-post-types.jpg', __FILE__ ); ?>" />
					</div>
					<div class="col last-feature">
						<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Custom Post Types (CPT)', 'umbg' ); ?></h2>

						<p><?php _e( 'Add media backgrounds to custom post types that are installed on your WordPress site. <a href="?post_type=umbg_post_type&page=umbg-settings">Go to UMBG->Settings</a> and select the custom post types you want to allowed to be use.', 'umbg' ); ?></p>

					</div>
				</div>


				<div class="feature-section two-col">
					<div class="col">

						<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Custom Post Categories (CPC)', 'umbg' ); ?></h2>

						<p><?php echo sprintf( __( 'These are categories, terms, and/or taxonomies of custom post types that you can also select to display media backgrounds. <a href="?post_type=umbg_post_type&page=umbg-settings">Go to UMBG->Settings</a> and select the custom post categories you want to allowed to be use.', 'umbg' ), UMBG_SHORT ); ?></p>

					</div>
					<div class="col last-feature">

						<img
							src="<?php echo plugins_url( 'images/docs/umbg-custom-post-categories.jpg', __FILE__ ); ?>" />

					</div>
				</div>

				<div class="feature-section three-col">
					<div class="col">

						<h3 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Autoplay', 'umbg' ); ?></h3>

						<p><?php echo sprintf( __( 'Auto playback has always been part of %s media backgrounds, but now you can select not to start the media with auto playback.', 'umbg' ), UMBG_SHORT ); ?></p>

					</div>
					<div class="col">

						<h3 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Media Link', 'umbg' ); ?></h3>

						<p><?php echo sprintf( __( 'Enter a URL to link the media background. You can select to open the link in a new window or the same window.', 'umbg' ), UMBG_SHORT ); ?></p>

					</div>
					<div class="col last-feature">

						<h4 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Other:', 'umbg' ); ?></h4>

						<p><?php echo sprintf( __( 'Other enhancements include: WooCommerce product tags. Change plugin\'s folder structure, limit unnecessary code loading, and other code enhancements.', 'umbg' ), UMBG_SHORT ); ?></p>

					</div>
				</div>

				<div class="changelog point-releases">
					<h3><?php _e( 'Change Log', 'umbg' ); ?></h3>

					<p><?php echo sprintf( __( 'For more information see the readme.txt file included in your download of %s.', 'umbg' ), UMBG_SHORT ); ?></p>
				</div>

				<div class="return-to-dashboard">
					<a href="?post_type=umbg_post_type&page=umbg-settings"><?php echo sprintf( __( 'Go to %s Settings', 'umbg' ), UMBG_SHORT ); ?></a>
				</div>


			</div>
		<?php endif; ?>

		<?php if ( $active_tab === 'display_features' ) : ?>
			<div class="changelog headline-feature" style="text-align: center;">
				<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 1em; text-align: center;">Ultimate Media Background</h2>
				<img src="<?php echo plugins_url( 'images/docs/umbg-intro-features.png', __FILE__ ); ?>" />

			</div>

			<div class="changelog">
				<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: center;"><?php _e( 'Display full screen media backgrounds like never before.', 'umbg' ); ?></h2>

				<p class="about-description"><?php echo sprintf( __( 'Use hosted videos from YouTube, Vimeo, Dailymotion, Wistia, or HTML5 videos. They all play and look amazing with %1$s. Want to use an image instead, no problem, %1$s lets you use one or more images to display beautiful backgrounds. What about just a color background, may be with a pattern? Yes, that too!', 'umbg' ), UMBG_SHORT ); ?></p>

				<br /><br />

				<div class="feature-section two-col">
					<div class="col">
						<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Simple to Use.', 'umbg' ); ?></h2>

						<p><?php echo sprintf( __( 'Unlike other plugins that make you go all over your WordPress website to find where you want to insert your short code, with %1$s you simply select the authors, categories, posts, and/or pages right from the \'Add New\' or \'Edit\' screen. No short codes needed.', 'umbg' ), UMBG_SHORT ); ?></p>
					</div>
					<div class="col last-feature">
						<img src="<?php echo plugins_url( 'images/docs/umbg-add-new.jpg', __FILE__ ); ?>" />
					</div>
				</div>

				<br /><br /><br />

				<div class="feature-section two-col">
					<div class="col">
						<img src="<?php echo plugins_url( 'images/docs/umbg-settings.jpg', __FILE__ ); ?>" />
					</div>
					<div class="col last-feature">
						<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Full of Options.', 'umbg' ); ?></h2>

						<p><?php _e( 'All of the necessary settings to display backgrounds to your needs, including:', 'umbg' ); ?></p>

						<p><?php echo sprintf( __( 'Append To, Poster, Overlay, Quality, Start At, End At, Loop, Audio, Page-Up-Down %s, and many more.', 'umbg' ), '(PUD)' ); ?></p>
					</div>
				</div>


				<div class="feature-section two-col">
					<div class="col">

						<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php echo sprintf( __( 'Say Hello to %s.', 'umbg' ), 'PUD' ); ?></h2>

						<p><?php echo sprintf( __( 'Page-Up-Down (%1$s) allows the page to be scroll up and down to allow full view of the media background. You can also select if %1$s will scroll the page down when the media playback starts and/or if it will scroll up when the media playback ends. You can also keep part of the page in view, such as the logo and navigation, during the %1$s down status.', 'umbg' ), 'PUD' ); ?></p>
					</div>
					<div class="col last-feature">

						<div class="about-video about-video-embed">
							<video width="500" height="352" preload="metadata" loop id="video-0-1" muted="muted"
								   autoplay="autoplay"
								   poster="<?php echo plugins_url( 'images/docs/pud.png', __FILE__ ); ?>"
								   class="wp-video-shortcode">
								<source src="<?php echo plugins_url( 'images/docs/hello-pud.mp4', __FILE__ ); ?>"
										type="video/mp4">
								<source src="<?php echo plugins_url( 'images/docs/hello-pud.webm', __FILE__ ); ?>"
										type="video/webm">
								<source src="<?php echo plugins_url( 'images/docs/hello-pod.ogv', __FILE__ ); ?>"
										type="video/ogg">
								<a href="<?php echo plugins_url( 'images/docs/hello-pud.mp4', __FILE__ ); ?>">
									<?php _e( 'View the video here.', 'umbg' ); ?></a>
							</video>
						</div>
					</div>
				</div>

				<div class="feature-section two-col">
					<div class="col">
						<img
							src="<?php echo plugins_url( 'images/docs/umbg-internationalization.png', __FILE__ ); ?>" />
					</div>
					<div class="col last-feature">
						<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Internationalization & Localization Supported.', 'umbg' ); ?></h2>

						<p><?php _e( 'Internationalization is the process of setting up software so that it can be localized; localization is the process of translating text displayed by the software into different languages.', 'umbg' ); ?></p>

						<p><?php echo sprintf( __( 'You can localize %s without the need to modify the source code of the plugin.', 'umbg' ), UMBG_SHORT ); ?></p>

						<p><a href="https://developer.wordpress.org/plugins/internationalization/localization/"
							  target="_blank"><?php echo sprintf( _x( 'Learn how to localize %s', 'link text', 'umbg' ), UMBG_SHORT ); ?></a>
						</p>
					</div>
				</div>

			</div>

			<div class="changelog">
				<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: center;"><?php _e( 'Supports WooCommerce single product pages, categories, and product page shortcodes.', 'umbg' );
					?></h2>
				<br />

				<div class="feature-section two-col">
					<div class="col">
						<img src="<?php echo plugins_url( 'images/docs/umbg-wc-categories.jpg', __FILE__ ); ?>" />
					</div>
					<div class="col last-feature">
						<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'WooCommerce Categories.', 'umbg' ); ?></h2>

						<p><?php _e( 'Select the WooCommerce categories you want to display your media background. When a user views a product on its product page and the product is in the selected category then the media background will play.', 'umbg' ); ?></p>

					</div>
				</div>

				<div class="feature-section two-col">
					<div class="col">

						<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'WooCommerce Products.', 'umbg' ); ?></h2>

						<p><?php echo sprintf( __( 'Select the WooCommerce product you want to display your media background on.', 'umbg' ), UMBG_SHORT ); ?></p>

						<p><?php _e( 'Supports WooCommerce product shortcodes:', 'umbg' ); ?></p>
						<ul>
							<li>[product id="1"]</li>
							<li>[product_page id="1"]</li>
						</ul>

					</div>
					<div class="col last-feature">

						<img
							src="<?php echo plugins_url( 'images/docs/umbg-wc-products.jpg', __FILE__ ); ?>" />

					</div>
				</div>

				<!-- Start FIO -->
				<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: center;"><?php _e( 'Other requested features now available!', 'umbg' ); ?></h2>

				<p class="about-description"
				   style="text-align: center; margin-top: 0;"><?php echo sprintf( __( 'You ask for them, you got them.', 'umbg' ), UMBG_SHORT ); ?></p>

				<div class="feature-section two-col">
					<div class="col">

						<div class="about-video about-video-embed">
							<video width="500" height="352" preload="metadata" loop id="video-0-1" muted="muted"
								   autoplay="autoplay"
								   poster="<?php echo plugins_url( 'images/docs/hello-fio.png', __FILE__ ); ?>"
								   class="wp-video-shortcode">
								<source src="<?php echo plugins_url( 'images/docs/hello-fio.mp4', __FILE__ ); ?>"
										type="video/mp4">
								<source src="<?php echo plugins_url( 'images/docs/hello-fio.webm', __FILE__ ); ?>"
										type="video/webm">
								<source src="<?php echo plugins_url( 'images/docs/hello-fio.ogv', __FILE__ ); ?>"
										type="video/ogg">
								<a href="<?php echo plugins_url( 'images/docs/hello-fio.mp4', __FILE__ ); ?>">
									<?php _e( 'View the video here.', 'umbg' ); ?></a>
							</video>
						</div>

					</div>
					<div class="col last-feature">
						<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php echo sprintf( __( 'Say Hello to %s.', 'umbg' ), 'FIO' ); ?></h2>

						<p><?php echo sprintf( __( 'Fade-In-Out (%1$s) sets the page to have a transparency effect to allow full view of the media background.', 'umbg' ), 'FIO' ); ?></p>


					</div>
				</div>


				<div class="feature-section under-the-hood three-col">
					<div class="col">
						<h4><?php _e( 'Start Playback Muted', 'umbg' ); ?></h4>

						<p><?php _e( 'Start playing your videos with its audio muted.', 'umbg' ); ?></p>
					</div>
					<div class="col">
						<h4><?php _e( 'Media End Fade-Out', 'umbg' ); ?></h4>

						<p><?php _e( 'Allows for the media to be faded out once done playing.', 'umbg' ); ?></p>
					</div>
					<div class="col">
						<h4><?php _e( 'Image Transition Timing', 'umbg' ); ?></h4>

						<p><?php _e( 'Control the timing of the fade effect between images during a slideshow.', 'umbg' ); ?></p>
					</div>
				</div>

				<div class="feature-section under-the-hood three-col">
					<div class="col">
						<h4><?php _e( 'UI for Append Background To section', 'umbg' ); ?></h4>

						<p><?php _e( 'Enhancement to the UI section for selecting where you want to display your background too.', 'umbg' ); ?></p>
					</div>
					<div class="col">
						<h4><?php _e( 'UI for Allow To Display On section', 'umbg' ); ?></h4>

						<p><?php _e( 'Enhancement to the UI of the Allow To Display On section in the Global Settings page.', 'umbg' ); ?></p>
					</div>
					<div class="col">
						<h4><?php _e( 'Other Enhancements Include:', 'umbg' ); ?></h4>

						<p><?php echo sprintf( __( '%1$s on start functionality, image transition fade effect, and resizing for mobile devices.', 'umbg' ), 'PUD' ); ?></p>
					</div>
				</div>

				<div class="changelog">
					<h2 style="font-size: 2.4em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: center;"><?php _e( 'Control what your mobile users see.', 'umbg' ); ?></h2>

					<p class="about-description" style="text-align: center; margin-top: 0;"><?php echo sprintf( __( 'With %1$s you can choose if your backgrounds will display on mobile devices or not.', 'umbg' ), UMBG_SHORT ); ?></p>

					<br />

					<div class="feature-section two-col">
						<div class="col">
							<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Disable all backgrounds.', 'umbg' ); ?></h2>

							<p><?php echo sprintf( __( 'Do not allow any of your %1$s backgrounds to be display on any mobile device.', 'umbg' ), UMBG_SHORT ); ?></p>
						</div>
						<div class="col last-feature">
							<img src="<?php echo plugins_url( 'images/docs/umbg-disable-mobile.jpg', __FILE__ ); ?>" />
						</div>
					</div>

					<br />

					<div class="feature-section two-col">
						<div class="col">
							<img src="<?php echo plugins_url( 'images/docs/umbg-disable-video.jpg', __FILE__ ); ?>" />
						</div>
						<div class="col last-feature">
							<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Disable video backgrounds only.', 'umbg' ); ?></h2>

							<p><?php _e( 'Choose not to display video backgrounds on mobile devices by enabling this feature. Image and color backgrounds will still play on mobile devices.', 'umbg' ); ?></p>

						</div>
					</div>


					<div class="feature-section two-col">
						<div class="col">

							<h2 style="font-size: 2.2em; font-weight: 300; line-height: 1.3; margin: 1.1em 0 0.2em; text-align: left;"><?php _e( 'Disable on mobile phones only.', 'umbg' ); ?></h2>

							<p><?php echo sprintf( __( 'Enable this feature to disable %1$s backgrounds only on mobile phones. They will continue to display on tablet devices. You can enable this feature together with \'Disable video backgrounds only\'.', 'umbg' ), UMBG_SHORT ); ?></p>

						</div>
						<div class="col last-feature">

							<img
								src="<?php echo plugins_url( 'images/docs/umbg-disable-phone.jpg', __FILE__ ); ?>" />

						</div>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard">
				<a href="?post_type=umbg_post_type&page=umbg-settings"><?php echo sprintf( __( 'Go to %s Settings', 'umbg' ), UMBG_SHORT ); ?></a>
			</div>

		<?php endif; ?>

		<?php if ( $active_tab === 'display_credits' ) : ?>
			<div class="changelog">
				<p class="about-description"><?php echo sprintf( __( '%1$s uses several available open source code from the list below. Some are used throughout %1$s, others are used in a couple of lines of code, and others have been modified for %1$s\'s use. The use of copyrighted works is also used with permission from their respected owners. Without these projects and works %1$s would not be possible.', 'umbg' ), UMBG_SHORT ); ?></p>
				<hr />

				<h3><?php echo sprintf( __( '%s will like to credit:', 'umbg' ), UMBG_SHORT ); ?></h3>

				<div class="feature-section three-col">
					<div class="col">
						<h4>WordPress Codex</h4>

						<p><?php _e( 'The online manual for WordPress and a living repository for WordPress information and documentation.', 'umbg' ); ?></p>

						<p><a href="http://codex.wordpress.org/" target="_blank">WordPress Codex</a></p>
					</div>
					<div class="col">
						<h4>jQuery</h4>

						<p><?php _e( 'The indispensable JavaScript library for developers. A great library.', 'umbg' ); ?></p>

						<p><a href="http://jquery.com/" target="_blank">jQuery</a></p>
					</div>
					<div class="col last-feature">
						<h4>Semantic UI</h4>

						<p><?php _e( 'An open source UI library.', 'umbg' ); ?></p>

						<p><a href="http://semantic-ui.com/" target="_blank">Semantic UI</a></p>
					</div>
				</div>

				<div class="feature-section three-col">
					<div class="col">
						<h4>RangeSlider</h4>

						<p><?php _e( 'Simple, small and fast JavaScript/jQuery polyfill for the HTML5 input element.', 'umbg' ); ?></p>

						<p><a href="http://andreruffert.github.io/rangeslider.js/" target="_blank">RangeSlider</a></p>
					</div>
					<div class="col">
						<h4>Sortable</h4>

						<p><?php _e( 'Sortable is a minimalist JavaScript library for reorderable drag-and-drop lists.', 'umbg' ); ?></p>

						<p><a href="http://rubaxa.github.io/Sortable/" target="_blank">Sortable</a></p>
					</div>

					<div class="col last-feature">
						<h4>Multi-Select</h4>

						<p><?php _e( 'User-friendlier drop-in replacement for the standard select box with multiple attribute activated.', 'umbg' ); ?></p>

						<p><a href="http://loudev.com/" target="_blank">Multi-Select</a></p>
					</div>
				</div>

				<div class="feature-section three-col">
					<div class="col">
						<h4>Spectrum</h4>

						<p><?php _e( 'The No Hassle jQuery Colorpicker.', 'umbg' ); ?></p>

						<p><a href="https://bgrins.github.io/spectrum/" target="_blank">Spectrum</a></p>
					</div>

					<div class="col">
						<h4>Almoond</h4>

						<p><?php _e( 'Flags of the World in Globe media  is copyrighted work of Almoond. All rights reserved.', 'umbg' ); ?></p>

						<p>
							<a href="http://graphicriver.net/user/almoond?WT.ac=item_profile_text&WT.z_author=almoond?ref=theefarmer"
							   target="_blank">Almoond</a></p>
					</div>

					<div class="col last-feature">
						<h4>SmoothSlides</h4>

						<p><?php _e( 'A responsive jQuery slideshow with beautiful panning effects on each image.', 'umbg' ); ?></p>

						<p><a href="http://kthornbloom.com/smoothslides/" target="_blank">SmoothSlides</a></p>
					</div>
				</div>

				<div class="feature-section three-col">

					<div class="col">
						<h4>Mobile-Detect</h4>

						<p><?php _e( 'Mobile device detection.', 'umbg' ); ?></p>

						<p><a href="http://hgoebl.github.io/mobile-detect.js/" target="_blank">Heinrich Goebl</a></p>
					</div>
				</div>

			</div>
		<?php endif; ?>

		<?php if ( $active_tab === 'display_help' ) : ?>
			<div class="feature-section two-col">
				<div class="col">
					<h3><?php echo sprintf( __( 'Need help using %s?', 'umbg' ), UMBG_SHORT ); ?></h3>

					<p class="about-description"><?php echo sprintf( __( '%1$s documentation is available right here on WordPress. Just look for the Help tab on the top right corner while you are in %1$s pages.', 'umbg' ), UMBG_SHORT ); ?></p>

					<p><?php _e( 'You can also go to:', 'umbg' ); ?></p>
					<ul>
						<li><a href="http://www.theefarmer.com/support/"
							   target="_blank"><?php echo sprintf( __( '%s Support', 'umbg' ), UMBG_SHORT ); ?></a>
						</li>

					</ul>
				</div>
				<div class="col last-feature">
					<img src="<?php echo plugins_url( 'images/docs/umbg-help-tabs.jpg', __FILE__ ); ?>" />
				</div>
			</div>

		<?php endif; ?>

	</div>

	<?php
}