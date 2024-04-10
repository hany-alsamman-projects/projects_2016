<?php
/**
.---------------------------------------------------------------------------.
|   Version: 2.0 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2008-2011, CODEXC. All Rights Reserved.                   |
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
 * @version 2.0 RC1
 * @pattern private
 * @lastupdate 29/03/2011 3:46:11 PM
 * @access CODEX TEAM
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
    var $menu;
    var $items;
    var $total;
    var $pro_delivery;
    var $order_id;
	
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
        
		//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );
		
		define("SITE_PATH", $this->cofings['SITE_PATH']);
		define("SITE_DIR", $this->cofings['SITE_DIR']);
		define("SITE_NAME", $this->cofings['SITE_NAME']);
        define("EMAIL_ACTIVATION" , true);
        
        $this->_ID = (preg_match('/^\d+$/', (int)$_GET['id'])) ? (int)$_GET['id'] : null;

        $this->connection();

        if(isset($this->ACTION)) $this->ACTION = strtolower(trim($this->ACTION));
		
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
    		  
            	/**
        		 * This case is responsible for presenting the registration page
        		 */	             
    			case "register":{                
                    
                    /**
                     * When account need to active, here the script will do the action
                     */
                    if(isset($_GET['active']) && $_GET['active'] == 1 && strlen($_GET['hash']) == 32){
                        $active_status = SIGNUP::ACTIVE_ACCOUNT();
                        parent::PAGE_VIEW($this->ACTION,false,$active_status);
                    }else{
                        parent::PAGE_VIEW($this->ACTION);  
                    }

    			break;
    			}
                
                /**
        		 * This case is responsible for presenting the login page
        		 */	            
    			case "login":{      
                    parent::PAGE_VIEW($this->ACTION);              
    			break;
    			}
                    
                /**
        		 * This case is responsible for presenting the logout and destory all sessions
        		 */	
                case "logout":{
                    session_destroy();
                    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./index.php?">';  
                break;
                }                     
            
    			case "viewdept":{
    			 
    			if (!is_null($this->_ID)){
    			           
                     parent::PAGE_VIEW($this->ACTION);

    			}
                
    			break;
    			}
                
                
                /**
        		 * This case is responsible for presenting the user control panel area
                 * Depending on the existing levels, which determine when you logon
                 * add link, profile, password, picture
                 * Levels:
                 * customer = 1
                 * point saler = 2
                 * reseller = 3
                 * agent = 4
                 * admin = 5
        		 */	
    			case "usercp":{
    			 
                    if( !isset($_SESSION['user_name']) ) die("you must login");
                 
                    if($_GET['pro'] == 'addlink'){        
                        $this->MyDept = LOGIN::BULID_MENU();                    
                        parent::PAGE_VIEW('addlink');                
                    }
                    
                    if($_GET['pro'] == 'profile'){                   
                        $this->ProfileData = USERCP::USERPROFILE();                                        
                        parent::PAGE_VIEW('profile');                    
                    }
                    
                    if($_GET['pro'] == 'password'){
                        parent::PAGE_VIEW('password');                    
                    }
                    
                    if($_GET['pro'] == 'picture'){
                        $this->Picture = USERCP::MYPICTURE();
                        parent::PAGE_VIEW('picture');                    
                    }
                
                    if(!isset($_GET['pro'])) parent::PAGE_VIEW($this->ACTION);
                           
    			break;
    			}
                
                
    			case "myorder":{
    			 
                if(!isset($_SESSION['user_name'])){
                    
                   unset($_SESSION['redirect']); 
                   $_SESSION['redirect'] = $_SERVER["REQUEST_URI"];
                   
                   //header("location: index.php?action=Login&order=1");                   
                   echo '<meta HTTP-EQUIV="REFRESH" content="0; url=./index.php?action=Login&order=1">';                                                         
                }
    			 
    			if (!is_null($this->_ID)){
    			      
                    if(!isset($_POST['PROD_ID']) && !isset($_POST['NextPage'])){
                        
                        ## check if this order in process list and return the order delivery date                         
                        $this->pro_delivery = (ORDERS::ORDER_DELIVERY() == TRUE ) ? ORDERS::ORDER_DELIVERY() : FALSE; 
                        
                        parent::PAGE_VIEW($this->ACTION);
                    
                    }
                    
                    if($_POST['NextPage'] == 'delivery_info' && $_POST['Process'] == true && (int)$_POST['PROD_ID']){
                    
                        //echo $_POST['delivery_date'];
                        ##0 (10) day
                        ##1 (09) month
                        ##2 (2008) year
                        
                        $delivery_date = explode("/", $_POST['delivery_date']);
                        
                        
                        //check delivery date if valid                
                        if ( !is_numeric($delivery_date[0]) || $delivery_date[1] < date("m") || trim(strtok($delivery_date[2], '@')) != date("Y")){ 
                            echo '<div style="clear: both; width:50%; padding: 10px; margin: 20px;" class="msg msg-error" >Sorry, your try to select last day or last month check it</div>';
                            echo '<div style="clear: both; width:30px; padding: 10px; margin: 20px;" class="msg msg-warn" ><A HREF="javascript:history.back()">Back</A></div>';
                            return false;
                        }
                        
                        $this->order_id = ORDERS::INSERT_ORDER();     
                          
                        // Start
                        parent::PAGE_VIEW('delivery_info');
                    
                                            
                    }
                    
                                       
                    if($_POST['NextPage'] == 'checkout' && $_POST['Process'] == true){
                    
                        ORDERS::INSERT_DETAILS();     
                          
                        // Start
                        parent::PAGE_VIEW('make_order');
                    
                                            
                    }

    			}
                
    			break;
    			}
                
    			case "orderprocess":{
                 
                    parent::PAGE_VIEW($this->ACTION);
                
    			break;
    			}
              
    			case "viewcart":{
                 
                    parent::PAGE_VIEW($this->ACTION);
                
    			break;
    			}
                
    			case "emptycart":{

                    parent::PAGE_VIEW($this->ACTION);
                
    			break;
    			}
              
    			case "ViewPage":{
    			 
    			if (!is_null($this->_ID)){
    			     
                     $this->title = mysql_result( mysql_query("SELECT p_name FROM `".$this->prefix_lang."_items` WHERE `id` = '{$this->_ID}'") ,0);
                     $this->content = mysql_result( mysql_query("SELECT p_content FROM `".$this->prefix_lang."_items` WHERE `id` = '{$this->_ID}'") ,0);
                   
                    parent::PAGE_VIEW("page");
    			}
                
    			break;
    			}
                
    			case "terms":{
    			 
    			if (!is_null($this->_ID)){

                    parent::PAGE_VIEW("terms");
    			}
                
    			break;
    			}
                
                
                case "contactus":{
                    
                     $this->title = mysql_result( mysql_query("SELECT p_name FROM `".$this->prefix_lang."_items` WHERE `id` = '19'") ,0);
                     $this->content = mysql_result( mysql_query("SELECT p_content FROM `".$this->prefix_lang."_items` WHERE `id` = '19'") ,0);
                    
             		/****SET THE MAX CHARS FOR EACH MESSAGE***************/            			
            			//it is recommended not to set the max too high, to prevent extremely long messages
            			// from stalling your server            			
            			$EMAIL_MAX = 2500;
            			$SMS_MAX = 120;            		
            		/*****************************************************/ 
                	if(isset($_POST["submitForm"])){
                
                		$_email = $_POST["sender_email"];                		
                		$_company_name = $_POST["company_name"];                		
                		$_sender_name = $_POST["sender_name"];                
                		$_subject = $_POST["sender_subject"];                
                		$_message = $_POST["sender_message"];                
                		$_phone = $_POST["sender_phone"];              
                		
                		$_body = "You have been sent this message from your contact form\n\n";
                
                		if($_company_name) $_body .= "Company Name: $_name\n\n";                		
                		if($_sender_name) $_body .= "Sender Name: $_name\n\n";                		
                		if($_email) $_body .= "Email: $_email\n\n";               		
                		if($_subject) $_body .= "Subject: $_url\n\n";                		
                		if($_message) $_body .= "Message: $_url\n\n";                		
                		if($_phone) $_body .= "Phone: $_phone\n\n";
                		
                		if($_message){                		
            			//check length of body, reduce to max chars
            			if(strlen($_message) > $EMAIL_MAX){$_message= substr($_message, 0, $EMAIL_MAX);}else{$_message = $_message;}
            			if(strlen($_message) > $SMS_MAX){$_message2 = substr($_message, 0, $SMS_MAX);}else{$_message2 = $_message;}
                		}      		

                		//store the recipient(s)
                		//$_to = array();                
                		//now get the recipient(s)
                		$_to = "amr@clima-sy.com";                		
                		//define the subject
                		if(!$_subject) $_subject = "E-Mail from your contact form"; 
                		if(!$_name) $_name = "CONTACT FORM";
                		if(!$_email) $_email = $_name;
                		
                		//set the headers
                		$_header = "From: $_name < $_email >" . "\r\n" .
                                    "Reply-To: ".$_email."\r\n" .
                                    "Super-Simple-Mailer: ".SITE_NAME."";                				
                		echo "<script type=\"text/javascript\">window.onload = function(){showThanks(thanks_message);}</script>";
                        
                        
                        mail($_to, $_subject, $_message, $_header);
                	}
                    
                    
                    parent::PAGE_VIEW("contactus_".$this->prefix_lang."");
    			break;
    			}
    		
    			default:{
    				#parent::PAGE_VIEW("main");
    			}    		
    		}
      }else{

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
        
        
        if(!isset($_GET['task'])){
            
            /**
    		 * This function will select all depts in DB and bulid the main menu
    		 */	
           
           if(isset($_SESSION['user_name'])){
            
             $this->items = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and `order_status` != 'delivered'") ,0);
             
             $this->total = mysql_result(mysql_query("SELECT SUM(`price`) FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and `order_status` != 'delivered'") ,0);
             
           }
       
           $this->menu = MYGLOBALS::BULID_MENU();   
           parent::PAGE_VIEW("home");
        
        
        /**
		 *  all cases in this area only founded to proccess the forms
         *  via send the data through json tech with jquery solutions
         *  every action here and functions, will return array to view
         *  the errors and messages about actions effected
		 */	
        }elseif(isset($_GET['task'])){
            
            if($_GET['task'] == 'login'):           
                LOGIN::LOGIN_PROCESS();         
            endif;
                
            if($_GET['task'] == 'register'):             
                SIGNUP::SIGNUP_PROCESS();                
            endif; 
            
            /**
    		 * check the request if realy have ajax header and check session is realy opened
             * all functions will proccess the data only when login
    		 */             
            if(IS_AJAX && isset($_SESSION['user_name']) ){
            
                if($_GET['task'] == 'insertorder'):            
                    ORDERS::INSERT_ORDER(); 
                endif;
                
                 if($_GET['task'] == 'updateorder'):            
                    ORDERS::UPDATE_ORDER(); 
                endif;
                
                 if($_GET['task'] == 'removefromorder'):            
                    ORDERS::REMOVE_FROM_ORDER(); 
                endif;
                
                if($_GET['task'] == 'linkslist'):            
                    USERCP::LINKSLIST();                
                    if(isset($_GET['remove_link']) ) USERCP::REMOVELINK($_GET['remove_link']);           
                endif;
                
                if($_GET['task'] == 'changeprofile'):
                    USERCP::CHANGEPROFILE();               
                endif;                
                
                if($_GET['task'] == 'password'):            
                    USERCP::CHANGEPASSWORD();                
                endif;
            }                  
        
        }else{
            
            exit();
            
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
