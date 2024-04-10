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
    
    /**
     * FUNCTIONS::is_url()
     * 
     * @return
     */
    public function is_url(&$url){        
        $urlregex = "/^(http|https|ftp)?\:\/\//";        
        return preg_match($urlregex , $url);
    }
    
    
    public function MakeDirectory($dir, $mode = 0755)
    {
      if (is_dir($dir) || @mkdir($dir,$mode)) return TRUE;
      if (!FUNCTIONS::MakeDirectory(dirname($dir),$mode)) return FALSE;
      return mkdir($dir,$mode);
    }
    
	
	public function getDirectoryTree( $outerDir, $filter = false){
	    $dirs = array_diff( scandir( $outerDir ), Array( ".", ".." ) ); 
	    if ( $filter ) {
		$dirs = preg_replace("/[-_.]/", " ", $dirs);  
		}
	    if(count($dirs)>0) return $dirs; else return false; 
	}

	public function getDirFileTree( $outerDir , $x, $filter = false, $myext = false){ 
	    $dirs = array_diff( scandir( $outerDir ), Array( ".", ".." ) ); 
	    $dir_array = Array(); 
	    $i = 1;
 
	    foreach( $dirs as $d ){ 
	        if( is_dir($outerDir."/".$d)  ){
	            $dir_array[ $d ] = FUNCTIONS::getDirFileTree( $outerDir."/".$d , $x); 
	            
	        }else{ 
		         if (($x)?ereg($x.'$',$d):1) {
		         	if ( $filter ){
			         	$d = str_replace("_", " ", $d);
			         	$d = str_replace("-", " ", $d);
						$d = preg_replace("/[!#$%^&*'{}()+=]/", "", $d);  
					}
                    $fileParts  = pathinfo($d);                    
                    //echo substr(strrchr($outerDir, '/'), 1);
                    if($fileParts['extension'] == "flv") $dir_array[ $i ] = $d;           
                    
					$i++; 
		         }
	        } 
	    	
	    }
                
	    return array_filter($dir_array); 
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
	
}


?>