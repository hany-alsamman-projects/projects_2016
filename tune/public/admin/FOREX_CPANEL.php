<?php

/**
 * FOREX_CPANEL.php
 *
 * @package FOREX
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @author Hany alsamman (Project administrator && Original founder)
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

	
class FOREX_CPANEL extends CONTROLLERS
{
	var $error = array();
	var $output = '';
	var $time;
	var $step;
	var $max;
	var $from;
	var $LinksShow = 10;
    var $countries;
	var $MaxTopic = 10;
	var $MaxPost = 10;
	var $ArchivesID = 3;
	var $MaxPicture = 10;    
	var $Agent;
    var $DEPT = array();
	
    public function __construct()
    {
        global $lang, $publish, $_countries;
        $this->error = array();
        $this->lang = $lang;
        $this->countries = $_countries;
        
        $this->DEPT = array('1' => 'Company News', '2' => 'Forex News And Analyatics', '3' => 'Forex News Archive');
        
        //create new connection :)
        parent::connection();

		//$secure = new security();
		//$secure->parse_incoming();
		
		$this->time = time();
      
    }
		
  /**
   * FOREX_CPANEL::DASHBOARD()
   *
   * @return
   */
	function DASHBOARD(){
	   
		global $lang;
        
	    //check the session if not registered
		if ( !session_is_registered("admin") ) {
			
				$this->LOGIN($_POST['username'], $_POST['password']);
		
        //show the board if registered	
		}else{
		  
              if(!isset($_GET['task'])){
                
    				//print what you have
    				//include(TEMPLATE.'/level_'.$_SESSION["group_id"].'.php');
                    include(TEMPLATE.'/level_4.php');
                    
              }else{                
                
                    if($_GET['task'] == 'search'):            
                        include(TEMPLATE.'/search.php');               
                    endif;
                                
                    if($_GET['task'] == 'dept_search'):            
                       
                        $mydepts = array(); 
                        
                        if(strlen($_REQUEST['q']) >= 3){
                            
                            //$_REQUEST['q'] = iconv("UTF-8", "WINDOWS-1256//IGNORE" ,); 
                             
                			//check and get admin row `lang` = '{$_REQUEST['getlang']}' and
                			$result = mysql_query("SELECT id,title,parent FROM `pages` WHERE  `title` LIKE '{$_REQUEST['q']}%' ORDER BY parent");
                            
                            if(mysql_num_rows($result) == false){
                                array_push($mydepts, array("title" => 'Sorry not found the DEPT like your search',"id" => "error"));
                                echo json_encode($mydepts);
                                exit();
                            }

                            while($row = mysql_fetch_object($result)){
                                
                                static $x = 0;                                
                                
                                $parent_title = @mysql_result(mysql_query("SELECT title FROM `pages` WHERE `id` = '{$row->parent}'"),0);


                                if(is_null($row->parent)){
                                    
                                    //echo '<li><a class="button red">'.$parent_title.'</a> &nbsp; <a href="#" class="button">'.$row->title.'</a></li>';
                             
                            		array_push($mydepts, array(
                            			"title" => $row->title,
                            			"id" => $row->id
                            		));
                                
                                }else{
                                    
                                    
                                    array_push($mydepts, array(
                                			"title" => $row->title,
                                			"id" => $row->id,
                                            "parent" => $row->parent,
                                            "parent_title" => $parent_title
                                	));   
                                    
                                   // echo "<li><a class='button'>$row->title</a></li>";

                                }                                
                                $x++;                                                  
                                
                            }
                                                        
            				header('Cache-Control: no-cache, must-revalidate');
            				//header('Expires: '.date('r', time()+(86400*365)));                                          
                            header('Content-type: application/json');
                            echo json_encode($mydepts);  
                            unset($_REQUEST['getlang']);  
                            unset($mydepts);                                                          
                        
                        }else{
                                                        
                            array_push($mydepts, array("title" => 'Please type more than 2 letter',"id" => "error"));
                            echo json_encode($mydepts);     
                            unset($_REQUEST['getlang']);                       
                        }
                                      
                    endif;
                        
                    if($_GET['task'] == 'signup'):             
                        SIGNUP::SIGNUP_PROCESS();                
                    endif; 
                
                
              }
		}
	}
    
        
    public function BUILD_PAGES_LANG($pageID) {
        
        
        $result = mysql_query("SELECT id,lang FROM `pages` WHERE `translation_for` = '{$pageID}'");
        
        if(mysql_num_rows($result) == false)  return '<p class="message">no think</p>';
        
            while($row = mysql_fetch_object($result)){
               
                $mylang = mysql_fetch_row(mysql_query("SELECT flag,name FROM `languages` WHERE `id` = '{$row->lang}'"));
                            
                $html .= '<li class="icon_'.strtolower($mylang[0]).'"><a href="./?section=EditPage&lang='.$row->lang.'&id='.$row->id.'&active=pages">'.$mylang[1].'</a></li>';
                             
            }
                            
        return $html;
        
    }
	
	/**
	 *  WHEN YOU LOGIN WITH ADMIN SESSION
	 *  YOU CAN VIEW AND MAKE ALL ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 */
	
	private function USE_ONLY_FOR_ADMIN(){
		if( !session_is_registered('admin') && ( session_is_registered('mod') ) ) die('<div style="width:50%; float: left" class="msg msg-error"><p>Restrictions Area : you dont have power to make this action</p></div>');
	}


	/**
	 *  WHEN YOU LOGIN WITH SUPER MOD SESSION
	 *  YOU CAN VIEW AND MAKE ALL RESTRICTION ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 *  BUT NOT MULTI DELETE OR EDIT OR ADD OR VIEW
	 *  ADMIN SECTION LIKE : ADD DEPT && ADD BLOGS , ETC
	 */
	 
	private function USE_ONLY_FOR_MOD(){
		if( ( !session_is_registered('admin') ) && ( session_is_registered('mod') ) )die('<div style="width:50%; float: left" class="msg msg-error"><p>Restrictions Area : you dont have power to make this action</p></div>');
	}

    public function msg($status,$txt)
    {
    	return '{"valid":'.$status.',"redirect":"'.$txt.'"}';
    }
	
  /**
   * FOREX_CPANEL::LOGIN()
   *
   * @return
   */
	function LOGIN($username, $password){

	 ## TODO : set cookie when keep me logged in checked       
            
            $error = false;

        	// If login form submitted
        	if (isset($_POST['a']))
        	{
        		$valid = false;
        		$redirect = isset($_REQUEST['redirect']) ? $_REQUEST['redirect'] : 'index.php';
        		
        		// Check fields
        		if (!isset($username) or strlen($username) == 0)
        		{
        			$error = 'Please enter your user name';
        		}
        		elseif (!isset($password) or strlen($password) == 0)
        		{
        			$error = 'Please enter your password';
        		}
        		else
        		{       		  
        			
                    $username = strtolower(trim($username)); // convert name to lower and trim space
        			$password = md5($password); //compile md5 password
        			$ip = $_SERVER['REMOTE_ADDR']; //get ip address of user
            
            
        			//check and get admin row
        			$a = mysql_query("SELECT * FROM `members` WHERE `email` = '{$username}' and `group_id` > '2' LIMIT 1");
        			//check rows == 1
        			if(mysql_num_rows($a) > 0){
        				
        				if($row = mysql_fetch_object($a) ){
        					
        					$id = $row->id;
        					$name = $row->name;
        					$pass = $row->password;
                            
        					//check password enterd
        					if($password != $pass){    					
            					//if you have wrong password i will add this error as attempt
            					mysql_query("UPDATE `members` SET `attempt` = attempt + 1, `action_time` = '".time()."' WHERE `id` = '{$row->id}'") or die("". mysql_error() ."error");
            						
            					//return the error message
                                $error = 'Wrong user/password, please try again';           
                            
                            }else{
                                $valid = true;
                            }
                        }
                        
            		}else{
            		  
                        $error = 'Sorry the member not found in database'; 
                       
            		}
                                        
        		}
        		
        		// Check if AJAX request
        		$ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        		
        		// If user valid
        		if ($valid)
        		{
        			// Handle the keep-logged option
        			if (isset($_POST['keep-logged']) and $_POST['keep-logged'] == 1)
        			{
        				// Set cookie or whatever here
        			}
        			
        			if ($ajax)
        			{        			 
    					//start as registered mod
                        if ($row->group_id == '3'): session_register("mod");   
    					//start as registered admin
                        elseif ($row->group_id == '4'): session_register("admin");  
    					endif;
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;
        			                                           
        				header('Cache-Control: no-cache, must-revalidate');
        				header('Expires: '.date('r', time()+(86400*365)));
        				header('Content-type: application/json');
                        
        				echo json_encode(array(
        					'valid' => true,
        					'redirect' => $redirect
        				));
                        
                        exit();
                        
                        //die($this->msg(true, $redirect));
                    
                    }
        			else
        			{
        				header('Location: '.$redirect);
        				exit();
        			}
        		}
        		else
        		{
        			if ($ajax)
        			{
        				header('Cache-Control: no-cache, must-revalidate');
        				header('Expires: '.date('r', time()+(86400*365)));
        				header('Content-type: application/json');
        				
        				echo json_encode(array(
        					'valid' => false,
        					'error' => $error
        				));
        				exit();
        			}
        		}
        	}
						
		return include(TEMPLATE.'/login.php');
	}
	
    
    private function ChangePassword($old, $new, $c_new){
    	
		$result = mysql_query("SELECT id FROM `members` WHERE `password` = MD5('$old') and `id` = '{$_SESSION['user_id']}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
		if($row = mysql_fetch_row($result)){
			
			mysql_query("UPDATE `members` SET `password` = MD5('$new') WHERE `id` = '{$row[0]}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
			
	    	if(mysql_affected_rows() == 1){    		
	    		return true;    					
			}
		}
		
		return false; 
	}

  /**
   * FOREX_CPANEL::CHECK_PAGES()
   *
   * @return
   */
	private function CHECK_PAGES(){
		global $lang;


		if( isset($_GET['section']) and $_GET['section'] != NULL ){
		
			$type = $_GET['section'];
            
            //include(TEMPLATE.'/menu.php');
			
			switch($type){
				
				case "logout" :
					@session_unregister("mod");
					@session_unregister("admin");
					@session_destroy();
										
					print '<div style="width:50%; float: left" class="msg msg-info"><p>Take Care!</p></div>';
					print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./index.php">';
				break;
                
                
				
				case "ShowPages" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				
				include(TEMPLATE.'/show_pages.php');
											    
				break;
                                                				
		                
                
				case "AddPage" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
                
             
	    
				    if(!empty($_POST['title']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						

                        $title = trim($_POST['title']);
						$desc =  trim($_POST['desc']);
						$content = trim($_POST['content']);
                        $hidden = ($_POST['hidden'] == '1') ? '0' : '1';
                        $creation_date = trim($_POST['creation_date']);
                        
                        // 1 = single page - 2 addtional page
                        $type = (isset($_POST['addtional']) && $_POST['addtional'] == '1') ? '2' : '1';

                        
                        $translation_for = (int)$_POST['translation_for'];
                        (int)$languages = $_POST['lang'];
                        (int)$added_by = $_POST['added_by'];
                        
                        $parent = ($_POST['main'] == '1') ? 'NULL' : "'$_POST[parent]'";
  
                        if($translation_for) $checkit = mysql_result(mysql_query("SELECT id FROM `pages` WHERE `lang` = '{$languages}' and `translation_for` = '{$translation_for}' LIMIT 1"),0) or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        
                        $ok = false;
                        
                        if($checkit == false){



    						if($_GET['translation'] == true){   

                                mysql_query("INSERT INTO `pages` 
        						( `id`, `parent`, `title`, `desc`, `content`, `creation_date`, `hidden`, `translation_for`, `lang`, `added_by`, `type`)
        						VALUES
        						(NULL, $parent, '{$title}', '{$desc}', '{$content}', NOW(), '{$hidden}', '{$translation_for}', '{$languages}', '{$added_by}', '{$type}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                              
                            }else{
                              
                                mysql_query("INSERT INTO `pages` 
        						( `id`, `parent`, `title`, `desc`, `content`, `creation_date`, `hidden`, `added_by`, `type`)
        						VALUES
        						(NULL, $parent, '{$title}', '{$desc}', '{$content}', NOW(), '{$hidden}', '{$added_by}', '{$type}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                                
                            }    					                    
                        
    						if(mysql_affected_rows() != -1) $ok = true; else $ok = false;
                            //$ok = true;                                						                          
                        }                       
												
					}
					$ok = ($ok != false) ? true : false;
				
					include(TEMPLATE.'/add_page.php');									    
				break;
                
                
				case "EditPage" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				    
					(int)$_GET['id'] = intval($_GET['id']);
                    $lang = isset($_GET['lang']) ? 'and `lang` = '.$_GET['lang'].'' : false;
                    
    			    $a = mysql_query("SELECT * FROM `pages` WHERE `id` = '{$_GET['id']}' $lang");
    			    
                    if($row = mysql_fetch_object($a)){

                        if(!is_null($row->parent)) $follower = mysql_result(mysql_query("SELECT title FROM `pages` WHERE `id` = '{$row->parent}'"),0);
                        
						$title = $row->title;
                        $desc = $row->desc;
						$mycontent = $row->content;
                        $last_update = $row->last_update;
                        (int)$lang = $row->lang;
                        $myparent = $row->parent;
                        $translation_for = $row->translation_for;
                        $hidden = ($row->hidden == 1) ? '' : 'checked="checked"';
                        $follow = (is_null($row->parent)) ? 'Do not follow one' : $follower;
    				}                    
                    
                    if(!empty($_POST['title']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == '1'){

						//$_POST['content'] = preg_replace("/\<strong\>(.+?)\<\/strong\>/","<b>$1</b>", $_POST['content']);
                        
                        //$_POST['content'] = preg_replace('/<br[^>]*>/', '', $_POST['content']); // Remove the start <p> or <p attr="">
                       // $_POST['content'] = preg_replace('/</p>/', '', $_POST['content']); // Replace the end
                        
                        $title = $_POST['title'];
                        $desc = $_POST['desc'];
						$mycontent = $_POST['mycontent'];
                        
                        //print_r($_POST);
                        

                        (int)$lang = $_POST['lang'];
                        
                        print $_POST['hidden'];
                        
                        $hidden = ($_POST['hidden'] == 'on') ? 0 : 1;
                                                
                        //$parent = (empty($_POST['parent']) || is_null($_POST['parent'])) ? NULL : (int)$_POST['parent'];
                        
                        
                        $parent = (empty($_POST['parent']) || is_null($_POST['parent'])) ? 'NULL' : "'$_POST[parent]'";
                        
                        print $parent;


                        mysql_query("UPDATE `pages` SET `parent` = $parent, `title` = '{$title}',`desc` = '{$desc}',`hidden` = '{$hidden}', `last_update` = NOW() WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        
                        mysql_query("UPDATE `pages` SET `content` = '{$mycontent}' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        
                        if(mysql_affected_rows() == -1){
							return false;
						}else{
						
						$ok = 1;
                        				    
						}
                        
					}
                    
                    unset($parent);
				
					include(TEMPLATE.'/edit_page.php');
								    
				break;
                
                
				case "RemovePage" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				#$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){	

    					//if the get correct id remove the member
    					mysql_query("DELETE FROM `pages` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        
                        if(isset($_GET['full']) && $_GET['full'] == true){
    					
                            mysql_query("DELETE FROM `pages` WHERE `translation_for` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                     
                        }
					}
                    
                    print '<div style="width:50%; margin:15px; float: left" class="msg msg-ok">
                                <p>Selected Page(s) has been <b>removed</b> successfully</p>
                          </div>';		
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowPages">';
					
				break;
				
				case "AddMember" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				    
				if(!empty($_POST['name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
					
					$account_name   = trim($_POST['name']);
					$account_pass	= md5($_POST['password']);
					$account_mail	= $_POST['email'];
			        $account_group	= intval($_POST['group_id']);
                    $activated = intval($_POST['activated']);
					
                    //check and get admin row
                    $a = mysql_query("SELECT * FROM `members` WHERE `email` = '{$account_mail}'");
                    //check rows == 1
                    if (mysql_num_rows($a) == 1)
                    {
                       $ok = 2;
                    }
					else
                    {
					
						mysql_query("INSERT INTO `members` 
						( `id`, `name`, `password`, `email`, `group_id`, `activated` )
						VALUES
						(NULL, '{$account_name}', '{$account_pass}', '{$account_mail}', '{$account_group}', '{$activated}')") or die(mysql_error());					
						
                        if(mysql_affected_rows() == -1){
							return false;
						}else{
						
						$ok = 1;
						
//							require_once("../library/mailler/class.phpmailer.php");							    
//							// HTML body
//						    $body  = "Hello " . $_POST['account_name'] . "";
//						    $body .= "Your account has been created by $_SESSION[user_name] .<p>";
//						
//						    // Plain text body (for mail clients that cannot read HTML)
//						    $body .= "Your account name: " . $_POST['account_name'] . ", \n\n";
//						    $body .= "Your account pass: " . $_POST['account_password'] . ".\n\n";
//						    $body .= "Thank you for your time, \n";
//							
//							$mail = new PHPMailer();					
//						    $mail->Body    = $body;
//						    $mail->AddAddress($_POST['account_mail'], $_POST['account_name']);
//						
//						    if(!$mail->Send()) echo $this->lang['error_send'] . $_POST['account_mail'] . "<br>";
//						
//						    // Clear all addresses and attachments for next loop
//						    $mail->ClearAddresses();					    
						}
					}
					
				}
				
                //$ok = ($ok == 1) ? 1 : '';
				
				include(TEMPLATE.'/add_member.php');
								    
				break;

				
				case "ShowAccounts" :

				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
                                
                $where =  (!isset($_GET['think'])) ? "WHERE `activated` = '1'" : "WHERE `activated` != '1'";
                
                $result = mysql_query("SELECT * FROM `members` ORDER BY group_id") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                
                $users = FUNCTIONS::fetch_data_array($result);       
                
				include(TEMPLATE.'/show_accounts.php');
				   								    
				break;
                
				case "ActiveMember" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
            		if(isset($_GET['id']) && intval($_GET['id']) > 0){
            		
            		## Check Topic Status
            		$check_topic = mysql_result( mysql_query("SELECT activated FROM `members` WHERE `id` = '{$_GET['id']}'"), 0);
                    
            		if($check_topic == 1){
            		//unapprove selected topic
            		mysql_query("UPDATE `members` SET `activated` = '0' WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
            		}else{
            		//approve selected topic
            		mysql_query("UPDATE `members` SET `activated` = '1' WHERE `id` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());	
            		}
            			
            			if(mysql_affected_rows() == -1){
            				return false;
            			}else{
            				
                            print '<div style="width:50%; float: left" class="msg msg-ok">
                                    <p>Selected Member activate status changed <strong>successfully</strong></p>
                                  </div>';
                                  
            			   
            			}
            								
            		}
                    
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowMembers">';
                     
				break;
				
				case "RemoveMember" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					   
					//if the get correct id remove the member
					mysql_query("DELETE FROM `members` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    
					}
                    
                    print '<div style="width:50%; float: left" class="msg msg-ok">
                            <p>The Selected Member Has Been Removed <strong>successfully</strong></p>
                          </div>';		
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowAccounts">';
					
				break;
					
				case "ChangePassword":
				
    				if (isset($_POST['old_pass'], $_POST['new_pass']) and $_POST['change'] == 1)
                    {                	
    	                if( $_POST['new_pass'] != $_POST['c_new_pass'] ) {
    	                	
    	                $change = $this->ChangePassword($_POST['old_pass'], $_POST['new_pass'] ,$_POST['c_new_pass']);                	
    	                	if($change == true){
    						$ok = 1;							
    						}else{
    						$ok = 2;					
    						}	                
    	                }		        
    				}
                
                include (TEMPLATE.'/change_pass.php');
				
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
		
				print 'Delete Ok !';
			    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./?section=ShowBlogs">';
										
				}
				
				break;
				
				
				case "ShowObjects":
				
                
                include(TEMPLATE.'/topic_case_top.php');
                
				if(isset($_GET['WaitingTopics'])){
					echo '<div style="color: red; text-align: center; padding:5px"><b>Your Now In <i>Waiting</i> Topics !</b></div>';
				}else{
					echo '<div style="color: red; text-align: center; padding:5px"><b>Your Now In Topics !</b></div>';
				}
								
				$this->step = ($_GET['step'] == '') ? 1 : $_GET['step'];
				
				if(isset($this->step) && intval($this->step) > 0){
				
				## Start from number?
				$this->from = ($this->MaxTopic * $this->step) - $this->MaxTopic;
				
				if(isset($_GET['Archives']) && $_GET['Archives'] == true){
				
				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '1' and `in_dept` = '{$this->ArchivesID}' $this->Agent"), 0);
				
				$get_archives = "WHERE `in_dept` = '{$this->ArchivesID}' and `approve` = '1'";
				$url_archives = "&Archives=true";
				
				}elseif(isset($_GET['WaitingTopics']) && $_GET['WaitingTopics'] == true){
								
				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '0' $this->Agent"), 0);
				
				$get_approved = "`approve` = '0'";
				$get_archives = "WHERE ";
				$url_archives = "&WaitingTopics=true";
				
				}elseif(isset($_GET['Questions']) && $_GET['Questions'] == true){
								
				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '1' and `in_dept` = '7'"), 0);
				
				$get_approved = "`approve` = '1'";
				$get_archives = "WHERE `in_dept` = '7' and ";
				$url_archives = "&Questions=true";
				
				}elseif(isset($_GET['TopicsAddBy']) && $_GET['TopicsAddBy'] == true){
								
				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `t_add_by` = {$_GET['t_add_by']}"), 0);
				
				//$get_approved = "`approve` = '0'";
				$get_archives = "WHERE `t_add_by` = {$_GET['t_add_by']}";
				$url_archives = "&TopicsAddBy=true&t_add_by={$_GET['t_add_by']}";

				}elseif(isset($_GET['in_dept']) && $_GET['in_dept'] > 0){

				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '1' and `in_dept` = '{$_GET['in_dept']}' $this->Agent"), 0);

				$get_archives = "WHERE `in_dept` = '{$_GET['in_dept']}'";
				$url_archives = "&in_dept=$_GET[in_dept]";			

				}else{

				## count the topics
				$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '1' and `in_dept` != '{$this->ArchivesID}' $this->Agent"), 0);
				$get_archives = "WHERE `in_dept` != '{$this->ArchivesID}' and `in_dept` != '7' and `approve` = '1'";
				$url_archives = false;
	
				}
				
				## have page
				$count_step = ceil($sum_topics / $this->MaxTopic); //ceil the max number
				
				switch($_GET['SORT']){
					
					case"new":
					$result = mysql_query("SELECT * FROM `topics` $get_archives $get_approved ORDER BY tid DESC LIMIT $this->from,$this->MaxTopic");
					break;
					
					case"top_views":
					$result = mysql_query("SELECT * FROM `topics` $get_archives $get_approved ORDER BY views DESC LIMIT $this->from,$this->MaxTopic");
					break;
					
					case"as_dept":
					$result = mysql_query("SELECT * FROM `topics` $get_archives $get_approved ORDER BY in_dept LIMIT $this->from,$this->MaxTopic");
					break;
					
					case"last_update":
					$result = mysql_query("SELECT * FROM `topics` $get_archives $get_approved ORDER BY last_update DESC LIMIT $this->from,$this->MaxTopic");
					break;					
					
				}
				
				if(!isset($_GET['SORT']))
				$result = mysql_query("SELECT * FROM `topics` $get_archives $get_approved ORDER BY tid DESC LIMIT $this->from,$this->MaxTopic");
				
				$view_now = mysql_num_rows($result);
				
				if($sum_topics>0){
				
				echo '<div>SORT BY: 
						<select name="select" class="textbox" onchange="MM_jumpMenu(\'parent\',this,0)">';
				
				if($_GET['SORT']== 'reset'){
						echo '<option value="?section=ShowObjects'.$url_archives.'" selected>RESET VIEW</option>';
				}else{
						echo '<option value="?section=ShowObjects'.$url_archives.'">RESET VIEW</option>';
				}
                
                if($_GET['SORT']== 'new'){
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=new" selected>NEW TOPIC</option>';
				}else{
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=new">NEW TOPIC</option>';
				}
				
				if($_GET['SORT']== 'top_views'){
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=top_views" selected>TOP VIEW</option>';
				}else{
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=top_views">TOP VIEW</option>';
				}
				
				if($_GET['SORT']== 'as_dept'){
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=as_dept" selected>DEPT INSERTD</option>';
				}else{
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=as_dept">DEPT INSERTD</option>';
				}
				
				if($_GET['SORT']== 'last_update'){
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=last_update" selected>LAST UPDATE</option>';
				}else{
						echo '<option value="?section=ShowObjects'.$url_archives.'&SORT=last_update">LAST UPDATE</option>';
				}
				
				echo '</select></div>';
				
				echo '<table align="center" cellpadding="0" cellspacing="0" style="width: 95%">
					
						<tr>
							<td colspan="5" style="text-align:center; height:20px">Show Topics (<span style="color:red">'.$view_now.'</span> OF <span style="color:green">'.$sum_topics.'</span> IN PAGE <span style="color:#0000FF">('.$this->step.')</span> )</td>
						</tr>
						<tr>
					  <td colspan="5">';
				
				while($row = mysql_fetch_object($result)){
					
					$approve = ($row->approve == 1) ? 'deactive.png' : 'active.png';
					
					$sum_posts = mysql_result( mysql_query("SELECT COUNT(`pid`) FROM `posts` WHERE `in_topic` = '{$row->tid}' and `approve` = '1'"), 0);
					
					$dept_name = $this->DEPT[$row->in_dept];                   
                    
					
				    $topic_modified = ( $row->modified == 1 ) ? 'Modified' : '<font color="red">Not Modified</font>';
					
					$t_add_by = @mysql_result( mysql_query("SELECT name FROM `members` WHERE `id` = '{$row->t_add_by}'"), 0);
					
					if(!$t_add_by) echo 'added from none';
					
					include(TEMPLATE.'/view_topic.php');
								
				}## end while
				
				echo '</td></tr>';
				
					  
				echo '
					</table>';
                    
                include(TEMPLATE.'/topic_case_bottom.php');
				
				}else{
				echo 'NOT FOUND ANY TOPIC!';	
				}
									
				}## end get step
				
				break;
				
				case "AddTopic":
				
				if(isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){				    

					  $queryString="INSERT INTO `topics` (";  
					  $columns=array();
					  $values=array();
					  
					  ## get all posted values
				      foreach ($_POST as $key=>$value)
				      {
				    		## check the empty value
							if( !empty($value) ){
		                        
								## keep someone out of the game
				    			if( (trim($key) !== 'sub_ok') && (trim($key) !== 'submit') ){
				    								    				
					    			## build all names of fileds as keys for query
						          	$columns []= '`'.trim($key).'`';
									## build all values of fileds as value for query 
						         	$values  []= "'".addslashes($value)."'";
								 	
			    				}
			    				
				         	}
			         	}			    
 
				  ## build the insert query
		      	  $queryString .= implode(',',$columns) .") VALUES (". implode(',',$values) .") ";
                    
		      	  mysql_query($queryString) or die(mysql_error());

				  if(mysql_affected_rows() > 0) $ok = true; else $ok = false; 
				  
				  ##$this->s(mysql_insert_id());
				   
				 print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./?section=ShowObjects">';
					
				}
				
				include(TEMPLATE.'/add_topic.php');
				
				break;
				
				case "EditTopic" :
				
				if(session_is_registered("agent")){
				## the agent
				$agent_post = @mysql_result( mysql_query("SELECT t_add_by FROM `topics` WHERE `tid` = '{$_GET[id]}'  $this->Agent"), 0);

					if($agent_post == $_SESSION['user_id']){
					$ViewMyPost = $_GET['id'];
					}else{
					$ViewMyPost = 0;
					}
				
				}else{
					
				$ViewMyPost = $_GET['id'];
					
				}
				
				if( session_is_registered("agent") && $ViewMyPost == false) die('<div style="text-align: center; color: red">'.$this->lang['error_access'].'</div>');
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
	
				if(isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){

				  $UpdateTopic="UPDATE `topics` SET ";
				  $fields=array();

				  foreach ($_POST as $key=>$value)	{ 
		    		 ## check the empty value
					 if( $value !== '' ){
						## keep someone out of the game
		    			if( (trim($key) !== 'sub_ok') && (trim($key) !== 'submit') && (trim($key) !== 'A') && (trim($key) !== 'B') && (trim($key) !== 'C') && (trim($key) !== 'D') && (trim($key) !== 'E') && (trim($key) !== 'p_right') && (trim($key) !== 'p_left1') && (trim($key) !== 'p_left2') && (trim($key) !== 'p_middle')  ){
				  	
		    				if(trim($key) == 'publish_date'){
	
			    			$fields[] = " `$key`='".(time()+$value)."' ";
			    			
		    				}else{
		    					
			    			$fields[] = " `$key`='".parent::add_slashes($value)."' ";
						 	
		    				}
					  	}
				  	 }
				  }
				  
				  $UpdateTopic .= implode(',',$fields)." WHERE `tid` = '{$_GET['id']}' LIMIT 1";
				  
				  mysql_query($UpdateTopic) or die("". mysql_error() ."error");
				  
				  if(mysql_affected_rows() > 0) $ok = true;
				  
				  ##$this->SET_ON_MAIN($_GET['id']);
				  
				  print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=index.php?section=ShowObjects&active=topics">';
				
				}				
					
				$result = mysql_query("SELECT * FROM `topics` WHERE `tid` = '{$_GET['id']}' LIMIT 1");
                
				## Get data with nice shout (return array with all Topic info) :D
				$GetTopicData = parent::fetch_data_array($result);
				
				$TopicData = $GetTopicData[0];
				
				include(TEMPLATE.'/edit_topic.php');
					
				}
				
				break;
				
				case "TopicChangeApprove":
				
				$this->USE_ONLY_FOR_SUPER();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
				
				## Check Topic Status
				$check_topic = mysql_result( mysql_query("SELECT approve FROM `topics` WHERE `tid` = '{$_GET['id']}'"), 0);
				if($check_topic == 1){
				//unapprove selected topic
				mysql_query("UPDATE `topics` SET `approve` = '0' WHERE `tid` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
				}else{
				//approve selected topic
				mysql_query("UPDATE `topics` SET `approve` = '1' WHERE `tid` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());	
				}
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						
						print 'Selected Topic Has Been Changed!';
					    print '<META HTTP-EQUIV=Refresh CONTENT="2; URL='.$_SERVER["HTTP_REFERER"].'">';
					}
										
				}
				
				break;
				
				case "TopicOperation" :
				
				### $_POST['operation'] == 1 (MOVE)
				### $_POST['operation'] == 2 (DELETE)	
				### $_POST['operation'] == 3 (MODIFIED)		
                
                //echo $_POST['operation'];	
				
				/**
				 *  OPERATION eq MOVE TOPICS TO ARCHIVES
				 */
				
				if(isset($_POST['operation']) && $_POST['operation'] == 1){
				
				$this->USE_ONLY_FOR_MOD();
				
				if(is_array($_POST['tid']) and sizeof($_POST['tid']) > 0){

					$i=0;
					foreach($_POST['tid'] as $id){
						
						//approved selected post
						mysql_query("UPDATE `topics` SET `in_dept` = '{$this->ArchivesID}' WHERE `tid` = '{$id}' LIMIT 1") or die(mysql_error());
					$i++;
					}
					
					print $i.' Topics Has Been Moved To Archives!';
					print '<META HTTP-EQUIV=Refresh CONTENT="2; URL='.$_SERVER["HTTP_REFERER"].'">';
					
				}else{
					if(!isset($_POST['tid']))
					print 'Not found any selected posts to moving!';
				}				
				
				}
				
				
				/**
				 *  OPERATION eq DELETE TOPICS
				 */
				 
				if(isset($_POST['operation']) && $_POST['operation'] == 2){

				/* USE THIS CASE ONLY FOR SUPER */
				//$this->USE_ONLY_FOR_SUPER();

				if(is_array($_POST['tid']) and sizeof($_POST['tid']) > 0){
					$i=1;
					foreach($_POST['tid'] as $id){
						//delete all posts for topics
						//@mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$id}'") or die(mysql_error());
						//if(mysql_affected_rows() == -1) return false;
						@mysql_query("DELETE FROM `topics` WHERE `tid` = '{$id}' LIMIT 1") or die(mysql_error());
					$i++;
					}
					
					print $i.' Topic Has been Deleted !';
					print '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$_SERVER["HTTP_REFERER"].'">';
					
				}else{
					if(!isset($_POST['tid']))
					print 'Not found any selected topics to delete !';
				}
					
				}
				
				/**
				 *  OPERATION eq MODIFIED TOPICS
				 */
				 
				if(isset($_POST['operation']) && $_POST['operation'] == 3){

				/* USE THIS CASE ONLY FOR SUPER */
				$this->USE_ONLY_FOR_SUPER();

				if(is_array($_POST['tid']) and sizeof($_POST['tid']) > 0){
					$i=1;
					foreach($_POST['tid'] as $id){
						//delete all posts for topics
						@mysql_query("UPDATE `topics` SET `modified` = '1' WHERE `tid` = '{$id}'") or die(mysql_error());

					$i++;
					}
					
					print $i.' Topic Modified Status Has been changed !';
					print '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$_SERVER["HTTP_REFERER"].'">';
					
				}else{
					if(!isset($_POST['tid']))
					print 'Not found any selected topics to modified !';
				}
					
				}
				
				/**
				 *  DELETE POST ONCE BY SELLECTD
				 */
				if(isset($_GET['id']) && $_GET['id'] > 0){
					
				/* USE THIS CASE ONLY FOR SUPER */
				$this->USE_ONLY_FOR_SUPER();

					//delete all posts for topics
					@mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$_GET['id']}'") or die(mysql_error());
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
												
					    //When finish delete the parent
						mysql_query("DELETE FROM `topics` WHERE `tid` = '{$_GET['id']}' LIMIT 1") or die(mysql_error());
						print 'Delete Ok !';
					    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$_SERVER["HTTP_REFERER"].'">';
					}
										
				}
				
				if(!isset($_POST['operation'])) echo "PLEASE SELECT OPREATION TO PROCESS!";
				
				break;
				
				case "EmptyTopic":
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){
					
					@mysql_query("DELETE FROM `posts` WHERE `in_topic` = '{$_GET['id']}'") or die(mysql_error());
					
					if(mysql_affected_rows() == -1){
						return false;
					}else{
								
						print 'The Topic ID ('.$_GET['id'].') Has Been Empty!';
					    print '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$_SERVER["HTTP_REFERER"].'">';
					}
				
				}
				
				break;                
                
                
				
			}
            
					
		}else{
			
			return include(TEMPLATE.'/board.php');
						
	    }
	
	}
    	
}
?>