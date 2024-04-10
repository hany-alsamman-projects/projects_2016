/* browser selection */
var ie8 = (jQuery.browser.msie && jQuery.browser.version == '8.0') ? true : false;

/* mobile */
var isMobile = false;
function isMobile_f() {
    var array_mobileIds = new Array('iphone', 'android', 'ipad', 'ipod');
    var uAgent = navigator.userAgent.toLowerCase();
	
    for (var i=0; i<array_mobileIds.length; i++) {
		if(uAgent.search(array_mobileIds[i]) > -1) {
			isMobile = true;
		}
    }
}
isMobile_f();

function init_menu() {
	var total_menu_items = jQuery('nav.top_menu > ul > li').length;
	jQuery('nav.top_menu > ul > li').css('width', 100 / total_menu_items + '%');
	jQuery('nav.top_menu > ul > li').eq(total_menu_items - 1).addClass('last');
	jQuery('.block_page_menu nav li').each(function() {
		if($(this).find('ul').length > 0) $(this).addClass('has_children');
	});
	
	jQuery('.block_page_menu nav .has_children > a').click(function(e) {
		if(isMobile) {
			if((!jQuery(this).parent().hasClass('expanded')) || jQuery(this).attr('href') == '#') {
				jQuery(this).parent().toggleClass('expanded');
				e.preventDefault();
			}
		}
	});
	
	build_responsive_menu();
}

function build_responsive_menu() {
	var full_nav = jQuery('.block_page_menu nav').html();
	if(full_nav != null) {
		jQuery('header .block_page_menu .inner').append('<div id="responsive_navigation" class="responsive_navigation"><div class="button_menu"></div><div class="r_menu"></div></div>');
		jQuery('#responsive_navigation .r_menu').html(full_nav);
		
		jQuery('#responsive_navigation .button_menu').click(function() {
			jQuery('#responsive_navigation > .r_menu').slideToggle();
		});
		
		jQuery('#responsive_navigation .has_children > a').click(function(e) {
			if((!jQuery(this).parent().hasClass('expanded')) || jQuery(this).attr('href') == '#') {
				jQuery(this).parent().toggleClass('expanded').find(' > ul').slideToggle();
				e.preventDefault();
			}
		});
	}
}

function init_sticky_footer() {
	if(jQuery('.wrapper').hasClass('sticky_footer')) jQuery('#content > .inner').css('padding-bottom', jQuery('footer').outerHeight() + 'px');
}

function init_r_corner() {
	jQuery('.r_coner').each(function() {
		var path = jQuery(this).find('img').attr('src');
		jQuery(this).css('background-image', 'url(' + path + ')');
	});
}

function init_iframe_size() {
	var max_width = false;
	if(jQuery('.wrapper').outerWidth() >= 950) {
		var max_width = 620;
	}
	if(jQuery('.wrapper').outerWidth() < 950 && jQuery('.wrapper').outerWidth() >= 768) {
		var max_width = 700;
	}
	if(jQuery('.wrapper').outerWidth() < 768 && jQuery('.wrapper').outerWidth() >= 480) {
		var max_width = 460;
	}
	if(jQuery('.wrapper').outerWidth() < 480) {
		var max_width = 300;
	}
	
	jQuery('iframe').each(function() {
		if(max_width) {
			var iframe_width = jQuery(this).attr('width');
			var iframe_height = jQuery(this).attr('height');
			
			iframe_height = parseInt((max_width * iframe_height) / iframe_width);
			
			
			jQuery(this).attr('width', max_width);
			jQuery(this).attr('height', iframe_height);
		}
	});
}

function init_fields() {
	jQuery('.w_def_text').each(function() {
		var text = jQuery(this).attr('title');
		
		if(jQuery(this).val() == '') {
			jQuery(this).val(text);
		}
	});
	
	jQuery('.w_def_text').live('click', function() {
		var text = jQuery(this).attr('title');
		
		if(jQuery(this).val() == text) {
			jQuery(this).val('');
		}
		
		$(this).focus();
	});
	
	jQuery('.w_def_text').live('blur', function() {
		var text = jQuery(this).attr('title');
		
		if(jQuery(this).val() == '') {
			jQuery(this).val(text);
		}
	});
}

function init_pretty_photo() {
	if(!isMobile) {
		jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
			deeplinking : false,
			keyboard_shortcuts : false
		});
	}
}

function init_img_w_icon() {
	jQuery('.img_w_icon').append('<span class="img_icon" />');
	
	if(!ie8) {
		jQuery('.img_w_icon').hover(
			function() {
				jQuery(this).find('.img_icon').stop(true).animate(
					{
						opacity : 1
					}, 300
				);
			},
			function() {
				jQuery(this).find('.img_icon').stop(true).animate(
					{
						opacity : 0
					}, 200
				);
			}
		);
	}
	else {
		jQuery('.img_icon').hide();
		jQuery('.img_w_icon').hover(
			function() {
				jQuery(this).find('.img_icon').css('display', 'block');
			},
			function() {
				jQuery(this).find('.img_icon').hide();
			}
		);
	}
}

function init_sorting() {
	var album = jQuery('.block_portfolio').clone();
	
	jQuery('.block_filter a').click(function(e) {
		jQuery('.block_filter li').removeClass('active');
		jQuery(this).parent().addClass('active');
		
		var filter_val = jQuery(this).attr('data-value');
		var filtered_data = '';
		
		if(filter_val == 'all') {
			filtered_data = album.find('.portfolio_item');
		}
		else {
			filtered_data = album.find('.portfolio_item[data-type*=' + filter_val + ']');
		}
		
		jQuery('.block_portfolio').quicksand(filtered_data, function() {
			init_pretty_photo();
		});
		
		e.preventDefault();
	});
}

function init_filter(pages) {
	var pagination = true;
	var current_page = 0;
	var album = jQuery('.block_portfolio').clone();
	
	if(!pages) {
		pagination = false;
		project_pagination(false);
	}
	else {
		var btn_prev = jQuery('#project_prev');
		var btn_next = jQuery('#project_next');
			
		btn_prev.click(function(e) {
			current_page--;
			project_pagination(pages);
		});
		
		btn_next.click(function(e) {
			current_page++;
			project_pagination(pages);
		});
		
		project_pagination(pages);
	}
	
	jQuery('.block_filter a').click(function(e) {
		jQuery('.block_filter li').removeClass('active');
		jQuery(this).parent().addClass('active');
		
		jQuery('.block_portfolio .portfolio_item').show();
		
		var filter_val = jQuery(this).attr('data-value');
		var filtered_data = '';
		
		if(filter_val == 'all') {
			filtered_data = album.find('.portfolio_item');
		}
		else {
			filtered_data = album.find('.portfolio_item[data-type=' + filter_val + ']');
		}
		
		jQuery('.block_portfolio').quicksand(filtered_data, function() {
			if(pagination) {
				current_page = 0;
				jQuery('.block_portfolio').css('height', 'auto');
				project_pagination(pages);
			}
			init_pretty_photo();
		});
		
		e.preventDefault();
	});
	
	function project_pagination(num) {
		if(num) {
			var total_items = jQuery('.block_portfolio .portfolio_item').length;
			var total_pages = parseInt(total_items / num);
			total_pages = (total_items % num == 0) ? total_pages : total_pages + 1;
			
			if(current_page > 0) {
				btn_prev.show();
			}
			else {
				btn_prev.hide();
			}
			
			if(current_page < total_pages - 1) {
				btn_next.show();
			}
			else {
				btn_next.hide();
			}
			
			for(i = 0; i < total_items; i++) {
				if(i >= (num * current_page) && i < (num * (current_page + 1))) {
					jQuery('.block_portfolio .portfolio_item').eq(i).show();
				}
				else {
					jQuery('.block_portfolio .portfolio_item').eq(i).hide();
				}
			}
		}
	}
}

//Audio player setup
AudioPlayer.setup('layout/plugins/audioplayer/player.swf', {
	width : '100%',
	transparentpagebg : 'yes',
	animation : 'no',
	
	bg : '3c3c3c',
	leftbg : 'cccccc',
	lefticon : '333333',
	voltrack : 'f2f2f2',
	volslider : '666666',
	rightbg : 'b4b4b4',
	rightbghover : '999999',
	righticon : '333333',
	righticonhover : 'ffffff',
	loader : 'e68d00',
	track : '303030',
	tracker : '555555',
	border : '999999',
	skip : '666666',
	text : 'ffffff'
});

//mask initialization
jQuery.supportSvg = function()
{
    return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1");
};

jQuery.fn.svg = function()
{
	if(jQuery.supportSvg()) {
		this.each(function(i) {
			if(!jQuery(this).parent().hasClass('mask_initialized')) {
				var image = jQuery(this).attr('src');
				var mask = jQuery(this).attr('data-mask');
				var width = jQuery(this).attr('width');
				var height = jQuery(this).attr('height');
				
				var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' + width + ' ' + height + '" width="' + width + '" height="' + height + '" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><mask id="mask_' + i + '"><image xlink:href="' + mask + '" x="0" y="0" width="' + width + '" height="' + height + '" /></mask></defs><image xlink:href="' + image + '" mask="url(#mask_' + i + ')" x="0" y="0" width="' + width + '" height="' + height + '" /></svg>';
				
				jQuery(this).parent().parent().append(svgContent);
				jQuery(this).parent().addClass('mask_initialized');
			}
		});
		
		return
	}
};

function init_masked_pics() {
	jQuery('.pic_masked').svg();
}

function init_main_menu() {
	jQuery('.v_centred_menu #content').css('padding-bottom', '0px');
	var header_height = jQuery('.v_centred_menu header').outerHeight();
	var footer_height = jQuery('.v_centred_menu footer').outerHeight();
	var free_space = jQuery(window).height() - header_height - footer_height;
	if(free_space > 0) var additional_padding = free_space / 2;
	else var additional_padding = 0;
	jQuery('.v_centred_menu header nav').css('padding-top', additional_padding + 'px');
}



function init_main_menu_w_animation() {
	if(!isMobile && !jQuery('body').hasClass('no_animation')) {
		jQuery('#sti-menu').iconmenu({
			disabledClass : '.current_page_item'
		});
	}
}



jQuery(document).ready(function() {
	init_sticky_footer();
	init_iframe_size();
	init_fields();
	init_img_w_icon();
	init_r_corner();
	init_on_top_button();
	
	jQuery('.block_show_code a').live('click' , function(e){
		jQuery(this).parent().toggleClass('expanded');
		jQuery(this).parent().prev().slideToggle();
		
		e.preventDefault();
	});
	
	if(isMobile) {
		jQuery('body').addClass('mobile_device');
	}
});

jQuery(window).resize(function() {
	init_sticky_footer();
	init_iframe_size();
	init_fields();
	init_main_menu();
});

jQuery(function() {
	init_menu();
	init_pretty_photo();
	init_masked_pics();
	init_main_menu();
	init_main_menu_w_animation();
	
	jQuery(function () {
		jQuery('.portfolio_item').live('mouseenter', function() {
			jQuery(this).find('.info').delay(100).fadeIn(300);
		});
		
		jQuery('.portfolio_item').live('mouseleave', function() {
			jQuery(this).find('.info').fadeOut(10);
		});
	});
	
});