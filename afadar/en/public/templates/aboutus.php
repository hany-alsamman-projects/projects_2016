        
<script type="text/javascript">
	$(document).ready( 
    function() {
        $(window).load( function( ){
            
            document.contactform.browser_check.value = "true";
            
            $("#submit").click(function(){             
            	$('div#result').html('<span><img src="images/loading.gif" class="loading-img" alt="loader image"> Loading ... </span>').fadeIn();
            	var input_data = $('#form').serialize();
            		$.ajax({
            		type: "POST",
            		url:  "http://amc-syria.com/ar/index.php?get=contactus", //this will post the form values to the same page
            		data: input_data,
            		success: function(msg){
            		$('div#result span').remove(); //Removing the loader image because the validation is finished
              
                        //if(msg != 'Your mail has been sent successfully!'){                                        
                         //   $('<div class="msg msg-error">').html('<p>'+msg+'</p>').appendTo('div#result').hide().fadeIn('slow'); //Appending the output of the php validation in the html div
                        //}else{
                            $('<div class="msg msg-info">').html('<p>'+msg+'</p>').appendTo('div#result').hide().fadeIn('slow'); //Appending the output of the php validation in the html div
                        //}
            		}					   
            	});	
            
            return false;
             
            });            
        });
    });
</script> 
           
      <div id="boarder_inside">
     
      <div id="boarder_inside_l"> <div id='aboutus'></div></div>      
      <div id="boarder_inside_m" style="position: relative;">
          <div id="product_title">
          
         <?=mysql_result(mysql_query("SELECT a_content FROM `additional_pages` WHERE `id` = '2'"),0); ?>
         
          </div>

    
      
          
      </div>
      <div id="boarder_inside_r"></div>
    
      </div><!--in of boarder inside-->