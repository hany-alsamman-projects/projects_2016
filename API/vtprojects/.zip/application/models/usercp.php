<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, CODEX.COM. All Rights Reserved.                    |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEX.COM TEAM (PRIVETE ACCESS ONLY)		|
'---------------------------------------------------------------------------'
*/

/**
 * USERCP.php
 *
 * @package WIX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
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
     * USERCP::USERCP_ADDlINK()
     * 
     * @return
     */
    public function DO_REQUEST(){

        //issubmit=1&site_sn=56ff590e-f533-3194-b61f-b0ab2d98452d&sitename=asdasdas&sitedomain=virtualtour.sa&site_information=

        // we check if everything is filled in            
        if( !$_POST['issubmit'] )
        {
        	die(FUNCTIONS::msg(0,'خطأ'));
        }

        ## check SN again!
        $sn = @mysql_result( mysql_query("SELECT ukey FROM `license` WHERE `ukey` = '{$_POST[site_sn]}' LIMIT 1"), 0);

        if($sn != $_POST['site_sn']){
            die(FUNCTIONS::msg(0,'مشكلة في مفتاح التشغيل لا يوجد تطابق'));
        }

        ## check domain enterd!
        $sdomain = @mysql_result( mysql_query("SELECT domain FROM `license` WHERE `domain` = '{$_POST[sitedomain]}' LIMIT 1"), 0);

        if($sdomain != $_POST['sitedomain']){
            die(FUNCTIONS::msg(0,'انت تستعمل مفتاح تشغيل خاص بنطاق اخر'));
        }

        ## check domain if exits!
        $check_domain = @mysql_result( mysql_query("SELECT domain FROM `links` WHERE `domain` = '{$sdomain}' LIMIT 1"), 0);

        if($check_domain == $_POST['sitedomain']){
            die(FUNCTIONS::msg(0,'النطاق المختار موجود بالفعل في قاعدة البيانات لدينا'));
        }

        $information = $_POST['site_information'];
        $sname = $_POST['sitename'];
        $addedby = $_SESSION['user_id'];
        $added_time = time();

        mysql_query("INSERT INTO `links`
        (`id` ,`title` ,`desc`, `domain` , `added_by`  ,`added_time`)
        VALUES 
        (NULL , '{$sname}', '{$information}', '{$sdomain}' , '{$addedby}','{$added_time}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
                    
        if(mysql_affected_rows() > -1){
            echo FUNCTIONS::msg(1, "تم اضافة طلبك بنجاح سوف يتم متابعة الموضوع وانشاء الموقع حسب طلباتك خلال ساعة واحده الى ثلاث ساعات كحد اقصى");
        }else{
            echo FUNCTIONS::msg(0,'مشكلة في الادخال');
        }
        
    }

    public function PRE_ADDLINK(){

        (int)$this->MaxLinks = 4;

        $this->step = ($_GET['step'] == '') ? 1 : $_GET['step'];



        include_once(ROOT . DS . 'application' . DS . 'views' . DS .'/addlink.php');

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