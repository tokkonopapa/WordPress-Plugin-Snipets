(function ($) {
	$(function () {
		function my_ajax_request( id ) {
			// `MyAjaxSample` is enqueued by wp_localize_script()
			$.post( MyAjaxSample.ajax_url, {
				action: MyAjaxSample.action,
				ajax_nonce: MyAjaxSample.ajax_nonce
			}).done( function( data, textStatus, jqXHR ) {
				// if no hander, response may be '0'
				$( id ).text( typeof data === 'object' ? data.message : 'deactivated' );
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
