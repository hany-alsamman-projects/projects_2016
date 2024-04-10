(function( $ ){

$.fn.parent_format = function(data) {
	return "<a class='button'>" + data.first_name + "</a>";
}

$.fn.single_format = function(data) {
	return "<a style='margin-bottom:8px' class='button'>" + data.title + "</a>";
}


$.fn.reloadsearch = function() {

	var uid = "#uid";
    
    var gid = "#gid";
    
    var vid = "#vid";
    
     
    //$(":input[name=uid]").keyup(function () { 
 
    var Mymatch = $(":input[name=uid]").val();
 
    if (Mymatch.length >= 3) {         

    	$(uid).autocomplete(SITE_URL + 'ajax/ajax_user_search?user_match='+Mymatch+'', {
    		//multiple: true,
            cacheLength: false,
            minLength: 3,
    		dataType: "json",
    		parse: function(data) {
    			return $.map(data, function(row) {    
                    return {
    					data: row,
    					value: row.title,
    					result: row.title
    				}
    			});
    		},
    		formatItem: function(item) {
   		      alert(item.id);
              if(item.id == 'error' ){
                
                  $("#select_error").html("<p class='message warning'><span class='close-bt'></span> " + item.title + "</p>");
              
              }else if(item.first_name && item.first_name != ''){
                
                 return  $(this).parent_format(item);                 
                 
              }else{

                 return  $(this).single_format(item);
                 
              }      
                
            }
            
    	}).result(function(e, item) {
            alert('qwww');
            //alert($(uid).val());
    		$("#select_error").html("<p class='message success'><span class='close-bt'></span>you are set the page " + item.title + " !</p>");
           
            //$(":input[name=parent]").val(item.id);
    	});
    
    }

};
	
})( jQuery );


jQuery(function($) { 


$(":input[name=uid]").live('keyup',function(){
            $(this).unautocomplete();
            $(this).reloadsearch();
});

});