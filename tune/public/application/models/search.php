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
 * SEARCH.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access TEAM
 */

class SEARCH extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;


    /**
     * SEARCH::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        global $INFO, $smarty;
		
		$this->ACTION = $_GET['action'];
        
        $this->cofings = $INFO;
        
		$this->smarty = $smarty;
    }    
    
    /**
     * SEARCH::SEARCH_PROCESS()
     * 
     * @return
     */
    public function SEARCH_PROCESS(){
                    
        $_GET['url'] = str_replace('HANY','&',$_GET['url']);
        $data = file_get_contents($_GET['url']);
        //$data = implode('', $iFile);
        $urlregex = "^(http?|https)\:\/\/";
        
        $images_array = array();                
        
        // Get encoding
        preg_match('/charset=(\S+)/', $data , $encode);
        // cleanup encoding
        $Encoding = str_replace(array('"','>') , '' , $encode[1] );
        
        // Get the title
        preg_match('/<title>(.*?)<\/title>/',$data,$match);
        
        // We've got the title here!
        if ( strtolower($Encoding) == 'windows-1256' ) {
        	$myimage = $match[1];
            array_push($images_array,$myimage);
        }else{
        	$myimage = iconv($Encoding, "CP1256//IGNORE", $match[1]);
            array_push($images_array,$myimage);
        }
        
        // get all images
        preg_match_all('/<img.*?src="([^\'"]*)".*?>/',$data,$images);
        
        // Remove duplicated images
        $unique = array_unique($images[1]);
        
        // get .jpg images only 
        foreach ( $unique as $image ) {
        	$ext = end(explode('.',$image));
        	if ( strtolower($ext) == 'jpg' ) {
                if(eregi($urlregex, $image))
                {
                    array_push($images_array,$image);
                }
        	}
        }
        
        $images_separated = implode("||", $images_array);
        //header('Content-Type: text/html; charset=utf-8');
        echo $images_separated; 

    }


    /**
     * SEARCH::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}