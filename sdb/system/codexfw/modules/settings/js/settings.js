jQuery(function($){
	var parents = 'div.tabs-content fieldset';
	var wscrolltop = 0;


if ( $.browser.msie ) {

    $(parents +' ol').sortable({
                     	   
    	handle: 'span.move-handle',
    	update: function() {
    		$(parents +' ol li').removeClass('even');
    		$(parents +' ol li:nth-child(even)').addClass('even');
    		order = new Array();
    		$(parents +' li').each(function(){
    			order.push( this.id );
    		});
    		order = order.join(',');
    
    		$.post(SITE_URL + 'admin/settings/ajax_update_order', { order: order });
    	}
    
    });

} else {

    $(parents +' ol').sortable({
          
          connectWith: '.tabs-content',
          start: function(event, ui) {
                  wscrolltop = $(window).scrollTop();
                 },
          sort: function(event, ui) {  
                       ui.helper.css({'top' : ui.position.top + $(window).scrollTop() + 'px'});
                   },       
        placeholder: 'placeholder-class',
           	   
    	handle: 'span.move-handle',
    	update: function() {
    		$(parents +' ol li').removeClass('even');
    		$(parents +' ol li:nth-child(even)').addClass('even');
    		order = new Array();
    		$(parents +' li').each(function(){
    			order.push( this.id );
    		});
    		order = order.join(',');
    
    		$.post(SITE_URL + 'admin/settings/ajax_update_order', { order: order });
    	}
    
    });
    
}
    
});