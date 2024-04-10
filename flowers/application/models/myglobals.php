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
 * MYGLOBALS.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright 3NJOOM.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access TEAM
 */

class MYGLOBALS extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;

    
    /**
     * MYGLOBALS::__construct()
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
     * MYGLOBALS::BULID_MENU()
     * 
     * @return
     */
    public function BULID_MENU(){
                
        $result = mysql_query("SELECT * FROM `departments` WHERE `d_parent` != '0' and `d_active` = '1' and `d_type` = 'cat'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        ## Get data with nice shout
        $GetData = FUNCTIONS::fetch_data_array($result);
        
        return $GetData;        
    }


    /**
     * MYGLOBALS::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}