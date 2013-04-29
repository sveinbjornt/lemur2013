(function($) {
	$.fn.SkapalonTabs = function(options) {
	
	var settings = $.extend({}, {
			responsive: false,
			fade: 0,
			currentTab: 0
		}, options),

		tab = this,
		tabNavEl = tab.find('>ul'),
		tabNavEls = tabNavEl.find('li'),
		currentTabEl = $(tabNavEls[settings.currentTab-1]),
		panelEls = $(tab.find('.panel'));
		currentPanelEl = $(panelEls[settings.currentTab-1]);
		navWidth = tabNavEls.width(),
		navItemsWidth = 0,
		t = -1,
		isExpanded = false;

		var init =  function() {
			makeTabs();
		};
		 
		var makeTabs = function(){
			currentTabEl.addClass('active');
			panelEls.css('display', 'none');
			currentPanelEl.css('display', 'block');
			tab.on('click', 'ul.tabs:first-child >li', togglePanels );

			if(settings.responsive){
				$(tabNavEls).each(function(){
					console.log($(this).outerWidth());
					navItemsWidth += $(this).outerWidth();
				});

				$(window).resize(function(){
					clearTimeout(t);
					t = setTimeout(doResize, 200);
				});
				doResize();
			}
		};

		var doResize = function(){
			if(tab.width() <= navItemsWidth && !isExpanded){
				tab.addClass('expand');
				panelEls.css('display', 'block').find('.content').css('display', 'block');
				isExpanded = true;
			}
			else if(tab.width() >= navItemsWidth && isExpanded){
				tab.removeClass('expand');
				panelEls.css('display', 'none');
				currentPanelEl.css('display', 'block');
				isExpanded = false;
			}
		};

		var togglePanels = function(e){
			panelEls.css('display', 'none').find('.content').css('display', 'none');
			currentTabEl = $(e.currentTarget);
			currentPanelEl = tab.find('#'+currentTabEl.attr('data-id'));

			currentTabEl.addClass('active').siblings().removeClass('active');

			currentPanelEl.css('display', 'block').find('.content').fadeIn(settings.fade);
		};

		init();
	};
})(jQuery);