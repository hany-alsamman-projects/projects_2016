        <div id="container_card" style="height:auto">
        <div id="group">  
<?php

//    [0] => stdClass Object
//        (
//            [id] => 2
//            [user_id] => 2
//            [display_name] => ديمة الهندية
//            [first_name] => ديمة
//            [last_name] => 
//            [user_power] => 1
//            [company] => 
//            [lang] => en
//            [bio] => 
//            [dob] => 
//            [gender] => 
//            [phone] => 
//            [mobile] => 
//            [address_line1] => 
//            [address_line2] => 
//            [address_line3] => 
//            [postcode] => 
//            [msn_handle] => 
//            [yim_handle] => 
//            [aim_handle] => 
//            [gtalk_handle] => 
//            [gravatar] => 
//            [website] => 
//            [twitter_access_token] => 
//            [twitter_access_token_secret] => 
//            [updated_on] => 1308045992
//            [lastactivity] => 1311004514
//            [email] => my.jazz@live.com
//            [password] => 17a6751ef82d55910d9cf4207ab746bb1f419532
//            [salt] => d39dc
//            [group_id] => 2
//            [ip_address] => 127.0.0.1
//            [active] => 1
//            [activation_code] => d5f8016843d009b75b158c799923cce38da586e0
//            [created_on] => 1305697447
//            [last_login] => 1311004451
//            [username] => sami
//            [forgotten_password_code] => 
//            [remember_code] => 5d4d7f45c5570f51e7ee95a1f08307ceed3c3896
//            [group_name] => Users
//            [full_name] => ديمة
//        )

    foreach($user_data as $user){
        
        if(!empty($user->gravatar) and $user->gravatar != 'no_avatar.jpg') {        
            $user_img = '<img class="profile_img" src="'.site_url() . 'files/thumb/' . $user->gravatar.'/50' .'" />';
        }else{
            $user_img =  theme_image('no_avatar.jpg', ' class="profile_img"');
        }                             
        
        if( $user->user_power == 2 ){
            
            // $link = user_displayname($user->user_id);
            $link = anchor("users/profile/view/".$user->username,$user->display_name);
            $highlight = theme_image('plus.png');
        
        }else{
            
            $link = $user->display_name;
            $highlight = false;
        }
        
        //print $user->display_name;
        print '<li>'.$user_img.' <p> '.$link.' '.$highlight.'</p></li>';

        //unset($highlight);     
    }
?>
   </div>
   
   </div>