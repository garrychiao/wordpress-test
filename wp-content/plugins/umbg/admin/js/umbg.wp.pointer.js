/**
 * Ultimate Media Background WP - WP Pointer JS Document
 * For: UMBG Plugin v1.0
 *      http://codecanyon.net/user/theefarmer?ref=theefarmer
 *      http://theefarmer.com
 *
 * Author: TheeFarmer | Alendee Internet Solutions
 * Copyright: (c) 2015 Alendee Internet Solutions
 *
 * Last Change: 2015-10-18 - Enhance code format.
 *              2015-05-25 - Initial release.
 **/

jQuery( document ).ready( function ( $ ) {
	'use strict';

	umbg_open_pointer( 0 );
	function umbg_open_pointer( i ) {
		var pointer,
			options,
			showOrHide
			;

		pointer = umbgPointer.pointers[ i ];
		options = $.extend( pointer.options, {
			close: function () {
				$.post( ajaxurl, {
					pointer: pointer.pointer_id,
					action : 'dismiss-wp-pointer'
				} );
			}
		} );

		// Load the pointer.
		$( pointer.target ).pointer( options ).pointer( 'open' );

		// On window resize adjust placement but if window size is less than 782px remove the pointer.
		$( window ).resize( function () {
			if ( $( window ).width() > 782 ) {
				$( pointer.target ).pointer( options ).pointer( 'open' );
			}
		} );

		// Show or hide pointer (does not closes it) when help link is clicked.
		$( '#contextual-help-link' ).on( 'click', function () {

			if ( showOrHide === false ) {
				$( '.wp-pointer' ).fadeIn( 700 ).show();
				showOrHide = true;
			} else {
				$( '.wp-pointer' ).fadeOut( 700 ).hide();
				showOrHide = false;
			}
			//$( '.wp-pointer' ).toggle( showOrHide ); // This is the same as above code but without fade effect.

		} );
	}

} );