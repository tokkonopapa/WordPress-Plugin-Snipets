(function ($) {
	$(function () {
		function my_ajax_call( id ) {
			// `MyAjaxSample` is enqueued by wp_localize_script()
			$.post( MyAjaxSample.ajax_url, {
				action: MyAjaxSample.action,
				ajax_nonce: MyAjaxSample.ajax_nonce
			// response: 0 (no handler) / -1 (invalid nonce)
			}).done( function( data, textStatus, jqXHR ) {
				$( id ).text( '0' !== data ? data : 'deactivated' );
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				$( id ).text( jqXHR.responseText );
			});
		}

		// Preload now button
		$( '#my_ajax_sample' ).on( 'click', function() {
			$( '#my_ajax_response' ).text( "Requesting ..." );
			my_ajax_call( '#my_ajax_response' );
		});
	});
}(jQuery));
