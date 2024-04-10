<?php
        

    $dateimg = site_url() . 'addons/themes/conjuction/img/date.jpg';
    $likeimg = site_url() . 'addons/themes/conjuction/img/like1.jpg';
    $timeago = time_delta('now', (int)$update['created']);
    $nopic = site_url() . 'addons/themes/conjuction/img/no_avatar.jpg';
    //this picture for the commenter
    $commenter = site_url().'files/thumb/'.$this->user->gravatar;

print <<<EOF

    <div class="wall_content" id="wall_content$update[msg_id]">
    
        <div id="wall_area_img"><img src="$update[username]" class='big_face'/></div>
        
        <p class="wall_name">$update[username]</p>
        <p class="date_wall">    
            <a class="stdelete" href="#" id="$update[msg_id]" title="حذف الحالة">X</a>
        </p>
        
		<div class="in_ur_mind">
            
            $update[message]
        </div>
        
       <div class="wall_content_info">       
       
       <img src="$dateimg" style="float:right; padding-top:3px"/><p>$timeago</p><a href="#"> <img src="$likeimg" style="float:right" />أعجبني</a>
       
       <a id="$update[msg_id]" class="commentopen" href="#" title="">تعليق</a>
              
       </div>
EOF;


print '

        <div id="comment_area'.$update['msg_id'].'" class="comment_area">

                  <div id="comment_text_area'.$update[msg_id].'" class="comment_text_area" style="display:none">
                    <form action="" method="post">
                        <a href="#"><img src="'.$commenter.'" class="small_face"/></a>
                        <textarea id="'.$update[msg_id].'" class="ctextarea" name="comment" style="width:330px; height:30px; margin-top:8px; float:right"></textarea>
                        <input type="hidden" id="" name="msg_id" value="'.$update[msg_id].'" />
                    </form>
                  </div>   
        </div><!--end of comment area-->
        
';

?>