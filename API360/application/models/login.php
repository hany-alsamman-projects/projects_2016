<?php
/**
 * LOGIN.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @access TEAM
 */

class LOGIN extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;

    
    /**
     * LOGIN::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        global $INFO;
		
		$this->ACTION = $_GET['action'];
        
        $this->cofings = $INFO;
        
		$this->smarty = $smarty;

    }  
    
    
	/**
	 *  WHEN YOU LOGIN
	 */

	public function CHECK_MEMBER_LOGIN(){
		if( session_is_registered('admin') || session_is_registered("member") || session_is_registered('mod') || session_is_registered('company') ) return true;
	}
	
	public function LOGOUT_PROCESS(){

		@session_unregister("mod");
		@session_unregister("admin");
		@session_destroy();
	
		FUNCTIONS::xml_msg(1);
		exit();
    	}
    /**
     * LOGIN::LOGIN_PROCESS()
     * 
     * @return
     */
    public function LOGIN_PROCESS(){
        
        // we check if everything is filled in            
        if( !empty($_POST['email']) && !empty($_POST['password']) )
        {
    			$username = strtolower(trim($_POST['email'])); // convert email to lower and trim space
    			$password = md5($_POST['password']); //compile md5 password
    			$ip = $_SERVER['REMOTE_ADDR']; //get ip address of user
    			
    			//check and get admin row
    			$a = mysql_query("SELECT * FROM `members` WHERE `email` = '{$username}' LIMIT 1");
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
                        		//die(FUNCTIONS::msg(0,$this->lang['LOGIN_MSG_WRONG_PASS']));
					FUNCTIONS::xml_msg(0);
            				exit();
    
    					}elseif($row->activated != 1){
                        
    					//return the error message
                        		//die(FUNCTIONS::msg(0,$this->lang['LOGIN_MSG_NOT_ACTIVE']));
					FUNCTIONS::xml_msg(0);
            				exit();
                        
                        }else{
    					
                        //start as registered member
    					if($row->group_id == '1'): session_register("member");         					
    					//start as registered company
                        elseif ($row->group_id == '2'): session_register("company");   
    					//start as registered mod
                        elseif ($row->group_id == '3'): session_register("mod");          
    					//start as registered admin
                        elseif ($row->group_id == '4'): session_register("admin");            
    					endif;
    					
    					$_SESSION["user_name"] = "$name";
    					$_SESSION["user_id"] = "$id";
    					$_SESSION["ip"] = "$ip";
    					$_SESSION["group_id"] = $row->group_id;
    					
    		            		//show welcome page
                        		//die(FUNCTIONS::msg(1, "index.php?action=login&auth=yes"));
					FUNCTIONS::xml_msg($id);
            				exit();
    					
    					}
    				}
    				
    			}else{
    				    //die(FUNCTIONS::msg(0, $this->lang['LOGIN_MSG_NOT_FOUND']));
					FUNCTIONS::xml_msg(0);
            				exit();
    			}
            
        }else{
                //die(FUNCTIONS::msg(0, $this->lang['LOGIN_MSG_CHECK']));
		FUNCTIONS::xml_msg(0);
		exit();
        }
        
    }


    public function CHANGE_PASSWORD(){

	if (isset($_POST['old_password']) and isset($_POST['new_password'])){   
             	
		## account email "ID"
		$user_email = strtolower(trim($_POST['uid']));

		$uid = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$user_email}' and `activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

	
		$change = LOGIN::ChangePassword($_POST['old_password'], $_POST['new_password'] ,$_POST['confirm_password'], $uid);                	
			if($change == true){
			    FUNCTIONS::xml_msg(1);							
			}else{
			    FUNCTIONS::xml_msg(0);					
			}	
			exit();		    
	}
    }

    function ChangePassword($old, $new, $c_new, $uid){
    	
	$result = mysql_query("SELECT id FROM `members` WHERE `password` = MD5('$old') and `id` = '{$uid}' LIMIT 1") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
	
	if($row = mysql_fetch_row($result)){
		
		mysql_query("UPDATE `members` SET `password` = MD5('$new') WHERE `id` = '{$row[0]}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
    		if(mysql_affected_rows() == 1){    		
    		return true;    					
		}
	}
		
		return false; 
    }
    

    /**
     * LOGIN::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}

