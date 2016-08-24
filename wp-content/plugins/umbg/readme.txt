=== Ultimate Media Background ===
Contributors: TheeFarmer | Alendee Internet Solutions
Donate link: http://www.theefarmer.com/
Tags: background, images, videos, patterns, color, full screen, responsive
Requires at least: 4.0
Tested up to: 4.4.2

Add video, image, or color full screen backgrounds.


== Description ==

Add a full screen video, image, or color background. Supports YouTube, Vimeo, Dailymotion, and HTML5 videos.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload 'umbg' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Refer to the included UMBG documentation for further help.


== Update ==

This section describes how to update the plugin.

e.g.

1. Download the new version from CodeCanyon and unzip.
2. Deactivate UMBG from the Plugins screen.
3. Upload 'umbg' folder to the '/wp-content/plugins/' directory with your FTP program. You will need to overwrite all files of UMBG.
4. Reactivate UMBG from the Plugins screen, then go to the global settings page (Settings) and make sure all your settings are as before.
5. That's it! You can continue to use UMBG as usual.


== Change Log ==

= 1.4.3 =
- 2016-03-02
* Fix media end fade-out function.
* Change default mediaLink value to ''.

= 1.4.2 =
- 2016-02-27
* Enhance $autoplay initialization variable for versions before 1.4.0.
* Fix Page Visability Pause and autoplay.

= 1.4.1 =
- 2016-02-25
* Fix autoplay on image slideshow.
* Fix UMBG-Slider script not loading with some EU mobile providers.


= 1.4.0 =
- 2015-12-04
* Add Custom Post Types support.
* Add WooCommerce Product Tags support via custom post type.
* Add autoPlay.
* Add capability to link the media background.
* Add alphabetically reorder the 'Append To' list.
* Add plugin functions file.
* Fix backgrounds not displaying when proper author of post/page.
* Change plugin's folder structure to limit unnecessary code loading.
* Change default setting for pudUp to 1.
* Change plugin's menu position to be closer to the Media menu.
* Enhance uninstall code.
* Remove height adjustment to Disallowed list.

= 1.3.3 =
- 2015-11-01
* Fix YouTube API change causing looping issue with Safari.

= 1.3.2 =
- 2015-10-18
* Fix transitioning of slides when the duration is a decimal number (in secs).
* Add default settings missing description comments.
* Enhance code format.
* Change default value of disableOnMobileVideoOnly from 1 to 0.

= 1.3.1 =
- 2015-10-14
* Change transition duration minimum limit from 500 to 0 milliseconds.
* Enhance slideTransitionDuration (making sure it is of integer type).
* Fix FIO transition effect sometimes not initializing properly.
* Fix disabling on mobile devices not working when Image type selected.

= 1.3.0
- 2015-09-22
* Add WooCommerce Support.
* Add start video with audio muted.
* Add FIO (Fade-In-Out) page opacity feature.
* Add Media End Fade-Out (MEFO).
* Add slide transition timing option.
* Fix custom column Type link.
* Fix delayBy when using Image media type.
* Fix Enlarge By not displaying when Image or Color types are selected.
* Enhance UI of Append Background To section.
* Enhance UI of Settings page Allow To Display On section.
* Enhance start PUD down, page will start down immediately.
* Enhanced Page Visibility Pause functionality.
* Enhance image transition (between images) fade effect.
* Enhance resizing for mobile devices.
* Removed slider container background color.
* Removed hiding of controls with Image and Color type.
* Renamed variable videoOverlayTransparent to mediaOverlayTransparent.

= 1.2.3 =
- 2015-07-21
* Added 'step' property to video Start At & End At html input.
* Enhance code for YT video quality detection.
* Try using YT HTML5 player first then fallback to flash.

= 1.2.2 =
- 2015-07-06
* Remove PUD restriction to hide controls.
* Add compatibility with PHP 5.3.
* Update documentation.

= 1.2.1 =
- 2015-06-29
* Enhance disable on mobile code.
* Reactivation no longer resets global settings.
* Fix YouTube play button sometimes not working.
* Fix uninstall action not deleting 4 of the option settings from DB tables.
* Fix not displaying on mobile phone right after updating to 1.2.

= 1.2 =
- 2015-06-23
* Add option to disable backgrounds on mobile phones only.
* Add Wistia doNotTrack option.
* Fix sprintf error on umbg.php.
* Update some help documentation and spanish translation.

= 1.1.2 =
- 2015-06-17
* Fix HTML5 audio volume not matching set level.

= 1.1.1 =
- 2015-06-16
* Fix HTML5 audio playing while audio option is disable.

= 1.1 =
- 2015-06-16
* Fix Vimeo API change.
* Fix CSS issue on mobile devices.
* Add option to disable backgrounds on mobile devices.
* Add option to disable video backgrounds only on mobile devices.

= 1.0 =
- 2015-05-28
* Initial release
