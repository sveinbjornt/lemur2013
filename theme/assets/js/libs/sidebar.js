(function($){

'use strict';

window.Sidebar = function(wrapEl, sideEl, bodyEl){
	this.wrapEl = $(wrapEl);
	this.sideEl = $(sideEl);
	this.bodyEl = $(bodyEl);

	this.getBrowserInformation();
	this.attachEvents();
	this.setHeight();
};

window.Sidebar.prototype = {
	css3: {
		translateX: function(num){
			return {
				'transform': 'translateX('+ num +'px)',
				'-webkit-transform': 'translateX('+ num +'px)',
				'-moz-transform': 'translateX('+ num +'px)',
				'-ms-transform': 'translate('+ num +'px, 0)'
			};
		}
	},

	// States
	isOpen: false,
	isAnimating: false,
	isMoving: false,
	isVisible: false,
	sidePosition: 0,

	// Options
	sideNavWidth: 260,
	sideNavSide: 'right',
	toggleTriggerSize: 50,

	attachEvents: function(){
		var documentEl = $(document);

		this.bodyEl.on('movestart', $.proxy(this.onMoveStart, this));
		this.bodyEl.on('moveend', $.proxy(this.onMoveEnd, this));
		this.bodyEl.on('move', $.proxy(this.onMove, this));

		if(!this.isLegacy){
			this.bodyEl[0].addEventListener('webkitTransitionEnd', $.proxy(this.onTransitionEnd, this), true);
			this.bodyEl[0].addEventListener('mozTransitionEnd', $.proxy(this.onTransitionEnd, this), true);
			this.bodyEl[0].addEventListener('MSTransitionEnd', $.proxy(this.onTransitionEnd, this), true);
			this.bodyEl[0].addEventListener('transitionend', $.proxy(this.onTransitionEnd, this), true);
		}

		documentEl.on('click', '.sidenav-toggle', $.proxy(this.toggle, this));
		documentEl.on('keydown', $.proxy(this.onKeyDown, this));

		$(window).on('resize', $.proxy(this.setHeight, this));
	},

	setHeight: function(){
		var windowHeight = $(window).innerHeight();
		var height = -1;

		if(this.isAndroid2 || this.isIOS4) {
			windowHeight = $(document).height();
			height = this.wrapEl.height();
		} else {
			windowHeight = window.innerHeight ? window.innerHeight : $(window).height();
			height = windowHeight;
		}

		this.sideEl.height(height);
	},

	toggle: function(){
		if(!this.isOpen){
			this.open();
		} else {
			this.close();
		}
	},

	open: function(){
		this.show();
		this.setBodyPosition(-this.sideNavWidth);
		this.isOpen = true;
		this.sidePosition = -this.sideNavWidth;

		this.sideEl.css({
			'-webkit-overflow-scrolling': 'touch'
		});

		jQuery.event.trigger('sideNavOpen');
	},

	close: function(){
		this.setBodyPosition(0);
		this.isOpen = false;
		this.sidePosition = 0;

		this.sideEl.css({
			'-webkit-overflow-scrolling': ''
		});

		jQuery.event.trigger('sideNavClose');
	},

	show: function(){
		if(this.isVisible)
			return;

		this.isVisible = true;
		this.sideEl.css({
			'display': 'block'
		});

		jQuery.event.trigger('sideNavVisible');
	},

	hide: function(){
		this.sideEl.css('display', 'none');
		this.isVisible = false;
		this.sideEl.css({
			'display': 'none'
		});

		jQuery.event.trigger('sideNavHidden');
	},

	setBodyPosition: function(num){
		var cssObj = this.css3.translateX(num);

		if(this.isLegacy || this.isAndroid2)
			cssObj = { left: num };

		this.bodyEl.css(cssObj);
	},

	onMoveStart: function(e){
		var targetEl = $();
		var isVertical = (e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY);

		if(e.target.tagName === 'TEXTAREA' || e.target.tagName === 'INPUT')
			e.preventDefault();


		if (!this.isOpen && isVertical) {
			e.preventDefault();
			return;
		}

		this.bodyEl.addClass('notransition');

		clearTimeout(this.timer);
		this.timer = setTimeout($.proxy(this.onMoveEnd, this), 1000);
	},

	onMoveEnd: function(e){
		this.bodyEl.removeClass('notransition');
		this.sidePosition = this.sidePositionTemp;

		if(!this.isOpen && this.sidePosition <= -this.toggleTriggerSize){
			this.open();
		} else if(this.isOpen && this.sidePosition >= (-this.sideNavWidth + this.toggleTriggerSize)) {
			this.close();
		} else if(this.isOpen){
			this.open();
		} else {
			this.close();
		}

		clearTimeout(this.timer);
	},

	onMove: function(e){
		var left = this.sidePosition + e.distX;

		if(left < -this.sideNavWidth){
			left = -this.sideNavWidth;
		} else if(left > 0){
			left = 0;
		}

		// Store body position
		this.sidePositionTemp = left;

		// Move navigation with the finger
		var cssObj = this.css3.translateX(left);

		this.bodyEl.css(cssObj);

		this.show();

		clearTimeout(this.timer);
		this.timer = setTimeout($.proxy(this.onMoveEnd, this), 1000);
	},

	onKeyDown: function(e){
		var code = (e.keyCode ? e.keyCode : e.which);

		if(code === 77)
			this.toggle();
	},

	onTransitionEnd: function(e){
		if(e.target !== this.bodyEl[0])
			return;

		if(!this.isOpen &&
			(e.propertyName === 'transform' ||
			e.propertyName === '-webkit-transform' ||
			e.propertyName === '-moz-transform' ||
			e.propertyName === '-ms-transform' ||
			e.propertyName === '-ms-transform')) {
			this.hide();
		}
	},

	getBrowserInformation: function(){
		this.isLegacy = $('.lt-ie9').length > 0;

		var agent = window.navigator.userAgent;
		var android = agent.indexOf('Android ');
		var ios = agent.indexOf('OS ');


		this.iosVersion = ios > -1 ? window.Number(agent.substr(ios + 3, 3).replace('_', '.')) : 0;
		this.isIOS4 = this.iosVersion === 4;

		this.androidVersion = android > -1 ? window.Number(agent.substr(android + 8, 3)) : 0;
		this.isAndroid2 = this.androidVersion === 2;
	}
};

}(jQuery));