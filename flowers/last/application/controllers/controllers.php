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
 * CONTROLLERS.php
 *
 * @package CONTROLLERS
 * @author Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access CODEXC TEAM
 */
 
 # $my = mysql_result( mysql_query("SELECT author_name FROM `upload`") , 0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

class CONTROLLERS extends FUNCTIONS
{
	
	var $ACTION;
	var $CODE;
    var $title;
    var $content;
    var $prefix_lang;
    var $lang = array();
	
  /**
   * CONTROLLERS::connection()
   * 
   * @return
   */
    private function connection()
    {
        dbconnector::getInstance();
    }
    
  /**
   * CONTROLLERS::__construct()
   * 
   * @return
   */
    public function __construct()
    {
        global $lang_ar, $lang_en, $INFO, $smarty;
			
		//$secure = new SECURITY();
	    //$secure->parse_incoming();
		
		$this->ACTION = $_GET['action'];
        
        $this->prefix_lang = (!isset($_GET['lang']) && $_GET['lang'] == '') ? 'en' : $_GET['lang'];
        
        $this->lang = (isset($_GET['lang']) && $_GET['lang'] == 'ar') ? $lang_ar : $lang_en;
        
        #echo $this->prefix_lang;
        
        $this->cofings = $INFO;
        
		$this->smarty = $smarty;
        
		//error_reporting( $this->cofings['REPORTING'] );
		
		define("SITE_PATH", $this->cofings['SITE_PATH']);
		define("SITE_DIR", $this->cofings['SITE_DIR']);
		define("SITE_NAME", $this->cofings['SITE_NAME']);
        
        $this->_ID = (preg_match('/^\d+$/', (int)$_GET['id'])) ? (int)$_GET['id'] : null;

        $this->connection();
		
		## start session
		##@session_start();
    }

  /**
   * CONTROLLERS::Get_Pages()
   * 
   * @return
   */
    public function Get_Pages()
    {
    	global $smarty;
        
        if (isset($this->ACTION)) {
            
    		switch ($this->ACTION)
    		{        
    			case "ViewPage":{
    			 
    			if (!is_null($this->_ID)){
    			     
                     $this->title = mysql_result( mysql_query("SELECT p_name FROM `".$this->prefix_lang."_items` WHERE `id` = '{$this->_ID}'") ,0);
                     $this->content = mysql_result( mysql_query("SELECT p_content FROM `".$this->prefix_lang."_items` WHERE `id` = '{$this->_ID}'") ,0);
                   
                    parent::PAGE_VIEW("page");
    			}
                
    			break;
    			}
    		
    			default:{
    				#parent::PAGE_VIEW("main");
    			}    		
    		}
      }else{
    	
//        if (isset($this->ACTION) && $this->ACTION == 'aboutus')
//        {
//        	parent::PAGE_VIEW($this->ACTION);
//        
//		}elseif(isset($this->ACTION) && $this->ACTION == 'contactus'){
// 
//			parent::PAGE_VIEW($this->ACTION);
//			
//		}elseif(isset($this->ACTION) && $this->ACTION == 'more'){
//        
//			parent::PAGE_VIEW($this->ACTION);
//		
//        } else
//        {
//            parent::PAGE_VIEW(false,'main');
//        }

             $this->title = mysql_result( mysql_query("SELECT a_name FROM `additional_pages` WHERE `id` = '13' LIMIT 1") ,0);
             $this->content = mysql_result( mysql_query("SELECT a_content FROM `additional_pages` WHERE `id` = '13' LIMIT 1") ,0);

            parent::PAGE_VIEW("main");
        }

    }

  /**
   * CONTROLLERS::MAIN_DISPLAY()
   * 
   * @return
   */
    public function MAIN_DISPLAY()
    {
    	global $smarty;
		  
          /**
           * check for intro page
           */
          if(!isset($_GET['lang']) && $_GET['lang'] == ''){
            
                parent::PAGE_VIEW("intro");
            
          }else{
               
               parent::PAGE_VIEW("home");
            
          }
    }


  /**
   * CONTROLLERS::__destruct()
   * 
   * This will be called automatically at the end of scope
   * 
   * @return
   */
    public function __destruct()
    {
    	
    }
    
}

?>