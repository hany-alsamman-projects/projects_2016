<?php

/**
 * api.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @pattern private
 * @access TEAM
 */

class API extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;


    /**
     * USERCP::__construct()
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

    public function FORGET_PASSWORD(){

        ## account email "ID"
        $user_email = strtolower(trim($_REQUEST['uid']));

        if(empty($user_email)){
            FUNCTIONS::xml_msg(0);
            exit();
        }

       $get_uid = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$user_email}' and `activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

	if($get_uid){

	$generate_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 6 ); //sex sorry six chart :P


		require_once("library/mailler/class.phpmailer.php");

		// HTML body
		$body  = "Dear Sir, \n\n";
		$body .= "Here the new requested password, \n\n";
		$body .= "password : " . $generate_password . ".\n\n";
		$body .= "Thank you for your time, \n";

		$mail = new PHPMailer();
		$mail->Body = $body;
		$mail->AddAddress($user_email);

		$mail->SetFrom('info@virtualtour.sa', 'Support Center');

		$mail->Subject    = "Virtual Tour :: Requested password";

		$mail->Send();

		// Clear all addresses and attachments for next loop
		$mail->ClearAddresses();

		// Change the password in DB
		mysql_query("UPDATE `members` SET `password` = MD5('$generate_password') WHERE `id` = '{$get_uid}'") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

		if(mysql_affected_rows() == 1){    		
		    FUNCTIONS::xml_msg(1);
		    exit();					
		}
	}
	
	}

    public function SET_DAYS_LEFT(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

	$place_name = $_POST['place_name'];

	$days_left = $_POST['days_left'];


        $result = @mysql_query("UPDATE `tour_requests` SET `days_left` = '{$days_left}' WHERE `place_name` = '{$place_name}' and `account_id` = '{$get_uid}'");

        if( @mysql_affected_rows() !=0 ){
            FUNCTIONS::xml_msg('1');
            exit();
        }else{
            FUNCTIONS::xml_msg('0');
            exit();
	}

    }

    public function DELETE_PLACE(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

	$place_name = $_POST['place_name'];


        $result = @mysql_query("DELETE FROM `tour_requests` WHERE `place_name` = '{$place_name}' and `account_id` = '{$get_uid}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        if( @mysql_affected_rows() !=0 ){
            FUNCTIONS::xml_msg('1');
            exit();
        }else{
            FUNCTIONS::xml_msg('0');
            exit();
	}

    }

    public function PLACE_AVAILABLE(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

	$place_available = $_POST['available_status'];

	$place_name = $_POST['place_name'];


        $result = @mysql_query("UPDATE `tour_requests` SET `place_available` = '{$place_available}' WHERE `place_name` = '{$place_name}' and `account_id` = '{$get_uid}'");

        if( @mysql_affected_rows() !=0 ){
            FUNCTIONS::xml_msg('1');
            exit();
        }else{
            FUNCTIONS::xml_msg('0');
            exit();
	}

    }

    public function TOUR_PLACES(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

        $result = @mysql_query("SELECT place_name, place_link, latitude, longitude, place_available, active_date as place_start_date, days_left as end_date FROM `tour_requests` WHERE `account_id` = '{$get_uid}'");

        if( !mysql_num_rows($result) ){
            FUNCTIONS::xml_msg('0');
            exit();
        }

        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            $row_element_s1 = "place";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));

            // Loop the columns
            foreach ($row as $col => $val) {

                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));

            }
        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
    }


    public function DAYS_LEFT(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

        $result = @mysql_query("SELECT place_name, place_link, days_left FROM `tour_requests` WHERE `account_id` = '{$get_uid}'");

        if( !mysql_num_rows($result) ){
            FUNCTIONS::xml_msg('0');
            exit();
        }

        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            $row_element_s1 = "credit";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));

            // Loop the columns
            foreach ($row as $col => $val) {

                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));

            }
        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
    }


    public function TOUR_FORM_PROCESS(){

        // we check if everything is filled in
        if( empty($_POST['first_name']) || empty($_POST['last_name']) )
        {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        ## account email "ID"
        $user_email = strtolower(trim($_POST['uid']));

        if(empty($user_email)){
            FUNCTIONS::xml_msg(0);
            exit();
        }

       $get_uid = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$user_email}' and `activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        ## request user name
        $first_name = iconv("UTF-8","CP1256//IGNORE", $_POST['first_name']);
	
	## request last name
        $last_name = iconv("UTF-8","CP1256//IGNORE", $_POST['last_name']);

        $tour_address = trim($_POST['tour_address']);

        ## request phone number
        $phone_number = trim($_POST['phone_number']);

        ## request person_contact_name
        $contact_name = trim($_POST['contact_name']);
	
	//$place_name = trim($_POST['place_name']);

	//$place_link = trim($_POST['place_link']);

	//$latitude = trim($_POST['latitude']);

	//$longitude = trim($_POST['longitude']);


        mysql_query("INSERT INTO `tour_requests`
        (`id` ,`first_name` ,`last_name` ,`phone_number` ,`tour_address` ,`contact_name`, `account_id`) VALUES
        (NULL , '{$first_name}', '{$last_name}' , '{$phone_number}', '{$tour_address}', '{$contact_name}', '{$get_uid}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        if(mysql_affected_rows() > -1){

            FUNCTIONS::xml_msg(1);
            exit();

        }else{

            FUNCTIONS::xml_msg(0);
            exit();

        }
	
    }

    public function USER_LOGIN(){
	LOGIN::LOGIN_PROCESS();
    }

    ## index.php?task=api&action=user&do=profile&uid=<email>
    public function UPDATE_PROFILE(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

	$firstname = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$address = $_POST['tour_address'];
	$phone_number = $_POST['phone_number'];


        $result = @mysql_query("UPDATE `members` SET `name` = '{$firstname}', `last_name` = '{$last_name}', `address` = '{$address}', `phone_number` = '{$phone_number}' WHERE `id` = '{$get_uid}'");

        if( @mysql_affected_rows() !=0 ){
            FUNCTIONS::xml_msg('1');
            exit();
        }else{
            FUNCTIONS::xml_msg('0');
            exit();
	}

    }

    ## GET Method
    ## index.php?task=api&action=user&do=profile&uid=<email>
    public function USER_PROFILE(){

        ## account "ID"
        $get_uid = trim($_POST['uid']);

        $result = @mysql_query("SELECT `name` as `firstname` ,  `last_name` as `lastname`,
        `email` as `emailaddress`, `gmap` as `touraddress`,  `phone_number`, `city` , `dept_id` FROM `members` WHERE `id` = '{$get_uid}'");

        if( !mysql_num_rows($result) ){
            FUNCTIONS::xml_msg('0');
            exit();
        }

        // The names of the root node and the node that will contain a row
        $root_element = "response";



        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            $row_element_s1 = "profile";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));

            // Loop the columns
            foreach ($row as $col => $val) {

                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));

            }
        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
    }

    ## POST Method
    ## index.php?task=api&action=user&do=signup
    public function SIGNUP_PROCESS()
    {

        // we check if everything is filled in
        if( empty($_POST['first_name']) || empty($_POST['last_name']) )
        {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        // is the email selected?
        if( empty($_POST['email_address']) || !FUNCTIONS::is_email($_POST['email_address']) )
        {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        // check email ID exists in DB
        $exists = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `email` = '{$_POST['email_address']}'"),0);
        if($exists > 0) {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        ## account user name
        $first_name = iconv("UTF-8","CP1256//IGNORE", $_POST['first_name']);

        $last_name = iconv("UTF-8","CP1256//IGNORE", $_POST['last_name']);

        ## account email ID
        $user_email = strtolower(trim($_POST['email_address']));

        ## account phone number
        $user_phone = trim($_POST['phone_number']);

	$user_pass = trim($_POST['password']);

        ## account email ID
        $user_tour = trim($_POST['tour_address']);

        $city_id = trim($_POST['city_id']);
        $cat_id = trim($_POST['cat_id']);

        $hash = (EMAIL_ACTIVATION == 1) ? md5(mt_rand(0, 32) . time()) : 'none';


        mysql_query("INSERT INTO `members`
        (`id` ,`name` ,`password` ,`last_name` ,`phone_number` ,`gmap` ,`email` , `active_key`, `city`, `dept_id`) VALUES
        (NULL , '{$first_name}', MD5( '{$user_pass}' ) , '{$last_name}' , '{$user_phone}', '{$user_tour}', '{$user_email}', '{$hash}', '{$city_id}', '{$cat_id}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        if(mysql_affected_rows() > -1){

            FUNCTIONS::xml_msg(1);
            exit();

        }else{

            FUNCTIONS::xml_msg(0);
            exit();

        }

    }


    public function EXPORT_CC(){

	$lang = $_GET['lang'];


        $result = mysql_query("SELECT id,d_name_".$lang." FROM `departments` WHERE `d_type` = 'city' and `d_active` = '1'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        $row_element_s1 = "cities";
        // Create a row node
        $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));

        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            // Loop the columns
            foreach ($row as $col => $val) {

		if($col == "id") $col = 'id';
                if($col == "d_name_".$lang."") $col = 'city';

                // if($col != 'd_name_ar' and $col != 'd_type' and $col != 'id' && $col != 'd_active'){
                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));
                //}

            }

        }

        $row_element_s2 = "categories";
        // Create a row node
        $rowNode = $rootNode->appendChild($dom->createElement($row_element_s2));

        $result = mysql_query("SELECT id, d_name_".$lang." FROM `departments` WHERE `d_type` = 'cat' and `d_active` = '1'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            // Loop the columns
            foreach ($row as $col => $val) {
		
		if($col == "id") $col = 'id';
                if($col == "d_name_".$lang."") $col = 'category';

                // if($col != 'd_name_ar' and $col != 'd_type' and $col != 'id' && $col != 'd_active'){
                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));
                //}

            }

        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
        
    }

    #index.php?task=api&action=places_list&city=riyadh&cat=hotels
    public function EXPORT_PLACES_LIST(){

	$lang = $_GET['lang'];

        $mycity = strtolower(trim($_GET['city']));

        $mycat = strtolower(trim($_GET['cat']));

        if(empty($mycity) or empty($mycat)) die("none");

        //$get_cid = mysql_result(mysql_query("SELECT id FROM `departments` WHERE LOWER(`d_name_en`) = '{$mycity}' and  `d_type` = 'city' and `d_active` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        //$get_did = mysql_result(mysql_query("SELECT id FROM `departments` WHERE LOWER(`d_name_en`) = '{$mycat}' and `d_type` = 'cat' and `d_active` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
       
        $get_cid = $mycity;

        $get_did = $mycat;

        $result = mysql_query("SELECT `name` as `place_name` ,  `phone_number` as `place_contact_number`,
        `gmap` as `place_latitude`,   `gmap` as `place_longitude` ,
        `website` as `place_tour_link` , `city` as `place_city`
        FROM `members` WHERE `city` = '{$get_cid}' and `dept_id` = '{$get_did}' and `activated` = '1'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);




        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            $row_element_s1 = "place";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));

            // Loop the columns
            foreach ($row as $col => $val) {

                if($col == 'place_latitude'){
                    $g = explode(",",$val);
                    $val = $g[0];
                }elseif($col == 'place_longitude'){
                    $g = explode(",",$val);
                    $val = $g[1];
                }elseif($col == 'place_city'){
                    $g = mysql_result( mysql_query("SELECT d_name_".$lang." FROM `departments` WHERE `id` = '{$val}'"), 0);
                    $val = $g;
                }


                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));

            }
        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
    }

    /**
     * USERCP::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}

