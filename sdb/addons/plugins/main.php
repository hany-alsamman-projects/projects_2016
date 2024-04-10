<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Example Plugin
 *
 * Quick plugin to demonstrate how things work
 *
 * @package		CodexFW
 * @author		Codex Corp "Experts" Dev Team
 * @copyright	Copyright (c) 2009 - 2010, PyroCMS
 *
 */
class Plugin_Main extends Plugin
{
	/**
	 * Hello
	 *
	 * Usage:
	 * {pyro:main:lasts_wall_messages}
	 *
	 * @param	array
	 * @return	array
	 */
	function lasts_wall_messages()
	{
		//$name = $this->attribute('name', 'World');
        
        // $this->attribute('limit'); $this->attribute('limit');
        
        $mymsg = $this->db->query("SELECT * FROM `wall_messages` ORDER BY msg_id DESC LIMIT 3")->result_array();
        		
        for( $i=0; $i<count($mymsg); $i++){
		    
            $profile = $this->db->query("SELECT display_name,gravatar, (select username FROM `users` WHERE `id` = '".$mymsg[$i]['uid_fk']."') AS username FROM `profiles` WHERE `user_id` = '".$mymsg[$i]['uid_fk']."' LIMIT 1")->row_object();
            
            $html .= '  <div style="clear:both; padding:5px">
                                    
                            <div style="font-size:12px; direction: rtl">                            
                            <a href="#"><img align="middle" style="width:32px; height:32px" src="'.site_url().'files/thumb/'.$profile->gravatar.'/50/50" /></a> 
                            <span>'.word_limiter($mymsg[$i]['message'], 8).'</span> : <span style="font-size:13px;"><b>'.anchor("users/profile/view/".$profile->username, $profile->display_name, "style='text-decoration: underline'").'</b></span>
                            </div>
                            
					    </div>
                                                
                        ';
		
		}
        
		return $html;
	}
    
    
 	function last_news()
	{
		//$name = $this->attribute('name', 'World');
        
        // $this->attribute('limit'); $this->attribute('limit');
        
        $mynews = $this->db->query("SELECT * FROM `blog` WHERE `status` = 'live'  ORDER BY created_on DESC LIMIT 4");
        
        $ournews = $mynews->result_object();
		
//        for( $i=0; $i<=count($ournews); $i++){
//		
//			$html .= $ournews[$i]['intro'];
//		
//		}
        
		return $ournews;
	}
    
}

/* End of file example.php */