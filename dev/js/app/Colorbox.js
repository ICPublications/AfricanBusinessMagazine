// Colorbox gallery
define(['jquery', 'jquery.colorbox'], function($) {

	$(function() {
		if ( $('.gallery-item').length > 0 ) {
		
			// Add colorbox to gallery links
			$('.gallery-item .colorbox').colorbox({
				rel: 'gallery', 
				maxWidth: '70%', 
				maxHeight: '80%', 
				minWidth: '50%', 
				minHeight: '50%', 
				fadeOut: 0
			});
			
			// Prevent window scrolling when colorbox is open
			$(document).bind('cbox_open', function () {
				$('html').css('overflow', 'hidden');
			}).bind('cbox_closed', function () {
				$('html').css('overflow', 'auto');
			});
		}
	});
	
});