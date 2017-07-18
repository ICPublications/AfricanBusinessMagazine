define(['jquery'], function($) {

	function polyfills() {

		// These polyfills are for IE8 when using equal-span() mixin

		// Homepage categories
		$('ul.latest-articles > li:nth-of-type(3n+1)').addClass('pf-4-1');
		$('ul.latest-articles > li:nth-of-type(3n+2)').addClass('pf-4-2');
		$('ul.latest-articles > li:nth-of-type(3n+3)').addClass('pf-4-3');

		// Sister sites
		$('ul.list-images > li:nth-of-type(4n+1)').addClass('pf-3-1');
		$('ul.list-images > li:nth-of-type(4n+2)').addClass('pf-3-2');
		$('ul.list-images > li:nth-of-type(4n+3)').addClass('pf-3-3');
		$('ul.list-images > li:nth-of-type(4n+4)').addClass('pf-3-4');

		// Related articles
		$('ul.related-articles > li:nth-of-type(3n+1)').addClass('pf-4-1');
		$('ul.related-articles > li:nth-of-type(3n+2)').addClass('pf-4-2');
		$('ul.related-articles > li:nth-of-type(3n+3)').addClass('pf-4-3');

		// Footer links
		$('div#footer-links > nav.menu:nth-of-type(5n+1)').addClass('pf-2-1');
		$('div#footer-links > nav.menu:nth-of-type(5n+2)').addClass('pf-2-2');
		$('div#footer-links > nav.menu:nth-of-type(5n+3)').addClass('pf-2-3');
		$('div#footer-links > nav.menu:nth-of-type(5n+4)').addClass('pf-2-4');
		$('div#footer-links > nav.menu:nth-of-type(5n+5)').addClass('pf-2-5');

		// Article lists
		$('article.medium-list:nth-of-type(2n+1)').addClass('pf-6-1');
		$('article.medium-list:nth-of-type(2n+2)').addClass('pf-6-2');

		// Magazine subscribe issues
		$('ul.subscribe-issues > li:nth-of-type(4n+1)').addClass('pf-3-1');
		$('ul.subscribe-issues > li:nth-of-type(4n+2)').addClass('pf-3-2');
		$('ul.subscribe-issues > li:nth-of-type(4n+3)').addClass('pf-3-3');
		$('ul.subscribe-issues > li:nth-of-type(4n+4)').addClass('pf-3-4');

	}

	return {
		polyfills: polyfills
	};

});