<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, CODEX.COM. All Rights Reserved.                     |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEX.COM TEAM (PRIVETE ACCESS ONLY)	    |
'---------------------------------------------------------------------------'
*/

/**
 * CONTROLLERS.php
 *
 * @package CONTROLLERS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @pattern private
 * @access TEAM
 */

class CONTROLLERS extends FUNCTIONS
{

    var $ACTION;
    var $CODE;
    var $ProfileData;
    var $MyDept;
    var $countries;
    var $Picture;
    var $lang;
    var $APIuserID;
    var $APIkeyID;
    var $cofings;

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
        $secure = new SECURITY();
        $secure->parse_incoming();

        $this->countries = $_countries;

        $this->ACTION = $_GET['action'];

        $this->cofings = $INFO;

        $this->lang = $SiteLang;


        ## check API
        ## REF http://stackoverflow.com/questions/9386930/rest-api-authorization-authentication-web-mobile

        $this->APIuserID = $_GET['user_id'];
        $this->APIkeyID = $_GET['key_id'];
        $this->RequestTimestamp = $_GET['req_time'];
        $this->RequestToken = $_GET['token'];

        //$this->RequestToken = md5($this->APIuserID+$this->RequestTimestamp+$this->APIkeyID);
        //isValidMd5($this->RequestToken);
        //error_reporting( $this->cofings['REPORTING'] );

        define("SITE_PATH", $this->cofings['SITE_PATH']);
        define("SITE_DIR", $this->cofings['SITE_DIR']);
        define("SITE_NAME", $this->cofings['SITE_NAME']);

        define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

        define("EMAIL_ACTIVATION", 1);

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

        switch ($this->ACTION) {


            /**
             * This case is responsible for presenting the login page
             */
            case "login":
            {
                parent::PAGE_VIEW($this->ACTION);
                break;
            }


            /**
             * This case is responsible for presenting the logout and destory all sessions
             */
            case "logout":
            {
                session_destroy();
                print '<META HTTP-EQUIV=Refresh CONTENT="1; URL=./index.php?">';
            }
                break;


            /**
             * If no case selection, The home page will show
             */
            default:
                {

                parent::PAGE_VIEW(false, 'main');

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
        global $INFO;

        if (!isset($_GET['task'])) {

            /**
             * This function will select all depts in DB and bulid the main menu
             */
            //$MenuData = LOGIN::BULID_MENU();
            parent::PAGE_VIEW("home", false, $MenuData);


            /**
             *  all cases in this area only founded to proccess the forms
             *  via send the data through json tech with jquery solutions
             *  every action here and functions, will return array to view
             *  the errors and messages about actions effected
             */
        } elseif (isset($_REQUEST['task'])) {


            if ($_REQUEST['task'] == 'api'):

                ## API AUTH

                ##if($this->APIuserID == 'obaid' && $this->APIkeyID == 'vip4ayman'){

                    if($_REQUEST['action'] ==  'get_books') echo API::GET_BOOKS();

                    if($_REQUEST['action'] ==  'get_sub_books') echo API::GET_SUB_BOOKS();

                    if($_REQUEST['action'] ==  'user') {

                    }

                ##}

            endif;

            if ($_GET['task'] == 'upload'):

                $uploaddir = './upload'. DS;

                if(isset($_FILES["myfile"]))
                {
                    $ret = array();

                    $error =$_FILES["myfile"]["error"];
                    {

                        if(!is_array($_FILES["myfile"]['name'])) //single file
                        {
				$fileName = $_FILES["myfile"]["name"];

				$ftp_server = "ftp.alukahapps.com";
				$ftp_username   = "alukahap";
				$ftp_password   =  "QaiPvgdf?^=m";

				//setup of connection
				$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");
				//login
				if(@ftp_login($conn_id, $ftp_username, $ftp_password))
				  {
				  echo "conectd as $ftp_username@$ftp_server\n";
				}
				else {
				  echo "could not connect as $ftp_username\n";
				}

				$remote_file_path = "/public_html/alukah/upload/".$fileName;

				ftp_put($conn_id, $remote_file_path, $_FILES["myfile"]["tmp_name"],FTP_ASCII); 

				ftp_close($conn_id);

                            	$ret[$fileName]= $uploaddir.$fileName;
                          
                             #$ownname='betavip4'; 
                            # chown($uploaddir.$fileName,$ownname );
                        }
                        else
                        {
                            $fileCount = count($_FILES["myfile"]['name']);
                            for($i=0; $i < $fileCount; $i++)
                            {
                                $fileName = $_FILES["myfile"]["name"][$i];
                                $ret[$fileName]= $uploaddir.$fileName;
                                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$uploaddir.$fileName );
                                
                            }

                        }
                    }
                    echo $uploaddir . $_FILES["myfile"]["name"];
                   //echo json_encode($ret);

                }


            endif;


            if ($_GET['task'] == 'sorting'):
                //$from = $_POST['from'];
                //$to = $_POST['to'];
                //mysql_query("UPDATE `books` SET `sort_id` = '$from' WHERE `id`='$to'");

                $neworderarray = $_POST['neworder'];

                foreach($neworderarray as $order=>$id){
		    $order = $order+1;
                    mysql_query("UPDATE `books` SET `sort_id` = '{$order}' WHERE `id`='{$id}'");
                    echo $id;
                }


            endif;


            /**
             * check the request if realy have ajax header and check session is realy opened
             * all functions will proccess the data only when login
             */
            if (IS_AJAX && isset($_SESSION['user_name'])) {

                //if ($_GET['task'] == 'addlink'):
                //    USERCP::ADDlINK();
                //endif;
            }

        } else {

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
