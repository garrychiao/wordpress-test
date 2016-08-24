/*
Plugin: Field Folding Extension for CMB2 Metabox
Version 1.1
Author: Ancil And Ron
Author URL: http://www.designova.net/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/


jQuery(document).ready(function($) {

	/**
	*
	* Define Checkbox Relation for Folding Fields configurations.
	*
	*/

	$('.cmb2-metabox input[type="checkbox"]').each(function(){
		
		if($(this).is(':checked'))
		{
			var this_ele = $(this).attr('id');

			$('.cmb2-metabox input[data-rel="'+this_ele+'"], .cmb2-metabox textarea[data-rel="'+this_ele+'"], .cmb2-metabox select[data-rel="'+this_ele+'"]').closest('.cmb-row').stop().slideDown(800);
		}
		else
		{
			var this_ele = $(this).attr('id');

			$('.cmb2-metabox input[data-rel="'+this_ele+'"], .cmb2-metabox textarea[data-rel="'+this_ele+'"], .cmb2-metabox select[data-rel="'+this_ele+'"]').closest('.cmb-row').stop().slideUp(800);
		}


	});
	

	$('.cmb2-metabox input[type="checkbox"]').on('click', function(){

		if($(this).is(':checked'))
		{
			var this_ele = $(this).attr('id');

			$('.cmb2-metabox input[data-rel="'+this_ele+'"], .cmb2-metabox textarea[data-rel="'+this_ele+'"], .cmb2-metabox select[data-rel="'+this_ele+'"]').closest('.cmb-row').stop().slideDown(800);
		}
		else
		{
			var this_ele = $(this).attr('id');

			$('.cmb2-metabox input[data-rel="'+this_ele+'"], .cmb2-metabox textarea[data-rel="'+this_ele+'"], .cmb2-metabox select[data-rel="'+this_ele+'"]').closest('.cmb-row').stop().slideUp(800);
		}

	});





	/**
	*
	* Define Select Field Relation for Folding Fields configurations.
	*
	*/

	$('.cmb2-metabox select').each(function(){
		
		var this_ele_val = $(this).val();
		$(this).find('option').each(function(){
			var exc_rel = $(this).attr('value');
			$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideUp(800);
		});
		$('input[data-rel="'+this_ele_val+'"], textarea[data-rel="'+this_ele_val+'"], select[data-rel="'+this_ele_val+'"]').closest('.cmb-row').stop().slideDown(800);
		$(this).data('old-opt-val', this_ele_val);
	});
	

	$('.cmb2-metabox select').change( function(){

		var this_ele_val = $(this).val();
		
		if($(this).data('old-opt-val'))
		{
			var this_old_val = $(this).data('old-opt-val');
			$('input[data-rel="'+this_old_val+'"], textarea[data-rel="'+this_old_val+'"], select[data-rel="'+this_old_val+'"]').closest('.cmb-row').stop().slideUp(800);
		}
		
		$('input[data-rel="'+this_ele_val+'"], textarea[data-rel="'+this_ele_val+'"], select[data-rel="'+this_ele_val+'"]').closest('.cmb-row').stop().slideDown(800);
		$(this).data('old-opt-val', this_ele_val);

	});






	$('#post-formats-select input[type="radio"]').each(function(){
		if($(this).attr('checked') == 'checked')
		{
			var exc_rel = $(this).attr('value');
			$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideDown(800);
		}
		else
		{
			var exc_rel = $(this).attr('value');
			$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideUp(800);
		}
	});

	$('#post-formats-select input[type="radio"]').on('click', function(){
		$('input[data-rel], textarea[data-rel], select[data-rel]').closest('.cmb-row').stop().slideUp(800);
		var exc_rel = $(this).attr('value');
		$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideDown(800);
	});



	//----

	$('.cmb2-metabox input[type="radio"]').each(function(){
		if($(this).attr('checked') == 'checked')
		{
			var exc_rel = $(this).attr('value');
			$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideDown(800);
		}
		else
		{
			var exc_rel = $(this).attr('value');
			$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideUp(800);
		}
	});

	$('.cmb2-metabox input[type="radio"]').on('click', function(){
		$('input[data-rel], textarea[data-rel], select[data-rel]').closest('.cmb-row').stop().slideUp(800);
		var exc_rel = $(this).attr('value');
		$('input[data-rel="'+exc_rel+'"], textarea[data-rel="'+exc_rel+'"], select[data-rel="'+exc_rel+'"]').closest('.cmb-row').stop().slideDown(800);
	});


	$('a.button.redux-slides-add').html('Add Icon');
	$('a.button.redux-slides-add').live('click', function(){
		$('.redux-slides-accordion div.redux-slides-accordion-group:last-child span.redux-slides-header').html('New Icon');	
		
	});

	$('.redux-slides-accordion div.redux-slides-accordion-group').each(function(){
		if($(this).find('span.redux-slides-header').html() == 'New Slide' || $(this).find('span.redux-slides-header').html() == '')
			$(this).find('span.redux-slides-header').html('New Icon');
	});

});