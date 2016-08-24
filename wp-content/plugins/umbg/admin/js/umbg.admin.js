/**
 * Ultimate Media Background WP - Admin Pages JS Document
 * For: UMBG Plugin v1.4
 *      http://codecanyon.net/user/theefarmer?ref=theefarmer
 *      http://theefarmer.com
 *
 * Author: TheeFarmer | Alendee Internet Solutions
 * Copyright: (c) 2015 Alendee Internet Solutions
 *
 * Last Change: 2015-12-04 - Add alphabetically reorder the 'Append To' list.
 *              2015-10-18 - Enhance code format.
 *              2015-09-22 - Add disable function to label for umbg-start-audio-muted.
 *                         - Add multi-select boxes (jquery.multi-select.js).
 *                         - Add image transition duration.
 *              2015-07-06 - Remove PUD restriction to display or hide controls.
 *              2015-06-23 - Add Wistia doNotTrack functionality.
 *              2015-05-25 - Initial release.
 **/

// Per WordPress suggestion of window.wp.
window.wp = window.wp || {};

(function ( $ ) {
	'use strict';

	$( document ).ready( function () {

		var objectL10n = window.objectL10n;

		var ytOptions = '<option value="">Auto</option>' +
				'<option value="highres">HD > 1080p</option>' +
				'<option value="hd1080">HD 1080p</option>' +
				'<option value="hd720">HD 720p</option>' +
				'<option value="large">480p</option>' +
				'<option value="medium">360p</option>' +
				'<option value="small">240p</option>',

			vimeoOptions = '<option value="0">Default</option>' +
				'<option value="1">HD</option>',

			dailyMotionOptions = '<option value="">Auto</option>' +
				'<option value="240">240</option>' +
				'<option value="380">380</option>' +
				'<option value="480">480</option>' +
				'<option value="720">HD 720</option>' +
				'<option value="1080">HD 1080</option>',

			wistiaOptions = '<option value="auto">Auto</option>' +
				'<option value="sd-only">Standard</option>' +
				'<option value="md">Medium</option>' +
				'<option value="hd-only">HD</option>',

			$qualityRow = $( '#umbg-quality-row' ),
			$quality = $( '#umbg-quality' ),
		//$qualitySelected = $( '#umbg-quality-selected' ).val(),
			$audio = $( '#umbg-audio' ),
			$volume = $( '#umbg-volume' ),
		//$controlsRow = $( '#umbg-controls-row' ),
			$controls = $( '#umbg-controls' ),
			$enlargeByRow = $( '#umbg-enlarge-by-row' ),
			$loopRow = $( '#umbg-loop-row' ),
			$loop = $( '#umbg-loop' ),
			$rewind = $( '#umbg-rewind-to-start-at' ),
			$mefo = $( '#umbg-mefo' ),
			$pudRow = $( '#umbg-pud-row' ),
			$pud = $( '#umbg-pud' ),
			$pudShow = $( '#umbg-pud-show' ),
			$pudUp = $( '#umbg-pud-up' ),
			$pudDown = $( '#umbg-pud-down' ),
			$fioRow = $( '#umbg-fio-row' ),
			$fio = $( '#umbg-fio' ),
			$fioIn = $( '#umbg-fio-start' ),
			$fioOut = $( '#umbg-fio-end' ),
			$fioOpacity = $( '#umbg-fio-opacity' ),
			$mediaPlayer = $( '#umbg-media-player-type' ),
			mediaId = '#umbg-media-id',
			$mediaId = $( mediaId ),
			$mediaIdLabel = $( '#umbg-media-id-label' ),
			$mediaIdDesc = $( '#umbg-media-id-description' ),
			$mediaIdSelectBtn = $( '#umbg-media-id-button' ),
			$imageIdSelectBtn = $( '#umbg-image-id-button' ),
			$posterRow = $( '#umbg-media-poster-row' ),
			poster = '#umbg-media-poster',
			$poster = $( poster ),
		//$posterLabel = $( '#umbg-media-poster-label' ),
		//$posterDesc = $( '#umbg-media-poster-description' ),
			$posterSelectBtn = $( '#umbg-media-poster-button' ),
			$posterRemoveBtn = $( '#umbg-media-poster-button-remove' ),
		//$overlayLabel = $('#umbg-overlay-row th' ),
			$overlayCheckBox = $( '#umbg-overlay' ),
			$overlayColor = $( '#umbg-overlay-color' ),
			$overlayCss = $( '#umbg-overlay-css' ),
			overlayPreview = '<div class="umbg-overlay-preview ' + $overlayCss.val() + '" style="background-color: ' + $overlayColor.val() + ';"></div>',
			fieldRequired = objectL10n.fieldRequired,
			imageLocationLabel = objectL10n.imageLocationLabel,
			colorLocationLabel = objectL10n.colorLocationLabel,
			colorImageLocation = objectL10n.colorImageLocation,
			mediaIdLabel = objectL10n.mediaIdLabel,
			mediaIdHtmlLabel = objectL10n.mediaIdHtmlLabel,
			descVideo = objectL10n.descVideo,
			descDm = objectL10n.descDm,
			descHtml5 = objectL10n.descHtml5,
			descImage = objectL10n.descImage
			;


		// START - Accordion
		$( '.ui.accordion' ).accordion();
		// END - Accordion


		// START - Multi-Select
		// Create search buttons
		function createSelectButton( id ) {
			$( '#' + id + '-select-all' ).click( function ( e ) {
				e.preventDefault();
				$( '#' + id ).multiSelect( 'select_all' );
			} );
		}

		function createDeselectButton( id ) {
			$( '#' + id + '-deselect-all' ).click( function ( e ) {
				e.preventDefault();
				$( '#' + id ).multiSelect( 'deselect_all' );
			} );
		}

		// If select elements exist then create multiselect boxes.
		if ( $( 'body' ).find( 'select .umbg-select' ) ) {

			var multiSelectArray = [];

			$( '.umbg-container-for-select select' ).each( function () {

				var id = $( this ).prop( 'id' );
				multiSelectArray.push( id );

				$( '#' + id ).multiSelect( {

					selectableHeader: '<a href="#" id="' + id + '-select-all" class="button umbg-append-button">Select' +
					' All</a>' +
					'<input type="text" id="umbg-select-all" class="umbg-search-input ' + id + '-search-input" autocomplete="off" placeholder="Search...">',

					selectionHeader: '<a href="#" id="' + id + '-deselect-all" class="button' +
					' umbg-append-button">Deselect All</a>' +
					'<input type="text" class="umbg-search-input ' + id + '-search-input" autocomplete="off"' +
					' placeholder="Search...">',

					afterInit: function ( ms ) {
						var that = this,
							$selectableSearch = that.$selectableUl.prev(),
							$selectionSearch = $( id + '-search-input' ), //that.$selectionUl.prev(),
							selectableSearchString = '#' + that.$container.attr( 'id' ) + ' .ms-elem-selectable:not(.ms-selected)',
							selectionSearchString = '#' + that.$container.attr( 'id' ) + ' .ms-elem-selection.ms-selected';

						that.qs1 = $selectableSearch.quicksearch( selectableSearchString )
							.on( 'keydown', function ( e ) {
								if ( e.which === 40 ) {
									that.$selectableUl.focus();
									return false;
								}
							} );

						that.qs2 = $selectionSearch.quicksearch( selectionSearchString )
							.on( 'keydown', function ( e ) {
								if ( e.which === 40 ) {
									that.$selectionUl.focus();
									return false;
								}
							} );

						this.qs1.cache();
						this.qs2.cache();

					}

				} );

				// Buttons
				createSelectButton( id );
				createDeselectButton( id );

				//
				var asd = $( '#ms-' + id + ' .ms-selection .ms-list li.ms-selected' ).length;
				if ( asd > 0 ) {
					$( '.' + id + '-title' ).css( {
						'background': 'transparent none repeat scroll 0 0',
						'color'     : 'rgba(0, 0, 0, 0.8)'
					} );
				}

			} );

		}
		// END - Multi-Select

		// START - SORT alphabetically all 'Allowed' items on 'Append To' list.
		var $divs = $( '.umbg-append-accordion > div' ).not( '.umbg-append-accordion > div.title, .umbg-append-accordion > div.content' );
		var alphabeticallyOrderedDivs = $divs.sort( function ( a, b ) {
			return $( a ).prop( 'id' ) > $( b ).prop( 'id' );
		} );
		$( '.umbg-append-accordion' ).append( alphabeticallyOrderedDivs );
		// END - Sort 'Allowed' items.

		// START - Initialize a new RangeSlider instance for all $('input[type="range"]') elements.
		if ( $( 'body' ).find( 'input[type="range"]' ) ) {
			$( 'input[type="range"]' ).rangeslider( {
				polyfill     : false,
				rangeClass   : 'umbg-rangeslider',
				disabledClass: 'umbg-rangeslider--disabled',
				fillClass    : 'umbg-rangeslider__fill',
				handleClass  : 'umbg-rangeslider__handle'

			} );

		}
		//END - RangeSlider

		/**
		 * WP Media Uploader customized for UMBG.
		 * @param inputBox
		 * @param mediaType
		 * @param multiple
		 */
		function selectMedia( inputBox, mediaType, multiple ) {

			multiple = multiple || false;

			var umbgFileFrame,
				attachment,
				selection
				;

			// If the media frame already exists, reopen it.
			if ( umbgFileFrame ) {
				umbgFileFrame.open();
				return;
			}

			// Create the media frame.
			umbgFileFrame = window.wp.media.frames.file_frame = window.wp.media( {
				//umbgFileFrame = wp.media.frames.file_frame = wp.media( {

				title   : $( this ).data( 'uploader_title' ),
				button  : {
					text: $( this ).data( 'uploader_button_text' )
				},
				multiple: multiple, // Set to true to allow multiple files to be selected
				library : {
					type: mediaType
				},

				autoSelect   : true,
				syncSelection: true

			} );

			// Open WP media frame & select current media.
			umbgFileFrame.on( 'open', function () {
				selection = umbgFileFrame.state().get( 'selection' );
				//var ids = $( inputBox + '-attachment-id' ).val().split( ',' );
				var id = $( inputBox + '-attachment-id' ).val(),
					ids
					;

				// If media is not found the set ids to empty.
				if ( id ) {
					ids = id.split( ',' );
				} else {
					ids = '';
				}

				if ( ids ) {
					for ( var i = 0; i < ids.length; i ++ ) {
						attachment = window.wp.media.attachment( ids[ i ] );
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					}
				}

			} );

			// When an image or video is selected, run a callback.
			umbgFileFrame.on( 'select', function () {

				selection = umbgFileFrame.state().get( 'selection' );

				// If multiple is true, then get all images from the uploader, else get only one.
				if ( multiple ) {

					var selected = [];
					selection.map( function ( file ) {
						selected.push( file.toJSON() );
					} );

					var urlArray = [];
					var idArray = [];
					for ( var i = 0; i < selected.length; i ++ ) {

						//urlArray.push( selected[ i ][ 'url' ] );
						//idArray.push( selected[ i ][ 'id' ] );
						urlArray.push( selected[ i ].url );
						idArray.push( selected[ i ].id );

					}
					urlArray.join();
					idArray.join();

					$( inputBox ).val( urlArray );
					$( inputBox + '-attachment-id' ).val( idArray );

				} else {
					attachment = selection.first().toJSON();
					//$( inputBox ).val( attachment[ 'url' ] );
					//$( inputBox + '-attachment-id' ).val( attachment[ 'id' ] );
					$( inputBox ).val( attachment.url );
					$( inputBox + '-attachment-id' ).val( attachment.id );
				}

				switch ( mediaType ) {
					case 'video':
						getVideoThumb();
						break;

					case 'image':
						if ( multiple ) {
							getVideoThumb();
						} else {
							getPosterThumb();
						}
						break;
				}

			} );

			// Finally, open the modal
			umbgFileFrame.open();
		}


		// START - MEDIA PREVIEW THUMB
		// Variable t is the time for some fade effect.
		var t = 500;

		// On input change, refresh preview.
		$mediaId.blur( function () {
			removeVideoThumb();
			getVideoThumb();
		} );

		// Media select buttons' functionality.
		$mediaIdSelectBtn.on( 'click', function ( event ) {
			event.preventDefault();
			selectMedia( mediaId, 'video' );
		} );

		$imageIdSelectBtn.on( 'click', function ( event ) {
			event.preventDefault();
			selectMedia( mediaId, 'image', true );
		} );

		$posterSelectBtn.on( 'click', function ( event ) {
			event.preventDefault();
			selectMedia( poster, 'image' );
		} );

		$posterRemoveBtn.on( 'click', function ( event ) {
			event.preventDefault();
			$poster.val( '' );
			$( '#umbg-media-poster-attachment-id' ).val( 0 );
			removePosterThumb();
		} );


		// Remove the media thumbnail preview.
		function removeVideoThumb() {
			//if ( $mediaId.val() !== $( '#umbg-media-id-thumb' ).prop( 'src' ) ) {
			$( '.umbg-media-id-preview' ).remove();
			//}
		}

		// Get the media thumbnail preview from the appropiate API.
		function getVideoPreview( id, mediaplayer ) {
			removeVideoThumb();

			var apiIframe,
				apiPreviewThumb
				;

			switch ( mediaplayer ) {
				case 'youtube':
					apiIframe = '<iframe id="umbg-media-id-thumb" src="//www.youtube-nocookie.com/embed/' + id +
						'?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
					break;
				case 'vimeo':
					apiIframe = '<iframe id="umbg-media-id-thumb" src="//player.vimeo.com/video/' + id +
						'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					break;
				case 'dailymotion':
					apiIframe = '<iframe id="umbg-media-id-thumb" src="//www.dailymotion.com/embed/video/' + id +
						'?id=umbg-media-id-thumb&chromeless=0&hideFacebookButton=1&hideTwitterButton=1&highlight=3897FC' +
						'&autoplay=0&info=0&logo=0&related=0&api=postMessage" frameborder="0" allowfullscreen></iframe>';
					break;
				case 'wistia':
					apiIframe = '<iframe id="umbg-media-id-thumb" src="http://fast.wistia.net/embed/iframe/' + id +
						'?controlsVisibleOnLoad=true&playerColor=688AAD&version=v1&wmode=transparent"' +
						'allowtransparency="true" frameborder="0" scrolling="no"></iframe>';
					break;
				case 'html5':
					// Get filename without file type extension.
					var videoFile = id;
					videoFile = videoFile.substring( 0, videoFile.lastIndexOf( "." ) );

					apiIframe = '<video id="umbg-media-id-thumb" preload="auto"  controls="controls">' +
						'<source src="' + videoFile + '.mp4" type="video/mp4">' +
						'<source src="' + videoFile + '.webm" type="video/webm">' +
						'<source src="' + videoFile + '.ogv" type="video/ogg">' +
						'</video>';
					break;
			}

			apiPreviewThumb = '<div class="umbg-media-id-preview">' +
				'<span class="ui left corner label">' +
				'<i class="umbg-thumb-icon dashicons dashicons-format-video"></i>' +
				'</span>' +
				overlayPreview +
				apiIframe +
				'</div>';

			$( apiPreviewThumb ).hide().appendTo( $( '#umbg-media-preview' ) ).fadeIn( t );
		}

		// Image media type thumbnail function.
		function getImageThumb( id ) {
			removeVideoThumb();

			var imgArray1 = id,
				imgArray2 = imgArray1.split( ',' ),
				length = imgArray2.length
				;

			for ( var i = 0; i < length; i ++ ) {
				var thumbImg = '<div class="umbg-media-id-preview">' +
					'<span class="ui left corner label">' +
					'<i class="umbg-thumb-icon dashicons dashicons-format-image"></i>' +
					'</span>' +
					overlayPreview +
					'<img id="umbg-media-id-thumb" src="' + imgArray2[ i ] + '" alt="Media Preview Image" />' +
					'   </div>';

				$( thumbImg ).hide().appendTo( $( '#umbg-media-preview' ) ).fadeIn( t );
			}

		}

		// Get the media preview thumbnail.
		function getVideoThumb() {
			if ( $( '#umbg-media-preview' ) ) {

				var mp = $mediaPlayer.val(),
					id = $mediaId.val()
					;

				if ( mp === 'image' || mp === 'color' ) {
					getImageThumb( id );
				} else {
					getVideoPreview( id, mp );
				}

				// If overlay is enable then show overlay preview.
				if ( $( '#umbg-overlay' ).prop( 'checked' ) ) {
					$( '.umbg-overlay-preview' ).show();
				} else {
					$( '.umbg-overlay-preview' ).hide();
				}
			}
		}

		getVideoThumb();

		// Remove the media poster preview thumbnail.
		function removePosterThumb() {
			if ( $poster.val() !== $( '#umbg-media-poster-thumb' ).prop( 'src' ) ) {
				//$( '.umbg-media-poster-preview' ).fadeOut( t , function () {
				//    $( this ).remove();
				//} );
				$( '.umbg-media-poster-preview' ).remove();
			}
		}

		// Get the media poster preview thumbnail.
		function getPosterThumb() {
			removePosterThumb();
			if ( $( '#umbg-media-preview' ) ) {
				if ( $poster.val() && $poster.val() !== $( '#umbg-media-poster-thumb' ).prop( 'src' ) ) {
					var thumbImg = '<div class="umbg-media-poster-preview">' +
						'<span class="ui left corner label">' +
						'<i class="umbg-thumb-icon dashicons dashicons-format-image"></i>' +
						'</span>' +
						overlayPreview +
						'<img id="umbg-media-poster-thumb" src="' + $poster.val() + '" alt="" />' +
						'   </div>';
					$( thumbImg ).appendTo( $( '#umbg-poster-preview' ) ).hide().fadeIn( t );
				}

				// If overlay is enable then show overlay preview.
				if ( $( '#umbg-overlay' ).prop( 'checked' ) ) {
					$( '.umbg-overlay-preview' ).show();
				} else {
					$( '.umbg-overlay-preview' ).hide();
				}
			}
		}

		getPosterThumb();
		// END - MEDIA PREVIEW THUMB

		// START - Video Quality
		function selectedQuality() {
			$( '#umbg-quality > option' ).each( function () {
				if ( $( this ).val() === $( '#umbg-quality-selected' ).val() ) {
					$( this ).attr( 'selected', 'selected' );
				}
			} );
		}


		$mediaPlayer.change( function () {

			var mediaIdValue = $mediaId.val(),
				t2 = 1000,
				mp = $mediaPlayer.val()
				;

			if ( mp === 'image' ) {

				if ( mediaIdValue === colorImageLocation ) {
					mediaIdValue = '';
				}
				$mediaId.val( mediaIdValue );
				$mediaIdLabel.html( imageLocationLabel + ' <span class="description">' + fieldRequired + '</span>' );
				$mediaId.fadeIn( t2 ).show();
				$mediaIdDesc.fadeIn( t2 ).show();
				$mediaIdDesc.html( descImage );
				$mediaIdSelectBtn.fadeOut( t2 ).hide();
				$imageIdSelectBtn.fadeIn( t2 ).show();
				$posterRow.fadeOut( t2 ).hide();
				$qualityRow.fadeOut( t2 ).hide();
				$enlargeByRow.fadeIn( t2 ).show();
				$quality.empty();
				$audio.prop( 'checked', false );
				$pudRow.fadeIn( t2 ).show();
				$( '#umbg-start-at-row, #umbg-endat-row, #umbg-audio-row, #umbg-volume-row, ' +
					'#umbg-wistia-tracking-row' ).fadeOut( t2 ).hide();
				$( '#umbg-fio-row, #umbg-image-duration-row, #umbg-image-transition-duration-row, #umbg-image-order-row,' +
					' #umbg-image-effect-row, #umbg-image-easing-row, #umbg-controls-row, #umbg-overlay, ' +
					'#umbg-aspect-ratio-row, label[for=umbg-overlay]' ).fadeIn( t2 ).show();

			} else if ( mp === 'color' ) {

				$mediaIdLabel.html( colorLocationLabel );
				$mediaId.fadeOut( t2 ).hide();
				$mediaId.val( colorImageLocation );
				$mediaIdDesc.fadeOut( t2 ).hide();
				$mediaIdSelectBtn.fadeOut( t2 ).hide();
				$imageIdSelectBtn.fadeOut( t2 ).hide();
				$posterRow.fadeOut( t2 ).hide();
				$qualityRow.fadeOut( t2 ).hide();
				$enlargeByRow.fadeOut( t2 ).hide();
				$quality.empty();
				$audio.prop( 'checked', false );
				$( '#umbg-controls-row' ).prop( 'checked', false );
				$overlayCheckBox.prop( 'checked', true );
				$overlayCss.prop( 'disabled', false );
				$overlayColor.prop( 'disabled', false );
				$overlayColor.spectrum( 'enable' );
				$( '.umbg-overlay-preview' ).show();
				$( '#umbg-overlay, label[for=umbg-overlay]' ).hide();
				$loopRow.fadeOut( t2 ).hide();
				$loop.prop( 'checked', false );
				$pudRow.fadeOut( t2 ).hide();
				$( '#umbg-fio-row, #umbg-start-at-row, #umbg-endat-row, #umbg-audio-row, #umbg-volume-row, ' +
					'#umbg-aspect-ratio-row, #umbg-image-duration-row, #umbg-image-transition-duration-row, ' +
					'#umbg-image-effect-row, #umbg-image-easing-row, #umbg-image-order-row, #umbg-controls-row, ' +
					'#umbg-wistia-tracking-row' ).fadeOut( t2 ).hide();

			} else {

				if ( mediaIdValue === colorImageLocation ) {
					mediaIdValue = '';
				}
				$mediaIdLabel.html( mediaIdLabel + ' <span class="description">' + fieldRequired + '</span>' );
				$mediaId.fadeIn( t2 ).show();
				$mediaId.val( mediaIdValue );
				$mediaIdDesc.html( descVideo );
				$mediaIdSelectBtn.fadeOut( t2 ).hide();
				$imageIdSelectBtn.fadeOut( t2 ).hide();
				$qualityRow.fadeIn( t2 ).show();
				$posterRow.fadeIn( t2 ).show();
				$enlargeByRow.fadeIn( t2 ).show();
				$loopRow.fadeIn( t2 ).show();
				$pudRow.fadeIn( t2 ).show();
				selectedQuality();
				$( '#umbg-fio-row, #umbg-start-at-row, #umbg-endat-row, #umbg-audio-row, #umbg-volume-row, ' +
					'#umbg-aspect-ratio-row, #umbg-controls-row, #umbg-overlay, label[for=umbg-overlay]' ).fadeIn( t2 ).show();
				$( '#umbg-start-at-image-description, #umbg-image-duration-row, #umbg-image-transition-duration-row, ' +
					'#umbg-image-fade-row, #umbg-image-order-row, #umbg-image-effect-row, #umbg-image-easing-row, ' +
					'#umbg-wistia-tracking-row' ).fadeOut( t2 ).hide();

				switch ( mp ) {
					case 'youtube':
						$quality.empty().append( ytOptions );
						break;
					case 'vimeo':
						$quality.empty().append( vimeoOptions );
						break;
					case 'dailymotion':
						$mediaIdDesc.html( descDm );
						$quality.empty().append( dailyMotionOptions );
						break;
					case 'wistia':
						//$mediaIdDesc.html( descDm );
						$quality.empty().append( wistiaOptions );
						$( '#umbg-wistia-tracking-row' ).fadeIn( t2 ).show();
						break;
					case 'html5':
						$mediaIdLabel.html( objectL10n.mediaIdHtmlLabel + ' <span class="description">' + fieldRequired + '</span>' );
						$mediaIdDesc.html( descHtml5 );
						$mediaIdSelectBtn.fadeIn( t2 ).show();
						$qualityRow.fadeOut( t2 ).hide();
						$quality.empty();
						break;
				}

			}
			removeVideoThumb();
			getVideoThumb();

		} ).change();

		// END - Video Quality

		// START - Audio
		$audio.change( function () {
			if ( $( this ).attr( 'checked' ) ) {

				$( '#umbg-start-audio-muted' ).prop( 'disabled', false );
				$( 'label[for="umbg-start-audio-muted"]' ).css( { 'color': 'inherit' } );

				$volume.prop( 'disabled', false );
				$( '#umbg-volume-output, #umbg-volume ~ p' ).removeClass( 'umbg-rangeslider--disabled' );
			} else {

				$( '#umbg-start-audio-muted' ).prop( 'disabled', true );
				$( 'label[for="umbg-start-audio-muted"]' ).css( { 'color': '#c2c2c2' } );

				$volume.prop( 'disabled', true );
				$( '#umbg-volume-output, #umbg-volume ~ p' ).addClass( 'umbg-rangeslider--disabled' );
			}
			$volume.rangeslider( 'update' );
		} ).change();

		$volume.change( function () {
			$( '#umbg-volume-output' ).html( $( this ).val() );
			//document.querySelector('#umbg-volume-output').value = $(this).val();
		} ).change();

		// END - Audio

		// START - Overlay
		$overlayColor.spectrum( {
			preferredFormat    : "rgb",
			color              : $( '.umbg-overlay-color' ).val(),
			showInput          : true,
			showAlpha          : true,
			showInitial        : true,
			showButtons        : false,
			clickoutFiresChange: true,
			theme              : 'umbg-cp',

			change: function ( color ) {
				$( '.umbg-overlay-preview' ).css( 'background-color', color.toRgbString() );
			}
		} );

		// If overlay is off disable overlay options, else enable.
		$( '#umbg-overlay' ).change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$overlayCss.prop( 'disabled', false );
				$overlayColor.prop( 'disabled', false );
				$overlayColor.spectrum( 'enable' );
				$( '.umbg-overlay-preview' ).show();
			} else {
				$overlayCss.prop( 'disabled', true );
				$overlayColor.prop( 'disabled', true );
				$overlayColor.spectrum( 'disable' );
				$( '.umbg-overlay-preview' ).hide();
			}
		} ).change();

		$overlayCss.change( function () {
			$( '.umbg-overlay-preview' ).prop( 'class', 'umbg-overlay-preview ' + $( this ).val() );
		} ).change();

		$( '.umbg-overlay-color-default' ).on( 'click', function ( e ) {
			e.preventDefault();
			$overlayColor.spectrum( "set", 'rgba(0, 0, 0, 0.4)' );
			$( '.umbg-overlay-preview' ).css( 'background-color', 'rgba(0, 0, 0, 0.4)' );
		} );

		// END - Overlay

		// START - Loop
		$loop.change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$rewind.prop( 'checked', false ).prop( 'disabled', true );
				$mefo.prop( 'checked', false ).prop( 'disabled', true );
			} else {
				$rewind.prop( 'disabled', false );
				$mefo.prop( 'disabled', false );
			}
		} ).change();
		// END - Loop

		// START - Play Controls & PUD
		$pud.change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$pudDown.prop( 'disabled', false );
				$pudUp.prop( 'disabled', false );
				$pudShow.prop( 'disabled', false );

			} else {
				$pudDown.prop( 'disabled', true );
				$pudUp.prop( 'disabled', true );
				$pudShow.prop( 'disabled', true );
			}
		} ).change();

		// END - PUD

		// START - FIO
		$fio.change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$fioIn.prop( 'disabled', false );
				$fioOut.prop( 'disabled', false );

			} else {
				$fioIn.prop( 'disabled', true );
				$fioOut.prop( 'disabled', true );
			}
		} ).change();

		$fioOpacity.change( function () {
			$( '#umbg-fio-output' ).html( $( this ).val() );
		} ).change();
		// END - FIO

		// START - Enlarge By
		$( '#umbg-enlarge-by' ).change( function () {
			$( '#umbg-enlarge-by-output' ).html( $( this ).val() + '%' );
		} ).change();

		// END - Enlarge By

		// START - UMBG CUSTOM POST TYPE FORM VALIDATION
		$( '#publish' ).on( 'click', function ( e ) {

			if ( $( '#umbg-media-player-id' ).val() === '' ) {
				e.preventDefault();
				$( '#umbg-media-player-id' ).focus();
				$( '#umbg-media-player-id-row' ).addClass( 'form-required form-invalid' );
			}
			if ( $( '#umbg-media-poster' ).val() && $( '#umbg-media-poster-css-class' ).val() === '' ) {
				e.preventDefault();
				$( '#umbg-media-poster-css-class' ).focus();
				$( '#umbg-media-poster-css-class-row' ).addClass( 'form-required form-invalid' );
			}
			if ( $mediaId.val() === '' ) {
				e.preventDefault();
				$mediaId.focus();
				$( '#umbg-media-id-row' ).addClass( 'form-required form-invalid' );
			}

		} );
		// END - UMBG CUSTOM POST TYPE FORM VALIDATION

	} );

})( jQuery );