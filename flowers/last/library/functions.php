<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2008-2009, CODEXC. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEXC TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * SITE_FUNCTIONS.php
 *
 * @package SITE_FUNCTIONS
 * @author Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access CODEXC TEAM
 */
 
class FUNCTIONS{
	
  /**
   * SITE_FUNCTIONS::_debug()
   * 
   * @param mixed $var
   * @param mixed $class
   * @param mixed $line
   * @return
   */
	public function _debug($var, $class = null, $line = null)
	{
		@chmod("./_SQLDebug.txt",0777);
		
		$v = var_export($var, true);
		$f = fopen("_SQLDebug.txt","a");
		
		fwrite($f,date("M j, g:i a ")."CLASS: {$class} ($line)".stripslashes($v)."\n");
		fclose($f);
		
		@chmod("./_SQLDebug.txt",0444);
	}
	

	public function PAGE_VIEW($mypage, $another = false){

		if(isset($mypage) || isset($another)){
		
		$action = !empty($mypage) ? $mypage : $another;
		
		$FILES = array();
		$DH = opendir(ROOT . DS . 'application' . DS . 'views' . DS);
		while ( ($file = readdir($DH)) !== false) {
			if ( $file != '.' and $file != '..' ) {
				array_push($FILES,$file);
			}
		}
		closedir($DH);
		
		$ACTION_URL = ROOT . DS . 'application' . DS . 'views' . DS . "$action.php";
		  
			if (file_exists("$ACTION_URL") and in_array("$action.php",$FILES) ) {	  
			  include("$ACTION_URL");
			}
		}
	}	
	
}


?>