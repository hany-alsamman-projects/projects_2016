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
 * SIGNUP.php
 *
 * @package WIX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
 * @access TEAM
 */

class SIGNUP extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;


    /**
     * SIGNUP::__construct()
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
     * SIGNUP::SIGNUP_PROCESS()
     * 
     * @return
     */
    public function SIGNUP_PROCESS()
    {
        
        // we check if everything is filled in            
        if( empty($_POST['name']) || empty($_POST['password']) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_FIELDS']));
        }
        
        // is the email selected?            
        if( empty($_POST['email']) || !FUNCTIONS::is_email($_POST['email']) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_INVALID']));
        }
       
        // is the sex selected?            
        if(!(int)$_POST['gender'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_SEX']));
        }

        // is the type selected?            
        if(!(int)$_POST['account'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_TYPE']));
        }
        
        // is the nationality selected?            
        if( empty($_POST['pre_nationality']) || !in_array ($_POST['pre_nationality'], $this->countries) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_NAT']));
        }
        
        // is the birthday selected?            
        if(!(int)$_POST['day'] || !(int)$_POST['month'] || !(int)$_POST['year'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_BRITHDAY']));
        }
        
        // is the email valid?            
        if( !FUNCTIONS::is_email($_POST['email']) )
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_PROV']));
                     
        
        // check email ID exists in DB
        //$exists = mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$_POST['email']}'"),0);        
        //if($exists > 0) 
        //die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_EXISTS']));
        
        ## account user name
        $user_name = iconv("UTF-8","CP1256//IGNORE", $_POST['name']);

        ## generate age and return as UNIXTIME
        $user_age = mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']);

        ## convert email to lowerCASE and trim space
        $user_pass = strtolower(trim($_POST['password']));
        
        ## select account type
        $user_account = (int)$_POST['account'];

        $hash = (EMAIL_ACTIVATION == 1) ? md5(mt_rand(0, 32) . time()) : 'none';
        
        ## account email ID
        $user_email = strtolower(trim($_POST['email']));             
        
        mysql_query("INSERT INTO `members` 
        (`id` ,`name` ,`password` ,`age` ,`nationality` ,`gender` ,`email` ,`action_time`, `group_id`, `active_key`) VALUES 
        (NULL , '{$user_name}', MD5( '{$user_pass}' ) , '{$user_age}', '{$_POST['nationality']}', '{$_POST['gender']}', '{$user_email}', '".time()."', '{$user_account}', '{$hash}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        if(mysql_affected_rows() > -1){

    		if(EMAIL_ACTIVATION == 1){
                require_once("library/mailler/class.phpmailer.php");

                // HTML body
        	    $body  = "Hello Mr/Miss " . $_POST['account_name'] . "";
                $body .= "You can active your account by click on this link: ".SITE_DIR."/index.php?action=signup&active=1&id=$user_email&hash=$hash, \n\n";
        	    $body .= "Your account name: " . $_POST['name'] . ", \n\n";
        	    $body .= "Your account pass: " . $_POST['password'] . ".\n\n";
        	    $body .= "Thank you for your time, \n";

        		$mail = new PHPMailer();
        	    $mail->Body = $body;
        	    $mail->AddAddress($_POST['email'], $_POST['name']);

        	    //if(!$mail->Send()) echo $this->lang['error_send'] . $_POST['account_mail'] . "<br>";

        	    // Clear all addresses and attachments for next loop
        	    $mail->ClearAddresses();
            }

            //die(FUNCTIONS::msg(1,"index.php?action=signup&done=yes"));
            echo FUNCTIONS::msg(1,"index.php?action=signup&done=yes");
        }else{
            
            echo FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_EXISTS']);
            
        }                    
        
    }

    public function ACTIVE_ACCOUNT(){

        $myhash = @mysql_result( @mysql_query("SELECT active_key FROM `members` WHERE `email` = '{$_GET['id']}' LIMIT 1"), 0);
        
        if($_GET['hash'] == $myhash){
            
            //if the get correct id update members
    		mysql_query("UPDATE `members` SET `activated` == '1' and `active_key` = 'none' WHERE `email` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
            return true;
        }
        
        return false;                
    }


    /**
     * SIGNUP::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}