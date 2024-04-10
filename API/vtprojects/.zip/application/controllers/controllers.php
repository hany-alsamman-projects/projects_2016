<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, CODEX.COM. All Rights Reserved.                     |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEX.COM TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * CONTROLLERS.php
 *
 * @package CONTROLLERS
 * @author Hany alsamman <hany.alsamman@gmail.com>
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
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

        if (!isset($_GET['task'])) {

            /**
             * This function will select all depts in DB and bulid the main menu
             */
            $MenuData = LOGIN::BULID_MENU();
            parent::PAGE_VIEW("home", false, $MenuData);


            /**
             *  all cases in this area only founded to proccess the forms
             *  via send the data through json tech with jquery solutions
             *  every action here and functions, will return array to view
             *  the errors and messages about actions effected
             */
        } elseif (isset($_GET['task'])) {


            if ($_GET['task'] == 'api'):

                ## API AUTH

                if($this->APIuserID == 'obaid' && $this->APIkeyID == 'vip4ayman'){
                    ## check action
                    if($_GET['action'] ==  'get_cities') echo API::EXPORT_PROCESS();

                }

                return false;
            endif;

            if ($_GET['task'] == 'createlic'):
                if (IS_AJAX) echo UUID::v4(); //'59fwb237-9dc5-3acd-b43b-e1eb030a7fda';
                return false;
            endif;

            if ($_GET['task'] == 'dorequest'):
                USERCP::DO_REQUEST();
            endif;

            if ($_GET['task'] == 'checklic'):
                SIGNUP::CHECK_LICENSE($_POST['key']);
            endif;

            if ($_GET['task'] == 'login'):
                LOGIN::LOGIN_PROCESS();
            endif;

            if ($_GET['task'] == 'search'):
                SEARCH::SEARCH_PROCESS();
            endif;

            if ($_GET['task'] == 'signup'):
                SIGNUP::SIGNUP_PROCESS();
            endif;

            /**
             * check the request if realy have ajax header and check session is realy opened
             * all functions will proccess the data only when login
             */
            if (IS_AJAX && isset($_SESSION['user_name'])) {

                if ($_GET['task'] == 'addlink'):
                    USERCP::ADDlINK();
                endif;

                if ($_GET['task'] == 'preaddlink'):
                    USERCP::PRE_ADDLINK();
                endif;

                if ($_GET['task'] == 'linkslist'):
                    USERCP::LINKSLIST();
                    if (isset($_GET['remove_link'])) USERCP::REMOVELINK($_GET['remove_link']);
                endif;

                if ($_GET['task'] == 'changeprofile'):
                    USERCP::CHANGEPROFILE();
                endif;

                if ($_GET['task'] == 'profilepicture'):
                    USERCP::PROFILEPICTURE();
                endif;

                if ($_GET['task'] == 'password'):
                    USERCP::CHANGEPASSWORD();
                endif;
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