// Constructor
var CollapsingNav = function(element, breakpoint) {
	
	// Properties
	this.el = element;
	this.breakpoint = (breakpoint) ? breakpoint : 768;
	this.triggerLabel = 'Menu';
	this.triggerClass = 'nav-trigger btn';
	this.trigger = '<button class="'+this.triggerClass+'">'+this.triggerLabel+'</button>';
	this.nav = $('ul:first', this.el);
	this.subNavs = $('ul:not(:first)', this.el);
	this.items = $('li', this.el).has('ul');
	this.links = $('a:first', this.items);
	this.speed = 250;
	this.effect = 'swing';
	
	// Methods
	this.init = function() {
		var viewport = $(window).width(),
			state = this.getState();
		
		// Check state
		if (!state)	{
			this.items.addClass('parent'); // Tag parent items
			$(this.el).removeClass('static');
		}
		
		// Check if menu should be collapsed
		if (this.breakpoint >= viewport) {
			this.collapse(); // Collapse menu
		} else {
			if (state === 'collapsed') this.expand(); // Expand menu
			else $(this.el).data('state', 'expanded'); // Set active state
		}
	};
	this.destroy = function() {
		// Remove click events
		this.links.off('click.cn');
		this.items.off('mouseenter.cn, mouseleave.cn').removeClass('parent open');
		
		$(this.el).removeData('state').addClass('static'); // Remove state data
		this.subNavs.removeAttr('style'); // Clean up dynamic styles
		this.removeTrigger(); // Remove trigger button
	};
	this.toggle = function(event) {	
		var that = event.data,
			state = that.getState(),
			item = (state == 'expanded') ? $(this) : $(this).parent('li'),
			childNav = item.children('ul');
		
		// Open/close sub nav
		if (!item.hasClass('open')) that.open(childNav);
		else that.close(childNav);
		
		// Close any open menus
		if (state == 'collapsed') that.close(item.siblings('.open').find('ul'));
		
		event.preventDefault();
	};
	this.open = function(nav) {
		nav.parent('li').addClass('open'); // Tag parent of open item
		nav.stop(true, true).slideDown(this.speed, this.effect); // Open item
	};
	this.close = function(nav) {
		nav.parent('li').removeClass('open'); // Remove open state
		nav.stop(true, true).slideUp(this.speed, this.effect); // Hide item
	};
	this.expand = function() {
		this.links.off('click.cn'); // Remove click events on links
		$(this.el).data('state', 'expanded'); // Change active state
		this.close(this.subNavs); // Close all sub navs
		this.items.on('mouseenter.cn, mouseleave.cn', this, this.toggle); // Add hover events
		
		this.removeTrigger();
	};
	this.collapse = function() {
		this.items.off('mouseenter.cn, mouseleave.cn'); // Remove hover events on items
		$(this.el).data('state', 'collapsed'); // Change active state
		this.close(this.subNavs); // Close all sub navs
		this.links.on('click.cn', this, this.toggle); // Add click event
		
		this.addTrigger();
	};
	this.addTrigger = function() {
		var that = this;
		
		if ($('.nav-trigger', this.el).length <= 0) {
			$(this.el).prepend(this.trigger); // Build trigger button
			this.trigger = $('.nav-trigger', this.el); // Update trigger reference
	
			// Add click event
			this.trigger.on('click.cn', function() {
				that.nav.slideToggle(that.speed, that.effect);
				that.close(that.subNavs);
			});
		}
		
		this.close(this.nav); // Close primary nav
	};
	this.removeTrigger = function() {
		this.open(this.nav); // Open primary nav
		this.trigger.off('click.cn').remove(); // Remove click event
	};
	this.getState = function() {
		return $(this.el).data('state');
	};
};

// Instantiation
var menuPrimary = new CollapsingNav('#menu-primary', 850);
menuPrimary.init();

// Handle viewport resizing
var resize;
$(window).resize(function() {
	clearTimeout(resize);
	resize = setTimeout(function() {
	
		menuPrimary.init();

	}, 250);
});