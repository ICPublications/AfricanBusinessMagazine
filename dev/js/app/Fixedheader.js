define(['jquery'], function($) {

	// Constructor
	// ====================================================================
	
		function Fixedheader(options) {
			this.el = $(options.element);		// container element
			this.topStop = options.topStop;
			this.floatingHeader = null;

			// Private variables
			_this = this;
		}

	// Prototype methods
	// ====================================================================
	

		// Add methods to the prototype
		Fixedheader.prototype = {
			
			constructor: Fixedheader,
	    

			initialize: function() { // Initialize the slider

				// Create header clone
				this.el.before(this.el.clone().addClass('is-floating')).addClass('orig-header');
				this.floatingHeader = this.el.prev();

				// Initialize user interactions
				this.userInteractions();
			},

			userInteractions: function() {

			$(document).on('scroll.fixedheader', $.proxy(function(event) {

					this.updateHeaderPos();

				}, this));
			},

			updateHeaderPos: function() {

				if ($(window).scrollTop() <= this.topStop) {
					this.floatingHeader.fadeOut(100);
				} else {
					this.floatingHeader.fadeIn(100);
				}

			},

			destroy: function() {

				this.floatingHeader.remove();
				this.el.removeClass('orig-header');
				$(document).off('scroll.fixedheader');
			}
		};
  

	return Fixedheader;

});