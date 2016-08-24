/**
 * Ultimate Media Background WP - Initialize JS Document
 * For: UMBG Plugin v1.4
 *      http://codecanyon.net/user/theefarmer?ref=theefarmer
 *      http://theefarmer.com
 *
 * Author: TheeFarmer | Alendee Internet Solutions
 * Copyright: (c) 2015 Alendee Internet Solutions
 *
 * Last Change: 2015-12-04 - Add autoPlay.
 *                         - Add mediaLink & mediaLinktarget.
 *              2015-10-18 - Enhance code format.
 *              2015-09-22 - Add startAudioMuted.
 *                         - Add FIO (Fade-In-Out).
 *                         - Add slideTransitionDuration.
 *              2015-07-21 - Add unary operator to Start At & End At.s
 *              2015-06-23 - Add wistiaDoNotTrack.
 *              2015-06-16 - Add disableOnMobileAll and disableOnMobileVideoOnly.
 *              2015-05-25 - Initial release.
 **/

(function ( $ ) {
	'use strict';

	// Start - Initialize UMBG
	var umbg_setting = window.umbg_setting;

	$( document ).ready( function () {

		// If WP Admin Bar is displayed, decrease pudShow by same amount as admin bar height.
		if ( $( '#wpadminbar' ).length && umbg_setting.pudShow > 0 ) {
			var h = $( '#wpadminbar' ).height(),
				ps = + umbg_setting.pudShow
				;

			umbg_setting.pudShow = (ps + h);
		}

		$( 'body' ).umbg( {
			// The + (Unary operator) in front of a setting value is to change string type (in case it is string) to number type where needed.
			'mediaAspectRatio'           : umbg_setting.mediaAspectRatio,
			'videoQuality'               : umbg_setting.videoQuality,
			'mediaPlayerType'            : umbg_setting.mediaPlayerType,
			'mediaId'                    : umbg_setting.mediaId,
			'mediaLink'                  : umbg_setting.mediaLink,
			'mediaLinkTarget'            : umbg_setting.mediaLinkTarget,
			'mediaPoster'                : umbg_setting.mediaPoster,
			'mediaPosterCss'             : umbg_setting.mediaPosterCss,
			'mediaOverlay'               : + umbg_setting.mediaOverlay,
			'mediaOverlayCss'            : umbg_setting.mediaOverlayCss,
			'mediaOverlayColor'          : umbg_setting.mediaOverlayColor,
			'wistiaDoNotTrack'           : + umbg_setting.wistiaDoNotTrack,
			'autoPlay'                   : + umbg_setting.autoPlay,
			'loop'                       : + umbg_setting.loop,
			'rewindToStartAt'            : umbg_setting.rewindToStartAt,
			'mediaEndFadeOut'            : + umbg_setting.mediaEndFadeOut,
			'startAt'                    : + umbg_setting.startAt,
			'endAt'                      : + umbg_setting.endAt,
			'slideShowDuration'          : + umbg_setting.slideShowDuration,
			'slideShowEffect'            : umbg_setting.slideShowEffect,
			'slideShowTransitionDuration': + umbg_setting.slideShowTransitionDuration,
			'slideShowEasing'            : umbg_setting.slideShowEasing,
			//'slideShowOrder'             : umbg_setting.slideShowOrder,
			'audio'                      : + umbg_setting.audio,
			'startAudioMuted'            : + umbg_setting.startAudioMuted,
			'volumeLevel'                : umbg_setting.volumeLevel,
			'displayControls'            : + umbg_setting.displayControls,
			'placeControls'              : umbg_setting.placeControls,
			'controlColor'               : umbg_setting.controlColor,
			'controlBgColor'             : umbg_setting.controlBgColor,
			'pud'                        : + umbg_setting.pud,
			'pudDown'                    : + umbg_setting.pudDown,
			'pudUp'                      : + umbg_setting.pudUp,
			'pudShow'                    : umbg_setting.pudShow,
			'pudElement'                 : umbg_setting.pudElement,
			'fio'                        : + umbg_setting.fio,
			'fioStart'                   : + umbg_setting.fioStart,
			'fioEnd'                     : + umbg_setting.fioEnd,
			'fioOpacity'                 : + umbg_setting.fioOpacity,
			'fioElement'                 : umbg_setting.fioElement,
			'enlargeBy'                  : umbg_setting.enlargeBy,
			'delayBy'                    : umbg_setting.delayBy,
			'pageVisibilityPause'        : umbg_setting.pageVisibilityPause,
			'disableOnMobileAll'         : + umbg_setting.disableOnMobileAll,
			'disableOnMobileVideoOnly'   : + umbg_setting.disableOnMobileVideoOnly,
			'disableOnMobilePhonesOnly'  : + umbg_setting.disableOnMobilePhonesOnly

		} );// End - Initialize UMBG

		// If WP Admin Bar is displayed, lower player controls when 'tr' or 'tl' are selected.
		if ( $( '#wpadminbar' ).length && ( umbg_setting.placeControls === 'umbg-tr' ||
			umbg_setting.placeControls === 'umbg-tl') ) {
			$( '.umbg-tr, .umbg-tl' ).css( 'top', '3rem' );
		}

	} );

})( jQuery );