define(['jquery'], function($) {

	// Constructor
	// ====================================================================
	
		function Stickycontent(options) {
			this.el = $(options.element);		// container element
			this.persistArea = $(options.persistArea);
			this.floatingContent = null;
			this.topSpacing = options.topSpacing;
			this.bottomSpacing = options.bottomSpacing;

			// Private variables
			_this = this;
			this._offset = this.el.offset().top;
			this._elHeight = this.el.outerHeight();
			this._elPosition = this.el.position().top;
			this._persistHeight = this.persistArea.height();
			this._stop = this.persistArea.offset().top + this._persistHeight - this.bottomSpacing;
		}

	// Prototype methods
	// ====================================================================
	

		// Add methods to the prototype
		Stickycontent.prototype = {
			
			constructor: Stickycontent,
	    

			initialize: function() { // Initialize the slider

				// Make sure parent container is positioned ...
				this.el.parent().css('position', 'relative');
				
				// ... and reset position var if necessary
				this._elPosition = this.el.position().top;

				// Create header clone
				this.el.addClass('is-sticky is-stuck-top');

				// Set initial position
				this.updateContentPos();

				// Initialize user interactions
				this.userInteractions();
			},

			userInteractions: function() {

				$(document).on('scroll.stickycontent', $.proxy(function(event) {

					this.updateContentPos();

				}, this));
			},

			updateContentPos: function() {

				if ($(window).scrollTop() >= (this._offset - this.topSpacing) && !$(this).hasClass('is-stuck-bottom')) {
					this.el.removeClass('is-stuck-top')
						.css({
							transform: 'translateY(' + ($(window).scrollTop() - this._offset + this.topSpacing) + 'px)'
						});
				} else {
					this.el.addClass('is-stuck-top')
						.css({
							transform: 'translateY(0px)'
						});
				}


				if(($(window).scrollTop() + this._elHeight + this.topSpacing) >= this._stop) {

					this.el.addClass('is-stuck-bottom')
						.css({
							transform: 'translateY(' + (this._persistHeight - this._elHeight - this._elPosition - this.bottomSpacing) + 'px)'
						});

				} else {
					this.el.removeClass('is-stuck-bottom');
				}

			},

			destroy: function() {

				this.el.removeClass('is-sticky is-stuck-top is-stuck-bottom')
					.css({
						transform: 'translateY(0px)'
					});
				$(document).off('scroll.stickycontent');
			}
		};
  

	return Stickycontent;

});