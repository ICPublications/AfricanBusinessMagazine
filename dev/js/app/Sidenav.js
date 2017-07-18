define(['jquery'], function($) {

	// Constructor
	// ====================================================================
	
		function Sidenav(options) {
			this.el = $(options.element);		// container element
			this.toggle = $(options.toggle);	// toggle button
			this.changeText = options.changeText;
			this.closeText = options.closeText;
		
			// Private variables
			this._navWidth = this.el.outerWidth() + 6 + 15; // 6 for box-shadow
			this._toggleText = this.toggle.text();
		}

	// Prototype
	// ====================================================================

	
		// Add methods to the prototype
		Sidenav.prototype = {
			
			constructor: Sidenav,

		    initialize: function() { // Initialize the slider

				// Move nav off canvas
				this.el.addClass('sidenav-wrap').css('left', -this._navWidth);

				// Create close button
				var closeBtnText;

				if(this.closeText) { closeBtnText = this.closeText; }
				else { closeBtnText = 'Close'; }
				this.closeBtn = $('<a href="#" class="sidenav-close"><span class="screen-reader-text">' + closeBtnText + '</span></a>').appendTo(this.el);

				// Initialise user interactions
				this.userInteractions();

			},


			userInteractions: function() { // Define user interactions

				this.toggle.on('click.sidenav', $.proxy(function() {

					if(this.el.hasClass('is-visible')) {
							
						this.closeNav();	

					} else {

						this.openNav();						

					}	
				}, this));

				$(window).on('resize.sidenav', $.proxy(function() {
					this._navWidth = this.el.outerWidth() + 6;
					if(!this.el.hasClass('is-visible')) {
						this.el.css('left', -this._navWidth);
					}
				}, this));
				
			},

			openNav: function() {

				// Close other instances of Sidenav
				for (var i = 0; i < Sidenav.allInstances.length; i++) {
					
					var thisNav = Sidenav.allInstances[i];

					if(thisNav.el.hasClass('is-visible')) {
						thisNav.closeNav();
					}
				}

				this.el.animate({
					left: 0
				}, 300).addClass('is-visible');
				if(this.changeText) { this.toggle.text('Close'); }

			},

			closeNav: function() {

				this.el.animate({
					left: -this._navWidth
				}, 300).removeClass('is-visible');
				if(this.changeText) { this.toggle.text(this._toggleText); }

			},

			destroy: function() { // Destroy the slider

				this.toggle.off('click.sidenav');
				$(window).off('resize.sidenav');
				this.el.removeClass('sidenav-wrap').css('left', 0);

			},

		};


	return Sidenav;
	

});