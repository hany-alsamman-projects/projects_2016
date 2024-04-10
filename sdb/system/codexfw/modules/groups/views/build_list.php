<script type="text/javascript" src="addons/themes/conjuction/js/jquery.coolautosuggest.js"> </script>

<link href="addons/themes/conjuction/css/jquery.coolautosuggest.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function(){

    $("#SearchInput").coolautosuggest({
		url: BASE_URI + "ajax/ajax_user_search?userid=username&user_match=",
    	showThumbnail:true,
    	showDescription:true,
    	width:280,
    	minChars:2
	});
    
    
    // check if user selected and redirect to wall page
	$(".suggest_item").live('click', function () {
        
        var myfiled = $(this).attr("id_field");
        
        eval("document.location='"+BASE_URI+"users/profile/view/"+myfiled+"'");
 
	});

});

</script>
<p style=" margin: 20px; clear: both;" >
<input type="text" style="width: 220px; text-align: right;" id="SearchInput" size="40" onblur="if ( this.value == '' ) this.value = this.defaultValue" onfocus="if ( this.value == this.defaultValue ) this.value = ''" value="ابدأ البحث هنا" />
<br />
<small style="color: #878686;">يمكنك البحث مباشرة من هنا</small>
</p>
<div class="layer">		
        <div id="main">			

			<div class="main_box">
						
				<div class="blackbox">
                	
			               
                    <?php
                    /**
                     *     [0] => Array
                            (
                                [id] => 1
                                [name] => admin
                                [description] => Administrators
                            )
                     */
                        $i=0;
                        foreach($groups as $group ){
                            
                            if($i < 10 ) $style = 'style="float: right; margin:0px 20px 20px 0px"'; else 'style="float: left; margin:0px 0px 20px 0px"';
                            echo '<div '.$style.'><a href="users/view/'.$group['id'].'"><h2 class="css3button" style="width:200px; text-align: center">'.$group['description'].'</h2></a></div>';
                          
                          $i++;  
                        }
                    
                    
                    ?>  
                                                   
                	</div>
                    
				</div>



                                         
			</div>

		</div>
	</div>


