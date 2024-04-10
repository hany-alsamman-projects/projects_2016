<div id="container_card">

	    <div id="work_area">
	      <img src="{pyro:url:base}uploads/files/<?=$vcard->picture ?>" />
	      <div id="desc">
	        <h3><?=$vcard->name?></h3>
	        <br />
	        <br />
	        <div id="full_desc">
             <p>           
               المنتج : <a href="#">بسام الملا</a><br />
               المخرج : <a href="#">بسام المال</a><br />
               كاتب العمل : <a href="#">بسام الملا</a><br />
	            <br />
              </p>
            </div>
	        <div id='explanation'>
	          <p><?=$vcard->description?></p>
              <br />
              <a href="cast/<?=$vcard->id?>"><h2 class="css3button" style="width:100px; text-align: center">شاهد كامل طاقم العمل</h2></a>
            </div><!--explanation-->

             </div>            
        </div>
	    <!--work_area-->
	   
       
        <!--------------------------------cast here----------------------------------------------->
        <div style="width: 510px; margin: 0 auto    ;">
        
        <div id="cast_right">
         <div class="acters">
             <div style="margin-top:10px"><h4>الممثلون </h4></div>
                <ul>
                <?php               
                    if(is_array($stars)):                    
                        foreach($stars as $art):                        
                            echo '<li class="artists"><a href="#"><img src="/uploads/files/'.$art->gravatar.'" /><h4>'.$art->display_name.'</h4> </a></li>';                        
                        endforeach;                    
                    endif;                
                ?>                         
                </ul> 
            </div><!--acters-->
         </div><!--end of cast ight-->
         
         </div>
</div>