define(['jquery', 'app/utils'], function($, utils) {

	var Megaslider = function(options) {

		this.el = $(options.element);		// container element
		this.slides = $(options.slides);	// slides
		this.slidecount = options.slidecount ? options.slidecount : 1;
		this.slidepadding = options.slidepadding ? options.slidepadding : 0;
		this.legacySupport = options.legacySupport ? options.legacySupport : false;

		// Public methods
		this.onSlide = null;

		// Private variables
		var _this = this;

		var uniqueid = Math.random(),
			slideWidth,
			animateWidth,
			currentSlide,
			slider,
			viewport,
			bulletNav,
			bulletNavPos,
			bullets,
			prevButton = $('<a href="#" class="lcms-slider-prev" data-icon="&#xe605;"><span class="screen-reader-text">Previous</span></a>'),
			nextButton = $('<a href="#" class="lcms-slider-next" data-icon="&#xe606;"><span class="screen-reader-text">Next</span></a>'),
			arrowShow = false,
			nextSlide,
			currSliderOffset,
			rtl = false;


		this.init = function() { // Initialize the slider

			// Check lang direction
			if($('[dir="rtl"]').length) {
				rtl = true;
			}
			
			// Initialize or reset current slider offset
			currSliderOffset = 0;

			this.el.addClass('lcms-content-slider');
			this.slides.width('auto');
			slideWidth = (this.slides.first().outerWidth() / this.slidecount) + (this.slidepadding / this.slidecount);
			animateWidth = slideWidth;

			// Create viewport and slider
			this.slides.wrapAll('<div class="lcms-slider">').addClass('lcms-slide');
			
			// Style slides
			this.slides.css({
				width: slideWidth,
				paddingRight: this.slidepadding
			});

			currentSlide = this.slides.first();
			currentSlide.addClass('lcms-is-current-slide');

			slider = this.el.find('div.lcms-slider');
			viewport = slider.parent().addClass();
			slider.wrap('<div class="lcms-viewport">');

			slider.width(slideWidth * (this.slides.length));

			// Create bullet nav
			bulletNav = $('<ul class="lcms-bullet-nav">').appendTo(viewport);
			bulletNavPos = parseInt(bulletNav.css('bottom'), 10);

			var thatBulletNav = bulletNav; // Swap scope for each loop

			this.slides.each(function(i) {
				$(this).attr('data-lcms-slide', i);
				$('<li><a class="lcms-bullet" href="#" data-lcms-ref="' + i + '">' + (i+1) + '</a>').appendTo(thatBulletNav);
				i ++;
			});

			bullets = bulletNav.find('a');
			bullets.first().addClass('lcms-is-current-bullet');

			// Create buttons
			nextButton.insertAfter(slider);
			prevButton.insertBefore(nextButton);

			// Reposition bullets
			if(this.bulletsMove) {
				this.bulletsReposition();
			}

			// Initialise user interactions
			this.userInteractions();
		};


		this.userInteractions = function() { // Define user interactions

			// Browser resize
			$(window).on('resize.lcms-slider' + uniqueid, $.proxy(this.resizeSlides, this));

			// Next / prev buttons
			nextButton.on('click.lcms-slider' + uniqueid, $.proxy(function() {

				if (currentSlide.is(':last-child')) {
					nextSlide = this.slides.first();
				} else {

					/* Slide slider based on number of slides per view (slidecount) */
					currentSlideNum = parseInt(currentSlide.data('lcms-slide'), 10);
					nextSlideNum = currentSlideNum + _this.slidecount;

					if(nextSlideNum > (_this.slides.length - 1)) {
						nextSlide = _this.slides.first();
					} else {
						nextSlide = _this.slides.filter('[data-lcms-slide="' + nextSlideNum + '"]');
					}
				}

				this.slideToNum(nextSlide.data('lcms-slide'));
				return false;

			}, this));

			prevButton.on('click.lcms-slider' + uniqueid, $.proxy(function() {

				if (currentSlide.is(':first-child')) {

					if(this.legacySupport && !Modernizr.csstransforms) {
						/* Legacy animate */
						slider.animate({left: '+=10px'}, 100, function() {
							slider.animate({left: '-=10px'}, 100);
						});
					} else {
						/* CSS animate */
						slider.css({
							transform: 'translate(10px, 0px)',
							transition: 'all 0.1s linear'
						});
						setTimeout(function() {
							slider.css({
								transform: 'translate(0px, 0px)',
								transition: 'all 0.1s linear'
							});
						}, 100);
					}
				} else {
					/* Slide slider based on number of slides per view (slidecount) */
					currentSlideNum = parseInt(currentSlide.data('lcms-slide'), 10);
					nextSlideNum = currentSlideNum - _this.slidecount;

					if(nextSlideNum < 0) {
						nextSlide = this.slides.first();
					} else {
						nextSlide = _this.slides.filter('[data-lcms-slide="' + nextSlideNum + '"]');
					}
					
					this.slideToNum(nextSlide.data('lcms-slide'));
				}

				return false;

			}, this));

			// Bullet navigation
			bullets.on('click.lcms-slider' + uniqueid, function() {

				_this.slideToNum($(this).data('lcms-ref'));
				return false;

			});

			// Reposition bullets
			$(window).on('scroll.lcms-slider' + uniqueid + ', resize.lcms-slider' + uniqueid, function() {
				if(_this.bulletsMove) {
					_this.bulletsReposition();
				}
			});
			
		};


		this.slideToNum = function(slideNum) { // Slide to specific slide function

			var currentSlideRef = currentSlide.data('lcms-slide'),
				moveDist;

			nextSlide = this.slides.filter('[data-lcms-slide="' + slideNum + '"]');
			
			this.slides.removeClass('lcms-is-current-slide');
			bullets.removeClass('lcms-is-current-bullet');

			/* Choose animation method: css transform or jquery animate */
			if(this.legacySupport && !Modernizr.csstransforms) {
				moveDist = (slideNum - currentSlideRef) * animateWidth;
				
				/* Check lang dir */
				if(rtl) {
					slider.animate({left: '+=' + moveDist}, 300);
				} else {
					slider.animate({left: '-=' + moveDist}, 300);
				}
			} else {
				moveDist = ((slideNum - currentSlideRef) * animateWidth) + currSliderOffset;
				
				/* Check lang dir */
				if(rtl) {
					slider.css({
						transform: 'translate(' + moveDist + 'px, 0px)',
						transition: 'all 0.5s ease'
					});
				} else {
					slider.css({
						transform: 'translate(-' + moveDist + 'px, 0px)',
						transition: 'all 0.5s ease'
					});
				}
			}

			// Reset global properties
			currentSlide = nextSlide;

			// Add current classes
			currentSlide.addClass('lcms-is-current-slide');
			bullets.filter('[data-lcms-ref="' + currentSlide.attr('data-lcms-slide') + '"]').addClass('lcms-is-current-bullet');

			// Update current slider offset for css transform
			currSliderOffset = moveDist;

			// Run callback
			if (typeof(this.onSlide) === 'function') this.onSlide(slideNum);

		};


		this.resizeSlides = function() { // Resize slides on container resize
			if(viewport !== null) {

				// Update slide width
				slideWidth = (viewport.width() / this.slidecount) + (this.slidepadding / this.slidecount);
				this.slides.css('width', slideWidth);
				slider.width(slideWidth * (this.slides.length + 1));
				animateWidth = this.slides.first().outerWidth();

				/* Get current slides position */
				var currentSlidePos = currentSlide.position();
				
				/* Check for animation method */
				if(this.legacySupport && !Modernizr.csstransforms) {

					// Reposition slide wrap
					if(rtl) {
						slider.css('right', -currentSlidePos.right);
					} else {
						slider.css('left', -currentSlidePos.left);
					}

				} else {

					if(rtl) {
						slider.css({
							transform: 'translate(-' + currentSlidePos.right + 'px, 0px)',
							transition: 'all 0.5s ease'
						});
					} else {
						slider.css({
							transform: 'translate(-' + currentSlidePos.left + 'px, 0px)',
							transition: 'all 0.5s ease'
						});
					}

					currSliderOffset = slideWidth * currentSlide.data('lcms-slide');
					
				}
			}	
		};


		this.destroy = function() { // Destroy the slider

			// Unbind events
			$(window).off('resize.lcms-slider' + uniqueid);
			$(window).off('scroll.lcms-slider' + uniqueid);
			$(window).off('resize.lcms-slider' + uniqueid);
			nextButton.off('click.lcms-slider' + uniqueid);
			prevButton.off('click.lcms-slider' + uniqueid);

			// Undo html updates
			slider.unwrap();
			this.slides.unwrap().removeClass('lcms-slide');
			bulletNav.remove();
			prevButton.remove();
			nextButton.remove();

			// Set slides to original styled width
			this.slides.css('width', '');
			
		};

		this.isBelowViewport = function(elem) {
			
			var windowOffset = $(window).scrollTop() + $(window).height() - this.bulletsOffset;
			elemOffset = elem.offset().top + elem.height();

			if(windowOffset > elemOffset) {
				return true;
			}
		};

	};

	return Megaslider;

});