<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 vipit.sa
 * @version 2.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */

class USERCP extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;
    var $MaxLinks;
    var $from;
    var $step;


    /**
     * USERCP::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        global $INFO;
		
		$this->ACTION = $_GET['action'];
        
        $this->cofings = $INFO;
        
		$this->smarty = $smarty;
        
    }    
    
    /**
     * USERCP::USERCP_PROCESS()
     * 
     * @return
     */
    public function USERCP_PROCESS(){        
        
        
    }
    
    
    /**
     * USERCP::CHANGEPROFILE()
     * 
     * @return
     */
    public function CHANGEPROFILE(){    
        
        // we check if everything is filled in            
        if( empty($_POST['pre_nationality']) || empty($_POST['gender']) || empty($_POST['name']) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['PROFILE_MSG_REQ']));
        }
        
        // is the birthday selected?            
        if(!(int)$_POST['day'] || !(int)$_POST['month'] || !(int)$_POST['year'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['PROFILE_MSG_BIR']));
        }
        
        // is the nationality selected?            
        if( !in_array ($_POST['pre_nationality'], $this->countries) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['PROFILE_MSG_NAT']));
        }
        
        // is the group selected?            
        if( !(int)$_POST['group_id'] )
        {
        	die(FUNCTIONS::msg(0,$this->lang['PROFILE_MSG_TYP']));
        }
        
        ## generate age and return as UNIXTIME
        $user_age = mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']);
        
        mysql_query("UPDATE `members` SET `name` = '{$_POST['name']}', `nationality` = '{$_POST['nationality']}', `gender` = '{$_POST['gender']}', `group_id` = '{$_POST['group_id']}', `age` = '{$user_age}' WHERE `id` = '{$_SESSION['user_id']}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);        
        
                    
        if(mysql_affected_rows() > -1){
            echo FUNCTIONS::msg(0,$this->lang['PROFILE_MSG_UPD']);
        }else{
            echo FUNCTIONS::msg(0,"some things wrong");
        }        
        
    }
    
    
    /**
     * USERCP::PROFILEPICTURE()
     * 
     * @return
     */
    public function PROFILEPICTURE(){
        
        mysql_query("UPDATE `members` SET `picture` = '{$_GET['pic']}' WHERE `id` = '{$_SESSION['user_id']}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        if(mysql_affected_rows() > -1){
            echo 'done';
        }
    }
    
    
    /**
     * USERCP::MYPICTURE()
     * 
     * @return
     */
    public function MYPICTURE(){
        
        $mypicture = mysql_result( mysql_query("SELECT picture FROM `members` WHERE `id` = '{$_SESSION['user_id']}'"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        return $mypicture;
    }
    
    
    /**
     * USERCP::USERPROFILE()
     * 
     * @return
     */
    public function USERPROFILE(){
        
        $result = mysql_query("SELECT * FROM `members` WHERE `id` = '{$_SESSION['user_id']}' and `activated` = '1'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        ## Get data with nice shout
        $GetData = FUNCTIONS::fetch_data_array($result);
        
        return $GetData[0];
    }
    
    
    /**
     * USERCP::CHANGEPASSWORD()
     * 
     * @return
     */
    public function CHANGEPASSWORD(){    
        
        // we check if everything is filled in            
        if( empty($_POST['old_password']) )
        {
        	die(FUNCTIONS::msg(0,"Sorry, But the old password field was empty"));
        }
        
        if( $_POST['password'] != $_POST['c_new_password'] )
        {
        	die(FUNCTIONS::msg(0,"Sorry, Please check the confirm password"));
        }          
        
		$passcheck = @mysql_result( @mysql_query("SELECT id FROM `members` WHERE `password` = MD5('{$_POST[old_password]}') and `id` = '1' LIMIT 1"), 0);       
        
        if($passcheck > 0){
            
			mysql_query("UPDATE `members` SET `password` = MD5('{$_POST[password]}') WHERE `id` = '{$_SESSION[user_id]}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			
            if(mysql_affected_rows() > -1){
                die(FUNCTIONS::msg(0,"Your password changed successfully !"));
            }
            
        }else{
            
            die(FUNCTIONS::msg(0,"Sorry, Your old password entered was wrong"));
               
        }
        
    }

    /**
     * USERCP::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}