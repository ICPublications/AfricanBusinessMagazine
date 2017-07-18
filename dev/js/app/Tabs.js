define(['jquery'], function($) {

	var Tabs = function(opt) {
		this.el = $(opt.el);
		this.tabs = (opt.tabLink) ? opt.tabLink : '.tab-link a';
		this.titles = (opt.tabTitle) ? opt.tabTitle : '.tab-title';
		this.panels = (opt.tabPanel) ? opt.tabPanel : '.tab-panel';
		
		this.init = function() {
			this.close($(this.titles, this.el)); // hide panel titles
			this.close($(this.panels, this.el).not(':first')); // hide panels except first
			$(this.tabs, this.el).first().addClass('is-active-tab');
			$(this.tabs, this.el).on('click.tabs', this, this.toggle);
		};
		this.destroy = function() {
			$(this.panels, this.el).removeAttr('style');
			$(this.tabs, this.el).off('tabs');
			$('.is-active-tab').removeClass('is-active-tab');
		};
		this.close = function(selector) {
			selector.hide();
		};
		this.toggle = function(event) {
			var that = event.data,
					id = $(this).attr('href'),
					panel = $(id).find(that.panels);
			
			$('.is-active-tab', that.el).removeClass('is-active-tab'); // Remove active states
			$(this).parent().addClass('is-active-tab'); // add state class
			event.preventDefault(); // prevent click action
			that.close($(that.panels, that.el)); // close open panels
			panel.show().addClass('is-active-tab'); // open relevant panel
		};
	};
	
	return Tabs;

});