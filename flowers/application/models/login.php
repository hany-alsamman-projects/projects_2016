<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, 3NJOOM. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER 3NJOOM TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * LOGIN.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright 3NJOOM.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
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
		if( isset($_SESSION["admin"]) || isset($_SESSION["agent"]) || isset($_SESSION["reseller"]) || isset($_SESSION["point"])  || isset($_SESSION["customer"]) ) return true;
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
    			$a = mysql_query("SELECT * FROM `accounts` WHERE `email` = '{$username}' LIMIT 1");
    			//check rows == 1
    			if(mysql_num_rows($a) > 0){
    				
    				if($row = mysql_fetch_object($a) ){
    					
    					$id = $row->id;
    					$name = $row->user_name;
    					$pass = $row->password;
                        
    					//check password enterd
    					if($password != $pass){
    					
    					//return the error message
                        die(FUNCTIONS::msg(0,'Entered wrong password'));
    
    					}elseif($row->activation != 1 && $row->approve != 1){
                        
    					//return the error message
                        die(FUNCTIONS::msg(0,'Your account is not active yet'));
                        
                        }else{
                            
    					//if you have login success update plz
    					mysql_query("UPDATE `accounts` SET `last_ip` = '{$_SERVER[REMOTE_ADDR]}', `action_time` = '".time()."' WHERE `id` = '{$row->id}'") or die("". mysql_error() ."error");
    						
    					
                        //start as registered member

                        if ($row->group_id == '5') $_SESSION["admin"] = 1;         
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;
    					
                        
                        if(isset($_SESSION['redirect']) && $_GET['order']) die(FUNCTIONS::msg(1, "$_SESSION[redirect]"));
                        
    		            //show welcome page
                        die(FUNCTIONS::msg(1, "index.php?action=login&auth=yes"));
    					
    					}
    				}
    				
    			}else{
    				    die(FUNCTIONS::msg(0, 'Sorry the member not found in database'));
    			}
            
        }else{
                die(FUNCTIONS::msg(0, 'Please check the fields'));
        }
        
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
