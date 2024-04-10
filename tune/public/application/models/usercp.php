<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, Codex Corp. All Rights Reserved.                    |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER Codex Corp TEAM (PRIVETE ACCESS ONLY)		|
'---------------------------------------------------------------------------'
*/

/**
 * USERCP.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
 * @access TEAM
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
     * USERCP::HISTORY()
     * 
     * @return
     */
    public function HISTORY(){
   
        // Setup sort and search SQL using posted data
        // http://code.google.com/p/flexigrid/wiki/TutorialPropertiesAndDocumentation
        $page = 1; // The current page $sortname = 'id'; 
        // Sort column 
        $sortorder = 'asc'; 
        // Sort order 
        $qtype = ''; 
        // Search column 
        $query = ''; // Search string
        
        
        if (isset($_POST['page'])) {
            $page = mysql_real_escape_string($_POST['page']);
        }
        if (isset($_POST['sortname'])) {
            $sortname = mysql_real_escape_string($_POST['sortname']);
        }
        if (isset($_POST['sortorder'])) {
            $sortorder = mysql_real_escape_string($_POST['sortorder']);
        }
        if (isset($_POST['qtype'])) {
            $qtype = mysql_real_escape_string($_POST['qtype']);
        }
        if (isset($_POST['query'])) {
            $query = mysql_real_escape_string($_POST['query']);
        }
        if (isset($_POST['rp'])) {
            $rp = mysql_real_escape_string($_POST['rp']);
        }
                
//        $handle = fopen("file.txt", "w+");
//        fwrite($handle, $qtype);
//        fclose($handle);
        
        $stable = (isset($_GET['funds']) && $_GET['funds'] == 'withdrawal') ? 'withdrawal' : 'deposit';
        
        $sortSql = "order by $sortname $sortorder";
        $searchSql = ($qtype != '' && $query != '') ? "where $qtype = '$query'" : '';
        
        $searchSql = ($qtype != '' && $query != '') ? " $qtype = '$query' and `added_by` = '".$_SESSION["user_id"]."' " : "`added_by` = '".$_SESSION["user_id"]."'";
        
        
        // Get total count of records
        $sql = "select count(id) FROM `$stable` where $searchSql";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        
        $total = $row[0]; // Setup paging SQL
        $pageStart = ($page - 1) * $rp;
        
        $limitSql = "limit $pageStart, $rp"; // Return JSON data $data = array();
        $data['page'] = $page;
        $data['total'] = $total;
        $data['rows'] = array();
        $sql = "select * from `$stable` where $searchSql $sortSql $limitSql";
        
        $results = mysql_query($sql);
        while ($row = mysql_fetch_assoc($results)) {
            $data['rows'][] = 
            array('id' => $row['id'], 
                  'cell' => array($row['amount'], $row['methods'].'('.strtoupper($row['currency']).')',$row['trans_no'], $row['purse_account'], $row['tune_no'])
                  );
        }
        echo json_encode($data);
        
    }
    
    /**
     * USERCP::BUILD_GATEWAYS()
     * 
     * @return
     */
    public function BUILD_GATEWAYS(){
        
        $myways = array('MoneyBookers' => true, 'WebMoney' => false, 'CashU' => true, 'AlertPay' => true, 'Dixipay' => true, 'Liqpay' => true, 'PerfectMoney' => true, 'LibertyReserve' => true, 'InternalTransfer' => true, 'BankWire' => true);
        
        return array_filter($myways);
        
    }
    
    
    /**
     * USERCP::ACCOUNT_TYPES()
     * 
     * @return
     */
    public function ACCOUNT_TYPES(){
        
        $myways = array('Micro' => true, 'Extra' => true, 'Ultimate' => true, 'IB' => true);
        
        return array_filter($myways);
        
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
        
		$passcheck = @mysql_result( @mysql_query("SELECT id FROM `members` WHERE `password` = MD5('{$_POST[old_password]}') and `id` = '{$_SESSION['user_id']}' LIMIT 1"), 0);       
        
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
     * USERCP::DEPOSIT()
     * 
     * @return
     */
    public function DEPOSIT(){  
        
        // we check if everything is filled in            
        if( empty($_POST['amount']) || empty($_POST['selected_gateway']))
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_REQ']));
        }
       
  
        // is the amount selected?            
        if(!is_numeric($_POST['amount']))
        {
        	die(FUNCTIONS::msg(0,"Please enter numbers only"));
        }        
        
        // is the gateway selected?            
        if(empty($_POST['selected_gateway']))
        {
        	die(FUNCTIONS::msg(0,"Please select an method"));
        }
        
        
        mysql_query("INSERT INTO `deposit` 
        (`id` ,`amount` ,`currency` ,`methods`, `tune_no`, `added_by`) 
        VALUES 
        (NULL , '{$_POST['amount']}', 'USD' , '{$_POST['selected_gateway']}', '{$_POST['tune_no']}', '{$_POST['added_by']}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);  
                    
        if(mysql_affected_rows() > -1){
                    
        if(EMAIL_NOTIFY == true){
            
                    require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");							    
            		
                    // HTML body
                    $body  = "submitted deposit from Mr/Miss " . $_SESSION["user_name"] . "\n\n";
                    $body .= "Amount : " . $_POST['amount'] . " Currency (USD) \n\n";
                    $body .= "Status : Pending \n\n";              
                    //$body .= "Account No / Purse : " . $_POST['purse_account'] . "\n\n";
                    //$body .= "Transaction No : " . $_POST['trans_no'] . "\n\n";
                    $body .= "Tune Trader Account No : " . $_POST['tune_no'] . "\n\n";
                    $body .= "Payment Method : " . $_POST['selected_gateway'] . "\n\n";
                    $body .= "Thanks for your time";
        
            		$mail = new PHPMailerLite();
                    					
                    $mail->SetFrom("support@tune-forex.com", 'Forex Deposit');
        
                    $mail->AddAddress("finance@tune-forex.com", "Tune Admin");
        
                    $mail->Subject = ''.$_SESSION["user_name"].' ('.$_POST['amount'].') Submitted an Deposit Request';
                    
                    $mail->ContentType = 'text/plain';
        
            	    $mail->Body = $body;
                    
                    $mail->IsHTML(false);
                
                    if(!$mail->Send()) {
                        echo FUNCTIONS::msg(0,$mail->ErrorInfo);
                        return false;
                    }
                    
            	    // Clear all addresses and attachments for next loop
            	    $mail->ClearAddresses();
                
        }        
            
            //echo FUNCTIONS::msg(1,"index.php?action=usercp&pro=MoneyDeposit&done=yes");
            
        }else{
            echo FUNCTIONS::msg(0,"Sorry an Error Has Occurred");
        }
        
    }
    
    
    /**
     * USERCP::WITHDRAWAL()
     * 
     * @return
     */
    public function WITHDRAWAL(){  
        
        // we check if everything is filled in            
        if( empty($_POST['amount']) || empty($_POST['purse_account']))
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_REQ']));
        }
       
  
        // is the amount selected?            
        if(!is_numeric($_POST['amount']))
        {
        	die(FUNCTIONS::msg(0,"Please enter numbers only"));
        }        
        
        // is the gateway selected?            
        if(empty($_POST['gateway']))
        {
        	die(FUNCTIONS::msg(0,"Please select an method"));
        }
        
        // is the amount selected?            
        if( !is_numeric($_POST['trans_no']) || !is_numeric($_POST['tune_no']))
        {
        	die(FUNCTIONS::msg(0,"Please enter the trans/tune ID numbers only"));
        } 
        
        
        if($_POST['gateway'] == 'BankWire'){
            
            
            $bankinfo = array(
                                'Beneficiary_Bank' => $_POST['Beneficiary_Bank'],
                                'Beneficiary_Bank_Address' => $_POST['Beneficiary_Bank_Address'], 
                                'Swift_or_BIC' => $_POST['Swift_or_BIC'],
                                'IBAN' => $_POST['IBAN'], 
                                'Intermediary_bank' => $_POST['Intermediary_bank'], 
                                'Beneficiary_Name' => $_POST['Beneficiary_Name'],
                                'Beneficiary_Address' => $_POST['Beneficiary_Address'], 
                                'Beneficiary_Account_Number' => $_POST['Beneficiary_Account_Number']        
                             );

        
            //to safely serialize
            $safe_store = base64_encode(serialize($bankinfo));

        //to unserialize...
        //$array_restored_from_db = unserialize(base64_decode($encoded_serialized_string)); 
                    
            
        }   

        mysql_query("INSERT INTO `withdrawal` 
        (`id` ,`amount` ,`currency` ,`methods` ,`trans_no`, `purse_account` ,`tune_no`, `bankinfo`, `recipient_tune_no`, `added_by`) 
        VALUES 
        (NULL , '{$_POST['amount']}', '{$_POST['currency']}' , '{$_POST['gateway']}','{$_POST['trans_no']}', '{$_POST['purse_account']}', '{$_POST['tune_no']}', '{$safe_store}', '{$_POST['recipient_tune_no']}', '{$_POST['added_by']}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);  
                    
        if(mysql_affected_rows() != -1){
                    
            if(EMAIL_NOTIFY == true){
                    require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");							    
            		
                    // HTML body
                    $body  = "submitted withdrawal from Mr/Miss " . $_SESSION["user_name"] . "\n\n";
                    $body .= "Amount : " . $_POST['amount'] . " Currency (" . $_POST['currency'] . ") \n\n";            
                    $body .= "Account No / Purse : " . $_POST['purse_account'] . "\n\n";
                    $body .= "Transaction No : " . $_POST['trans_no'] . "\n\n";
                    $body .= "Tune Trader Account No : " . $_POST['tune_no'] . "\n\n";
                    if( !empty($_POST['recipient_tune_no']) ) $body .= "Recipient’s Tune Trader Account No : " . $_POST['recipient_tune_no'] . "\n\n";
                    $body .= "Payment Method : " . $_POST['gateway'] . "\n\n"; 
                    
                    if(isset($bankinfo) && sizeof($bankinfo)){                       
                        foreach ($bankinfo as $label => $val){
                            $filed = str_replace("_"," ",$label);
                            $body .=  "$filed : $val "."\n\n";
                        }
                    }
                           
                    $body .= "Thanks for your time";
        
            		$mail = new PHPMailerLite();
                    					
                    $mail->SetFrom("support@tune-forex.com", 'Forex Withdrawal');
        
                    $mail->AddAddress("finance@tune-forex.com", "Tune Admin");
        
                    $mail->Subject = ''.$_SESSION["user_name"].' ('.$_POST['amount'].') Submitted an Withdrawal Request';
                    
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
            
            echo FUNCTIONS::msg(1,"index.php?action=usercp&pro=FundsWithdrawal&done=yes");
            
        }else{
            echo FUNCTIONS::msg(0,"ERROR");
        }
        
    }
    
    
    /**
     * USERCP::TRADINGACCOUNT()
     * 
     * @return
     */
    public function TRADINGACCOUNT(){  
        
        // we check if everything is filled in            
        if( empty($_POST['name']) || empty($_POST['type']))
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_REQ']));
        }
       
  
        // is the amount selected?            
        if(FUNCTIONS::is_email($_POST['email']) == false)
        {
        	die(FUNCTIONS::msg(0,"Please enter vaild email address"));
        }        
        
        // is the gateway selected?            
        if(!is_numeric($_POST['phone']))
        {
        	die(FUNCTIONS::msg(0,"Please enter vaild phone number"));
        }
         
                    
        if(EMAIL_NOTIFY == true){
                    require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");							    
            		
                    // HTML body
                    $body  = "You Have New Trading Account Request !\n\n";
                    $body .= "Client name : " . $_POST['name'] . " Type (" . $_POST['type'] . ") \n\n";            
                    $body .= "Client E-mail : " . $_POST['email'] . "\n\n";
                    $body .= "Client Telephone No : " . $_POST['phone'] . "\n\n";
                    $body .= "Account Type : " . $_POST['type'] . "\n\n";
                    $body .= "Sent From Tune Forex Informations DATACENTER \n";
                    
                    
            		$mail = new PHPMailerLite();
                    					
                    $mail->SetFrom("info@tune-forex.com", 'Tune Forex Information');
        
                    $mail->AddAddress("support@tune-forex.com", "New Trading Account");
        
                    $mail->Subject = ''.$_SESSION["user_name"].' New Trading Account Requested';
                    
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
            
        echo FUNCTIONS::msg(1,"index.php?action=usercp&pro=TradingAccount&done=yes");            
        
    }
    
    
    
    /**
     * USERCP::BANKWIRE()
     * 
     * @return
     */
    public function BANKWIRE(){  
        
        // we check if everything is filled in            
        if( empty($_POST['name']) || empty($_POST['type']))
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_REQ']));
        }
       
  
        // is the amount selected?            
        if(FUNCTIONS::is_email($_POST['email']) == false)
        {
        	die(FUNCTIONS::msg(0,"Please enter vaild email address"));
        }        
        
        // is the gateway selected?            
        if(!is_numeric($_POST['phone']))
        {
        	die(FUNCTIONS::msg(0,"Please enter vaild phone number"));
        }
         
                    
        if(EMAIL_NOTIFY == true){
                    require_once(SITE_PATH."/library/mailler/class.phpmailer-lite.php");							    
            		
                    // HTML body
                    $body  = "You Have New Trading Account Request !\n\n";
                    $body .= "Client name : " . $_POST['name'] . " Type (" . $_POST['type'] . ") \n\n";            
                    $body .= "Client E-mail : " . $_POST['email'] . "\n\n";
                    $body .= "Client Telephone No : " . $_POST['phone'] . "\n\n";
                    $body .= "Account Type : " . $_POST['type'] . "\n\n";
                    $body .= "Sent From Tune Forex Informations DATACENTER \n";
                    
                    
            		$mail = new PHPMailerLite();
                    					
                    $mail->SetFrom("info@tune-forex.com", 'Tune Forex Information');
        
                    $mail->AddAddress("support@tune-forex.com", "New Trading Account");
        
                    $mail->Subject = ''.$_SESSION["user_name"].' New Trading Account Requested';
                    
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
            
        echo FUNCTIONS::msg(1,"index.php?action=usercp&pro=TradingAccount&done=yes");            
        
    }   
    
    
    
    /**
     * USERCP::USERCP_ADDlINK()
     * 
     * @return
     */
    public function ADDlINK(){  
        
        // we check if everything is filled in            
        if( empty($_POST['url']) || empty($_POST['title']) || empty($_POST['thumbnail']) || empty($_POST['desc']) )
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_REQ']));
        }
       
        // is the DEPT selected?            
        if(!(int)$_POST['in_dept'])
        {
        	die(FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_DEPT']));
        }
        
        ## convert added title encoding
        $link_title = iconv("UTF-8","CP1256//IGNORE", $_POST['title']);
        
        ## convert added desc encoding
        $link_desc = iconv("UTF-8","CP1256//IGNORE", $_POST['desc']);
        
        $link_lang = (!isset($_GET['link_lang'])) ? LANG_EXT : $_GET['link_lang'];
        
        mysql_query("INSERT INTO `links` 
        (`id` ,`title` ,`desc` ,`url` ,`lang`, `added_by` ,`in_dept` ,`thumbnail`) 
        VALUES 
        (NULL , '{$link_title}', '{$link_desc}' , '{$_POST['url']}','$link_lang', '{$_POST['added_by']}', '{$_POST['in_dept']}', '{$_POST['thumbnail']}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
                    
        if(mysql_affected_rows() > -1){
            echo FUNCTIONS::msg(1,"index.php?action=usercp&pro=addlink&done=yes");
        }else{
            echo FUNCTIONS::msg(0,$this->lang['ADDLINK_MSG_EXISTS']);
        }
        
    }
    
    
    /**
     * USERCP::LINKSLIST()
     * 
     * @return
     */
    public function LINKSLIST(){

		(int)$this->MaxLinks = 4;
        
        $this->step = ($_GET['step'] == '') ? 1 : $_GET['step'];
        
        ## Start from number?
		$this->from = ($this->MaxLinks * $this->step) - $this->MaxLinks;

        $count_links = mysql_result( mysql_query("SELECT COUNT(`id`) FROM `links` WHERE `added_by` = '{$_SESSION['user_id']}'"), 0);

        $result = mysql_query("SELECT * FROM `links` WHERE `added_by` = '{$_SESSION['user_id']}' LIMIT $this->from,$this->MaxLinks") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        ## have page
		$count_step = ceil( $count_links / $this->MaxLinks); //ceil the max number

        ## Get data with nice shout
        $GetData = FUNCTIONS::fetch_data_array($result);

        //parent::PAGE_VIEW('linkslist',false,$GetData); 
        
        include_once(ROOT . DS . 'application' . DS . 'views' . DS .'/linkslist.php');
        
    }
    
    
    /**
     * USERCP::REMOVELINK()
     * 
     * @return
     */
    public function REMOVELINK($id){
     
        ## check session valid
        if( LOGIN::CHECK_MEMBER_LOGIN() ){
            
            mysql_query("DELETE FROM `links` WHERE `id` = '{$id}' LIMIT 1") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);            
                        
            if(mysql_affected_rows() == 1) echo '1'; else echo '0';    
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