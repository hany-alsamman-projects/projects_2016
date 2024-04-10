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

<div id="center_side">
    <form name="contactform" id="form">
        <div id="fields">
            <div id="mylabel">Name</div> <div><input name="name" value="" type="text" /></div> 
            <div id="mylabel">Mobile</div> <div><input name="mobile" value="" type="text" /></div> <br /> <br />
            <div id="mylabel">E-mail</div> <div><input name="email" value="" type="text" /></div> <br /> <br />
            <div id="mylabel">Message</div> <div><textarea name="msg"></textarea></div>			                                    
            <div style="margin-left: 270px"><input type="hidden" name="browser_check" value="false" />
            <input style="border: 0px; position: relative; font-size: 15pt" name="submit" type="submit" class="box" id="submit" value="Send">
            </div>
        </div>   
    </form>
</div>        
