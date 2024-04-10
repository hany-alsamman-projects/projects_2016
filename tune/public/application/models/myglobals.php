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
 * @lastupdate 04/10/2008 11:46:11 م
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
    
        
    public function getsubs($id=NULL,$parent=NULL) {
         
        $q = (is_null($parent)) ? "SELECT `id`,`title`,`parent` FROM `pages` WHERE `parent` = '{$id}'" : NULL;
        
        if(is_null($q)) return false;

        $result = mysql_query($q) or die(mysql_error()); 
            
            $subs = array();
            $childs = array();
            
            while ($cat = mysql_fetch_assoc($result)){ 
                //echo '<li>'. $cat['id'] . ' => ' . $cat['title'] . '</li>';

                if($cat['parent'] != NULL) $childs = MYGLOBALS::getsubs($cat['id']);
                
                array_push($subs, array("title" => $cat['title'], "id" => $cat['id'], "parent" => $cat['parent'], "childs" => $childs) );
                
            }
            
            return $subs;
    }
    
    
    /**
     * MYGLOBALS::BULID_MENU()
     * 
     * @return
     */
    public function BULID_MENU(){
                
        $result = mysql_query("SELECT * FROM `pages` WHERE `parent` IS NULL and `lang` = '".LANG_ID."' and `hidden` != '1' and `type` = '1' ORDER BY parent ASC") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                
        while($row = mysql_fetch_object($result)){
            
            static $menus = array();
            
            //$getID = ($row->translation_for == '0') ? $row->id : $row->translation_for;

            $build = array("root" => "$row->title" , "id" => "$row->id", "sub" => MYGLOBALS::getsubs($row->id ,$row->parent));
            
            array_push($menus, $build);     
            
        }
        ## Get data with nice shout
        //$GetData = FUNCTIONS::fetch_data_array($result);
        
        return $menus;        
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