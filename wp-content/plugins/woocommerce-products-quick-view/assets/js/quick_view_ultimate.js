// JavaScript Document
jQuery(document).ready(function($) {
	$( document ).on( 'click', '.quick_view_plus, .quick_view_minus', function() {
		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.quick_view_plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );
	});

	$(document).on( 'click', '.quick_view_previous_control', function() {
		$('.quick_view_popup_loading').show();
		var product_id = $(this).attr('new-product-id');
		var orderby = $(this).attr('orderby');
		var is_shop = $(this).attr('is-shop');
		var is_category = $(this).attr('is-category');
		var qv_data = {
			action: "quick_view_load_previous_product",
			product_id : product_id,
			orderby: orderby,
			is_shop: is_shop,
			is_category: is_category
		};
		$.post( wc_qv_vars.ajax_url, qv_data, function(responsve){
			$('.quick_view_popup_container').html(responsve);
			$('.quick_view_popup_loading').hide();
		});
	});
	$(document).on( 'click', '.quick_view_next_control', function() {
		$('.quick_view_popup_loading').show();
		var product_id = $(this).attr('new-product-id');
		var orderby = $(this).attr('orderby');
		var is_shop = $(this).attr('is-shop');
		var is_category = $(this).attr('is-category');
		var qv_data = {
			action: "quick_view_load_next_product",
			product_id : product_id,
			orderby: orderby,
			is_shop: is_shop,
			is_category: is_category
		};
		$.post( wc_qv_vars.ajax_url, qv_data, function(responsve){
			$('.quick_view_popup_container').html(responsve);
			$('.quick_view_popup_loading').hide();
		});
	});
});