(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $(document).ready(function() {
		$(".ced_add_to_cart").click(function(){
			var quantity = 0;
			if ($('#ced_quantity').length){
				quantity = 	$('#ced_quantity').val();	
			}
			else{		
				quantity = 1;
			}

			$.ajax({
				url:ajaxurl.ajax_url,
				type: 'POST',
				data: {
					'prod_id': $(this).attr('prod_id'),
					'quantity': quantity,
					'action': 'add_to_cart_ajax',
				},
				success:function(data) {
					
					alert("Added to cart Successfully");
				},
				error: function(errorThrown){
					console.log(errorThrown);
				}
			});

		}); 
		$(".ced_remove_from_cart").click(function(){
			
			$.ajax({
				url:ajaxurl.ajax_url,
				type: 'POST',
				data: {
					'remove': $(this).attr('prod_id'),
					'action': 'remove_from_cart_ajax',
				},
				success:function(data) {
					window.location='my-cart';
				},
				error: function(errorThrown){
					console.log(errorThrown);
				}
			});

		});
		$(".ced_proceed_to_checkout").click(function(){
				window.location='my-checkout';
		});
	});
})( jQuery );
