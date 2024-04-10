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
 * SIGNUP.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright 3NJOOM.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access TEAM
 */

class SIGNUP extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;
    var $mylang;


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
        
        $this->mylang = array(
                        
                        ## SIGNUP PROCCESS 
                        'SIGNUP_MSG_FIELDS' => 'All the fields are required',
                        'SIGNUP_MSG_INVALID' => 'You have entered an invalid email address',
                        'SIGNUP_MSG_INVALID_PHONE' => 'You have entered an invalid phone number',
                        'SIGNUP_MSG_SEX' => 'You have to select your sex',
                        'SIGNUP_MSG_TYPE' => 'You have to select your account type',
                        'SIGNUP_MSG_NAT' => 'Sorry, but you try to select invalid nationality',
                        'SIGNUP_MSG_BRITHDAY' => 'You have to fill in your birthday',
                        'SIGNUP_MSG_PROV' => 'You haven\'t provided a valid email',
                        'SIGNUP_MSG_EXISTS' => 'The Email ID was already exists in database'
                        
        );
        
        
        // we check if everything is filled in            
        if( empty($_POST['name']) || empty($_POST['password']) || empty($_POST['address']) )
        {
        	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_FIELDS']));
        }


        // is the phone selected?            
        if( empty($_POST['phone']) && !FUNCTIONS::is_number($_POST['phone']) )
        {
        	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_INVALID_PHONE']));
        }
        
        
        // is the email selected?            
        if( empty($_POST['email']) || !FUNCTIONS::is_email($_POST['email']) )
        {
        	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_INVALID']));
        }

        // is the type selected?            
        if(!(int)$_POST['account'])
        {
        	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_TYPE']));
        }
        
        // is the birthday selected?            
        if(!$_POST['day'] || !$_POST['month'] || !$_POST['year'])
        {
        	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_BRITHDAY']));
        }
        
        // is the email valid?            
        if( FUNCTIONS::is_email($_POST['email']) == false )	die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_PROV']));
                     
        // check email ID exists in DB
        //$exists = mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$_POST['email']}'"),0);        
        //if($exists > 0) 
        //die(FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_EXISTS']));
        
        ## account user name
        $user_name = iconv("UTF-8","CP1256//IGNORE", $_POST['name']);
        
        ## generate age and return as UNIXTIME
        $user_age = mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']);

        ## convert email to lowerCASE and trim space
        $user_pass = strtolower(trim($_POST['password']));
        
        $phone = trim($_POST['phone']);
        
        $address = trim($_POST['address']);
        
        ## select account type
        $user_account = (int)$_POST['account'];

        $hash = (EMAIL_ACTIVATION == true) ? md5(mt_rand(0, 32) . time()) : 'none';
        
        $mail_from = 'info@3njoom.com';
        
        ## account email ID
        $user_email = strtolower(trim($_POST['email']));             
        
        mysql_query("INSERT INTO `accounts` 
        (`id` ,`user_name` ,`password` , `email` ,`phone` ,`address` , `birthday` ,`creation_date`, `group_id`, `active_key`) VALUES 
        (NULL , '{$user_name}', MD5( '{$user_pass}' ) , '{$user_email}', '{$phone}', '{$address}', '{$user_age}', '".time()."', '{$user_account}', '{$hash}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        if(mysql_affected_rows() > -1){
        
    		if(EMAIL_ACTIVATION == true){
                require_once("library/mailler/class.phpmailer-lite.php");							    
        		
                // HTML body
                $body  = "Hello Mr/Miss " . $_POST['account_name'] . "\n\n";
                $body .= "You can active and verify your account by click on this link: ".SITE_DIR."index.php?action=Register&active=1&id=$user_email&hash=$hash"."\n\n";            
                $body .= "Your account name: " . $_POST['name'] . "\n\n";
                $body .= "Your account pass: " . $_POST['password'] . "\n\n";
                $body .= "Thank you for your time";

        		$mail = new PHPMailerLite();
                					
                $mail->SetFrom($mail_from, 'Jasmin Accounts');

                $mail->AddAddress($user_email, $_POST['name']);

                $mail->Subject = 'Jasmin :: Your Account Information';
                
                $mail->ContentType = 'text/plain';

        	    $mail->Body = $body;
                
                $mail->IsHTML(false);
                
                //$mail->MsgHTML($body);
                
                //$mail->IsHTML(true); // send as HTML
            
                if(!$mail->Send()) {
                    echo FUNCTIONS::msg(0,$mail->ErrorInfo);
                    return false;
                }
                
        	    // Clear all addresses and attachments for next loop
        	    $mail->ClearAddresses();
            
            }

            //die(FUNCTIONS::msg(1,"index.php?action=signup&done=yes"));
            echo FUNCTIONS::msg(1,"index.php?action=Register&done=yes");
            return false;

        }else{
            
            echo FUNCTIONS::msg(0,$this->mylang['SIGNUP_MSG_EXISTS']);
            
        }                    
        
    }
    
    public function ACTIVE_ACCOUNT(){

        $myhash = @mysql_result( @mysql_query("SELECT active_key FROM `accounts` WHERE `email` = '{$_GET['id']}' LIMIT 1"), 0);
        
        if($_GET['hash'] == $myhash){
            
            //if the get correct id update members
    		mysql_query("UPDATE `accounts` SET `activated` = '1' , `active_key` = 'none' , `approve` = '1' WHERE `email` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
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