<?php

/**
 * LINKS_CPANEL.php
 *
 * @package WIX
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @author Hany alsamman (Project administrator && Original founder)
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

	
class LINKS_CPANEL extends CONTROLLERS
{
	var $error = array();
	var $output = '';
	var $time;
	var $step;
	var $max;
	var $from;
	var $LinksShow = 10;
    var $countries;
	
    public function __construct()
    {
        global $lang, $publish, $_countries;
        $this->error = array();
        $this->lang = $lang;
        $this->countries = $_countries;

        //create new connection :)
        parent::connection();

		$secure = new security();
		$secure->parse_incoming();
		
		$this->time = time();
      
    }
		
  /**
   * CPANEL_CORE::DASHBOARD()
   *
   * @return
   */
	function DASHBOARD(){
		global $lang;
        
	    //check the session if not registered
		if ( !$_SESSION["admin"] and !$_SESSION["mod"] ) {
			
				$this->LOGIN($_POST['username'], $_POST['password']);
		
        //show the board if registered	
		}else{
		  
				//print what you have
				//include_once(TEMPLATE.'/level_'.$_SESSION["group_id"].'.php');
                include_once(TEMPLATE.'/level_4.php');
		}
	}

    function validate_latitude($e){
        return (bool)preg_match("`^-?([0-8]?[0-9]|90)\.[0-9]{1,6},-?((1?[0-7]?|[0-9]?)[0-9]|180)\.[0-9]{1,6}$`i", trim($e));
    }
	
	/**
	 *  WHEN YOU LOGIN WITH ADMIN SESSION
	 *  YOU CAN VIEW AND MAKE ALL ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 */
	
	private function USE_ONLY_FOR_ADMIN(){
		if( !$_SESSION['admin'] && ( $_SESSION['mod'] ) ) die('<div style="width:50%; float: left" class="msg msg-error"><p>Restrictions Area : you dont have power to make this action</p></div>');
	}


	/**
	 *  WHEN YOU LOGIN WITH SUPER MOD SESSION
	 *  YOU CAN VIEW AND MAKE ALL RESTRICTION ACTION LIKE
	 *  VIEW,EDIT,ADD,DELETE,MOVE
	 *  BUT NOT MULTI DELETE OR EDIT OR ADD OR VIEW
	 *  ADMIN SECTION LIKE : ADD DEPT && ADD BLOGS , ETC
	 */
	 
	private function USE_ONLY_FOR_MOD(){
		if( ( !$_SESSION['admin'] ) && ( $_SESSION['mod'] ) )die('<div style="width:50%; float: left" class="msg msg-error"><p>Restrictions Area : you dont have power to make this action</p></div>');
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
                        $this->error[] = 'Enter wrong password';                        
    
    					}else{			   
    					          					
    					//start as registered mod
                        if ($row->group_id == '3'): $_SESSION["mod"] = 'mod';   
    					//start as registered admin
                        elseif ($row->group_id == '4'): $_SESSION["admin"] = 'admin';  
    					endif;
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;

    		            //show message and go to main
    					//return include_once(TEMPLATE.'/level_'.$_SESSION["group_id"].'.php');                     
    					return include_once(TEMPLATE.'/level_4.php');
    					}
    				}
    				
    			}else{
                        $this->error[] = 'Sorry the member not found in database'; 
    			}
            
        }else{
                $this->error[] = 'Please check the fields'; 
		}
        
        $message = $this->error[0];
						
		return include_once(TEMPLATE.'/login.php');
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

    function generate_book_id($pos){

        $result = mysql_query("SHOW TABLE STATUS LIKE 'books'");
        $row = mysql_fetch_array($result);
        $nextId = $row['Auto_increment'];

        if($pos == false) $pos = 'main'; else $pos = 'part';

        $book_id = 'book_'.$pos.'_'.$nextId.'';

        return $book_id;
    }

  /**
   * CPANEL_CORE::CHECK_PAGES()
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
					unset($_SESSION['mod']);
					unset($_SESSION['admin']);
					@session_destroy();
										
					print '<div style="width:50%; float: left" class="msg msg-info"><p>Take Care!</p></div>';
					print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./index.php">';
				break;
                
                
				
				case "Showitems" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				
				include(TEMPLATE.'/show_departments.php');
											    
				break;

                case "AddToStore" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();

                    if(!empty($_POST['book_name'])){

                        $exts = array('pdf', 'png', 'jpg', 'gif');

                        $book_name   = trim($_POST['book_name']);
                        //$book_image	= trim($_POST['book_image']);
                        //$book_extra	= trim($_POST['book_extra']);
                        $book_price	= trim($_POST['book_price']);
                        $book_type	= trim($_POST['book_type']);
                        $book_dir	= trim($_POST['book_dir']);
                        $parent     = ($_POST['parent'] == false) ? $parent = null : $_POST['parent'];
                        $store_id	= ($book_type == 1) ? $this->generate_book_id($parent) : $_POST['store_id'];
                        $publish_date = $_POST['publish_date'];
                        $book_summary = $_POST['book_summary'];
                        $approved = $_POST['approved'];

                        $added_by	= $_SESSION['user_id'];

                        $get_sort_id = @mysql_result( mysql_query("SELECT MAX(`sort_id`) FROM `books`"), 0);

                        $sort_id = $get_sort_id+1;

                        if(!in_array(end(explode('.', $_FILES['book_image']['name'])), $exts))  {
                            $this->error[] = 'انت تستخدم لاحقة غير مدعمومة';
                        }

                        $uploaddir = SITE_PATH . DS . 'upload'. DS;

                        ## validate check !
                        if( $_FILES['book_image']['name'] != false){
                            $structure = $uploaddir . $store_id;

                                if (!is_dir($structure)) {
                                    mkdir($structure, 0777);

                                    //$book_extra = $_FILES['book_extra']['name'];
                                    //$uploadfile = $structure . DS . basename($_FILES['book_extra']['name']);
                                    //if (!move_uploaded_file($_FILES['book_extra']['tmp_name'], $uploadfile))
                                    //    $this->error[] = 'لم يتم رفع الملف !';
                                    $book_extra = $_POST['book_extra'];

                                    //move my baby photo to store folder
                                    copy($uploaddir . $book_extra, $structure. DS . $book_extra);
                                    //remove tmp
                                    unlink($uploaddir . $book_extra);

                                    $book_image = $_FILES['book_image']['name'];
                                    $uploadfile = $structure . DS . basename($_FILES['book_image']['name']);
                                    if (!move_uploaded_file($_FILES['book_image']['tmp_name'], $uploadfile))
                                        $this->error[] = 'لم يتم رفع الملف !';

                                }else{
                                    $this->error[] = 'اسم المجلد التقني موجود مسبقا يرجى تغييره';
                                }
                        }

                        if( !empty($this->error) ){
                            $message = $this->error[0];
                            $ok = 3;
                        }

                        if($ok != 3){
                            mysql_query("INSERT INTO `books`
                            ( `id`, `parent`, `book_name`,`book_image`, `book_summary`, `book_extra`, `book_price`, `book_type`, `book_dir`, `store_id`, `publish_date`, `added_by`, `approved`, `sort_id` )
                            VALUES
                            (NULL, '{$parent}', '{$book_name}', '{$book_image}', '{$book_summary}', '{$book_extra}', '{$book_price}', '{$book_type}', '{$book_dir}', '{$store_id}', '{$publish_date}', '{$added_by}', '{$approved}', '{$sort_id}')") or die(mysql_error());

                            $message = 'تم الإضافة بنجاح';

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

                    include_once(TEMPLATE.'/add_store.php');

                    break;

                case "ShowStore" :

                    if(isset($_GET['do']) && $_GET['do'] == 'remove' && intval($_GET['id']) > 0){

                        /* USE THIS CASE ONLY FOR ADMIN */
                        $this->USE_ONLY_FOR_ADMIN();

                        $checkID = @mysql_result( mysql_query("SELECT `id` FROM `books` WHERE `id` = '{$_GET['id']}' LIMIT 1"), 0);

                        $isRoot = @mysql_result( mysql_query("SELECT `parent` FROM `books` LIMIT 1"), 0);

                        if($isRoot == '0' && $checkID != false){ // that mean this is root one for books

                            //delete all sub books
                            mysql_query("DELETE FROM `books` WHERE `parent` = '{$checkID}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                            //delete root book
                            mysql_query("DELETE FROM `books` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

                        }
                        if(!$isRoot && $checkID != false){
                        // delete the sub book only
                            mysql_query("DELETE FROM `books` WHERE `id` = '{$_GET['id']}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                        }

                        if(mysql_affected_rows() > 0) $ok = 1;
                        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowStore">';
                    }

				    include(TEMPLATE.'/show_store.php');
				break;
                
                
				case "EditProduct" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				
			    $g = mysql_query("SELECT * FROM `books` WHERE `id` = '{$_GET['id']}'");

                if($row = mysql_fetch_object($g)){

                    $book_name   = $row->book_name;
                    $book_image	= $row->book_image;
                    $book_extra	= $row->book_extra;
                    $book_price	= $row->book_price;
                    $book_type	= $row->book_type;
                    $book_dir	= $row->book_dir;
                    $parent     = $row->parent;
                    $store_id	= $row->store_id;
                    $publish_date = $row->publish_date;
                    $book_summary = $row->book_summary;
                    $approved = $row->approved;

                    $added_by = $_SESSION['user_id'];
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){

                    $book_name   = $_POST['book_name'];
                    $book_price	= $_POST['book_price'];
                    $book_type	= $_POST['book_type'];
                    $book_dir	= $_POST['book_dir'];
                    $parent     = ($_POST['parent'] == false) ? $parent = '0' : $_POST['parent'];
                    //$store_id	= $_POST['store_id'];
                    $publish_date = $_POST['publish_date'];
                    $book_summary = $_POST['book_summary'];
                    $approved = $_POST['approved'];

                    $upload_dir = SITE_PATH . DS . 'upload'. DS;

                    ## validate check !
                    if( $_FILES['book_extra']['name'] != false){
                        $structure = $upload_dir . $store_id;

                        if (is_dir($structure)) {
                            //mkdir($structure, 0777);

                            $up_book_extra = $_FILES['book_extra']['name'];
                            $uploadfile = $structure . DS . basename($_FILES['book_extra']['name']);
                            if (!move_uploaded_file($_FILES['book_extra']['tmp_name'], $uploadfile))
                                $this->error[] = 'لم يتم رفع الملف !';

                            $up_book_image = $_FILES['book_image']['name'];
                            $uploadfile = $structure . DS . basename($_FILES['book_image']['name']);
                            if (!move_uploaded_file($_FILES['book_image']['tmp_name'], $uploadfile))
                                $this->error[] = 'لم يتم رفع الملف !';

                        }else{
                            $this->error[] = 'اسم المجلد التقني موجود مسبقا يرجى تغييره';
                        }
                    }else{
                        $up_book_extra	= $book_extra;
                        $up_book_image	= $book_image;
                    }

					mysql_query("UPDATE `books` SET
                        `book_price` = '{$up_book_image}',
                        `book_extra` = '{$up_book_extra}',
                        `book_name` = '{$book_name}',
                        `book_image` = '{$book_image}',
                        `book_dir` = '{$book_dir}',
                        `book_type` = '{$book_type}',
                        `book_summary` = '{$book_summary}',
                        `publish_date` = '{$publish_date}',
                        `added_by` = '{$added_by}',
                        `approved` = '{$approved}' WHERE `id` = '{$_GET['id']}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    				
					if(mysql_affected_rows() == -1){
						return false;
					}else{
						$ok = 1;
                        $message = 'تم تعديل الكتاب بنجاح';
				        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowStore">';
					}
				}
				
				include(TEMPLATE.'/edit_product.php');
				
				break;                                        
                        
				case "ChangeLink" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_MOD();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
				    ## if the get correct id
    				## Check link Status

    				$check_link = mysql_result( mysql_query("SELECT approved FROM `links` WHERE `id` = '{$_GET['id']}'"), 0);
    				if($check_link >= 1){
    				//disable selected link
                    $status = 'Disabled';
    				mysql_query("UPDATE `links` SET `approved` = '0' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
    				}elseif($check_link == 0){
    				//enable selected link
                    $status = 'Enabled';
    				mysql_query("UPDATE `links` SET `approved` = '1' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);	
    				}                    
                    
					if(mysql_affected_rows() > 0)
                    print '<div style="width:50%; float: left" class="msg msg-ok">
                            <p>Selected Links was '.$status.' <strong>successfully</strong></p>
                          </div>';						
					}
                    
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowLinks">';
					
				break;
                
                
				case "ApproveLink" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){					   
					//if the get correct id update members
					mysql_query("UPDATE `links` SET `approved` = '2' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
						if(mysql_affected_rows() > 0)
                        print '<div style="width:50%; float: left" class="msg msg-ok">
                                <p>Selected Links was Approved and Published <strong>successfully</strong></p>
                              </div>';						
					}					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowLinks">';
					
				break;

			
				case "Addcity" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				    if(!empty($_POST['d_name_en']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
						
						$d_name_en = trim($_POST['d_name_en']);
                        $d_name_ar = trim($_POST['d_name_ar']);
                        $d_type = trim($_POST['d_type']);
				        (int)$d_active = $_POST['d_active'];
						
						mysql_query("INSERT INTO `departments` 
						( `id`, `d_name_en`, `d_name_ar`, `d_active`, `d_type` )
						VALUES
						(NULL, '{$d_name_en}','{$d_name_ar}', '{$d_active}', '{$d_type}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
						
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
						}
					}
    
					include(TEMPLATE.'/add_department.php');
                     							    
				break;

				
				case "EditDepartment" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
			    $g = mysql_query("SELECT * FROM `departments` WHERE `id` = '{$_GET['id']}'");
			    
                if($row_edit_dep = mysql_fetch_object($g)){
			    	$d_name_en = $row_edit_dep->d_name_en;
                    $d_name_ar = $row_edit_dep->d_name_ar;
			    	$stauts = $row_edit_dep->d_active;
				}
								
				if(isset($_GET['id'],$_POST['sub_ok']) and $_GET['id'] > 0 and $_POST['sub_ok'] == 1){
					
					mysql_query("UPDATE `departments` SET `d_name_en` = '{$_POST['d_name_en']}', `d_name_ar` = '{$_POST['d_name_ar']}', `d_active` = '{$_POST['d_active']}' WHERE `id` = '{$_GET['id']}' LIMIT 1");
					
						if(mysql_affected_rows() == -1){
							return false;
						}else{
							$ok = 1;
					        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowDepartments">';
						}
				}
				
				include(TEMPLATE.'/edit_department.php');	
				
				break;


				case "RemoveDepartment" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				
				if(isset($_GET['id']) && $_GET['id'] > 0){		    
    				//delete all links in dept
    				mysql_query("DELETE FROM `links` WHERE `in_dept` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);				
				
                
                mysql_query("DELETE FROM `departments` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);	
									
				if(mysql_affected_rows() == -1) return false;
                }
		
				print '<div style="width:50%; float: left" class="msg msg-ok"><p>Selected DEPT Removed <strong>successfully</strong></p></div>';
			    print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?section=ShowBlogs">';
				
				break;
				
				case "AddMember" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				    
				if(!empty($_POST['name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
					
					$account_name   = trim($_POST['name']);
                    $account_last   = trim($_POST['last_name']);
					$account_pass	= md5($_POST['password']);
					$account_mail	= trim($_POST['email']);

                    $company_name	= trim($_POST['company_name']);
                    $phone_number	= trim($_POST['phone_number']);
                    $fax_number	= trim($_POST['fax_number']);
                    $website	= trim($_POST['website']);
                    $gmap	= trim($_POST['gmap']);


                    $account_city	= intval($_POST['city_id']);
                    $account_dept	= intval($_POST['cat_id']);
                    $account_group	= intval($_POST['group_id']);
                    $activated = intval($_POST['activated']);


                    ## validate check !

                    if( $this->validate_latitude($gmap) == false){
                        $this->error[] = 'wrong latitude code';
                    }


                    if( !empty($this->error) ){
                        $message = $this->error[0];
                        $ok = 3;
                    }

                    if($ok != 3){
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
                            ( `id`, `name`,`last_name`, `password`, `email`, `group_id`, `activated`, `dept_id`, `city`, `company_name`, `phone_number`, `fax_number`, `website`, `gmap` )
                            VALUES
                            (NULL, '{$account_name}', '{$account_last}', '{$account_pass}', '{$account_mail}', '{$account_group}', '{$activated}', '{$account_dept}', '{$account_city}', '{$company_name}', '{$phone_number}', '{$fax_number}', '{$website}', '{$gmap}')") or die(mysql_error());

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
					
				}
				
                //$ok = ($ok == 1) ? 1 : '';
				
				include_once(TEMPLATE.'/add_member.php');
								    
				break;
				
				case "ShowMembers" :

				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				
				include_once(TEMPLATE.'/show_members.php');
				   								    
				break;
                
				case "ActiveMember" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					   
					//if the get correct id update members
					mysql_query("UPDATE `members` SET `activated` = '1' WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
					
						if(mysql_affected_rows() > 0)
                        print '<div style="width:50%; float: left" class="msg msg-ok">
                                <p>Selected Member activated <strong>successfully</strong></p>
                              </div>';						
					}
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowMembers">';
					
				break;
				
				case "RemoveMember" :
				 
				/* USE THIS CASE ONLY FOR ADMIN */
				$this->USE_ONLY_FOR_ADMIN();
				   
					if(isset($_GET['id']) && intval($_GET['id']) > 0){
					   
					//if the get correct id remove the member
					mysql_query("DELETE FROM `members` WHERE `id` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    
					//if the get correct id remove all links added by this member
					//mysql_query("DELETE FROM `links` WHERE `added_by` = '{$_GET['id']}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

					}
                    
                    print '<div style="width:50%; float: left" class="msg msg-ok">
                            <p>Selected Member Removed <strong>successfully</strong></p>

                          </div>';		
					
					print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowMembers">';
					
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
				
			}
					
		}else{
			
			return include_once(TEMPLATE.'/board.php');
						
	    }
	
	}
    	
}
?>
