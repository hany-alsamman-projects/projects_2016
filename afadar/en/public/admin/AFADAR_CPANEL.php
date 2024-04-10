<?php

/**
 * AFADAR_CPANEL.php
 *
 * @package afadar-jewelry
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @author Hany alsamman (Project administrator && Original founder)
 * @version $Id$
 * @pattern private
 * @access private
 */
 
if ( ! defined( 'IN_SCRIPT' ) )
{
    print "<h1>Incorrect access</h1>You cannot access this file directly.";
    exit();
}
	
class AFADAR_CPANEL extends AFADAR_CORE
{
	var $error = array();
	var $output = '';
	var $time;
	var $step;
	var $max;
	var $from;
	var $MaxTopic = 10;
	var $MaxPost = 20;
	var $ArchivesID = 13;
	var $Agent;
	var $PublishDates;
	
    public function __construct()
    {

        global $lang, $publish;
        $this->error = array();
        $this->lang = $lang;

        //create new connection :)
        AFADAR_DB::getInstance();

		$secure = new security();
		$secure->parse_incoming();
		
		$this->time = time();
		$this->PublishDates = $publish;
    }
		
  /**
   * CPANEL_CORE::DASHBOARD()
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
		if( !session_is_registered('admin') && ( session_is_registered("agent") || session_is_registered('mod') || session_is_registered('super_mod') ) ) die('<div style="text-align: center; color: red">'.$this->lang['error_access'].'</div>');
	}
		
  /**
   * CPANEL_CORE::LOGIN()
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
					
                    if ($row->group_id == '4'){
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
					$this->error[] = $this->lang['no_data'];
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
   * CPANEL_CORE::CHECK_PAGES()
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
                
				case "AddItem":

				    if(!empty($_POST['prodcut_name_ar']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$prodcut_name_ar = trim($_POST['prodcut_name_ar']);
                        $prodcut_details_ar = trim($_POST['prodcut_details_ar']);

                        $prodcut_picture = $_POST['sfileToUpload']; 

                        $prodcut_picture_big = $_POST['bfileToUpload']; 
                               
                   (int)$in_dept = $_POST['in_dept'];
            
                        $added_by = $_SESSION['user_id'];
                        

                        ## make sure when add item in arabic table and get last id for arabic table (main)
						mysql_query("INSERT INTO `ar_products` 
(`id` ,`prodcut_name` ,`prodcut_details` ,`prodcut_picture` ,`prodcut_picture_big` , `added_by` ,`last_update`, `in_dept`)
VALUES 
(NULL , '{$prodcut_name_ar}', '{$prodcut_details_ar}', '{$prodcut_picture}', '{$prodcut_picture_big}', '{$added_by}', '".time()."', '{$in_dept}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                          
                                
                        if(mysql_affected_rows() >= 1) {
                            
                          $folderid = mysql_insert_id();
                          
                          FUNCTIONS::MakeDirectory(UPLOAD_PATH.'p_'.$folderid); 
                          
                          $ok = 1;  
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
                
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
                
                
                if(isset($_POST['used_lang'])){
                    
                    $used_lang = $_POST['used_lang'];                                   
                    
                    $_POST['prodcut_picture'] = ( !empty($_POST['sfileToUpload']) ) ? $_POST['sfileToUpload'] : $_POST['prodcut_picture'];
                    
                    $_POST['prodcut_picture_big'] = ( !empty($_POST['bfileToUpload']) ) ? $_POST['bfileToUpload'] : $_POST['prodcut_picture_big'];

                    
                    $_POST['prodcut_details'] = addslashes($_POST['prodcut_details']);
                    
                    mysql_query("UPDATE `".$used_lang."_products` SET 
                                        `prodcut_name` = '{$_POST['prodcut_name']}',
                                        `prodcut_details` = '{$_POST['prodcut_details']}',
                                        `prodcut_picture` = '{$_POST['prodcut_picture']}',
                                        `prodcut_picture_big` = '{$_POST['prodcut_picture_big']}',
                                        `added_by` = '{$_SESSION['user_id']}',
                                        `in_dept` = '{$_POST['in_dept']}',
                                        `last_update` = '".time()."' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                
                                   
                }
					
    				if(mysql_affected_rows() == -1){
    					return false;
    				}else{
    					$ok = 1;
    			        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowItems">';
    				}					
				}## end check post
				
				if( isset($_GET['lang']) and strlen($_GET['lang']) > 1 ){
				
			    $h = mysql_query("SELECT * FROM `".$_GET['lang']."_products` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			    
    				if($row_edit = mysql_fetch_object($h)){
    				    
    					$prodcut_name = $row_edit->prodcut_name;
                        $prodcut_details = $row_edit->prodcut_details;
                   (int)$prodcut_price  = $row_edit->prodcut_price;
                        $prodcut_picture = $row_edit->prodcut_picture;
                        $prodcut_picture_big = $row_edit->prodcut_picture_big;
                   (int)$in_dept = (isset($_POST['in_dept']) && $row_edit->in_dept != $_POST['in_dept']) ? $_POST['in_dept'] : $row_edit->in_dept;
                        $added_by = $row_edit->added_by; 
                        $last_update = time();
    				}              
				}
                
                
				include_once('./pages/edit_item.php');
				
				break;
				
				case "AddBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				    if(!empty($_POST['d_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						$d_name = trim($_POST['d_name']);
						$d_type = trim($_POST['d_type']);
				   (int)$d_active = $_POST['d_active'];
						
						mysql_query("INSERT INTO `departments` 
						( `id`, `d_name`, `d_type`, `d_active` )
						VALUES
						(NULL, '{$d_name}', '{$d_type}', '{$d_active}')") or die(mysql_error());
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}
						
					}
					$ok = ($ok == 1) ? 'Done' : '';
				
					$this->AddBlog($ok);									    
				break;
				
				case "AddDepartments" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				    if(!empty($_POST['d_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$d_name   = trim($_POST['d_name']);
						$d_type   = 'cat';
						$d_parent = $_POST['d_parent'];
				   (int)$d_active = $_POST['d_active'];
						
						mysql_query("INSERT INTO `departments` 
						( `id`, `d_name`, `d_type`, `d_active`, `d_parent` )
						VALUES
						(NULL, '{$d_name}', '{$d_type}', '{$d_active}', '{$d_parent}')") or die(mysql_error());
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}
						
					}
					$ok = ($ok == 1) ? 'Done' : '';
				
					$this->DisplayAddDepartments($ok);									    
				break;
				
				case "ShowBlogs" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				$this->ShowBlogs();		
											    
				break;
				
				case "EditDepartment" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
			    $g = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}' ORDER BY d_type LIMIT 1");
			    if($row_edit_dep = mysql_fetch_object($g)){
			    	$d_name = $row_edit_dep->d_name;
			    	$d_type = $row_edit_dep->d_type;
			    	$stauts = $row_edit_dep->d_active;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
					
					mysql_query("UPDATE `departments` SET `d_name` = '{$_POST['d_name']}', `d_active` = '{$_POST['d_active']}' WHERE `id` = '{$_GET['id']}' LIMIT 1");
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowDepartments">';
						}
				}
				
				$this->EditDepartment($ok,$d_name,$d_type,$stauts);	
				
				break;
				
				case "EditBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
			    $g = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}' ORDER BY d_type LIMIT 1");
			    if($row_edit_dep = mysql_fetch_object($g)){
			    	$d_name = $row_edit_dep->d_name;
			    	$d_type = $row_edit_dep->d_type;
			    	$stauts = $row_edit_dep->d_active;
			    	$d_parent = $row_edit_dep->d_parent;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
					
					mysql_query("UPDATE `departments` SET `d_parent` = '{$_POST['d_name']}', `d_active` = '{$_POST['d_active']}' WHERE `d_parent` != '0' and `d_parent` = '{$d_name}'");
					
					mysql_query("UPDATE `departments` SET `d_name` = '{$_POST['d_name']}', `d_active` = '{$_POST['d_active']}' WHERE `id` = '{$_GET['id']}' LIMIT 1");
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowBlogs">';
						}
					
				}
				
				$this->EditBlog($ok,$d_name,$d_type,$stauts);	
				
				break;
				
				case "DeleteBlog" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
				
				//delete all products pages in class
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
			    $result = mysql_query("SELECT * FROM `topics` WHERE `in_dept` = '{$_GET['id']}' LIMIT 1");
			    
			    while($row = mysql_fetch_object($result)){

				//delete all posts in toipcs
				mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$row->tid}'") or die(mysql_error());
					
				}
				
				//delete all topics in dept
				mysql_query("DELETE FROM `topics` WHERE `in_dept` = '{$_GET['id']}'") or die(mysql_error());
									
				if(mysql_affected_rows() == -1) return false;
				
			    //When finish delete the selected department
				mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
		
				print ' „ «·Õ–› »‰Ã«Õ !';
			    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowBlogs">';
										
				}
				
				break;
				
				
		
				case "AddPages" :
								
				    if(!empty($_POST['a_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$a_name = trim($_POST['a_name']);
						$a_content = $_POST['a_content'];
						$a_title = trim($_POST['a_title']);
						$in_class =  $_POST['in_class'];
						
						mysql_query("INSERT INTO `additional_pages` 
						( `id`, `a_name`, `a_content`, `a_title`, `in_class`)
						VALUES
						(NULL, '{$a_name}', '{$a_content}', '{$a_title}', '{$in_class}')");
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}
						
					}
					$ok = ($ok == 1) ? 'Done' : '';
				
					$this->DisplayAddPages($ok);									    
				break;
				
				case "ViewPages" :
				
				$this->ShowPages();
				
				break;
				
				case "EditPage" :
								
				if(isset($_GET['id']) and is_numeric($_GET['id']) > 0){
					
			    $k = mysql_query("SELECT * FROM `additional_pages` WHERE `id` = '{$_GET['id']}' LIMIT 1");
			    
					if($row_edit_page = mysql_fetch_object($k)){
				    	$a_name  = $row_edit_page->a_name;
				    	$a_title  = $row_edit_page->a_title;
				    	$a_content  = $row_edit_page->a_content;
				    	$last_update  = $row_edit_page->last_update;
				    	$in_class = $row_edit_page->in_class;
					}
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
					
					mysql_query("UPDATE `additional_pages` SET `a_name` = '{$_POST['a_name']}', `a_title` = '{$_POST['a_title']}', `a_content` = '{$_POST['a_content']}', `in_class` = '{$_POST['in_class']}' WHERE `id` = '{$_GET['id']}' LIMIT 1");
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ViewPages">';
						}
					
				}
				
				$this->EditPage($a_name,$a_title,$a_content,$last_update,$in_class,$about_msg,$contactus_msg,$main_msg);
				
				break;
				
				case "DeletePage" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) and is_numeric($_GET['id']) > 0){
				
				mysql_query("DELETE FROM `additional_pages` WHERE `id` = '{$_GET['id']}'") or die(mysql_error());
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						print ' „ «·Õ–› »‰Ã«Õ !';
					    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ViewPages">';
					}
				
				}
					
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
	
	function EditBlog($ok,$d_name,$d_type,$stauts){
	  include('./pages/edit_blog.php');	
	}
	
	function DisplayAddDepartments($ok){	
	  include_once('./pages/add_departments.php');	
	}
		
	function EditDepartment($ok,$d_name,$d_type,$stauts){
	  include('./pages/edit_department.php');	
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