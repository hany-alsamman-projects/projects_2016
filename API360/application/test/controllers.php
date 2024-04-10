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
 * SECURITY.php
 *
 * @package SECURITY
 * @programmer Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.5
 * @lastupdate 04/10/2008 11:46:11
 * @pattern private
 * @access TEAM
 */
 
class SECURITY{
	

	
	
  /**
   * SECURITY::parse_incoming()
   * 
   * @return
   */
    function parse_incoming()
    {
		//-----------------------------------------
		// Attempt to switch off magic quotes
		//-----------------------------------------

		@set_magic_quotes_runtime(0);

		$this->get_magic_quotes = @get_magic_quotes_gpc();
		
    	//-----------------------------------------
    	// Clean globals, first.
    	//-----------------------------------------
    	
		$this->clean_globals( $_GET );
		$this->clean_globals( $_POST );
		$this->clean_globals( $_COOKIE );
		$this->clean_globals( $_REQUEST );
    	
	}
}
	
?>
