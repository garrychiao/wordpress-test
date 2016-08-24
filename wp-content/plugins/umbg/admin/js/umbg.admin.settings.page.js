/**
 * Ultimate Media Background WP - Admin Settings JS Document
 * For: UMBG Plugin v1.4
 *      http://codecanyon.net/user/theefarmer?ref=theefarmer
 *      http://theefarmer.com
 *
 * Author: TheeFarmer | Alendee Internet Solutions
 * Copyright: (c) 2015 Alendee Internet Solutions
 *
 * Last Change: 2015-12-04 - Remove height adjustment to Disallowed list.
 *              2015-10-18 - Enhance code format.
 *              2015-09-22 - Add support for WooCommerce.
 *                         - Enhance Sortable functionality.
 *              2015-06-23 - Add checkbox change events for disable on mobile phones only.
 *              2015-06-16 - Add checkbox change events for disable on mobile devices.
 *              2015-05-25 - Initial release.
 **/

(function ( $ ) {
	'use strict';

	$( document ).ready( function () {

		$( '#_umbg_control_color' ).spectrum( {
			preferredFormat    : "rgb",
			color              : $( '.umbg-overlay-color' ).val(),
			showInput          : true,
			showAlpha          : true,
			showInitial        : true,
			showButtons        : false,
			clickoutFiresChange: true,
			theme              : 'umbg-cp',

			change: function ( color ) {
				//$( '.umbg-overlay-preview').css('background-color', color.toRgbString());
			}
		} );

		$( '#_umbg_control_bgcolor' ).spectrum( {
			preferredFormat    : "rgb",
			color              : $( '.umbg-overlay-color' ).val(),
			showInput          : true,
			showAlpha          : true,
			showInitial        : true,
			showButtons        : false,
			clickoutFiresChange: true,
			theme              : 'umbg-cp',

			change: function ( color ) {
				//$( '.umbg-overlay-preview').css('background-color', color.toRgbString());
			}
		} );

		$( '._umbg_control_color_default' ).on( 'click', function ( e ) {
			e.preventDefault();
			$( '#_umbg_control_color' ).spectrum( "set", 'rgba(239, 239, 239, 0.9)' );
		} );
		$( '._umbg_control_bgcolor_default' ).on( 'click', function ( e ) {
			e.preventDefault();
			$( '#_umbg_control_bgcolor' ).spectrum( "set", 'rgba(39, 173, 211, 0.78)' );
		} );


		// START - SORTABLE BOX

		// Allowed html elements
		var a1 = document.getElementById( '_umbg_allow_authors' );
		var c1 = document.getElementById( '_umbg_allow_categories' );
		var pt1 = document.getElementById( '_umbg_allow_posts' );
		var pg1 = document.getElementById( '_umbg_allow_pages' );
		var wcc1 = document.getElementById( '_umbg_allow_wc_categories' );
		var wcp1 = document.getElementById( '_umbg_allow_wc_products' );


		// Strength of allowed html elements
		var a2 = document.getElementById( '_umbg_author_strength' );
		var c2 = document.getElementById( '_umbg_category_strength' );
		var pt2 = document.getElementById( '_umbg_post_strength' );
		var pg2 = document.getElementById( '_umbg_page_strength' );
		var wcc2 = document.getElementById( '_umbg_wc_category_strength' );
		var wcp2 = document.getElementById( '_umbg_wc_product_strength' );


		// Draggle & sortable html elements.
		var ad = $( '#umbg_authors_draggable' );
		var cd = $( '#umbg_categories_draggable' );
		var ptd = $( '#umbg_posts_draggable' );
		var pgd = $( '#umbg_pages_draggable' );
		var wccd = $( '#umbg_wc_categories_draggable' );
		var wcpd = $( '#umbg_wc_products_draggable' );

		// Custom Post Types & Categories
		var cpt = CustomPostTypes,
			cpc = CustomPostCats,
			cpt_allow_arr = [],
			cpt_strength_arr = [],
			cpt_draggable_arr = [],
			cpc_allow_arr = [],
			cpc_strength_arr = [],
			cpc_draggable_arr = [],
			cpta1 = [],
			cpta2 = [],
			cptd = [],
			cpca1 = [],
			cpca2 = [],
			cpcd = [];

		for ( var i = 0; i < cpt.length; i ++ ) {

			// Allowed html elements
			//cpt_allow_arr['cpt_allow_' + i] = '_umbg_allow_' + cpt[i];
			//cpt_strength_arr['cpt_strength_' + i] = '_umbg_' + cpt[i] + '_strength';
			//cpt_draggable_arr['cpt_draggable_' + i] = 'umbg_' + cpt[i] + '_draggable';


			cpta1[ i ] = document.getElementById( '_umbg_allow_' + cpt[ i ] );
			cpta2[ i ] = document.getElementById( '_umbg_' + cpt[ i ] + '_strength' );
			cptd[ i ] = $( '#umbg_' + cpt[ i ] + '_draggable' );

		}

		for ( var i = 0; i < cpc.length; i ++ ) {

			cpca1[ i ] = document.getElementById( '_umbg_allow_' + cpc[ i ] );
			cpca2[ i ] = document.getElementById( '_umbg_' + cpc[ i ] + '_strength' );
			cpcd[ i ] = $( '#umbg_' + cpc[ i ] + '_draggable' );

		}


		//var sortable_items = [ ad, cd, ptd, pgd, wccd, wcpd, cpcd, cptd ];

		function removePlLabel() {
			$( "#bar" ).each( function () {
				$( this ).find( 'span.umbg-priority-level' ).css( 'visibility', 'hidden' );
			} );
		}

		// Start Sortable.js functionality.
		var foo = document.getElementById( 'foo' );
		if ( foo ) {
			new Sortable( foo, {
				group   : 'allowed',
				store   : null,
				onUpdate: function ( event ) {
					var item = event.item; // dragged HTMLElement

					if ( item.id === 'umbg_authors_draggable' ) {
						a1.value = 1;
					}
					if ( item.id === 'umbg_categories_draggable' ) {
						c1.value = 1;
					}
					if ( item.id === 'umbg_posts_draggable' ) {
						pt1.value = 1;
					}
					if ( item.id === 'umbg_pages_draggable' ) {
						pg1.value = 1;
					}
					if ( item.id === 'umbg_wc_categories_draggable' ) {
						wcc1.value = 1;
					}
					if ( item.id === 'umbg_wc_products_draggable' ) {
						wcp1.value = 1;
					}


					if ( a1.value === '1' ) {
						var av = $( ad ).index() + 1;
						a2.value = av;
						$( ad ).find( 'span.umbg-priority-level' ).text( 'PL = ' + av );
					}
					if ( c1.value === '1' ) {
						var cv = $( cd ).index() + 1;
						c2.value = cv;
						$( cd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + cv );
					}
					if ( pt1.value === '1' ) {
						var ptv = $( ptd ).index() + 1;
						pt2.value = ptv;
						$( ptd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + ptv );
					}
					if ( pg1.value === '1' ) {
						var pgv = $( pgd ).index() + 1;
						pg2.value = pgv;
						$( pgd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + pgv );
					}
					if ( wcc1.value === '1' ) {
						var wccv = $( wccd ).index() + 1;
						wcc2.value = wccv;
						$( wccd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wccv );
					}
					if ( wcp1.value === '1' ) {
						var wcpv = $( wcpd ).index() + 1;
						wcp2.value = wcpv;
						$( wcpd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wcpv );
					}

					// Custom Post Types
					for ( var i = 0; i < cpt.length; i ++ ) {

						if ( item.id === cptd[ i ].prop( 'id' ) ) {
							cpta1[ i ].value = 1;
						}

						if ( cpta1[ i ].value === '1' ) {
							var cptv = cptd[ i ].index() + 1;
							cpta2[ i ].value = cptv;
							cptd[ i ].find( 'span.umbg-priority-level' ).text( 'PL = ' + cptv );

						}

					}

					// Custom Post Categories
					for ( var i = 0; i < cpc.length; i ++ ) {

						if ( item.id === cpcd[ i ].prop( 'id' ) ) {
							cpca1[ i ].value = 1;
						}

						if ( cpca1[ i ].value === '1' ) {
							var cpcv = cpcd[ i ].index() + 1;
							cpca2[ i ].value = cpcv;
							cpcd[ i ].find( 'span.umbg-priority-level' ).text( 'PL = ' + cpcv );
						}

					}


					removePlLabel();
				},
				onRemove: function ( event ) {
					var item = event.item; // dragged HTMLElement

					if ( item.id === 'umbg_authors_draggable' ) {
						a1.value = 0;
						a2.value = 0;
					}
					if ( item.id === 'umbg_categories_draggable' ) {
						c1.value = 0;
						c2.value = 0;

					}
					if ( item.id === 'umbg_posts_draggable' ) {
						pt1.value = 0;
						pt2.value = 0;
					}
					if ( item.id === 'umbg_pages_draggable' ) {
						pg1.value = 0;
						pg2.value = 0;
					}
					if ( item.id === 'umbg_wc_categories_draggable' ) {
						wcc1.value = 0;
						wcc2.value = 0;
					}
					if ( item.id === 'umbg_wc_products_draggable' ) {
						wcp1.value = 0;
						wcp2.value = 0;
					}


					if ( a1.value === '1' ) {
						var av = $( ad ).index() + 1;
						a2.value = av;
						$( ad ).find( 'span.umbg-priority-level' ).text( 'PL = ' + av );
					} else if ( a1.value === '0' ) {
						$( ad ).find( 'span.umbg-priority-level' ).hide();
					}
					if ( c1.value === '1' ) {
						var cv = $( cd ).index() + 1;
						c2.value = cv;
						$( cd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + cv );
					} else if ( c1.value === '0' ) {
						$( cd ).find( 'span.umbg-priority-level' ).hide();
					}

					if ( pt1.value === '1' ) {
						var ptv = $( ptd ).index() + 1;
						pt2.value = ptv;
						$( ptd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + ptv );
					} else if ( pt1.value === '0' ) {
						$( ptd ).find( 'span.umbg-priority-level' ).hide();
					}
					if ( pg1.value === '1' ) {
						var pgv = $( pgd ).index() + 1;
						pg2.value = pgv;
						$( pgd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + pgv );
					} else if ( pg1.value === '0' ) {
						$( pgd ).find( 'span.umbg-priority-level' ).hide();
					}
					if ( wcc1.value === '1' ) {
						var wccv = $( wccd ).index() + 1;
						wcc2.value = wccv;
						$( wccd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wccv );
					} else if ( wcc1.value === '0' ) {
						$( wccd ).find( 'span.umbg-priority-level' ).hide();
					}
					if ( wcp1.value === '1' ) {
						var wcpv = $( wcpd ).index() + 1;
						wcp2.value = wcpv;
						$( wcpd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wcpv );
					} else if ( wcp1.value === '0' ) {
						$( wcpd ).find( 'span.umbg-priority-level' ).hide();
					}


					// Custom Post Types
					for ( var i = 0; i < cpt.length; i ++ ) {

						if ( item.id === cptd[ i ].prop( 'id' ) ) {
							cpta1[ i ].value = 0;
							cpta2[ i ].value = 0;
						}

						if ( cpta1[ i ].value === '1' ) {
							var cptv = $( cptd[ i ] ).index() + 1;
							cpta2[ i ].value = cptv;
							$( cptd[ i ] ).find( 'span.umbg-priority-level' ).text( 'PL = ' + cptv );
						} else if ( cpta1[ i ].value === '0' ) {
							$( cptd[ i ] ).find( 'span.umbg-priority-level' ).hide();
						}

					}

					// Custom Post Categories
					for ( var i = 0; i < cpc.length; i ++ ) {

						if ( item.id === cpcd[ i ].prop( 'id' ) ) {
							cpca1[ i ].value = 0;
							cpca2[ i ].value = 0;
						}

						if ( cpca1[ i ].value === '1' ) {
							var cpcv = $( cpcd[ i ] ).index() + 1;
							cpca2[ i ].value = cpcv;
							$( cpcd[ i ] ).find( 'span.umbg-priority-level' ).text( 'PL = ' + cpcv );
						} else if ( cpca1[ i ].value === '0' ) {
							$( cpcd[ i ] ).find( 'span.umbg-priority-level' ).hide();
						}

					}


					removePlLabel();

				},
				onAdd   : function ( event ) {
					var item = event.item; // dragged HTMLElement

					if ( item.id === 'umbg_authors_draggable' ) {
						a1.value = 1;
					}
					if ( item.id === 'umbg_categories_draggable' ) {
						c1.value = 1;
					}
					if ( item.id === 'umbg_posts_draggable' ) {
						pt1.value = 1;
					}
					if ( item.id === 'umbg_pages_draggable' ) {
						pg1.value = 1;
					}
					if ( item.id === 'umbg_wc_categories_draggable' ) {
						wcc1.value = 1;
					}
					if ( item.id === 'umbg_wc_products_draggable' ) {
						wcp1.value = 1;
					}


					if ( a1.value === '1' ) {
						var av = $( ad ).index() + 1;
						a2.value = av;
						$( ad ).find( 'span.umbg-priority-level' ).text( 'PL = ' + av ).fadeIn().css( 'visibility', 'visible' );
					}
					if ( c1.value === '1' ) {
						var cv = $( cd ).index() + 1;
						c2.value = cv;
						$( cd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + cv ).fadeIn().css( 'visibility', 'visible' );
					}
					if ( pt1.value === '1' ) {
						var ptv = $( ptd ).index() + 1;
						pt2.value = ptv;
						$( ptd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + ptv ).fadeIn().css( 'visibility', 'visible' );
					}
					if ( pg1.value === '1' ) {
						var pgv = $( pgd ).index() + 1;
						pg2.value = pgv;
						$( pgd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + pgv ).fadeIn().css( 'visibility', 'visible' );
					}
					if ( wcc1.value === '1' ) {
						var wccv = $( wccd ).index() + 1;
						wcc2.value = wccv;
						$( wccd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wccv ).fadeIn().css( 'visibility', 'visible' );
					}
					if ( wcp1.value === '1' ) {
						var wcpv = $( wcpd ).index() + 1;
						wcp2.value = wcpv;
						$( wcpd ).find( 'span.umbg-priority-level' ).text( 'PL = ' + wcpv ).fadeIn().css( 'visibility', 'visible' );
					}

					// Custom Post Types
					for ( var i = 0; i < cpt.length; i ++ ) {

						if ( item.id === cptd[ i ].prop( 'id' ) ) {
							cpta1[ i ].value = 1;
						}

						if ( cpta1[ i ].value === '1' ) {
							var cptv = cptd[ i ].index() + 1;
							cpta2[ i ].value = cptv;
							cptd[ i ].find( 'span.umbg-priority-level' ).text( 'PL = ' + cptv ).fadeIn().css( 'visibility', 'visible' );
						}

						$( cptd[ i ] ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );

					}

					// Custom Post Categories
					for ( var i = 0; i < cpc.length; i ++ ) {

						if ( item.id === cpcd[ i ].prop( 'id' ) ) {
							cpca1[ i ].value = 1;
						}

						if ( cpca1[ i ].value === '1' ) {
							var cpcv = cpcd[ i ].index() + 1;
							cpca2[ i ].value = cpcv;
							cpcd[ i ].find( 'span.umbg-priority-level' ).text( 'PL = ' + cpcv ).fadeIn().css( 'visibility', 'visible' );
						}

						$( cpcd[ i ] ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );

					}


					$( ad ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );
					$( cd ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );
					$( ptd ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );
					$( pgd ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );
					$( wccd ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );
					$( wcpd ).find( 'span.umbg-priority-level' ).css( 'visibility', 'visible' );

					removePlLabel();
				}
			} );

			var bar = document.getElementById( 'bar' );
			new Sortable( bar, { group: 'allowed' } );

		}
		// END - SORTABLE

		// START - DISABLE MOBILE
		// If disable all is off then disable the other mobile options, else enable.
		$( '#_umbg_disable_mobile_all_2' ).change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$( this ).prop( 'value', 1 );
				$( '#_umbg_disable_mobile_all' ).prop( 'value', 1 );
				$( '#_umbg_disable_mobile_video_2' ).prop( 'disabled', true );
				$( '#_umbg_disable_mobile_phone_2' ).prop( 'disabled', true );
			} else {
				$( this ).prop( 'value', 0 );
				$( '#_umbg_disable_mobile_all' ).prop( 'value', 0 );
				$( '#_umbg_disable_mobile_video_2' ).prop( 'disabled', false );
				$( '#_umbg_disable_mobile_phone_2' ).prop( 'disabled', false );
			}
		} ).change();

		$( '#_umbg_disable_mobile_video_2' ).change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$( this ).prop( 'value', 1 );
				$( '#_umbg_disable_mobile_video' ).prop( 'value', 1 );
			} else {
				$( this ).prop( 'value', 0 );
				$( '#_umbg_disable_mobile_video' ).prop( 'value', 0 );
			}
		} ).change();

		$( '#_umbg_disable_mobile_phone_2' ).change( function () {
			if ( $( this ).prop( 'checked' ) ) {
				$( this ).prop( 'value', 1 );
				$( '#_umbg_disable_mobile_phone' ).prop( 'value', 1 );
			} else {
				$( this ).prop( 'value', 0 );
				$( '#_umbg_disable_mobile_phone' ).prop( 'value', 0 );
			}
		} ).change();
		// END - DISABLE MOBILE

	} );

})( jQuery );
