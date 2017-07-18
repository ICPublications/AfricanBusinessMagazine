define(['jquery', 'app/utils'], function($, utils) {

	// Constructor
	// ====================================================================
	
		function Contentslider(options) {
			this.uniqueid = options.uniqueid;	// Unique ID for namespacing
			this.el = $(options.element);		// container element
			this.slides = $(options.slides);	// slides
			this.bulletMove = options.bulletMove;
			this.slidecount = options.slidecount ? options.slidecount : 1;
			this.slidepadding = options.slidepadding ? options.slidepadding : 0;

			// Private variables
			this._slideWidth = null;
			this._animateWidth = null;
			this._currentSlide = null;
			this._slider = null;
			this._viewport = null;
			this._bulletNav = null;
			this._bullets = null;
			this._prevButton = $('<a href="#" class="slider-prev">Previous</a>');
			this._nextButton = $('<a href="#" class="slider-next">Next</a>');
			this._arrowShow = false;
			this._nextSlide = null;
		}

	// Methods
	// ====================================================================

	
		// Add methods to the prototype
		Contentslider.prototype = {
			
			constructor: Contentslider,


		    initialize: function() { // Initialize the slider

				this.el.addClass('content-slider');
				this.slides.width('auto');
				this._slideWidth = (this.slides.first().outerWidth() / this.slidecount) + (this.slidepadding / this.slidecount);
				this._animateWidth = this._slideWidth;

				// Create viewport and slider
				this.slides.wrapAll('<div class="slider">').addClass('slide');
				
				// Style slides
				this.slides.css({
					width: this._slideWidth,
					paddingRight: this.slidepadding
				});

				this._currentSlide = this.slides.first();
				this._currentSlide.addClass('is-current-slide');

				this._slider = this.el.find('div.slider');
				this._viewport = this._slider.parent().addClass();
				this._slider.wrap('<div class="viewport">');

				this._slider.width(this._slideWidth * (this.slides.length + 1));

				// Create bullet nav
				this._bulletNav = $('<ul class="bullet-nav">').appendTo(this._viewport);

				var thatBulletNav = this._bulletNav; // Swap scope for each loop

				this.slides.each(function(i) {
					$(this).attr('data-slide', i);
					$('<li><a class="bullet" href="#" data-ref="' + i + '">' + (i+1) + '</a>').appendTo(thatBulletNav);
					i ++;
				});

				this._bullets = this._bulletNav.find('a');
				this._bullets.first().addClass('is-current-bullet');

				// Create buttons
				this._nextButton.insertAfter(this._slider);
				this._prevButton.insertBefore(this._nextButton);

				// Initialise user interactions
				this.userInteractions();
			},


			userInteractions: function() { // Define user interactions

				// cache this for reasigning scope within handlers
				var _this = this;

				// Browser resize
				$(window).on('resize.slider' + this.uniqueid, $.proxy(this.resizeSlides, this));

				// Next / prev buttons
				this._nextButton.on('click.slider' + this.uniqueid, $.proxy(function() {

					this.slideToNext();
					return false;

				}, this));

				this._prevButton.on('click.slider' + this.uniqueid, $.proxy(function() {

					this.slideToPrev();
					return false;

				}, this));

				// Bullet navigation
				this._bullets.on('click.slider' + this.uniqueid, function() {

					_this.slideToNum($(this).data('ref'));
					return false;

				});


				// Swipe functions

				
			},


			slideToNum: function(slideNum) { // Slide to specific slide function

				var currentSlideRef = this._currentSlide.data('slide');

				this._nextSlide = this.slides.filter('[data-slide="' + slideNum + '"]');
				
				var moveDist = (slideNum - currentSlideRef) * this._animateWidth;

				this.slides.removeClass('is-current-slide');
				this._bullets.removeClass('is-current-bullet');

				this._slider.animate({left: '-=' + moveDist}, 300);

				// Reset global properties
				this._currentSlide = this._nextSlide;

				// Add current classes
				this._currentSlide.addClass('is-current-slide');
				this._bullets.filter('[data-ref="' + this._currentSlide.attr('data-slide') + '"]').addClass('is-current-bullet');

			},


			slideToNext: function() { // Slide to next slide function

				this.slides.removeClass('is-current-slide');

				this._bullets.removeClass('is-current-bullet');

				if (this._currentSlide.is(':last-child')) {
					this._nextSlide = this.slides.first();
					this._slider.animate({left: 0}, 300);
				} else {
					
					var currentSlideRef = this._currentSlide.data('slide');
					this._nextSlide = this.slides.filter('[data-slide="' + (currentSlideRef + this.slidecount) + '"]');

					this._slider.animate({left: '-=' + (this._animateWidth * this.slidecount)}, 300);
				}

				this._currentSlide = this._nextSlide;
				this._currentSlide.addClass('is-current-slide');
				this._bullets.filter('[data-ref="' + this._currentSlide.attr('data-slide') + '"]').addClass('is-current-bullet');
		

			},

		
			slideToPrev: function() { // Slide to prev function
						
				var slider = this._slider; // *** FIX THIS - NESTED VAR NOT REGISTERING

				if (this._currentSlide.is(':first-child')) {
					this._slider.animate({left: '+=10px'}, 100, function() {
						slider.animate({left: '-=10px'}, 100);
					});
				} else {
					this.slides.removeClass('is-current-slide');
					this._bullets.removeClass('is-current-bullet');
					
					var currentSlideRef = this._currentSlide.data('slide');
					this._nextSlide = this.slides.filter('[data-slide="' + (currentSlideRef - this.slidecount) + '"]');

					this._slider.animate({left: '+=' + (this._animateWidth * this.slidecount)}, 300);
					this._currentSlide = this._nextSlide;
					this._currentSlide.addClass('is-current-slide');
					this._bullets.filter('[data-ref="' + this._currentSlide.attr('data-slide') + '"]').addClass('is-current-bullet');
				
				}

			},


			resizeSlides: function() { // Resize slides on container resize
				if(this._viewport !== null) {

					// Update slide width
					this._slideWidth = (this._viewport.width() / this.slidecount) + (this.slidepadding / this.slidecount);
					this.slides.css('width', this._slideWidth);
					this._slider.width(this._slideWidth * (this.slides.length + 1));
					this._animateWidth = this.slides.first().outerWidth();

					// Reposition slide wrap
					var currentSlidePos = this._currentSlide.position();	
					this._slider.css('left', -currentSlidePos.left);
				}	
			},
			

			bulletsReposition: function(origPos) { // Move bullet nav to sit in browser view

				var topPos = ($(window).scrollTop() + $(window).height()) - 50;	

				if(topPos < origPos) {
					this._bulletNav.css('top', topPos + 'px');
				}
			},


			destroy: function() { // Destroy the slider

				// Unbind events
				$(window).off('resize.slider' + this.uniqueid);
				this._nextButton.off('click.slider' + this.uniqueid);
				this._prevButton.off('click.slider' + this.uniqueid);

				// Undo html updates
				this._slider.unwrap();
				this.slides.unwrap().removeClass('slide');
				this._bulletNav.remove();
				this._prevButton.remove();
				this._nextButton.remove();

				// Set slides to original styled width
				this.slides.css('width', '');
				
			}

		};


	return Contentslider;
	

});