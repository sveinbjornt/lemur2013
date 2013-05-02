// select.js

(function(){

	var select = function(){

		var els = $('select');

		els.each(function(){
			var el = $(this);
			var parentEl = el.parent();

			if(parentEl.hasClass('dropdown')){
				return;
			}

			var wrapEl = $('<div class="dropdown"><span class="trigger"></span></div>');
			var labelEl = $('<span class="text">???</span>');

			labelEl.css('width', el.css('width') - 10);

			labelEl.html(el.find(':selected').text());

			el.before(wrapEl);
			wrapEl.attr('class', 'dropdown ' + el.attr('class'));
			wrapEl.append(labelEl);
			wrapEl.append(el);

			el.on('change', function(){
				labelEl.html(el.find(':selected').text());
			});
		});

	};

	$(select);

}());
