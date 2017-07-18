define(['jquery'], function($) {

	function IsSafari() {

		var is_safari = navigator.userAgent.toLowerCase().indexOf('safari/') > -1;
		return is_safari;

	}

	function equalHeight(elements) {

		var elems = $(elements);

		function changeHeight() {

			var maxHeight = -1;

			elems.each(function() {
				maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
			});

			elems.each(function() {
				$(this).height(maxHeight);
			});
		}

		changeHeight();

		$(window).resize(function() {
			elems.css('height', 'auto');
			changeHeight();
		});
	}

	function closeParent(link) {
		var dataParent = link.closest('[data-parent]');
		dataParent.fadeOut(function() {
			dataParent.addClass('is-closed');
		});
	}

	function scrollToAnchor(link) {

		console.log('scroll');
		
		var anchor = link.attr('href');

		var scrollElem = $('html, body');
		if(IsSafari()) {
			scrollElem = $('body');
		}

		//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
		var parts = anchor.split('#');
		var trgt = parts[1];

		//get the top offset of the target anchor
		var targetOffset = $('#'+trgt).offset();
		var targetTop = targetOffset.top - 140;

		//goto that anchor by setting the body scroll top to anchor top
		scrollElem.animate({
			scrollTop:targetTop
		}, 500, function() {
			if(link.data('target')) {
				$('#filter-nav').find('a[data-sort="' + link.data('target') + '"]').click();
			}
		});

	}

	function toggleElem(link) {
		var toggleRef = link.attr('data-toggle');
		$('.' + toggleRef).toggle();
		console.log(toggleRef);
	}

	function isScrolledIntoView(elem) {

		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();

		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height();

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) || (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );

	}

	return {
		IsSafari: IsSafari,
		equalHeight: equalHeight,
		closeParent: closeParent,
		scrollToAnchor: scrollToAnchor,
		toggleElem: toggleElem,
		isScrolledIntoView: isScrolledIntoView
	};

});