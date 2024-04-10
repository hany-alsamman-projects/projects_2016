<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, Codex Corp. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER Codex Corp TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * LOGIN.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
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
	
	public function CHECK_PARTNER(){
		if( isset($_GET['partner']) && $_GET['partner']>0) return true;
        return false;
	}
    
	/**
	 *  WHEN YOU LOGIN
	 */
	
	static function CHECK_MEMBER_LOGIN(){
		if( $_SESSION['admin'] || $_SESSION['member']  || $_SESSION['mod']  || $_SESSION['company'] ) return true;
	}
    
    /**
     * LOGIN::LOGIN_PROCESS()
     * 
     * @return
     */
    static function LOGIN_PROCESS(){
        
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
    					if($row->type == 'Micro' || $row->type == 'Extra' || $row->type == 'Ultimate'): $_SESSION["member"] = 'member';         					
    					//start as registered company
                        elseif ($row->type == 'IB'): $_SESSION["company"] = 'company';   
    					//start as registered mod
                        elseif ($row->group_id == '3'): $_SESSION["mod"] = 'mod';          
    					//start as registered admin
                        elseif ($row->group_id == '4'): $_SESSION["admin"] = 'admin';            
    					endif;
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;
                        $_SESSION["user_pic"] = $row->picture;
    					
    		            //show welcome page
                        die(FUNCTIONS::msg(1, "/en/index.php?action=usercp"));
    					
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
    
    
    public function forgotten_password($email){
        
        if( isset($email) ){
        
            
    		$passcheck = @mysql_result( @mysql_query("SELECT id FROM `members` WHERE `email` = '{$email}' LIMIT 1"), 0);       
            
            if($passcheck > 0){
                
    			$newpass = LOGIN::generatePassword(10);
                
                mysql_query("UPDATE `members` SET `password` = MD5('{$newpass}') WHERE `id` = '{$passcheck}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
    			
                if(mysql_affected_rows() > -1){
                    
                require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");
                
                // body
                $body  = "Dear " . $name . "\n\n";
                //$body .= "Hey, we heard you lost your tune account password.  Say it ain't so!:"."\n\n";        
                //$body .= "Your account user name: " . $name . "\n\n";
                $body .= "Your password is: " . $newpass . "\n\n";
                $body .= "Best Regards.";
        
        		$mail = new PHPMailerLite();
                					
                $mail->SetFrom("support@tune-forex.com", 'Support');    
                $mail->AddAddress($email);    
                $mail->Subject = 'Tune Forex :: Reset Password Account';            
                $mail->ContentType = 'text/plain';    
        	    $mail->Body = $body;            
                $mail->IsHTML(false);
            
                if(!$mail->Send()) {
                    echo FUNCTIONS::msg(0,$mail->ErrorInfo);
                    return false;
                }            
        	    // Clear all addresses and attachments for next loop
        	    $mail->ClearAddresses();
                
                return true;
  
                }
                
            }else{
                
                die(FUNCTIONS::msg(0,"Sorry, Your old password entered was wrong"));
                   
            }
            
            return false;
                
        }
                
    }
    
    public function generatePassword($length = 6, $chars = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ')
    {
      $password = '';
      $char_length = strlen($chars);
      for ($i = 0; $i < $length; $i++)
      {
        $num = rand() % $char_length;
        $password .= $chars[$num];
      }
      return $password;
    }
    
    
	/**
	 * Reset a user's password
	 * @access public
	 * @return void
	 */
	public function reset_pass()
	{
		//if user is logged in they don't need to be here. and should use profile options
		if (LOGIN::CHECK_MEMBER_LOGIN())
		{
            die(FUNCTIONS::msg(1,"index.php?action=usercp"));
		}

		if ($_POST['reset'])
		{
			//$name = $_POST['username'];
			$email = trim($_POST['email']);
            //$newpass = $_POST['newpass'];

			$user_email = mysql_result(mysql_query("SELECT email FROM `members` WHERE `email` = '{$email}' LIMIT 1"),0);

			//supplied username match the email also given?  if yes keep going..
			if ($user_email == $email)
			{
				$new_password = LOGIN::forgotten_password($user_email);

				if ($new_password)
				{
					//set success message
					die(FUNCTIONS::msg(0,"Your password changed successfully !"));
				}
				else
				{
					// Set an error message explaining the reset failed
					die(FUNCTIONS::msg(0,"error message"));
				}
			}
			else
			{
				//wrong username / email combination
				die(FUNCTIONS::msg(0,"wrong username / email combination !"));
			}
		}
        die(FUNCTIONS::msg(0,"wrong email !"));

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
