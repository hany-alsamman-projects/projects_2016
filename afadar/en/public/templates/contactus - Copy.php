        
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
           
           <div id="fram_contactus">
            <object width="218" height="108">
            <param name="movie" value="images/logo.swf">
            <param name="movie" value="images/logo.swf">
            <embed wmode="transparent" quality="high" src="images/logo.swf" width="218" height="108">
            </embed>
            </object>
              </div><!--fram_contactus-->
              <div id="c_us">
              <div style="color:white; font-size:17pt;">CONTACTUS</div>
              
              <br/>

              <div id="contactus" style="margin: 0px 0px 0px 0px;">
            
            	<div id="result"></div> 
            
            	<form name="contactform" id="form">
            
            			<div id="fields">
            				<div id="mylabel">Name</div> <div><input name="name" value="" type="text" /></div> <br /> <br />
            			   
            				<div id="mylabel">Company</div>  <div><input name="company" value="" type="text" /></div> <br /> <br />
            				
            				<div id="mylabel">Telephone</div> <div><input name="phno" value="" type="text" /></div> <br /> <br />
            				
            				<div id="mylabel">Mobile</div> <div><input name="mobile" value="" type="text" /></div> <br /> <br />
            				
            				<div id="mylabel">E-mail</div> <div><input name="email" value="" type="text" /></div> <br /> <br />
            				
            				<div id="mylabel">Message</div> <div><textarea name="msg"></textarea></div>	  
            																		
            				<div class="clear"><input style="border: 0px; margin-top:10px; width: 50px" name="submit" type="submit"  id="submit" value="Send" /></div>
                            <input type="hidden" name="browser_check" value="false" />
            			</div>   
            				 
            	</form>
            
            	</div><!-- contactus -->


              </div><!--c_us-->