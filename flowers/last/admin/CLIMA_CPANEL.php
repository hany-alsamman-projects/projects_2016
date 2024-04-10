<?php

/**
 * CLIMA_CPANEL.php
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 

class CLIMA_CPANEL extends CONTROLLERS
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
        
		$this->my_language = array('«·≈‰Ã·Ì“Ì…' => 'en',
		                           '«·⁄—»Ì…'  => 'ar'
		                          );
    }
		
  /**
   * CLIMA_CPANEL::DASHBOARD()
   *
   * @return
   */
	function DASHBOARD(){
		global $lang;
		
	    //check the session if not registered
		if ( !session_is_registered("admin") and !session_is_registered("super_mod") and !session_is_registered("mod") and !session_is_registered("agent") ) {
			
				$this->LOGIN($_POST['username'], $_POST['password']);
		//show the board if registered		
		}else{
		
		$this->Agent = ( session_is_registered("agent") ) ? 'and `t_add_by` = \''.$_SESSION["user_id"].'\' ' : '';
			
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
		if( !session_is_registered('admin') && ( session_is_registered("agent") || session_is_registered('mod') || session_is_registered('super_mod') ) ) die('<div class="message error">'.$this->lang['error_access'].'</div>');
	}


	/**
	 *  WHEN YOU LOGIN WITH SUPER MOD SESSION
	 *  YOU CAN VIEW AND MAKE ALL RESTRICTION ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 *  BUT NOT MULTI DELETE OR EDIT OR ADD OR VIEW
	 *  ADMIN SECTION LIKE : ADD DEPT && ADD BLOGS , ETC
	 */
	 
	private function USE_ONLY_FOR_SUPER(){
		if( ( !session_is_registered('admin') || !session_is_registered('super_mod') ) && ( session_is_registered('mod') || session_is_registered("agent") ) )die('<div class="message error">'.$this->lang['error_access'].'</div>');
	}
	
	/**
	 *  WHEN YOU LOGIN WITH MOD SESSION
	 *  YOU CAN VIEW AND MAKE ALL RESTRICTION ACTION LIKE
	 *  VIEW,EDIT,ADD,MOVE
	 */
	 
	private function USE_ONLY_FOR_MOD(){
		if( ( !session_is_registered('admin') || !session_is_registered('super_mod') || session_is_registered('mod') ) && session_is_registered("agent") )die('<div class="message error">'.$this->lang['error_access'].'</div>');
	}
		
  /**
   * CLIMA_CPANEL::LOGIN()
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
			$a = mysql_query("SELECT * FROM `members` WHERE `name` = '{$username}' LIMIT 1");
			//check rows == 1
			if(mysql_num_rows($a) > 0){
				
				if($row = mysql_fetch_object($a) ){
					
					$id = $row->id;
					$name = $row->name;
					$pass = $row->password;
					$ips = $row->last_ip;
					//check password enterd
					if($password != $pass){
						
					//return the error message
					$this->error[] = $this->lang['error_pass'];

					}else{

					//if the password correct update session id for checked later
					mysql_query("UPDATE `members` SET `session_life` = '".session_id()."', `action_time` = '".time()."', `last_ip` = '{$ip}' WHERE `id` = '{$row->id}'") or die("". mysql_error() ."error");
					
					if($row->group_id == '1'){
						//start as registered agent
						session_register("agent");
					
					}elseif ($row->group_id == '2'){
						//start as registered mod
						session_register("mod");

					}elseif ($row->group_id == '3'){
						//start as registered super mod
						session_register("super_mod");

					}elseif ($row->group_id == '4'){
						//start as registered admin
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
    	
		$result = mysql_query("SELECT id FROM `members` WHERE `password` = MD5('$old') and `id` = '{$_SESSION['user_id']}' LIMIT 1") or die(mysql_error());
		
		if($row = mysql_fetch_row($result)){
			
			mysql_query("UPDATE `members` SET `password` = MD5('$new') WHERE `id` = '{$row[0]}'") or die(mysql_error());
			
	    	if(mysql_affected_rows() == 1){    		
	    		return true;    					
			}
		}
		
		return false; 
	}

  /**
   * CLIMA_CPANEL::CHECK_PAGES()
   *
   * @return
   */
	private function CHECK_PAGES(){
		global $lang;
		
		//get the session_life row
		$e = mysql_query("SELECT session_life FROM `members` WHERE `id` = '{$_SESSION['user_id']}' LIMIT 1") or die("". mysql_error() ."error");

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
				    @session_unregister("agent");
					@session_unregister("mod");
					@session_unregister("super_mod");
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
						(NULL, '{$en_d_name}', '{$ar_d_name}', '{$d_type}', '{$d_active}')") or die(mysql_error());
						
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
						(NULL, '{$en_d_name}', '{$ar_d_name}', '{$en_content_sub}', '{$ar_content_sub}', '{$d_parent}', '{$d_active}')") or die(mysql_error());
						
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
                    `d_type` = 'cat' and `d_parent` = '0' LIMIT 1") or die(mysql_error());
					
					//mysql_query("UPDATE `departments` SET `d_parent` = '{$_POST['en_d_name']}' WHERE `d_type` = 'cat' and `d_parent` != '0' and `d_parent` = '{$en_d_name}'") or die(mysql_error());
					
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
						mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$row_s->tid}'") or die(mysql_error());
							
						}
						
						//delete all topics in dept
						mysql_query("DELETE FROM `topics` WHERE `in_dept` = '{$sub->id}'") or die(mysql_error());
						
					}
				
			    //delete parent departments	
				mysql_query("DELETE FROM `departments` WHERE `d_type` = 'cat' and `d_parent` = '{$row->d_name}'") or die(mysql_error());
			    
				//delete departments
				mysql_query("DELETE FROM `departments` WHERE `d_type` = 'cat' and `d_parent` = '0' and `id` = '{$row->id}' LIMIT 1") or die(mysql_error());
									
				}
								
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						//When finish delete the root
						mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}'") or die(mysql_error());
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
				mysql_query("DELETE FROM `en_items` WHERE `in_parent` = '{$row->d_parent}'") or die(mysql_error());
				mysql_query("DELETE FROM `ar_items` WHERE `in_parent` = '{$row->d_parent}'") or die(mysql_error());
					
				}
				
				//delete all sub dept
				mysql_query("DELETE FROM `departments` WHERE `d_parent` = '{$_GET['id']}'") or die(mysql_error());
				
			    //When finish delete the selected department
				mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}'") or die(mysql_error());
		
				if(mysql_affected_rows() == -1) return false; 
                
                print '<div class="message success"> „ «·Õ–› »‰Ã«Õ !</div>';
			    print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowBlogs&active=departments">';
										
				}
				
				break;
                
                
				case "AddItem":
				
				    if(!empty($_POST['p_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$p_name = trim($_POST['p_name']);
				   (int)$in_parent = $_POST['in_parent'];
				        $p_content = $_POST['p_content'];
				        $used_lang = $_POST['used_lang'];
				        				        
				        if(is_array($this->my_language)){
				        				            				                    
					        foreach($this->my_language as $lang_table){
					        
								if($used_lang == $lang_table){
									
								$last_insert = mysql_result(mysql_query("SELECT id FROM `en_items` ORDER BY id DESC LIMIT 1"),0);
								
								$sure_last_insert = $last_insert+1;

								mysql_query("INSERT INTO `".$lang_table."_items` 
								( `id`, `p_name`, `in_parent`, `p_content`)
								VALUES
								('{$sure_last_insert}', '{$p_name}', '{$in_parent}', '{$p_content}')") or die(mysql_error());
								
								}else{
								
								mysql_query("INSERT INTO `".$lang_table."_items` 
								( `id`, `p_name`, `in_parent`, `p_content`)
								VALUES
								('{$sure_last_insert}', 'none', '{$in_parent}', 'none')") or die(mysql_error());
								
								}
					           														
							}
						}
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
						    print 'ADDED Ok !';
						    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowItems">';
						}
						
					}
				
					include_once('./pages/add_item.php');			
				break;
				
				case "ShowItems" :
				    include_once('./pages/show_items.php');
				break;
				
				case "DeleteItem" :
				
				mysql_query("DELETE FROM `en_items` WHERE `id` = '{$_GET['id']}'") or die(mysql_error());
				mysql_query("DELETE FROM `ar_items` WHERE `id` = '{$_GET['id']}'") or die(mysql_error());
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						print '<div class="message success">·ﬁœ  „ Õ–› «·’›Õ… »‰Ã«Õ</div>';
					    print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowItems&active=items">';
					}
					
				break;
				
				case "EditItem" :
				
				if( isset($_GET['lang']) and strlen($_GET['lang']) > 1 ){
				
			    $h = mysql_query("SELECT * FROM `".$_GET['lang']."_items` WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
			    
				if($row_edit_pro = mysql_fetch_object($h)){
			    	$p_name  = $row_edit_pro->p_name;
			    	$in_parent  = (isset($_POST['in_parent']) && $row_edit_pro->in_parent != $_POST['in_parent']) ? $_POST['in_parent'] : $row_edit_pro->in_parent;
			    	$p_content  = $row_edit_pro->p_content;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
				
                ## update the item row	
				mysql_query("UPDATE `".$_GET['lang']."_items` SET `p_name` = '{$_POST['p_name']}', `p_content` = '{$_POST['p_content']}' WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
                
                ## reset dept (id) for item same id in all lang   
                foreach($this->my_language as $lang_table){
					mysql_query("UPDATE `".$lang_table."_items` SET `in_parent` = '{$in_parent}' WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
                }
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowItems">';
						}					
				}## end check post
				
				}
				
				include_once('./pages/edit_item.php');
				
				break;	
				
				case "AddAccount" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				    
					if(!empty($_POST['account_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$account_name   = trim($_POST['account_name']);
						$account_pass	= md5($_POST['account_password']);
						$account_mail	= $_POST['account_mail'];
				        $account_group	= intval($_POST['account_group']);
						
                        //check and get admin row
                        $a = mysql_query("SELECT * FROM `members` WHERE `name` = '{$account_name}' LIMIT 1");
                        //check rows == 1
                        if (mysql_num_rows($a) == 1)
                        {
                           echo $this->lang['member_exists'];
                        }
						else
                        {
						
						mysql_query("INSERT INTO `members` 
						( `id`, `name`, `password`, `email`, `group_id` )
						VALUES
						(NULL, '{$account_name}', '{$account_pass}', '{$account_mail}', '{$account_group}')") or die(mysql_error());					
							if(mysql_affected_rows() == -1){
								return false;
							}else{
							
							$ok = 1;
							
								require_once("../includes/mailler/class.phpmailer.php");							    
								// HTML body
							    $body  = "Hello " . $_POST['account_name'] . "";
							    $body .= "Your account has been created by $_SESSION[user_name] .<p>";
							
							    // Plain text body (for mail clients that cannot read HTML)
							    $body .= "Your account name: " . $_POST['account_name'] . ", \n\n";
							    $body .= "Your account pass: " . $_POST['account_password'] . ".\n\n";
							    $body .= "Thank you for your time, \n";
								
								$mail = new PHPMailer();					
							    $mail->Body    = $body;
							    $mail->AddAddress($_POST['account_mail'], $_POST['account_name']);
							
							    if(!$mail->Send()) echo $this->lang['error_send'] . $_POST['account_mail'] . "<br>";
							
							    // Clear all addresses and attachments for next loop
							    $mail->ClearAddresses();					    
							}
						}
						
					}
					$ok = ($ok == 1) ? ' „ «·«÷«›…' : '';
				
					$this->DisplayAddAccount($ok);
								    
				break;
				
				case "ShowAccount" :

				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				   include_once('./pages/show_accounts.php');
				   								    
				break;
				
				case "DeleteAccount" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN(); 
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					//if the get correct id update members
					mysql_query("DELETE FROM `members` WHERE `id` = '{$_GET['id']}'") or die("". mysql_error() ."error");
					
						if(mysql_affected_rows() > 0) print $this->lang['user_delete']; 						
					}
					
					include('pages/show_accounts.php');
					
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