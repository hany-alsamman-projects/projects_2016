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
 * SIGNUP.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
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
        
        // is the nationality selected?            
        if( empty($_POST['pre_nationality']) || !in_array ($_POST['pre_nationality'], $this->countries) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_NAT']));
        }
        
        // is the nationality selected?            
        if( $_POST['terms'] != "on" )
        {
        	die(FUNCTIONS::msg(0,'please Agree on tune forex terms to continue'));
        }
        
        // is the birthday selected?            
        if(!(int)$_POST['day'] || !(int)$_POST['month'] || !(int)$_POST['year'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_BRITHDAY']));
        }
        
        // is the phone?            
        if(!(int)$_POST['phone'])
        {
        	die(FUNCTIONS::msg(0,'Please check the phone number'));
        }
        
        // is the email valid?            
        if( !FUNCTIONS::is_email($_POST['email']) ) die(FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_PROV']));
            
        // we check if everything is filled in
        if(CAPTCHA)
        if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
            die(FUNCTIONS::msg(0,'Captcha Not Vaild'));
        }             
        
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
        $user_account = $_POST['account'];

        $hash = (EMAIL_ACTIVATION == 1) ? md5(time()) : 'none';

        ## account email ID
        $user_email = strtolower(trim($_POST['email']));
        
        $user_country = $_POST['pre_nationality'];
        
        $user_phone = (int)$_POST['phone'];
        
        
        ## get assignedto (partner ID)
        $assigned_to = (isset($_POST['assignedto'])) ? (int)$_POST['assignedto'] : false;
        
        $url = 'http://tune-forex.com/vtigerCRM/';
          
        $WSClient = SITE_PATH.'/library/vtwsclib/Vtiger/WSClient.php';
        
        include_once($WSClient);    
        
        $client = new Vtiger_WSClient($url);                    
        
        if(!class_exists('Vtiger_WSClient')) die(FUNCTIONS::msg(0,'Vtiger_WSClient ERROR'));     
        
        $login = $client->doLogin('admin', 'nFSr0N8BwUC5GP2Q');
        
        if (!$login) die(FUNCTIONS::msg(0,'Vtiger Login ERROR'));  
        
        if($login){
            
            
            // create partner account (IB)
            if( $user_account == 'IB' ){

                 $module = 'Users';
                 $record = $client->doCreate($module,
                  Array(
                  'user_name'=> $user_name,
                  'last_name'=> $user_name,
                  'email1'=> $user_email,
                  'status'=>'Active',
                  'phone_work'=> $user_phone,
                  'address_country'=> $user_country,                  
                  //'is_admin'=>'off',
                  'user_password'=> $user_pass,                  
                  'confirm_password'=> $user_pass,                   
                  'roleid' => 'H7', 
                  'role_name'=>'Tune Partner')
                );
                
                //if ($record) (int)$vTigerID = $client->getRecordId($record["id"]);
                
                
                $client_data = array(
                               'accountname'=> "$user_name",
                               'accounttype'=> NULL,
                               'cf_608' => "$user_account",
                               'cf_610' => "$user_country",
                               'email1'=> "$user_email",
                               'phone'=> $user_phone,
                               'ship_city'=> $user_country,
                               'ship_state'=> '123',
                               'ship_street'=>"n/a",
                               'bill_city'=> "$user_country",
                               'bill_state'=>'4112',
                               'bill_street'=>"n/a"
                              );
                
                $myIB = $client->doCreate("Accounts", $client_data);
                
                //get accounts fieldset and id
                if ($myIB) (int)$vTigerID = $client->getRecordId($myIB["id"]);                
                                
            }else{
                
                 // create account with assigned to partner        
                 if( isset($_POST['partner']) && $_POST['partner'] > 0 ){
                    
                    // check email ID exists in DB
                    $exists = mysql_result(mysql_query("SELECT email FROM `members` WHERE `id` = '{$_POST['partner']}'"),0);
                    
                        if (!empty($exists)){
                            
                            $query = "SELECT * FROM Users WHERE email1 = '$exists'";
                            $records = $client->doQuery($query);
                            $special_id = $records[0]['id'];
                            
                            
                            $client_data = array(
                                           'accountname'=> "$user_name",
                                           'accounttype'=> NULL,
                                           'cf_608' => "$user_account",
                                           'email1'=> "$user_email",
                                           'cf_610' => "$user_country",
                                           'assigned_user_id'=> $special_id,
                                           'phone'=> $user_phone,
                                           'ship_city'=> $user_country,
                                           'ship_state'=> '123',
                                           'ship_street'=>"n/a",
                                           'bill_city'=> $user_country,
                                           'bill_state'=>'4112',
                                           'bill_street'=>"n/a"
                                          ); 
                                          
                            $resacc = $client->doCreate("Accounts", $client_data);
                            if ($resacc) (int)$vTigerID = $client->getRecordId($resacc["id"]);             
                                                                                   
                        }  
                            
                                        
                    }else{
                 
                        // create account simple account
                        
                        $client_data = array(
                                       'accountname'=> "$user_name",
                                       'accounttype'=> NULL,
                                       'cf_608' => "$user_account",
                                       'email1'=> "$user_email",
                                       'cf_610' => "$user_country",
                                       'phone'=> $user_phone,
                                       'ship_city'=> $user_country,
                                       'ship_state'=> '123',
                                       'ship_street'=>"n/a",
                                       'bill_city'=> $user_country,
                                       'bill_state'=>'4112',
                                       'bill_street'=>"n/a"
                                      );
                        
                        $resacc = $client->doCreate("Accounts", $client_data);
                        if ($resacc) (int)$vTigerID = $client->getRecordId($resacc["id"]); 
                   }
                
            }
            

        
        }
        
        //die(FUNCTIONS::msg(0,$vTigerID.'not logged'));
        
        
        mysql_query("INSERT INTO `members` 
        (`id` ,`name` ,`password` ,`phone`, `age`,`type` ,`nationality` ,`email` ,`action_time`, `group_id`, `active_key`, `vtiger_id`) VALUES 
        (NULL , '{$user_name}', MD5( '{$user_pass}' ) , '{$user_phone}' , '{$user_age}','{$user_account}', '{$_POST['nationality']}', '{$user_email}', '".time()."', '{$user_account}', '{$hash}', '{$vTigerID}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        
        if(mysql_affected_rows() > -1){
            
            $myid = mysql_insert_id();
            
    		if(EMAIL_ACTIVATION == true){
                require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");							    
        		
                $_POST['name'] = str_replace(" ", "_",$_POST['name']);
                
                // HTML body
                $body  = "Dear  " . $_POST['name'] . "\n\n";
                $body .= "Thank you for registering a new account with Tune Forex. To activate your account kindly click on the following link or copy paste it in the address bar in your browser:  ".SITE_DIR."/en/index.php?action=signup&active=1&id=$user_email&hash=$hash"."\n\n";            
                $body .= "once your account has been activated a sales representative will contact you via E-mail to provide you with your Tune Trader account number and password. You may login and deposit/withdrawal funds from the client cabinet once your account is activated. "."\n\n"; 
                $body .= "Your account username: " . $_POST['name'] . "\n\n";
                $body .= "Your account password: " . $_POST['password'] . "\n\n";                
                
                //check if this partnet and send the link
                //if($user_account == 'IB') $body .= "Partner Link: ".SITE_DIR."/en/partners/". $myid ."/".$_POST['name'].".html \n\n";
                
                if($user_account == 'IB') $body .= "Partner Link: ".SITE_DIR."/en/partners/". $myid ." \n\n";
                
                //$body .= "Your account type: " . $user_account . "\n\n";
                $body .= "Best Regards". "\n\n";
                $body .= "Tune Forex";

        		$mail = new PHPMailerLite();
                					
                $mail->SetFrom("support@tune-forex.com", 'Forex Accounts');

                $mail->AddAddress($user_email, $_POST['name']);

                $mail->Subject = 'Tune Forex :: Your Account Information';
                
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
            echo FUNCTIONS::msg(1,"http://www.tune-forex.com/en/index.php?action=signup&done=yes");
        }else{
            
            echo FUNCTIONS::msg(0,$this->lang['SIGNUP_MSG_EXISTS']);
            
        }                    
        
    }
    
    public function ACTIVE_ACCOUNT(){

        $myhash = @mysql_result( @mysql_query("SELECT active_key FROM `members` WHERE `email` = '{$_GET['id']}' LIMIT 1"), 0);
        
        if($_GET['hash'] == $myhash){
            
            //if the get correct id update members
    		mysql_query("UPDATE `members` SET `activated` = '1', `active_key` = 'none' WHERE `email` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
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