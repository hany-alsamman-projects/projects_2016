<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, SYRIA-NEWS. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER SYRIA-NEWS TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * BLOG.php
 *
 * @package Tune
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
 * @access TEAM
 */

class BLOG extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;

    
    /**
     * BLOG::__construct()
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
     * BLOG::Get_Pages()
     *
     * @return
     */
    public function Get_Pages()
    {
        if (isset($this->ACTION)) {

            switch ($this->ACTION) {

                case "ViewDEPT":
 
                $publish_now = time();

                    if (isset($this->_ID) && is_numeric($this->_ID)) {

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
                                
                                include (SITE_PATH.'/templates/dept_pages.php');
								
							}
								
                            } else {

                                echo 'هذا القسم متوفق حاليا';
                                return false;

                            }

                        } else {

                            echo 'هذا القسم غير موجود';
                            return false;

                        }

                    } else {

                        echo 'محاولة تغيير الرابط بطريقة خاطئة';
                        return false;

                    }

                break;

                case "ViewTOPIC":
            
                    if (isset($this->_ID) && is_numeric($this->_ID)) {
                    	
                        $my_query = mysql_query("SELECT * FROM `topics` WHERE `tid` = '{$_GET['id']}' and `approve` = '1' and `publish_date` <= '".time()."' LIMIT 1");
						
                        if (mysql_num_rows($my_query) == 1) {
                        
                        mysql_query("UPDATE `topics` SET `views` = views+1 where `tid` = '{$_GET['id']}' LIMIT 1");
                        	
                                ## Get data with nice shout (return array with all Topic) :D
                                $GetTopicData = parent::fetch_data_array($my_query);

                                include (SITE_PATH.'/templates/view_topic.php');

                        } else {

                            echo 'هذا الموضوع غير متوفر';

                        }

                    } else {

                        echo 'محاولة تغيير الرابط بطريقة خاطئة';
                    }

                break;
                
                case "ViewWaitingTOPIC":

                    if (isset($this->_ID) && is_numeric($this->_ID) && strlen($_GET['check']) == 32) {
                    	
                        $my_query = mysql_query("SELECT * FROM `topics` WHERE `tid` = '{$_GET['id']}' LIMIT 1");
						
                        if (mysql_num_rows($my_query) == 1) {
                        
                        mysql_query("UPDATE `topics` SET `views` = views+1 where `tid` = '{$_GET['id']}' LIMIT 1");
                        	
                                ## Get data with nice shout (return array with all Topic) :D
                                $GetTopicData = parent::fetch_data_array($my_query);

                                include (SITE_PATH.'/templates/view_topic.php');

                        } else {

                            echo 'هذا الموضوع غير متوفر';

                        }

                    } else {

                        echo 'محاولة تغيير الرابط بطريقة خاطئة';
                    }

                break;

                case "TopicTOPVIEWS":
                   
                    $result = mysql_query("SELECT * FROM `topics` WHERE `approve` = '1' and `publish_date` <= '".time()."' ORDER BY views DESC LIMIT 15");

                    ## Get data with nice shout (return array with all Topic) :D
                    $GetDeptData = parent::fetch_data_array($result);

                    include (SITE_PATH.'/templates/view_dept.php');

                break;
                
                
                case "Search":
                
                if(isset($_POST['sub_ok']) && strlen($_POST['word']) > 2){
                $publish_now = time();

                    $result = mysql_query("SELECT * FROM `topics` WHERE `approve` = '1' and `publish_date` <= '".time()."' and (t_short REGEXP '{$_POST[word]}') OR (t_content REGEXP '{$_POST[word]}') OR (t_title REGEXP '{$_POST[word]}')");

                    ## Get data with nice shout (return array with all Topic) :D
                    $GetDeptData = parent::fetch_data_array($result);

                    include (SITE_PATH.'/templates/view_dept.php');
                }else{
                	echo 'الرجاء ادخال كلمة عدد حروفها اكبر من 2';
                }
				                
                break;
                
            }


        } else {
            exit();
        }

    }

    /**
     * BLOG::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}