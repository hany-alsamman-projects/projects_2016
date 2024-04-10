<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, CODEX.COM. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEX.COM TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * LOGIN.php
 *
 * @package WIX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
 * @access TEAM
 */

class LOGIN extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;

    
    /**
     * LOGIN::__construct()
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
	 *  WHEN YOU LOGIN
	 */
	
	public function CHECK_MEMBER_LOGIN(){
		if( session_is_registered('admin') || session_is_registered("member") || session_is_registered('mod') || session_is_registered('company') ) return true;
	}
    
    /**
     * LOGIN::LOGIN_PROCESS()
     * 
     * @return
     */
    public function LOGIN_PROCESS(){
        
        // we check if everything is filled in            
        if( !empty($_POST['email']) && !empty($_POST['password']) )
        {
    			$username = strtolower(trim($_POST['email'])); // convert email to lower and trim space
    			$password = md5($_POST['password']); //compile md5 password
    			$ip = $_SERVER['REMOTE_ADDR']; //get ip address of user
    			
    			//check and get admin row
    			$a = mysql_query("SELECT * FROM `members` WHERE `email` = '{$username}' LIMIT 1");
    			//check rows == 1
    			if(mysql_num_rows($a) > 0){
    				
    				if($row = mysql_fetch_object($a) ){
    					
    					$id = $row->id;
    					$name = $row->name;
    					$pass = $row->password;
                        
    					//check password enterd
    					if($password != $pass){
    					
    					//if you have wrong password i will add this error as attempt
    					mysql_query("UPDATE `members` SET `attempt` = attempt + 1, `action_time` = '".time()."' WHERE `id` = '{$row->id}'") or die("". mysql_error() ."error");
    						
    					//return the error message
                        die(FUNCTIONS::msg(0,$this->lang['LOGIN_MSG_WRONG_PASS']));
    
    					}elseif($row->activated != 1){
                        
    					//return the error message
                        die(FUNCTIONS::msg(0,$this->lang['LOGIN_MSG_NOT_ACTIVE']));
                        
                        }else{
    					
                        //start as registered member
    					if($row->group_id == '1'): session_register("member");         					
    					//start as registered company
                        elseif ($row->group_id == '2'): session_register("company");   
    					//start as registered mod
                        elseif ($row->group_id == '3'): session_register("mod");          
    					//start as registered admin
                        elseif ($row->group_id == '4'): session_register("admin");            
    					endif;
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;
    					
    		            //show welcome page
                        die(FUNCTIONS::msg(1, "index.php?action=login&auth=yes"));
    					
    					}
    				}
    				
    			}else{
    				    die(FUNCTIONS::msg(0, $this->lang['LOGIN_MSG_NOT_FOUND']));
    			}
            
        }else{
                die(FUNCTIONS::msg(0, $this->lang['LOGIN_MSG_CHECK']));
        }
        
    }
    
    
    /**
     * LOGIN::BULID_MENU()
     * 
     * @return
     */
    public function BULID_MENU(){
                
        $result = mysql_query("SELECT * FROM `departments` WHERE `d_active` = '1' and `d_type` = 'cat'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        ## Get data with nice shout
        $GetData = FUNCTIONS::fetch_data_array($result);
        
        return $GetData;        
    }
    
    
    /**
     * LOGIN::DEPT_VIEW()
     * 
     * @return
     */
    public function DEPT_VIEW(){
                
        (int)$approve = ($_GET['approve'] == 1 OR $_GET['approve'] == 2) ? $_GET['approve'] : 1;
        
        $result = mysql_query("SELECT * FROM `links` WHERE `approved` = '$approve' and `lang` = '".LANG_EXT."' and `in_dept` = '{$_GET['id']}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        ## Get data with nice shout
        $GetData = FUNCTIONS::fetch_data_array($result);
        
        return $GetData;
    }


    /**
     * LOGIN::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}