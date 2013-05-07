(function ($) {
	$(function () {
		function my_ajax_request( id ) {
			// `MyAjax` is enqueued by wp_localize_script()
			$.post( MyAjax.url, {
				action: MyAjax.action,
				token: MyAjax.token
			}).done( function( data, textStatus, jqXHR ) {
				// if no hander, response may be '0'
				$( id ).text( '0' !== data ? data.message : 'deactivated' );
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				// if nonce does't match, response may be '-1'
				$( id ).text( jqXHR.responseText );
			});
		}

		// Preload now button
		$( '#my_ajax_sample' ).on( 'click', function() {
			$( '#my_ajax_response' ).text( "Requesting ..." );
			my_ajax_request( '#my_ajax_response' );
		});
	});
}(jQuery));
