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
 * FUNCTIONS.php
 *
 * @package SITE_FUNCTIONS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
 * @access TEAM
 */
 
class FUNCTIONS {
	
  /**
   * FUNCTIONS::_debug()
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
    
        
    /**
     * FUNCTIONS::is_url()
     * 
     * @return
     */
    public function is_url(&$url){        
        $urlregex = "/^(http|https|ftp)?\:\/\//";        
        return preg_match($urlregex , $url);
    }
    
    
    /**
     * FUNCTIONS::is_email()
     * 
     * @return
     */
    public function is_email($email) {
        return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
    }

    
    /**
     * FUNCTIONS::is_image()
     * 
     * @return
     */
	public function is_image($f)
	{
	    $fp = @fopen($f, 'rb') ;
	    if (!$fp) return false;
	    $hd = fread($fp, 8) ;
	    fclose($fp) ;
	    return $hd == "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A" || substr($hd, 0, 2) == "\xFF\xD8" || substr($hd, 0, 3) == 'GIF' ;
	}
    
    
	/**
	 * FUNCTIONS::fetch_data_array()
	 * 
	 * @param mixed $result
	 * @return
	 */
	public function fetch_data_array($result) 
   	{
		$data=array();
	    while( $row = mysql_fetch_assoc($result) )
	        { $data[]=$row; } 
	    return $data;
   	}
    

 	/**
 	 * functions::fetch_assoc()
 	 * 
 	 * @param mixed $result
 	 * @return
 	 */
 	public function fetch_assoc($result)
    {
    	return mysql_fetch_assoc($result);
    }

	public function PAGE_VIEW($mypage, $another = false, $data = false){

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
        
    
    public function generate_options($from,$to,$callback=false,$stop=false)
    {         
        $reverse=false;
    	
    	if($from>$to)
    	{
    		$tmp=$from;
    		$from=$to;
    		$to=$tmp;
    		
    		$reverse=true;
    	}
    	
    	$return_string=array();
    	for($i=$from;$i<=$to;$i++)
    	{
    	    if($callback == true) $callback = date('M',mktime(0,0,0,$i,1));

            if(isset($stop) && $stop == $i){                
                
                $return_string[]='<option value="'.$i.'" selected>'.($callback?$callback:$i).'</option>';                
                
            }else{
                
                $return_string[]='
        		<option value="'.$i.'">'.($callback?$callback:$i).'</option>
        		';
            }        
            
    	}
    	
    	if($reverse)
    	{
    		$return_string=array_reverse($return_string);
    	}
    	
    	
    	return join('',$return_string);
    }
    
    public function msg($status,$txt)
    {
    	return '{"status":'.$status.',"txt":"'.$txt.'"}';
    }
    	
}




?>