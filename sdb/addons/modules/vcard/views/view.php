<div id="container_card">

	    <div id="work_area">
	      <img src="{pyro:url:base}uploads/files/<?=$vcard->picture ?>" />
	      <div id="desc">
	        <h3><?=$vcard->name?></h3>
	        <br />
	        <br />
	        <div id="full_desc">
             <p>    
                
                <?php               
                    if(is_array($cast)): 

                        foreach($cast as $key => $part):
                        
                        static $i = 0;
                             $group = $this->db->query('SELECT id,description FROM (groups) WHERE `id` = '.$part->gid.'')->row_object();

                             echo $group->description . ' : ' . anchor("users/profile/view/".$part->user_id, $part->display_name, "style='text-decoration: underline'") .'<br />';
                        
                        
                        if($i > 5) break;
                        
                        $i++;
  
                        endforeach;
             
                    endif;                
                ?>  
	            <br />
              </p>
            </div>
	        <div id='explanation'>
	          <p><?=$vcard->description?></p>
              <br />
              <a href="<?=site_url()?>vcard/full/<?=$vcard->id?>"><h2 class="css3button" style="width:100px; text-align: center">شاهد كامل طاقم العمل</h2></a>
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
                            echo '<li class="artists"><a href="#"><img src="/uploads/files/'.$art->gravatar.'" /><h4>'.anchor("users/profile/view/".$art->user_id, $art->display_name, "style='text-decoration: underline'").'</h4> </a></li>';                        
                        endforeach;                    
                    endif;                
                ?>                         
                </ul> 
            </div><!--acters-->
         </div><!--end of cast ight-->
         
         </div>
</div>