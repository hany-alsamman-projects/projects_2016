<?php
/**
 * AFADAR_CORE.php
 *
 * @package afadar-jewelry
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @author Hany alsamman (Project administrator && Original founder)
 * @copyright codexc.com
 * @version $Id$
 * @pattern private
 * @access private
 */
 
if ( ! defined( 'IN_SCRIPT' ) )
{
        print "<h1>Incorrect access</h1>You cannot access this file directly.";
        exit();
}


class AFADAR_CORE extends functions
{
	
	/**
	 * @return errors array blank 
	 */
    var $error = array();
    
	/**
	 * @return pages number
	 */    
	var $step;
	
	/**
	 * @return max pages views
	 */
	var $max;
	
	/**
	 * @return view pages number from?
	 */
	var $from;
	
	/**
	 * @return intavel ID
	 */	
	private $_ID;

    /**
     * AFADAR_CORE::connection()
     * 
     * @return void
     */     
    private function connection()
    {
        AFADAR_DB::getInstance();
    }
    
    
    /**
     * AFADAR_CORE::__construct()
     * 
     * @return void
     */
    public function __construct()
    {
        global $lang;
 
        $this->lang = $lang;

        $this->connection(); //create new connection

        //$this->_ID = addslashes( (int)$_GET['id'] );
		//$this->_ID = preg_replace("/^[0-9]$/","", (int)$_GET['id']);
		
        $secure = new security();
        $secure->parse_incoming();
        
		$this->_ID = (preg_match('/^\d+$/', (int)$_GET['id'])) ? (int)$_GET['id'] : null;
    }
	
    /**
     * AFADAR_CORE::NAV()
     * 
     * @param mixed $POSITION
     * @return
     */
    public function _NAV($POSITION){
    	if(!is_null($this->_ID) && $_GET['do'] == 'page'){
    		$this->title = mysql_result( mysql_query("SELECT a_name FROM `additional_pages` WHERE `id` = '{$POSITION}' LIMIT 1") ,0);
		}elseif(!is_null($this->_ID) && $_GET['do'] == 'ShowCat'){
    		$this->title = mysql_result( mysql_query("SELECT d_name FROM `departments` WHERE `id` = '{$POSITION}' LIMIT 1") ,0);
		
        }elseif(!is_null($this->_ID) && $_GET['do'] == 'ShowProduct'){
            $this->title = 'Show Products';
        }elseif(!is_null($this->_ID) && $_GET['do'] == 'ShowPage'){
			$cat = mysql_result( mysql_query("SELECT d_name FROM `departments` WHERE `id` = (SELECT in_dept FROM `topics` WHERE `tid` = '{$POSITION}' LIMIT 1) LIMIT 1") ,0);
			$catid = mysql_result( mysql_query("SELECT id FROM `departments` WHERE `id` = (SELECT in_dept FROM `topics` WHERE `tid` = '{$POSITION}' LIMIT 1) LIMIT 1") ,0);
			$topic = mysql_result( mysql_query("SELECT t_title FROM `topics` WHERE `tid` = '{$POSITION}' LIMIT 1") ,0);			
			$this->title = '<a href="index.html?do=ShowCat&id='.$catid.'"><b>'.$cat.'</b></a>'.' <span style="color:#FF6">&raquo;</span> '.$topic;
		}else{
		  $this->title = 'Welcome';
		}
		
    	return stripslashes($this->title);
    }

    /**
     * CORE::Get_Pages()
     *
     * @return
     */
    public function Get_Pages()
    {
        if (isset($_GET['do'])) {

            switch ($_GET['do']) {
                
                case "Products":
                
                    include (SITE_PATH.'/templates/products.php');                
                
                break;

                case "ShowCat":
 
                $publish_now = time();

                    if (!is_null($this->_ID) && is_numeric($this->_ID)) {

                        $my_query = mysql_query("SELECT d_active FROM `departments` WHERE `id` = '{$_GET['id']}' LIMIT 1");

                        if (mysql_num_rows($my_query) == 1) {

                            $d_active = mysql_result($my_query, 0);

                            if ($d_active == 1) {
                            
			  				$this->step = ($_GET['step'] == '') ? 1 : $_GET['step'];
							
							if(isset($this->step) && is_numeric($this->step) > 0){
								
								## Start from number?
								$this->from = ($this->MaxTopic * $this->step) - $this->MaxTopic;			

							
								$count_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `approve` = '1' and `publish_date` <= '".time()."' and `in_dept` = '{$_GET['id']}'"), 0);

                                ## have page
								$count_step = ceil( $count_topics / $this->MaxTopic); //ceil the max number
								
								$result = mysql_query("SELECT * FROM `topics` WHERE `in_dept` = '{$_GET['id']}' and `approve` = '1' and `publish_date` <= '".time()."' ORDER BY tid DESC LIMIT $this->from,$this->MaxTopic");
                                
                                ## Get data with nice shout (return array with all Topic) :D
                                $GetDeptData = parent::fetch_data_array($result);

                                include (SITE_PATH.'/templates/view_dept.php');
                                
                                //include (SITE_PATH.'/templates/dept_pages.php');
								
							}
								
                            } else {
                            	
                                //echo 'åÐÇ ÇáÞÓã ãÊæÝÞ ÍÇáíÇ';
                                return false;

                            }

                        } else {

                            //echo 'åÐÇ ÇáÞÓã ÛíÑ ãæÌæÏ';
                            return false;

                        }

                    } else {

                        //echo 'ãÍÇæáÉ ÊÛííÑ ÇáÑÇÈØ ÈØÑíÞÉ ÎÇØÆÉ';
                        return false;

                    }

                break;

                case "ShowPage":
                
                $publish_now = time();

                    if (!is_null($this->_ID) && is_numeric($this->_ID)) {
                    	
                        $my_query = mysql_query("SELECT * FROM `topics` WHERE `tid` = '{$_GET['id']}' and `approve` = '1' and `publish_date` <= '".time()."' LIMIT 1");
						
                        if (mysql_num_rows($my_query) == 1) {
                        
                        mysql_query("UPDATE `topics` SET `views` = views+1 where `tid` = '{$_GET['id']}' LIMIT 1");
                        	
                                ## Get data with nice shout (return array with all Topic) :D
                                $GetTopicData = parent::fetch_data_array($my_query);

                                include (SITE_PATH.'/templates/view_topic.php');

                        } else {

                            echo 'no page';

                        }

                    } else {

                        echo 'an error';
                    }

                break;
                
                
                case "ShowProduct":
                

                    if (!is_null($this->_ID) && is_numeric($this->_ID)) {

                        //$my_similar = mysql_query("SELECT * FROM `ar_products` WHERE  `available` = '1' ORDER BY id < $_GET[id],id ASC");
                        $my_similar = mysql_query("SELECT * FROM `ar_products` WHERE  `available` = '1' and `in_dept` = '$_GET[id]' ORDER BY id DESC");
                        
                        if (mysql_num_rows($my_similar) > 0) {
                            
                                ## Get data with nice shout :D
                                $myData = parent::fetch_data_array($my_similar);

                                
                                include (SITE_PATH.'/templates/view_product.php');

                        } else {

                            echo 'not found';

                        }
                                                

                    } else {

                        echo 'an error';
                    }

                break;
                
                
                
				case "page" :

                if (!is_null($this->_ID) && is_numeric($this->_ID) > 0)
                {                	
                    $result = mysql_query("SELECT * FROM `additional_pages` where `id` = '{$_GET['id']}' LIMIT 1");
                    if ($row_page = mysql_fetch_object($result))
                    {
                    	mysql_query("UPDATE `additional_pages` SET `a_visit` = a_visit+1 where `id` = '{$_GET['id']}' LIMIT 1");

						include (SITE_PATH.'/templates/view_page.php');
					}
					
                } else {

                    echo 'an error';
                }

				break;
                
                case "Search":
				
				$_POST['word'] = trim ($_POST['word']);
                
                if(isset($_POST['sub_ok']) && strlen($_POST['word']) > 2){
					
                	$search_in = ( $_POST['in_dept'] > 0 ) ? $_POST['in_dept'] : '';

                    $result = mysql_query("SELECT * FROM `topics` WHERE (t_short REGEXP '{$_POST[word]}') OR (t_title REGEXP '{$_POST[word]}' and `approve` = '1' and `publish_date` <= '".time()."' and `in_dept` = '{$search_in}')");

                    ## Get data with nice shout (return array with all Topic) :D
                    $GetDeptData = parent::fetch_data_array($result);
                    
                    if(mysql_num_rows($result) == 0) echo '<div style="text-align: center">No think to view</div>';
                    
                    include (SITE_PATH.'/templates/view_dept.php');
                }else{
                	echo '<div style="text-align: center"><b>an error</b></div>';
                }
				                
                break;
            }


        } else {
            
            $my_query = mysql_query("SELECT * FROM `ar_products` where `available` = '1' ORDER BY id DESC LIMIT 6");
            	
            ## Get data with nice shout :D
            $GetData = parent::fetch_data_array($my_query);
            
                       
            include (SITE_PATH.'/templates/main.php');
        }

    }


    /**
     * AFADAR_CORE::MAIN_DISPLAY()
     * 
     * @return
     */
    public function MAIN_DISPLAY()
    {
		
		/**
		 * if case want to PrintNEWS
		 */
		if($_GET['get'] == 'PrintPage'){
            
			if (!is_null($this->_ID) && is_numeric($this->_ID)) {
            
                $p_news = mysql_query("SELECT * FROM `topics` WHERE `tid` = '{$_GET['id']}' and `approve` = '1' and `publish_date` <= '".time()."' LIMIT 1");
				
                if (mysql_num_rows($p_news) == 1) {
                	
                        ## Get data with nice shout (return array with all Topic) :D
                        $GetNews = parent::fetch_data_array($p_news);

                        include (SITE_PATH.'/templates/print_news.php');

                } else {

                    //echo 'åÐÇ ÇáãæÖæÚ ÛíÑ ãÊæÝÑ';

                }
			
			}
            
        }elseif($_GET['get'] == 'gallery'){
            
            $GetData = FUNCTIONS::getDirectoryTree($_SERVER["DOCUMENT_ROOT"]."/amc/upload/p_$_GET[id]");
            
            include (SITE_PATH.'/templates/gallery.php');
            

        ## end
            
            
        }elseif($_GET['get'] == 'removefile'){
                    
        $myfile = explode(",",$_REQUEST['folder']);        
        
        $do = unlink($_SERVER["DOCUMENT_ROOT"]."/upload/p_".$myfile[1]."/".$myfile[0]."");

        if($do){echo "The file was deleted successfully.";} else { echo "There was an error trying to delete the file."; } 
        
        ## end
			
        }elseif($_GET['get'] == 'contactus'){                        
                        
            if($_POST)
            {
            $javascript_enabled = $_REQUEST['browser_check'];
            $department = $_REQUEST['dept'];
            $name = $_REQUEST['name'];
            $company = $_REQUEST['company'];
            $email = $_REQUEST['email'];
            $phno = $_REQUEST['phno'];
            $mobile = $_REQUEST['mobile'];
            $subject = $_REQUEST['subject'];
            $msg = $_REQUEST['msg'];
             
             
            //mail settings
            
            $headers = "From: ".$email;
            $subject = "Mederm Website - Contact Us Request";
            $to = "gm@mederm.net";
            
            $error = 1;
            
            $txt .= "<table width=\"600\" cellpadding=0 cellspacing=1 border=0>";
            $txt .= "<tr><td class=\"body_textbg\" width=\"25%\" colspan=2>CONTACT INFORMATION</td></tr>";
            $txt .= "<tr><td class=\"body_text\">Name:</td><td class=\"body_text\">$name</td></tr>";
            $txt .= "<tr><td class=\"body_textbg\">Company:</td><td class=\"body_textbg\">$company</td></tr>";
            $txt .= "<tr><td class=\"body_text\">Phone:</td><td class=\"body_text\">$phone</td></tr>";
            $txt .= "<tr><td class=\"body_textbg\">Mobile:</td><td class=\"body_textbg\">$mobile</td></tr>";
            $txt .= "<tr><td class=\"body_text\">Email:</td><td class=\"body_text\">$email</td></tr>";
            $txt .= "<tr><td class=\"body_textbg\">Details:</td><td class=\"body_textbg\">$details</td></tr>";
            $txt .= "</table>";
             
        	if ( $name == "" || $name == " ")
        	{
        		$result = "Name field is required";
                
        	}
        	elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) 
        	{
        		$result = "Enter a valid email address";
        	}
        	elseif(!is_numeric($phno)) //check for a pattern of 91-0123456789
        	{
        		$result = "Enter a valid phone number";
        	}
        	elseif(!is_numeric($mobile)) //check for a pattern of 91-0123456789
        	{
        		$result = "Enter a valid mobile number";
        	}
        	elseif ( $subject == "" || $subject == " ")
        	{
        		$result = "Subject is required";
        	}
        	elseif ( strlen($msg) < 10 )
        	{
        		$result = "Write more than 10 characters";
        	}
        	else
        	{	
                $error = 0;
        			mail($to, $subject, $message, $headers);
        		if( $selfcopy == "yes" )
        			mail($email, $subject, $message, $headers);
        		$result = "Your mail has been sent successfully!";
         
        	}
         
            	if($javascript_enabled == "true") {
            		echo $result;
            		die();
            	}
             
            }
		        
		} else {
			
			include (SITE_PATH.'/templates/home.php');
			
        }
    }

    // this will be called automatically at the end of scope
    public function __destruct()
    {
        //mysql_close($this->_Link);
    }

}

?>