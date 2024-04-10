<?php

/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 vipit.sa
 * @version 2.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
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

    function Magic_Upload(){

        if(is_array($_FILES["myfile"]["name"])){ //single file

            $fileCount = count($_FILES["myfile"]["name"]);
            for($i=0; $i < $fileCount; $i++)
            {
                $ext = pathinfo($_FILES["myfile"]["name"][$i], PATHINFO_EXTENSION);

                $fileName = substr(md5($_FILES["myfile"]["name"][$i]),rand(5,7));
                $output_dir = SITE_PATH . '/tmp/'. $fileName.'.'.$ext;

                if ($_FILES['myfile']['error'][$i] === UPLOAD_ERR_OK) {

                    $uploadSuccess = move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir);

                } else {
                    throw new UploadException($_FILES['myfile']['error'][$i]);
                }

                chmod($output_dir, 0777);

                if($uploadSuccess && $ext == 'zip'){
                    $folder = $fileName;

                    $dest = SITE_PATH . '/vtprojects/'.$folder;
                    //if (!is_dir($dest)) mkdir($dest ,0777);
                    $archive = new PclZip($output_dir);
                    if ($archive->extract(PCLZIP_OPT_PATH, $dest) == 1) {
                        //chown($dest,"virtualt");
                        chmod($dest,0777);
                    }

                }else{
                    ## move file to upload
                    rename($output_dir, SITE_PATH . '/upload/'. $fileName.'.'.$ext);
                }

                $ret[]= $fileName.'.'.$ext;
            }
        }

        echo json_encode($ret);
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
            
            include(TEMPLATE.'/menu.php');
			
			switch($type){
				
				case "logout" :
					unset($_SESSION['mod']);
					unset($_SESSION['admin']);
					@session_destroy();
										
					print '<div style="width:50%; float: left" class="msg msg-info"><p>Take Care!</p></div>';
					print '<META HTTP-EQUIV=Refresh CONTENT="2; URL=./index.php">';
				break;


                case "ShowRequests" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();

                    include_once(TEMPLATE.'/show_tours.php');

                break;

                case "ShowPlaces" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();

                    include_once(TEMPLATE.'/show_places.php');

                    break;

                case "AddPlace" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();

                    if(!empty($_POST['place_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){

                        $place_name = trim($_POST['place_name']);
                        $account_id = trim($_POST['account_id']);

                        (int)$city_id = $_POST['city_id'];
                        (int)$dept_id = $_POST['dept_id'];
                        $latitude = trim($_POST['latitude']);
                        $longitude = trim($_POST['longitude']);
                        $first_name = trim($_POST['first_name']);
                        $campaign_place = trim($_POST['campaign_place']);
                        $approved = trim($_POST['approved']);
                        $days_left = $_POST['days_left'];
                        $tour_address = $_POST['tour_address'];
                        $place_info = $_POST['place_info'];
                        $place_number = $_POST['place_number'];

                        ## be smart :P
                        $place_link = (isset($_POST['htm_file'])) ? 'vtprojects/' .current(explode('.',$_POST['htm_file'])) : NULL;
                        $place_image = (isset($_POST['photo_file'])) ? 'upload/' .$_POST['photo_file'] : NULL;

                        mysql_query("INSERT INTO `tour_requests`
						( `id`, `first_name`,  `place_name`, `place_link`,`place_info`, `phone_number`, `account_id`, `place_image`, `city_id`,`dept_id`, `latitude`, `longitude`, `approved`, `campaign_place` , `days_left`, `tour_address` )
						VALUES
						(NULL, '{$first_name}', '{$place_name}', '{$place_link}','{$place_info}', '{$place_number}', '{$account_id}', '{$place_image}', '{$city_id}','{$dept_id}', '{$latitude}', '{$longitude}', '{$approved}', '{$campaign_place}', '{$days_left}', '{$tour_address}')") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

                        if(mysql_affected_rows() == -1){
                            $ok = 2;
                        }else{
                            $ok = 1;
                        }
                    }

                    if($ok == 1){
                        print '<div style="width:50%; float: left" class="msg msg-ok">
                               <p>The Place ('.$_POST['place_name'].') was <strong>added</strong> successfully !</p>
                               </div>';

                        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowPlaces">';

                        return false;

                    }elseif($ok == 2){
                        print '<div style="width:50%; float: left" class="msg msg-error">
                                <p>there errors or not valid contents</p>
                                <p>'.$message.'</p>
                                </div>';
                    }


                    include_once(TEMPLATE.'/add_place.php');

                    break;

                case "EditPlace" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();


                    $g = mysql_query("SELECT * FROM `tour_requests` WHERE `id` = '{$_GET['id']}'");

                    if($row = mysql_fetch_object($g)) $place = $row;

                    if(!empty($_POST['place_name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){

                        $place_name = trim($_POST['place_name']);
                        $account_id = trim($_POST['account_id']);

                        (int)$city_id = $_POST['city_id'];
                        (int)$dept_id = $_POST['dept_id'];
                        $latitude = trim($_POST['latitude']);
                        $longitude = trim($_POST['longitude']);
                        $first_name = trim($_POST['first_name']);
                        $campaign_place = trim($_POST['campaign_place']);
                        $approved = trim($_POST['approved']);
                        $days_left = $_POST['days_left'];
                        $tour_address = $_POST['tour_address'];
                        $place_info = $_POST['place_info'];
                        $place_number = $_POST['place_number'];

                        ## be smart :P
                        $place_link = (isset($_POST['htm_file'])) ? 'vtprojects/' .current(explode('.',$_POST['htm_file'])) : $place->place_link;
                        $place_image = (isset($_POST['photo_file'])) ? 'upload/' .$_POST['photo_file'] : $place->place_image;


                        mysql_query("UPDATE `tour_requests`
						SET
						`first_name` = '{$first_name}',
						`place_name` = '{$place_name}',
						`place_link` = '{$place_link}',
						`account_id` = '{$account_id}',
						`place_image` = '{$place_image}',
						`place_info` = '{$place_info}',
						`phone_number` = '{$place_number}',
						 `city_id` = '{$city_id}',
						 `latitude` = '{$latitude}',
						 `longitude` = '{$longitude}',
						 `approved` = '{$approved}',
						 `campaign_place` = '{$campaign_place}',
						 `days_left` = '{$days_left}',
						 `tour_address`= '{$tour_address}',
						 `dept_id`= '{$dept_id}'
						 WHERE `id` = '{$_GET['id']}'
						 ") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

                        if(mysql_affected_rows() == -1){
                            $ok = 2;
                        }else{
                            $ok = 1;
                        }
                    }

                    if($ok == 1){
                        print '<div style="width:50%; float: left" class="msg msg-ok">
                               <p>The Place ('.$_POST['place_name'].') was <strong>updated</strong> successfully !</p>
                               </div>';

                        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowPlaces">';

                        return false;

                    }elseif($ok == 2){
                        print '<div style="width:50%; float: left" class="msg msg-error">
                                <p>there errors or not valid contents</p>
                                <p>'.$message.'</p>
                                </div>';
                    }


                    include_once(TEMPLATE.'/edit_place.php');

                    break;

                case "Showitems" :
				
				/* USE THIS CASE ONLY FOR ADMIN */
				//$this->USE_ONLY_FOR_ADMIN();
				
				include(TEMPLATE.'/show_departments.php');
											    
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

                    /**
                     * todo: add member function
                     */

                    /* USE THIS CASE ONLY FOR ADMIN */
                    //$this->USE_ONLY_FOR_ADMIN();

                    if(!empty($_POST['name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){
					
					$account_name   = trim($_POST['name']);
                    $account_last   = trim($_POST['last_name']);
					$account_pass	= md5($_POST['password']);
					$account_mail	= trim($_POST['email']);
                    $account_address	= trim($_POST['address']);

                    $company_name	= trim($_POST['company_name']);
                    $phone_number	= trim($_POST['phone_number']);
                    $fax_number	= trim($_POST['fax_number']);
                    $website	= trim($_POST['website']);
                    //$gmap	= trim($_POST['gmap']);


                    $account_city	= intval($_POST['city_id']);
                    $account_dept	= intval($_POST['cat_id']);
                    $account_group	= intval($_POST['group_id']);
                    $activated = intval($_POST['activated']);


                    ## validate check !

                    //if( $this->validate_latitude($gmap) == false){
                    //    $this->error[] = 'wrong latitude code';
                    // }


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
                            ( `id`, `name`,`last_name`, `password`, `address`, `email`, `group_id`, `activated`, `dept_id`, `city`, `company_name`, `phone_number`, `fax_number`, `website` )
                            VALUES
                            (NULL, '{$account_name}', '{$account_last}', '{$account_pass}', '{$account_address}', '{$account_mail}', '{$account_group}', '{$activated}', '{$account_dept}', '{$account_city}', '{$company_name}', '{$phone_number}', '{$fax_number}', '{$website}')") or die(mysql_error());

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

                case "EditMember" :

                    /* USE THIS CASE ONLY FOR ADMIN */
                    $this->USE_ONLY_FOR_ADMIN();


                    if(!empty($_POST['name']) && isset($_POST['sub_ok']) && $_POST['sub_ok'] == 1){


                        $account_name   = trim($_POST['name']);
                        $account_last   = trim($_POST['last_name']);
                        $account_pass	= (!empty($_POST['password'])) ? md5($_POST['password']) : null;
                        $account_mail	= trim($_POST['email']);
                        $account_address	= trim($_POST['address']);

                        $company_name	= trim($_POST['company_name']);
                        $phone_number	= trim($_POST['phone_number']);
                        $fax_number	= trim($_POST['fax_number']);
                        $website	= trim($_POST['website']);
                        $gmap	= trim($_POST['gmap']);


                        $account_city	= intval($_POST['city_id']);
                        $account_dept	= intval($_POST['cat_id']);
                        $account_group	= intval($_POST['group_id']);
                        $activated = intval($_POST['activated']);

                        //if the get correct id update members
                        mysql_query("UPDATE `members`
                    SET `name` = '$account_name', `password` = '$account_pass', `last_name` = '$account_last', `company_name` = '$company_name',
                    `address` = '$account_address', `phone_number` = '$phone_number', `fax_number` = '$fax_number', `website` = '$website', `gmap` = '$gmap',
                    `avatar` = '123', `email` = '$account_mail', `activated` = '$activated',
                    `city` = '$account_city', `dept_id` = '$account_dept'  WHERE `id` = '{$_GET['id']}'
                    ")
                        or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


                        print '<div style="width:50%; float: left" class="msg msg-ok">
                                            <p>The Member ('.$_POST['name'].') was <strong>updated</strong> successfully !</p>
                               </div>';

                        print '<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php?section=ShowMembers">';

                        return false;

                    }

                    $g = mysql_query("SELECT * FROM `members` WHERE `id` = '{$_GET['id']}'");

                    if($row = mysql_fetch_object($g)) $user = $row;


                    include(TEMPLATE.'/edit_member.php');

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

            //if the get correct id remove the member
            $total_users = @mysql_result(mysql_query("SELECT COUNT(*) FROM `members` WHERE `activated` = '1'"), 0);
            $waiting_users = @mysql_result(mysql_query("SELECT COUNT(*) FROM `members` WHERE `activated` != '1'"), 0);
            $vt_requestes = @mysql_result(mysql_query("SELECT COUNT(*) FROM `tour_requests` WHERE `approved` = '1'"), 0);
            $waiting_requestes = @mysql_result(mysql_query("SELECT COUNT(*) FROM `tour_requests` WHERE `approved` != '1'"), 0);

            return include_once(TEMPLATE.'/board.php');
						
	    }
	
	}
    	
}
?>
