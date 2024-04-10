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
     * CONTROLLERS::connection()
     *
     * @return
     */
    public function connection()
    {
        dbconnector::getInstance();
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
        } elseif (isset($_REQUEST['task'])) {


            if ($_REQUEST['task'] == 'api'):

                ## API AUTH

                ##if($this->APIuserID == 'obaid' && $this->APIkeyID == 'vip4ayman'){


                    if($_REQUEST['do'] == 'get_review') REVIEWS::GET_REVIEW();

                    if($_REQUEST['do'] == 'add_review') REVIEWS::ADD_REVIEW();

                    if($_REQUEST['do'] == 'get_photo') PLACES::GET_PHOTO();

                    if($_REQUEST['do'] == 'campaign_place') PLACES::GET_PLACES();

                    if($_REQUEST['do'] == 'add_place_img') PLACES::ADD_PLACE_IMG();

                    if($_GET['action'] ==  'get_cc') echo API::EXPORT_CC();

                    if($_GET['action'] ==  'places_list') echo API::EXPORT_PLACES_LIST();

                    if($_REQUEST['action'] ==  'user') {

			            if($_REQUEST['do'] == 'forget_pass') echo API::FORGET_PASSWORD();

                        if($_POST['do'] ==  'profile') echo API::USER_PROFILE();

                        if($_POST['do'] ==  'update_profile') echo API::UPDATE_PROFILE();

                        if($_POST['do'] ==  'signup') echo API::SIGNUP_PROCESS();

                        if($_POST['do'] ==  'login') echo API::USER_LOGIN();

                        if($_POST['do'] ==  'logout') LOGIN::LOGOUT_PROCESS();

                        if($_POST['do'] ==  'request_tour_form') echo API::TOUR_FORM_PROCESS();

                        if($_POST['do'] ==  'change_password') echo LOGIN::CHANGE_PASSWORD();

                        if($_REQUEST['do'] ==  'days_left') API::DAYS_LEFT();

                        if($_POST['do'] ==  'tour_places') API::TOUR_PLACES();

                        if($_POST['do'] ==  'remove_place') API::DELETE_PLACE();

                        if($_POST['do'] ==  'place_available') API::PLACE_AVAILABLE();

                        if($_POST['do'] ==  'set_days_left') API::SET_DAYS_LEFT();

                    }

                ##}

            endif;

            if ($_GET['task'] == 'zip_upload'):
                LINKS_CPANEL::Magic_Upload();
            endif;

            if ($_GET['task'] == 'login'):
                LOGIN::LOGIN_PROCESS();
            endif;

            if ($_GET['task'] == 'signup'):
                SIGNUP::SIGNUP_PROCESS();
            endif;

            /**
             * check the request if really have ajax header and check session is realy opened
             * all functions will process the data only when login
             */
            if (IS_AJAX && isset($_SESSION['user_name'])) {

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

class UploadException extends Exception
{
    public function __construct($code) {
        $message = $this->codeToMessage($code);
        parent::__construct($message, $code);
        echo $message;
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;
            default:
                $message = "Unknown upload error";
                break;
        }
        return $message;
    }
}

?>
