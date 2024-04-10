<script type="text/javascript" src="<?=site_url()?>addons/modules/wall/js/wall.js"></script>

<div id="wall_area">

<?php

foreach($Updates as $wall_msg){
    

    $timeago = time_delta('now', (int)$wall_msg['created']);
    $dateimg = site_url() . 'addons/themes/conjuction/img/date.jpg';
    $likeimg = '<a href="#"> <img src="'.site_url().'addons/themes/conjuction/img/like1.jpg" style="float:right" />أعجبني</a>';
    $nopic = site_url() . 'addons/themes/conjuction/img/no_avatar.jpg';
    
    $message = tolink(htmlentities($wall_msg['message']));
    
    $comments = $this->wall_m->Comments($wall_msg['msg_id']);
    
    $delete_link = ($this->user->id == $wall_msg['uid_fk']) ? '<a class="stdelete" href="#" id="'.$wall_msg['msg_id'].'" title="حذف الحالة">X</a>' : false;
    

    //this picture for the wall owner
    $mypicture = site_url().'files/thumb/'.$user_data->gravatar;
    
    //this picture for the commenter
    if(isset($this->user->gravatar) && $this->user->gravatar != 'no_avatar.jpg'){
        $commenter = site_url() . 'files/thumb/' . $this->user->gravatar . '/50';
    }else{
        $commenter = site_url() . 'addons/themes/conjuction/img/no_avatar.jpg';
    }
    
    if(!empty($this->user->id)) $comment_link = '<a id="'.$wall_msg['msg_id'].'" class="commentopen" href="#" title="">تعليق</a>';

print <<<EOF

    <div class="wall_content" id="wall_content$wall_msg[msg_id]">
    
        <div id="wall_area_img"><img src="$mypicture"/></div>
        
        <p class="wall_name">$wall_msg[username]</p>
        <p class="date_wall">    
            $delete_link
        </p>
        
		<div class="in_ur_mind">
			$message
        </div>
        
       <div class="wall_content_info">       
       
       <img src="$dateimg" style="float:right; padding-top:3px"/><p>$timeago</p>
       

       $comment_link
       
       </div>
EOF;

print '<div id="comment_area'.$wall_msg['msg_id'].'" class="comment_area">';

foreach($comments as $comment){

    $timeago = time_delta('now', (int)$comment['created']);
    $user = $this->users_m->get(array('username'=>$comment['username']));
    //this picture for each comment
    $commentpic = site_url().'files/thumb/'.$user->gravatar;

    $delete_comment = ($this->user->id == $comment['uid_fk']) ? '<a class="stcommentdelete" href="#" id="'.$comment['com_id'].'" title="حذف التعليق">X</a>' : false;

print <<<EOF

         		 <div class="commenter" id="stcommentbody$comment[com_id]">                    
                    <a href="#"><img src="$commentpic" class='small_face'/></a>
                  <div class="commenter_text">
                    <p style="float:left; margin-left: 10px">$delete_comment</p>
                    <h4>$comment[username]:</h4>                    
                    <p class="text_box">$comment[comment]</p>
                  </div>
               	   
                  <h5>$timeago</h5>
                  </div>
                  

EOF;
unset($user,$commentpic);
   
}

print '
                  <div id="comment_text_area'.$wall_msg[msg_id].'" class="comment_text_area" style="display:none">
                    <form action="" method="post">
                        <a href="#"><img src="'.$commenter.'" class="small_face"/></a>
                        <textarea id="'.$wall_msg[msg_id].'" class="ctextarea" name="comment" style="width:330px; height:30px; margin-top:8px; float:right"></textarea>
                        <input type="hidden" id="" name="msg_id" value="'.$wall_msg[msg_id].'" />
                    </form>
                  </div>   

</div><!--end of comment area-->';

print '</div>';
    
}
?>

	<div style="text-align: center; clear: both; padding-top: 8px; width: 100%; background-color: #FBFBFB; height: 30px; border: 1px solid #D1D1D1;">
	<a id="more_" class="more_records" href="javascript: void(0)">التحديثات السابقة</a>
	</div>

</div><!--end of wall area-->   

