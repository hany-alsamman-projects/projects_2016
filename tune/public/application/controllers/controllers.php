<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, Codex Corp. All Rights Reserved.                    |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER Codex Corp TEAM (PRIVETE ACCESS ONLY)		|
'---------------------------------------------------------------------------'
*/

/**
 * CONTROLLERS.php
 *
 * @package CONTROLLERS
 * @author Hany alsamman <hany.alsamman@gmail.com>
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
 * @access TEAM
 */

class CONTROLLERS extends FUNCTIONS
{
	
	var $ACTION;
	var $CODE;
    var $ProfileData;
    var $MyDept;
    var $Gateway;
    var $countries;
    var $Picture;
    var $lang;
    var $_ID;
	
  /**
   * CONTROLLERS::connection()
   * 
   * @return
   */
    public function connection()
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
        global $INFO, $_countries, $SiteLang;
				
		
        /**
         * initialization the security system
         * parsing all incoming data [get,post,cookie,request]
         * cleaning  all values and keys by wonderful ways
         */
//        $secure = new SECURITY();
//		$secure->parse_incoming();
        
        $this->countries = $_countries;
		
		$this->ACTION = $_GET['action'];
        
        $this->cofings = $INFO;
        
        $this->lang = $SiteLang;
        
        //$this->allowed_lang = array("ar" => 'العربية', "en" => 'English');
        
		//error_reporting( $this->cofings['REPORTING'] );
        
        $this->_ID = (preg_match('/^\d+$/', (int)$_GET['id'])) ? (int)$_GET['id'] : null;
		
		define("SITE_PATH", $this->cofings['SITE_PATH']);
		define("SITE_DIR", $this->cofings['SITE_DIR']);
		define("SITE_NAME", $this->cofings['SITE_NAME']);
        define("SITE_CDN", $this->cofings['SITE_CDN']);
        
        define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        
        define("EMAIL_ACTIVATION", 1);
        
        define("CAPTCHA", 1);

        /**
         * Create prefect connection, USING SINGLETON PATTREN
         * this return only '1' connection and will closed automatic when sleep 
         */
        $this->connection();
        
    }

  /**
   * CONTROLLERS::Get_Pages()
   * Switch in action , to view the page via routing by $this->ACTION and make proccess
   * this function will put on content tags in html home page
   * @return
   */
    public function Get_Pages()
    {
    	
		$this->AccountTypes = USERCP::ACCOUNT_TYPES();
        
        switch ($this->ACTION)
		{
		  
        	/**
    		 * This case is responsible for presenting the registration page
    		 */	             
			case "signup":{                
                
                    /**
                     * When account need to active, here the script will do the action
                     */
                    if(isset($_GET['active']) && $_GET['active'] == 1 ){
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
			case "reset":{             
                parent::PAGE_VIEW($this->ACTION);              
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
            }
            break;
            
            
            /**
    		 *This case is responsible for presenting the department page
    		 */	
            case "dept":{
                
                $DeptData = LOGIN::DEPT_VIEW();                
                parent::PAGE_VIEW($this->ACTION,false,$DeptData);              
            }
            break;
            
            /**
    		 *This case is responsible for presenting the department page
    		 */	
            case "page":{
                
                //$PageData = LOGIN::PAGE_VIEW();                
                parent::PAGE_VIEW($this->ACTION,false,$DeptData);              
            }
            break;
            
            
            
            /**
    		 * This case is responsible for presenting the user control panel area
             * Depending on the existing levels, which determine when you logon
             * add link, profile, password, picture
             * Levels:
             * Member = 1
             * Company = 2
             * Mod = 3
             * Admin = 4
    		 */	
			case "usercp":{
			 
                if( !isset($_SESSION['user_name']) ) die("you must login");
             
                if($_GET['pro'] == 'TradingAccount'){  
                    $this->AccountTypes = USERCP::ACCOUNT_TYPES();
                    parent::PAGE_VIEW('tradingaccount');                
                }
                
                if($_GET['pro'] == 'MoneyDeposit'){                    
                    $this->Gateway = USERCP::BUILD_GATEWAYS();                  
                    parent::PAGE_VIEW('addlink');                
                }
                
                if($_GET['pro'] == 'FundsWithdrawal'){                    
                    $this->Gateway = USERCP::BUILD_GATEWAYS();                  
                    parent::PAGE_VIEW('withdrawal');                
                }
                
                
                if($_GET['pro'] == 'status'){                    
                    //$this->Status = USERCP::FUNDS_STATUS();                  
                    parent::PAGE_VIEW('status');                
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
		
        
            /**
    		 * If no case selection, The home page will show
    		 */	
			default:{
			    
				parent::PAGE_VIEW(false,'main');
                
			}
		
		}

    }

  /**
   * CONTROLLERS::MAIN_DISPLAY()
   * 
   * @return
   */
    public function MAIN_DISPLAY()
    {
        
        if(!isset($_GET['task'])){
            
            /**
    		 * This function will select all depts in DB and bulid the main menu
    		 */	      
            //$MenuData = LOGIN::BULID_MENU();
            parent::PAGE_VIEW("home",false,$MenuData);       
        
        
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
            
            if($_GET['task'] == 'reset'):            
                LOGIN::reset_pass();                
            endif;
                        
            if($_GET['task'] == 'search'):            
                SEARCH::SEARCH_PROCESS();                
            endif;
                
            if($_GET['task'] == 'signup'):             
                SIGNUP::SIGNUP_PROCESS(); 
            endif; 
            
            if($_GET['task'] == 'page'):             
                parent::PAGE_VIEW($_GET['task'],false);                 
            endif; 
            
            /**
    		 * check the request if realy have ajax header and check session is realy opened
             * all functions will proccess the data only when login
    		 */             
            if(isset($_SESSION['user_name']) ){
            
                if($_GET['task'] == 'history'):            
                    USERCP::HISTORY();                
                endif;
                
                if($_GET['task'] == 'deposit'):            
                    USERCP::DEPOSIT();                
                endif;  
                
                if($_GET['task'] == 'withdrawal'):            
                    USERCP::WITHDRAWAL();                
                endif; 
                
                if($_GET['task'] == 'tradingaccount'):            
                    USERCP::TRADINGACCOUNT();                
                endif;                
                
                if($_GET['task'] == 'bankwire'):            
                    USERCP::BANKWIRE();                
                endif;  
                              
                
//                if($_GET['task'] == 'linkslist'):            
//                    USERCP::LINKSLIST();                
//                    if(isset($_GET['remove_link']) ) USERCP::REMOVELINK($_GET['remove_link']);           
//                endif;
                
                if($_GET['task'] == 'changeprofile'):
                    USERCP::CHANGEPROFILE();               
                endif;
                
//                if($_GET['task'] == 'profilepicture'):            
//                    USERCP::PROFILEPICTURE();            
//                endif;
                
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