//Simply clear field on click and re-assign default value if nothing was typed
//I like this "feature", makes the interface a bit more usable without the hassle for the coder ;)
$.fn.clearField = function() {
    return this.focus(function() {
        if( this.value == this.defaultValue ) {
            this.value = "";
        }
    }).blur(function() {
        if( !this.value.length ) {
            this.value = this.defaultValue;
        }
    });
};	

(function( $ ){
    
    $(':input[name=main]').click(function() {
          $(':input[name=parent]').toggle('slow', function() {
            // Animation complete.
          });
    });
        
	//Change this to the ID of the country input you want to be autocompleted
	//make sure to update the CSS for this ID as well
	var ac_dept = "#ac_dept";
    
    var deptval = $("#ac_dept").val(); 

    $(":input[name=languages]").change(function () { 
    
      var getlang = $( this ).val();
      
      $('#fucker').fadeIn('slow', function() {
        
            
            $(":input[name=lang]").val(getlang); 
            
            
            //var getlang = $(":input[name=parent]").val();
            
            //alert($(":input[name=lang]").val());
            
            //disable lang menu
            $(":input[name=languages]").attr('disabled','disabled');    
      

        	function parent_format(data) {
        		return "<a style='margin-bottom:8px' class='button red'>" + data.parent_title + "</a> &nbsp; <a class='button'>" + data.title + "</a>";
        	}
            
        	function single_format(data) {
        		return "<a style='margin-bottom:8px' class='button'>" + data.title + "</a>";
        	}
                        
        
        	$(ac_dept).autocomplete("index.php?task=dept_search&q="+deptval+"&getlang="+getlang+"", {
        		//multiple: true,
                cacheLength: 0,
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
        		  
                  if(item.id == 'error' ){
                      $("#select_error").html("<p class='message warning'><span class='close-bt'></span> " + item.title + "</p>");
                  
                  }else if(item.parent && item.parent != ''){
                     //alert('have child');
                     return parent_format(item);
                     
                  }else{
                    
                     return single_format(item);
                     
                  }
                    
                    $(ac_dept).flushCache();
                }
                
        	}).result(function(e, item) {
//        	    if(getlang == 0){
//        	       $("#select_error").html("<p class='message warning'><span class='close-bt'></span>Please select the language you want to add</p>");
//                   return false;
//        	    }
                
        		$("#select_error").html("<p class='message success'><span class='close-bt'></span>you are set the page " + item.title + " !</p>");
                
                $(":input[name=parent]").val(item.id);
        	});
      });
   

    });  

});


