<?php

/**
 * FLOWERS_CPANEL.php
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 

class FLOWERS_CPANEL extends CONTROLLERS
{
	var $error = array();
	var $output = '';
	var $time;
	var $step;
	var $max;
	var $from;
	var $Agent;
    var $cofings;
    var $my_language;
    var $groups;
	
    public function __construct()
    {
        global $lang_en, $INFO;
        
        $this->error = array();
        $this->lang = $lang_en;
        $this->cofings = $INFO;

        //create new connection :)
        dbconnector::getInstance();

		$secure = new security();
		$secure->parse_incoming();
        
        define("SITE_PATH", $this->cofings['SITE_PATH']);
		define("SITE_DIR", $this->cofings['SITE_DIR']);
		define("SITE_NAME", $this->cofings['SITE_NAME']);
		
		$this->time = time();
        
        $this->groups = array('1' => '“»Ê‰', '2' => '‰ﬁÿ… »Ì⁄', '3' => '„Ê“⁄', '4' => 'ÊﬂÌ·', '5' => '≈œ«—Ì');
        
		$this->my_language = array('«·≈‰Ã·Ì“Ì…' => 'en',
		                           '«·⁄—»Ì…'    => 'ar'
		                          );
    }
		
  /**
   * FLOWERS_CPANEL::DASHBOARD()
   *
   * @return
   */
	function DASHBOARD(){
		global $lang;
		
	    //check the session if not registered
		if ( !session_is_registered("admin") and !session_is_registered("reseller") and !session_is_registered("agent") ) {
			
				$this->LOGIN($_POST['username'], $_POST['password']);
		//show the board if registered		
		}else{
		
				//print what you have
				include_once('pages/level_'.$_SESSION["group_id"].'.php');
		}
	}
	
	/**
	 *  WHEN YOU LOGIN WITH ADMIN SESSION
	 *  YOU CAN VIEW AND MAKE ALL ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 */
	
	private function USE_ONLY_FOR_ADMIN(){
		if( !session_is_registered('admin') && ( session_is_registered("reseller") || session_is_registered('agent') ) ) die('<div class="message error">'.$this->lang['error_access'].'</div>');
	}


	/**
	 *  WHEN YOU LOGIN WITH SUPER MOD SESSION
	 *  YOU CAN VIEW AND MAKE ALL RESTRICTION ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 *  BUT NOT MULTI DELETE OR EDIT OR ADD OR VIEW
	 *  ADMIN SECTION LIKE : ADD DEPT && ADD BLOGS , ETC
	 */
	 
	private function USE_ONLY_FOR_SUPER(){
		if( ( !session_is_registered('admin') || !session_is_registered('reseller') ) && ( session_is_registered('agent') || session_is_registered("agent") ) )die('<div class="message error">'.$this->lang['error_access'].'</div>');
	}

		
  /**
   * FLOWERS_CPANEL::LOGIN()
   *
   * @return
   */
	function LOGIN($username, $password){

		//check the user name and password enterd and check sub_ok if true
		if( isset($username, $password) && $_POST['sub_ok'] == '1'){
		    
			$username = strtolower(trim($username)); // convert name to lower and trim space
			$password = md5($password); //compile md5 password
			$ip = $_SERVER['REMOTE_ADDR']; //get ip address of user
			
			//check and get admin row
			$a = mysql_query("SELECT * FROM `accounts` WHERE `email` = '{$username}' LIMIT 1");
			//check rows == 1
			if(mysql_num_rows($a) > 0){
				
				if($row = mysql_fetch_object($a) ){
					
					$id = $row->id;
					$name = $row->user_name;
					$pass = $row->password;
					$ips = $row->last_ip;
					//check password enterd
					if($password != $pass){
						
					//return the error message
					$this->error[] = $this->lang['error_pass'];

					}else{

					//if the password correct update session id for checked later
					mysql_query("UPDATE `accounts` SET `session_life` = '".session_id()."', `action_time` = '".time()."', `last_ip` = '{$ip}' WHERE `id` = '{$row->id}'") or die("". mysql_error() ."error");
					
					if($row->group_id == '3'){
						//start as registered agent
						session_register("reseller");
					
					}elseif ($row->group_id == '4'){
						//start as registered mod
						session_register("agent");

					}elseif ($row->group_id == '5'){
						//start as registered super mod
						session_register("admin");

					}
					
					$_SESSION["user_name"] = "$name";
					$_SESSION["user_id"] = "$id";
					$_SESSION["ip"] = "$ip";
					$_SESSION["group_id"] = $row->group_id;
					
		            //show message and go to main
					return include_once('pages/level_'.$_SESSION["group_id"].'.php');
					
					}
				}
				
			}else{
					$this->error[] = '<div class="message error">'.$this->lang['no_data'].'</div>';
			}
			
		}else{
					$this->error[] = $this->lang['login_start'];
		}

		foreach ($this->error as $value) {
		    $message = $value;
		}
						
		return include_once('pages/login.php');
	}
	
     private function ChangePassword($old, $new, $c_new){
    	
		$result = mysql_query("SELECT id FROM `accounts` WHERE `password` = MD5('$old') and `id` = '{$_SESSION['user_id']}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
		if($row = mysql_fetch_row($result)){
			
			mysql_query("UPDATE `accounts` SET `password` = MD5('$new') WHERE `id` = '{$row[0]}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			
	    	if(mysql_affected_rows() == 1){    		
	    		return true;    					
			}
		}
		
		return false; 
	}

  /**
   * FLOWERS_CPANEL::CHECK_PAGES()
   *
   * @return
   */
	private function CHECK_PAGES(){
		global $lang;
		
		//get the session_life row
		$e = mysql_query("SELECT session_life FROM `accounts` WHERE `id` = '{$_SESSION['user_id']}' LIMIT 1") or die("". mysql_error() ."error");

		if($row = mysql_fetch_row($e)){
		    //check the session_life with browser session_id
			if( strcasecmp($row[0], session_id()) !== 0){
			    //if you do double login destory the first session
			    @session_unregister("agent");
				@session_unregister("mod");
				@session_unregister("super_mod");
				@session_unregister("admin");
				@session_destroy();
				
				print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./index.php">';
			}
		}
		
		if( isset($_GET['section']) and $_GET['section'] != NULL ){
		
			$type = $_GET['section'];
			
			switch($type){
			
				case "logout" :
					@session_unregister("reseller");
					@session_unregister("agent");
					@session_unregister("admin");
					@session_destroy();
										
					print $lang['log_out'];
					print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./index.php">';
				break;
				
				case "AddBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				    if(!empty($_POST['en_d_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						$en_d_name = trim($_POST['en_d_name']);
						$ar_d_name = trim($_POST['ar_d_name']);				
						
						$d_type = trim($_POST['d_type']);
				   (int)$d_active = $_POST['d_active'];
						
						mysql_query("INSERT INTO `departments` 
						( `id`, `en_d_name`, `ar_d_name`, `d_type`, `d_active` )
						VALUES
						(NULL, '{$en_d_name}', '{$ar_d_name}', '{$d_type}', '{$d_active}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}
						
					}
					$ok = ($ok == 1) ? '<div class="message success">ADD</div>' : '';
				
					$this->AddBlog($ok);									    
				break;
				
				case "AddDepartments" :
                
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
                
				    if(!empty($_POST['en_d_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){

						$en_d_name = trim($_POST['en_d_name']);
						$ar_d_name = trim($_POST['ar_d_name']);	
                        
						$en_content_sub = $_POST['en_content_sub'];
				        $ar_content_sub = $_POST['ar_content_sub'];		
						
				   (int)$d_active = $_POST['d_active'];
                        $d_parent = $_POST['d_parent'];
						
						mysql_query("INSERT INTO `departments` 
						( `id`, `en_d_name`, `ar_d_name`, `en_content_sub`, `ar_content_sub`, `d_parent`, `d_active` )
						VALUES
						(NULL, '{$en_d_name}', '{$ar_d_name}', '{$en_content_sub}', '{$ar_content_sub}', '{$d_parent}', '{$d_active}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}						
					}
                    
					$ok = ($ok == 1) ? 'Done' : '';
				
					include_once('./pages/add_departments.php');									    
				break;
				
				case "ShowBlogs" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				$this->ShowBlogs();		
											    
				break;
				
                case "EditDepartment" :
				
			    $g = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}' ORDER BY d_type LIMIT 1");
                
			    if($row_edit_dep = mysql_fetch_object($g)){
			    	
                    $en_d_name = $row_edit_dep->en_d_name;
			    	$ar_d_name = $row_edit_dep->ar_d_name;
			    	
			    	$d_type = $row_edit_dep->d_type;
			    	$stauts = $row_edit_dep->d_active;
			    	
			    	$en_content_sub = $row_edit_dep->en_content_sub;
			    	$ar_content_sub = $row_edit_dep->ar_content_sub;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){

				$en_content_sub = addslashes($_POST['en_content_sub']);
				$ar_content_sub = addslashes($_POST['ar_content_sub']);

					mysql_query("UPDATE `departments` SET 
                    `en_d_name` = '{$_POST['en_d_name']}', `ar_d_name` = '{$_POST['ar_d_name']}',
                    `en_content_sub` = '{$en_content_sub}', `ar_content_sub` = '{$ar_content_sub}',
                    `d_active` = '{$_POST['d_active']}'
                    WHERE `id` = '{$_GET['id']}' LIMIT 1");

					if(mysql_affected_rows() == -1){
						return false;
					}else{
						$ok = 1;
				        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=index.php?section=ShowBlogs&active=departments">';
					}
				}
				
				include('./pages/edit_department.php');	
				
				break;
				
				case "EditBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
			    $result = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}' ORDER BY d_type LIMIT 1");
			    
                if($row_edit_dep = mysql_fetch_object($result)){
			    	$en_d_name = $row_edit_dep->en_d_name;
			    	$ar_d_name = $row_edit_dep->ar_d_name;
			    	
			    	$d_type    = $row_edit_dep->d_type;
			    	$stauts    = $row_edit_dep->d_active;
			    	$d_parent  = $row_edit_dep->d_parent;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
					
					mysql_query("UPDATE `departments` SET 
                    `en_d_name` = '{$_POST['en_d_name']}', `ar_d_name` = '{$_POST['ar_d_name']}' 
                    WHERE `id` = '{$_GET['id']}' and `d_active` = '{$_POST['d_active']}' and 
                    `d_type` = 'cat' and `d_parent` = '0' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
					//mysql_query("UPDATE `departments` SET `d_parent` = '{$_POST['en_d_name']}' WHERE `d_type` = 'cat' and `d_parent` != '0' and `d_parent` = '{$en_d_name}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowBlogs">';
						}					
				}
				
				include('./pages/edit_blog.php');	
				
				break;
				
				case "DeleteBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
				
				//delete all items pages in class
			    $result = mysql_query("SELECT * FROM `departments` WHERE `d_type` = 'cat' and `id` = '{$_GET['id']}' LIMIT 1");
			    
			    while($row = mysql_fetch_object($result)){
				
					$sub = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '{$row->d_name}'");
					
					while($get_sub = mysql_fetch_object($sub)){
						
						//select all topic for delete
					    $result = mysql_query("SELECT * FROM `topics` WHERE `in_dept` = '{$sub->id}'");
					    
					    while($row_s = mysql_fetch_object($result)){
		
						//delete all posts in toipcs
						mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$row_s->tid}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
							
						}
						
						//delete all topics in dept
						mysql_query("DELETE FROM `topics` WHERE `in_dept` = '{$sub->id}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
						
					}
				
			    //delete parent departments	
				mysql_query("DELETE FROM `departments` WHERE `d_type` = 'cat' and `d_parent` = '{$row->d_name}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			    
				//delete departments
				mysql_query("DELETE FROM `departments` WHERE `d_type` = 'cat' and `d_parent` = '0' and `id` = '{$row->id}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
									
				}
								
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						//When finish delete the root
						mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
						print ' „ «·Õ–› »‰Ã«Õ !';
					    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowBlogs">';
					}
										
				}
				break;
				
				case "DeleteDepartment" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
								
				//select all topic for delete
			    $result = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}' LIMIT 1");
			    
			    while($row = mysql_fetch_object($result)){

				//delete all items selected
				mysql_query("DELETE FROM `en_items` WHERE `in_parent` = '{$row->d_parent}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
				mysql_query("DELETE FROM `ar_items` WHERE `in_parent` = '{$row->d_parent}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
				}
				
				//delete all sub dept
				mysql_query("DELETE FROM `departments` WHERE `d_parent` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
				
			    //When finish delete the selected department
				mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
				if(mysql_affected_rows() == -1) return false; 
                
                print '<div class="message success"> „ «·Õ–› »‰Ã«Õ !</div>';
			    print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowBlogs&active=departments">';
										
				}
				
				break;
                
                
				case "AddItem":
				
				    if(!empty($_POST['prodcut_name_ar']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$prodcut_name_ar = trim($_POST['prodcut_name_ar']);
                        $prodcut_details_ar = trim($_POST['prodcut_details_ar']);
                   (int)$prodcut_price_ar  = trim($_POST['prodcut_price_ar']);
						
                        $prodcut_name_en = trim($_POST['prodcut_name_en']);
                        $prodcut_details_en = trim($_POST['prodcut_details_en']);
                   (int)$prodcut_price_en  = trim($_POST['prodcut_price_en']);
          
                        $prodcut_picture = ( !empty($_POST['fileToUpload']) ) ? $_POST['fileToUpload'] : $_POST['prodcut_picture'];          
                   (int)$in_dept = $_POST['in_dept'];
                        $extra = $_POST['extra'];
                        $available = $_POST['available'];                
                        $added_by = $_SESSION['user_id'];
                        
				        //$used_lang = $_POST['used_lang'];
                        $last_update = time();                        
				        				        
				        if(is_array($this->my_language)){
				            				                    
					        foreach($this->my_language as $lang_table){
					           
    							$table_status = mysql_fetch_row(mysql_query("SHOW TABLE STATUS LIKE '".$used_lang."_products'"));                                    
                                $last_insert = $table_status[10];
                                
                                if($lang_table == 'ar'){
                                
                                ## make sure when add item in arabic table and get last id for arabic table (main)
								mysql_query("INSERT INTO `".$lang_table."_products` 
(`id` ,`prodcut_name` ,`prodcut_details` ,`prodcut_picture` ,`prodcut_price` ,`available` ,`added_by` ,`last_update`, `in_dept`, `extra`)
VALUES 
('{$last_insert}' , '{$prodcut_name_ar}', '{$prodcut_details_ar}', '{$prodcut_picture}', '{$prodcut_price_ar}', '{$available}', '{$added_by}', '".time()."', '{$in_dept}', '{$extra}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                                                                 
                                }else{
                                    
                                ## make sure when add item in english table and get last id for arabic table (main)
								mysql_query("INSERT INTO `".$lang_table."_products` 
(`id` ,`prodcut_name` ,`prodcut_details` ,`prodcut_picture` ,`prodcut_price` ,`available` ,`added_by` ,`last_update`, `in_dept`, `extra`)
VALUES 
('{$last_insert}' , '{$prodcut_name_en}', '{$prodcut_details_en}', '{$prodcut_picture}', '{$prodcut_price_en}', '{$available}', '{$added_by}', '".time()."', '{$in_dept}', '{$extra}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                                    
                                }
                                
                                
                                
                                if(mysql_affected_rows() >= 1) $ok = 1;			
                            
						    }
                        
                        }
						
					}
				
					include_once('./pages/add_item.php');			
				break;
                
                
				
				case "ShowItems" :
				    include_once('./pages/show_items.php');
				break;
				
				case "DeleteItem" :
				
				mysql_query("DELETE FROM `en_products` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
				mysql_query("DELETE FROM `ar_products` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						print '<div style="width:50%; margin:10px; float: right" class="msg msg-ok">·ﬁœ  „ Õ–› «·„‰ Ã «·„ÿ·Ê» »‰Ã«Õ</div>';
					    print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowItems&active=items">';
					}
					
				break;
				
				case "EditItem" :
				
				if( isset($_GET['lang']) and strlen($_GET['lang']) > 1 ){
				
			    $h = mysql_query("SELECT * FROM `".$_GET['lang']."_products` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			    
				if($row_edit = mysql_fetch_object($h)){
				    
					$prodcut_name = $row_edit->prodcut_name;
                    $prodcut_details = $row_edit->prodcut_details;
               (int)$prodcut_price  = $row_edit->prodcut_price;
                    $prodcut_picture = ( parent::is_url($row_edit->prodcut_picture) ) ? $row_edit->prodcut_picture : "$row_edit->prodcut_picture";
               (int)$in_dept = (isset($_POST['in_dept']) && $row_edit->in_dept != $_POST['in_dept']) ? $_POST['in_dept'] : $row_edit->in_dept;
                    $extra = $row_edit->extra;
                    $available = $row_edit->available;
                    $added_by = $row_edit->added_by; 
                    $last_update = time();
				}
                
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
                
                
                if(isset($_POST['used_lang'])){
                    
                    $used_lang = $_POST['used_lang'];                                   
                    
                    $_POST['prodcut_picture'] = ( !empty($_POST['fileToUpload']) ) ? $_POST['fileToUpload'] : $_POST['prodcut_picture'];

                    mysql_query("UPDATE `".$used_lang."_products` SET 
                                        `prodcut_name` = '{$_POST['prodcut_name']}',
                                        `prodcut_details` = '{$_POST['prodcut_details']}',
                                        `prodcut_picture` = '{$_POST['prodcut_picture']}',
                                        `prodcut_price` = '{$_POST['prodcut_price']}',
                                        `available` = '{$_POST['available']}',
                                        `added_by` = '{$_SESSION['user_id']}',
                                        `in_dept` = '{$_POST['in_dept']}',
                                        `extra` = '{$_POST['extra']}',
                                        `last_update` = '".time()."' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                
                    
                    ## reset dept (id) for item same id in all lang   
                    foreach($this->my_language as $lang_table){
                        mysql_query("UPDATE `".$lang_table."_products` SET `in_dept` = '{$_POST['in_dept']}' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    }
                
                }
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowItems">';
						}					
				}## end check post
				
				}
				
				include_once('./pages/edit_item.php');
				
				break;	
				
				case "AddAccount" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				    
					if(!empty($_POST['user_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$user_name   = trim($_POST['user_name']);
						$password	= md5($_POST['password']);
						$email	= $_POST['email'];
                   (int)$group_id	= $_POST['group_id'];
                        $approve = $_POST['approve'];
                   (int)$oncity = $_POST['oncity'];
                        $creation_date = time();
						
                        //check member exists
                        $a = mysql_result(mysql_query("SELECT id FROM `accounts` WHERE `email` = '{$email}'"),0);
                        //check rows == 1
                        if ($a > 0)
                        {
                           $ok = 2;
                        
                        }elseif(!FUNCTIONS::is_email($email)){
                            $ok = 3;
                        }
						else
                        {
						
						mysql_query("INSERT INTO `accounts` 
						( `id`, `user_name`, `password`, `email`, `approve`, `oncity`, `group_id`, `creation_date`, `activated` )
						VALUES
						(NULL, '{$user_name}', '{$password}', '{$email}', '{$approve}', '{$oncity}', '{$group_id}', '{$creation_date}', '1')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);					

                            if(mysql_affected_rows() == -1){
								return false;
							}else{
							
							$ok = 1;
                            
                            require_once("../library/mailler/class.phpmailer-lite.php");
                            
                            // HTML body
                            $body  = "Hello Mr/Miss " . $_POST['account_name'] . "\n\n";
                            $body .= "You can active and verify your account by click on this link: ".SITE_DIR."index.php?action=Register&active=1&id=$user_email&hash=$hash"."\n\n";            
                            $body .= "Your account name: " . $_POST['account_name'] . "\n\n";
                            $body .= "Your account pass: " . $_POST['password'] . "\n\n";
                            $body .= "Your account has been created by ".$_SESSION['user_name']."\n\n";
                            
                            $body .= "Thank you for your time";
            
                    		$mail = new PHPMailerLite();
                            					
                            $mail->SetFrom($mail_from, 'Jasmin Accounts');
            
                            $mail->AddAddress($_POST['account_mail'], $_POST['name']);
            
                            $mail->Subject = 'Jasmin :: Your Account Information';
                            
                            $mail->ContentType = 'text/plain';
            
                    	    $mail->Body = $body;
                            
                            $mail->IsHTML(false);
                            
                            //$mail->MsgHTML($body);
                            
                            //$mail->IsHTML(true); // send as HTML
                        
                                if(!$mail->Send()) {
                                    echo FUNCTIONS::msg(0,$mail->ErrorInfo);
                                    return false;
                                }
                            					    
							}
						}
						
					}
				
					$this->DisplayAddAccount($ok);
								    
				break;
                
                
				case "EditAccount" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				    
					
    			    $a = mysql_query("SELECT * FROM `accounts` WHERE `id` = '{$_GET['id']}'");
    			    
                    if($row = mysql_fetch_object($a)){
						$user_name   = $row->user_name;
                        $mypassword = $row->password;
						$email	= $row->email;
                   (int)$group_id	= $row->group_id;
                        $approve = $row->approve;          
                        $cities = $row->cities;       
    				}
                    
                    
                    if(!empty($_POST['user_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$user_name   = trim($_POST['user_name']);
						$password	= ($mypassword != md5($_POST['password'])) ? md5($_POST['password']) : $mypassword;
						$email	= $_POST['email'];
                   (int)$group_id	= $_POST['group_id'];
                        $approve = $_POST['approve'];


                        mysql_query("UPDATE `accounts` SET `user_name` = '{$user_name}', `password` = '{$password}',`email` = '{$email}' , `group_id` = '{$group_id}' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        
                        if(mysql_affected_rows() == -1){
							return false;
						}else{
						
						$ok = 1;
                        				    
						}
						
					}
				
					include_once('./pages/edit_account.php');
								    
				break;
                
				
				case "ShowAccount" :

				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				   include_once('./pages/show_accounts.php');
				   								    
				break;
                
				case "ActiveAccount" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					   
					//if the get correct id update members
					mysql_query("UPDATE `accounts` SET `activation` = '1', `approve` = '1' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
						if(mysql_affected_rows() > 0)
                        print '<div style="width:50%; margin:10px; float: right" class="msg msg-ok">
                                <p> „  ›⁄Ì· «·Õ”«» «·„Õœœ »‰Ã«Õ</p>
                              </div>';						
					}
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowAccount">';
					
				break;
                
				
				case "RemoveAccount" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					   
					//if the get correct id remove the accounts
					mysql_query("DELETE FROM `accounts` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    
					}
                    
                    print '<div style="width:50%; margin:10px; float: right" class="msg msg-ok">
                            <p> „ Õ–› «·Õ”«» «·„Õœœ »‰Ã«Õ</p>
                          </div>';		
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowAccount">';
					
				break;
                
                
                
                case "ShowOrders":
                
                    
                    include('pages/show_orders.php');
                    
                break;
                

					
				case "ChangePassword":
				
				if (isset($_POST['old_pass'], $_POST['new_pass']) and $_POST['change'] == 1)
                {                	
	                if( strcmp($_POST['new_pass'], $_POST['c_new_pass']) == 0){
	                	
	                $change = $this->ChangePassword($_POST['old_pass'], $_POST['new_pass'] ,$_POST['c_new_pass']);
	                	
	                	if($change == true){
							
						print '<div> „: ﬂ·„… «·”— «·Œ«’… »ﬂ ﬁœ  €ÌÌ— </div>';
							
						}else{
						print '<div>⁄–—«:  ›ﬁœ ﬂ·„… «·”— «·ﬁœÌ„…</div>';						
						}
	                
	                }else{
						print '<div>⁄–—«:  ›ﬁœ  √ﬂÌœ ﬂ·„… «·”—</div>';	
					}
		        
				}

                if (!$_POST['change'])
                    include ('pages/change_pass.php');
				
				break;
				
			}
					
		}else{
			
			return include_once('pages/board.php');
						
	    }
	
	}
	
	function DisplayAddAccount($ok){	
	  include_once('./pages/add_account.php');	
	}
	
	function AddBlog($ok){
	  include_once('./pages/add_blog.php');	
	}
	
	function ShowBlogs(){
	  include_once('./pages/show_blogs.php');
	}
	
	function DisplayAddPages($ok){
	  include_once('./pages/add_pages.php');		
	}  
	
	function ShowPages(){
	  include_once('./pages/show_pages.php');	
	}
	
	function EditPage($a_name,$a_title,$a_content,$last_update,$in_class){
		  include_once('./pages/edit_page.php');	  
	}	
}
?>