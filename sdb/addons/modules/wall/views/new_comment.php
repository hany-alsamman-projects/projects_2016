<?php
        
        $timeago = time_delta('now', (int)$comment['created']);
        
        if(isset($this->user->gravatar) && $this->user->gravatar != 'no_avatar.jpg'){
            $commnterpic = site_url() . 'files/thumb/' . $this->user->gravatar . '/50';
        }else{
            $commnterpic = site_url() . 'addons/themes/conjuction/img/no_avatar.jpg';
        }
        
print <<<EOF

 		 <div class="commenter" id="stcommentbody$comment[com_id]">                     
            <a href="#"><img src="$commnterpic" class='small_face'/></a>
            
          <div class="commenter_text">
            <p style="float:left; margin-left: 10px"><a class="stcommentdelete" href="#" id="$comment[com_id]" title="حذف التعليق">X</a></p>
            <h4>$comment[username]:</h4>                    
            <p class="text_box">$comment[comment]</p>
          </div>
       	  
          <h5>$timeago</h5>
          </div>
          
          
EOF;

?>