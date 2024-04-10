
    <div style="width: 510px; margin: 0 auto    ;">
        <div id="cast_right"><div class="acters">
            
            <?php
                $get = $this->vcard_m->get_fullcast_by_vid($vcard->id); 
                
                for($i = 0; $i < sizeof($get); ++$i){   
                    
                    //$class = ($get[$i]->gid == '3') ? 'cast_right' : 'cast_left';

                    if($i%1 == 0) echo '<ul style="margin: 0px auto 20px auto;">';
                       
                       $result = $this->vcard_m->get_cast_by_id($vcard->id, $get[$i]->gid); 

                       $group = $this->db->query('SELECT id,description FROM (groups) WHERE `id` = '.$get[$i]->gid.'')->row_object();
                      
                       print '<div style="margin-top:10px"><h4>'.$group->description.'</h4></div>';
                       
                       foreach($result as $art){
                        
                            $mypic = (empty($art->gravatar) && $art->gravatar == 'no_avatar.jpg') ?  site_url().'uploads/files/no_avatar.jpg' : site_url()."files/thumb/$art->gravatar";
                            
                            echo '<li class="artists"><a href="#">'.anchor("users/profile/view/".$art->user_id, '<img src="'.$mypic.'" /><h4>'.$art->display_name.'</h4>', "style='text-decoration: underline'").'</a></li>'."\n\n";
                            
                       }
                     
                     if(next($get)==true) echo '</ul><ul>';
                }                   
               
            ?>
          
        </div><!--acters--> </div><!--end of cast ight-->
     
     </div>