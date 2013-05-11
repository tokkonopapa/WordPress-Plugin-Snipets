(function ($) {
	function myajax_request(id) {
		// `MyAjax` is enqueued by wp_localize_script()
		$.post(MyAjax.url, {
			action: MyAjax.action,
			token: MyAjax.token
		}).done(function (data, textStatus, jqXHR) {
			// if no hander, response may be '0'
			if ('0' !== data) {
				var msg = '';
				$.each(data, function (key, val) {
					msg += key + " => " + val + "<br />";
				});
				$(id).text('').append(msg);
			} else {
				$(id).text('deactivated');
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			// if nonce does't match, response may be '-1'
			$(id).text(jqXHR.responseText);
		});
	}

	$(function () {
		// Ajax button
		$('#myajax_sample').on('click', function () {
			$('#myajax_response').text("Requesting ...");
			myajax_request('#myajax_response');
		});
	});
}(jQuery));