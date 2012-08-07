// Testimonials Rotation
	$(document).ready(function() {
		setupRotator();
	});
	function setupRotator() {
		if ($('.textItem').length > 1) {
			$('.textItem:first').addClass('current').fadeIn(2000);
			setInterval('textRotate()', 6000);
		}
	}
	function textRotate() {
		var current = $('#quotes > .current');
		if (current.next().length == 0) {
			current.removeClass('current').fadeOut(2000);
			$('.textItem:first').addClass('current').fadeIn(2000);
		} else {
			current.removeClass('current').fadeOut(2000);
			current.next().addClass('current').fadeIn(2000);
		}
	}
