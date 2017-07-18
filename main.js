require.config({
	paths: {
		'jquery': '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min',
		'underscore': 'lib/underscore-min',
		'sharethis': '//w.sharethis.com/button/buttons',
		'jquery.colorbox': '//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min'
	},
	'shim': {
		'jquery.colorbox': ['jquery']
	}
});

// Colorbox
require(['app/Colorbox']);

// Tracking
require(['jquery'], function($) {

	$(document).ready(function() {

		/* Attach event to outbound ad clicks */
		$('.ad-unit a').addClass('banner-link'); 

		$('.person-pic').mouseenter(function(){
            var person;
            person = $(this).attr('id');

            $('.person-info').stop().fadeOut();
            $('#' + person + '-large').stop().fadeIn();
        }) 
	});

});

// Browser Fixes
require(['jquery', 'app/utils', 'app/browser-fixes'], function($, utils, browserFixes) {
		
	$(document).ready(function() {
		

		// Initialize various components

			// Search toggle
			$(document).on('click', '#large-search-toggle', function() {
				utils.toggleElem($(this));
				positionHeaders();
				return false;
			});

			// Scrolling anchor links
			$(document).on('click', 'a.scroll', function() {
					utils.scrollToAnchor($(this));
					return false;
			});

			// Close buttons
			$(document).on('click', 'a.close', function() {
					utils.closeParent($(this));
					return false;
			});

			// Social popups
			$(document).on('click', 'a.popup', function(event) {
					var width  = 575,  
					height = 400,  
					left = ($(window).width() - width) / 2,  
					top = ($(window).height() - height) / 2,  
					url = $(this).attr('href'),   
					opts = 'status=1' +  
					',width=' + width +   
					',height=' + height + 
					',top=' + top +   
					',left=' + left;  

					window.open(url, 'twitter', opts);

					return false;
				});


		// Initialize browser polyfills
		
			if($('body').hasClass('ie8')) {
				browserFixes.polyfills();
			}

	});
	
});

// Mobile side nav
require(['jquery', 'app/Sidenav'], function($, Sidenav) {

	$(document).ready(function() {

		// Display elements hidden in css to stop visual js building on load
		$('div.menu-primary-wrapper, div.menu-secondary-wrapper').removeClass('js-menu-build');

		function navInits() {

			var navOverlay = $('<div class="nav-overlay">').prependTo('body');

			$('#search-toggle, #social-toggle, #secondary-toggle').on('click', function() {
				if(!navOverlay.is(':visible')) { navOverlay.fadeIn(); }
			});

			Sidenav.allInstances = []; // Create array to store all instances of side navs

			mobileNav = new Sidenav({
				element: 'nav#menu-primary-container',
				toggle: 'a#cat-toggle',
				changeText: false,
				closeText: '&larr; Back'
			});

			mobileNav.initialize();
			Sidenav.allInstances.push(mobileNav); // Push instance to array

			mobileNav.closeBtn.on('click', function() { // Close button function
				mobileSecondary.openNav();
			});

			regionNav = new Sidenav({
				element: 'nav#menu-region-container',
				toggle: 'a#region-toggle',
				changeText: false,
				closeText: '&larr; Back'
			});

			regionNav.initialize();
			Sidenav.allInstances.push(regionNav); // Push instance to array

			regionNav.closeBtn.on('click', function() { // Close button function
				mobileSecondary.openNav();
			});

			mobileSecondary = new Sidenav({
				element: 'nav#menu-secondary-container',
				toggle: 'a#secondary-toggle',
				changeText: false
			});

			mobileSecondary.initialize();
			Sidenav.allInstances.push(mobileSecondary); // Push instance to array

			mobileSecondary.closeBtn.on('click', function() { // Close button function
				mobileSecondary.closeNav();
				if(navOverlay.is(':visible')) { navOverlay.fadeOut(); }
			});

			mobileSearch = new Sidenav({
				element: 'form#searchform',
				toggle: 'a#search-toggle',
				changeText: false
			});

			mobileSearch.initialize();
			Sidenav.allInstances.push(mobileSearch); // Push instance to array

			mobileSearch.closeBtn.on('click', function() { // Close button function
				mobileSearch.closeNav();
				if(navOverlay.is(':visible')) { navOverlay.fadeOut(); }
			});

			mobileSocial = new Sidenav({
				element: 'header#site-header ul.connect',
				toggle: 'a#social-toggle',
				changeText: false
			});

			mobileSocial.initialize();
			Sidenav.allInstances.push(mobileSocial); // Push instance to array

			mobileSocial.closeBtn.on('click', function() { // Close button function
				mobileSocial.closeNav();
				if(navOverlay.is(':visible')) { navOverlay.fadeOut(); }
			});
		}

		// Init / destroy on browser size
		var mobileInit = false;
		
		if($(window).width() < 768) {
			navInits();
			mobileInit = true;
		}

		// Destroy / init category slider on browser resize
		$(window).on('resize', function() {

			if($(window).width() <= 768 && mobileInit === false) {
				navInits();
				mobileInit = true;
			}
			if($(window).width() > 768 && mobileInit === true) {
				mobileNav.destroy();
				regionNav.destroy();
				mobileSecondary.destroy();
				mobileSearch.destroy();
				mobileInit = false;
			}

		});

	});	

});

// Fixed headers
require(['jquery', 'app/Fixedheader'], function($, Fixedheader) {

	$(document).ready(function() {
	
		// Create array of all fixed headers
		Fixedheader.allInstances = []; // Create array to store all instances of side navs

		// Fixed nav on inner pages
		if(!$('body').hasClass('home')) {
			fixedNav = new Fixedheader({
				element: 'div.fixed-nav',
				topStop: 0
			});

			fixedNav.initialize();
			Fixedheader.allInstances.push(fixedNav);
		}
		
		// Fixed share utility bar for articles		
		if($('div.share-utils').length) {
			shareHeader = new Fixedheader({
				element: 'div.share-utils',
				topStop: 1000
			});

			shareHeader.initialize();
			Fixedheader.allInstances.push(shareHeader);
		}

		// Position fixed headers - Needs placing inside Fixedheader.js
		function positionHeaders() {

			var headerPos = 0;
			var index = Fixedheader.allInstances.length;

			for (var i = 0; i < Fixedheader.allInstances.length; i++) {
				
				var thisHeader = Fixedheader.allInstances[i].floatingHeader;
				thisHeader.css({
						top: headerPos, // Set position
						zIndex: 100 + index 	// Set z-index
				});

				headerPos += thisHeader.height();
				index -= 1;

			}
		}
			
		positionHeaders();

		$(window).on('resize', function() {
			positionHeaders();

			// Shift share header up on mobile
			if($(window).width() <= 768) {
				$('div.share-utils').css('top', '0px');
			}
		});
	});		

});

// Content sliders
require(['jquery', 'app/Contentslider', 'app/utils'], function($, Contentslider, utils) {
	
	$(document).ready(function() {

		// Homepage content slider
		if ( $('ul#promo-slider').length ) {
		
			var homeSlider = new Contentslider({
				uniqueid: 1,
				element: 'ul#promo-slider',
				slides: 'ul#promo-slider > li'
			});

			homeSlider.initialize();

			// Title controls
			var titleLinks = $('ul[data-slider-ref="promo-slider"]').find('a');
			titleLinks.first().addClass('is-current-title');

			titleLinks.on('click', function() {
				titleLinks.removeClass('is-current-title');
				homeSlider.slideToNum($(this).data('ref'));
				$(this).addClass('is-current-title');
				return false;
			});

			// Auto slider function
			function homeAutoSliderFunc() {
				// Highlighting for current title nav
				var nextTitleLink;

				if(titleLinks.filter('.is-current-title').parent().is(':last-child')) {
					nextTitleLink = titleLinks.first();
				} else {
					nextTitleLink = titleLinks.filter('.is-current-title').parent().next().find('a');
				}
				
				titleLinks.removeClass('is-current-title');
				homeSlider.slideToNext();
				nextTitleLink.addClass('is-current-title');
			}

			// Initiate auto slider
			var homeAutoSlider = setInterval(function() { homeAutoSliderFunc(); }, 9000);

			// Pause auto slider on hover
			$('#promo-slider, ul.slider-title-nav').hover(function() {
				clearInterval(homeAutoSlider);
			}, function() {
				homeAutoSlider = setInterval(function() { homeAutoSliderFunc(); }, 9000);
			});

			// Promo slider equal height columns
			// utils.equalHeight($('ul#promo-slider').find('div.article-content'));

			// Categories slider
			var catSliderInit = false;
			var catSlider = new Contentslider({
				uniqueid: 2,
					element: 'ul.latest-articles',
					slides: 'ul.latest-articles > li',
					slidecount: 2,
					slidepadding: 10
				});

			if( $(window).width() < 768 ) {
				catSlider.initialize();
				catSliderInit = true;
			}

			// Destroy / init category slider on browser resize
			$(window).on('resize', function() {

				if($(window).width() <= 768 && catSliderInit === false) {
					catSlider.initialize();
					catSliderInit = true;
				}
				if($(window).width() > 768 && catSliderInit === true) {
					catSlider.destroy();
					catSliderInit = false;
				}

			});
		}
		
	});
	
});

// Galleries
require(['jquery', 'app/Megaslider', 'app/utils'], function($, Megaslider, utils) {
	
	$(window).load(function() {
	
		var gallerySliders = [];
		var galleryThumbnailSliders = [];
		
		if ( $('.gallery').length ) {
			$('.gallery').each(function(index, element) {
				var reference = index,
					thumbNav = $('.thumbnail-nav', this),
					thumbs = $('.thumbnail-link', this),
					activeState = 'is-active';

				// Push gallery to array
				gallerySliders[reference] = new Megaslider({
					element: element,
					slides: '#' + element.id + ' .gallery-items > li',
					legacySupport: true
				});
				gallerySliders[reference].init();

				// Check if on full gallery page
				var thumbCount;

				if($('body.page-gallery, body.single-format-gallery').length) {
					thumbCount = 6;
				} else {
					thumbCount = 4;
				}

				// Set up thumbnail slider
				galleryThumbnailSliders[reference] = new Megaslider({
					element: '#' + element.id + ' .thumbnail-nav',
					slides: '#' + element.id + ' .thumbnail-nav > li',
					slidecount: thumbCount,
					legacySupport: true
				});
				galleryThumbnailSliders[reference].init();


				// Setup thumbnail navigation
				thumbs.each(function(index, element) {
					if (index == 0) {
						$(element).addClass(activeState);
					}

					$(element).on('click', function(event) {
						event.preventDefault();

						$('.'+activeState, thumbNav).removeClass(activeState);
						$(element).addClass(activeState);

						gallerySliders[reference].slideToNum(index);
					});
				});

				// Setup public method for next/prev buttons
				gallerySliders[reference].onSlide = function(slide) {
					$('.'+activeState, thumbNav).removeClass(activeState);
					$(thumbs).eq(slide).addClass(activeState);
				};

			});
		}
		
	});
	
});

// YouTube players
require(['jquery', 'app/YoutubePlayer'], function($, YoutubePlayer) {

	$(document).ready(function() {
		
		var youtubePlayers = [];
		
		if ( $('.ytplayer').length > 0 ) {
			
			$('.ytplayer').each(function(index, element) {
				var id = 'youtubePlayer'+index,
						link = $('a', element),
						video_url = link.attr('href'),
						video_id = video_url.split('v=')[1];
				
				// Add id to link
				link.attr('id', id).wrap('<div class="video-youtube ratio-4x3" />');
				
				// Add play icon
				link.addClass('icon-play');
				
				// Set up new player
				youtubePlayers[index] = new YoutubePlayer(id, video_id, 1);
				
				// Load player on click
				link.on('click', function(event) {
					event.preventDefault();
					youtubePlayers[index].setup();
					$(this).removeClass('icon-play');
				});
			});
			
		}
		
	});
			
});

// Article rating
require(['jquery'], function($) {

	$(document).ready(function() {
		$('#video-banner-wrapper').addClass('taller');
			$('#solutions-img-banner').fadeOut();
			
		$('#video-banner-wrapper').hover(function(){
			$('#video-banner-wrapper').addClass('taller');
			$('#solutions-img-banner').fadeOut();
			//$('#solutions-video-banner').fadeIn();
		},function(){
			$('#video-banner-wrapper').removeClass('taller');
			//$('#solutions-video-banner').fadeOut();	
			$('#solutions-img-banner').fadeIn();
		});


		$(".article-like a").click(function(){
			heart = jQuery(this);
			post_id = heart.data("post_id");

			jQuery.ajax({
				type: "post",
				url: ajaxurl,
				data: "action=post-like&nonce="+ajaxnonce+"&post_like=&post_id="+post_id,
				success: function(count){
					if(count != "already") {
						heart.addClass("voted");
						heart.siblings(".count").text(count);
					}
				}
			});

			return false;
		});

		// Extra trigger
		$('p.rate-prompt').click(function() { $(".article-like a").click(); });
		
	});
			
});

// Tabs
require(['jquery', 'app/Tabs'], function($, Tabs) {

	$(document).ready(function() {
	
		var classifiedTabs = new Tabs({el: '#classifieds'}),
				featuredPosts = new Tabs({el: '#featured-posts'});
				
		classifiedTabs.init();
		featuredPosts.init();
		
	});
			
});

// Sticky content (set after sidebar tabs are created)
require(['jquery', 'app/Stickycontent'], function($, Stickycontent) {

	$(window).load(function() {

		// Only initialize if content is taller than sidebar
		if($('#content').height() > $('#sidebar').height() && $(window).width() > 768) {
		
			// Homepage
			if($('body.home').length) {
				var stickyWidgetHome = new Stickycontent({
					element: '#sidebar > *:last-child',
					persistArea: '#content',
					topSpacing: 20,
					bottomSpacing: 60
				});

				stickyWidgetHome.initialize();
			}

			// Category pages
			if($('body.category').length) {
				var stickyWidgetCategory = new Stickycontent({
					element: '#sidebar > *:last-child',
					persistArea: '#content',
					topSpacing: 80,
					bottomSpacing: 500
				});

				stickyWidgetCategory.initialize();
			}

			// Article pages
			if($('body.single-post').length && !$('body.single-format-gallery').length) {
				var stickyWidgetArticle = new Stickycontent({
					element: '#sidebar > *:last-child',
					persistArea: '#content',
					topSpacing: 60,
					bottomSpacing: 10
				});

				stickyWidgetArticle.initialize();

				// Position sticky content in relationship to share utilitues
				var shareUtils = $('div.share-utils');

				function positionStickyContent() {

					if(shareUtils.is(':visible')) {
						stickyWidgetArticle.topSpacing = 140;
					} else {
						stickyWidgetArticle.topSpacing = 80;
					}

				}

				positionStickyContent();

				$(window).on('scroll', function() {
					positionStickyContent();
				});

				// Not working !!!!
				$(document).on('click', 'a.close', function() {
					setTimeout(positionStickyContent, 1000);
				});

			}

		}
	});

});

// ShareThis
require(['sharethis'], function() {

	stLight.options({
		publisher: '35cf39aa-b9ec-487a-a14c-2e5af999c585',
		onhover: false,
		version: '5x',
		doNotHash: false, 
		doNotCopy: false, 
		hashAddressBar: false
	});

});
