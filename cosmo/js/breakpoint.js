/*
 * Breakpoint jQuery Plugin
 *
 * Copyright (c) 2012
 * Licensed under the MIT license.
 *
 */

(function($){
	$.breakpoint = {
		els: $(),
		init: true
	};

	$.fn.breakpoint = function() {
		$.breakpoint.els = $.breakpoint.els.add(this);

		if (!$.breakpoint.init) {
			$(window).on('resize.breakpoint', function(){
				$.breakpoint.els.trigger('swapres.breakpoint');
			});
		}

		return this.each(function(){
			var $el = $(this),
				maxWidths = [],
				minWidths = [];

			$el.data('m1src', $el.attr('src'));

			// parse breakpoints.
			$.each( $el.data(), function(key, value) {
				if (key && (key.toLowerCase().indexOf('maxwidth') === 0 || key.toLowerCase().indexOf('minwidth') === 0)) {
					var width = key.substring(3).match( /\d+/g );
					if (width.length === 1) {
						var bp = {
							key: key,
							type: ( key.toLowerCase().indexOf('max') === 0 ? 'max' : 'min' ),
							width: width[0]
						};

						if ( bp.type === 'max' ) {
							maxWidths.push( bp );
						}
						else {
							minWidths.push( bp )
						}
					}
				}
			});
			// sort low to high.
			minWidths.sort(function( a, b ) {
				return a.width - b.width;
			});
			// sort high to low.
			maxWidths.sort(function( a, b ) {
				return b.width - a.width;
			});

			$el
				.on('swapres.breakpoint', function(){

					// if breakpoints are defined just use them and ignore the rest.
					if ( maxWidths.length > 0 || minWidths.length > 0 ) {

						// loop threw each break point and try apply it.
						var windowWidth = $(window).width();
						var activeBreakpoint = null;
						$.each( maxWidths, function(index, bp) {
							if ( windowWidth <= bp.width ) {
								activeBreakpoint = bp;
							}
						});
						$.each( minWidths, function(index, bp) {
							if ( windowWidth >= bp.width ) {
								activeBreakpoint = bp;
							}
						});
						// fallback to mobile first if no matches.
						if ( activeBreakpoint != null ) {
							$el.attr( 'src', $el.data( activeBreakpoint.key ) );

						} else {
							$el.attr( 'src', $el.data('m1src') );
						}

					} else {
						$el.attr( 'src', $el.data('m1src') );
					}
				})
				.trigger('swapres.breakpoint');
		});
	};

})(jQuery);


