<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, SYRIA-NEWS. All Rights Reserved.                    |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER SYRIA-NEWS TEAM (PRIVETE ACCESS ONLY)		|
'---------------------------------------------------------------------------'
*/

/**
 * USERCP.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright SYRIA-NEWS.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
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
        
		$passcheck = @mysql_result( @mysql_query("SELECT id FROM `accounts` WHERE `password` = MD5('{$_POST[old_password]}') and `id` = '{$_SESSION[user_id]}'"), 0);       
        
        if($passcheck > 0){
            
			mysql_query("UPDATE `accounts` SET `password` = MD5('{$_POST[password]}') WHERE `id` = '{$_SESSION[user_id]}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			
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