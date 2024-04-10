<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, vip4it.sa. All Rights Reserved.                     |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER vip4it.sa TEAM (PRIVETE ACCESS ONLY)	        |
'---------------------------------------------------------------------------'
*/

/**
 * PLACES.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @pattern private
 * @copyright (c) 2013 vip4it.sa. All Rights Reserved
 * @access TEAM
 */

class PLACES extends CONTROLLERS
{

    public function __construct()
    {

    }

    /**
     * Get photos by passing place id
     * @link index.php?task=api&do=get_photo&place_id=
     * @guide API to get the photos uploaded by the users by passing the place_id
     * @string (int) $place_id
     * @return print xml feed
     */
    public function GET_PHOTO(){


        $place_id = trim($_REQUEST['place_id']);

        $result = @mysql_query("SELECT id as photo_id , user_id as photo_user , place_image as place_url, place_info as photo_desecription, place_time_stamp as photo_time_stamp, user_id as photo_user_id  FROM `places_images` WHERE place_id = '{$place_id}'");

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


                if($col == "photo_user"){
                    $get_uid = @mysql_result(mysql_query("SELECT name FROM `members` WHERE `id` = '{$val}'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    $val = $get_uid;
                }

                if($col == "place_url"){
                    $val = end(explode("/",$val));
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
     * Get campaign places
     * index.php?task=api&do=campaign_place
     * @return void() xml feed
     */
    public function GET_PLACES(){

        //$get_uid = @mysql_result(mysql_query("SELECT id FROM `members` WHERE activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        $result = @mysql_query("
        SELECT `tour_requests`.`id` as place_id , `tour_requests`.`place_name` , `tour_requests`.`phone_number` AS `place_contact_number` ,
`tour_requests`.`place_link` AS `place_tour_link` , `tour_requests`.`place_image` ,
`tour_requests`.`latitude` AS place_latitude, `tour_requests`.`longitude` AS place_longitude, `tour_requests`.`place_info`,
reviews.review_rating as place_rating , count(reviews.id) as place_reviews
FROM `tour_requests`
LEFT JOIN `reviews` ON tour_requests.id = reviews.place_id
WHERE `tour_requests`.campaign_place = '1'
AND tour_requests.`approved` = '1'
        ");


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

    /**
     * Upload photo with description into an place
     * @guide API to upload the photo with description.
     * @link index.php?task=api&do=add_place_img
     * @string (int) $uid
     * @string (int) $place_id
     * @string (text) $place_info
     * @string (file) $userfile
     * @action upload photo and add it to DB
     * @return status
     */
    public function ADD_PLACE_IMG(){

        ## account "ID"
        $uid = strtolower(trim($_REQUEST['uid']));

        $pid = strtolower(trim($_REQUEST['place_id']));

        $user_id = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `id` = '{$uid}' and `activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        $place_id = @mysql_result(mysql_query("SELECT id FROM `tour_requests` WHERE `id` = '{$pid}' and `approved` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        if(empty($user_id) or empty($place_id)){
            FUNCTIONS::xml_msg(0);
            exit();
        }

        $place_info = $_POST['place_info'];

        if(isset($_FILES['userfile'])){

            //add time to the current filename
            $name = basename($_FILES['userfile']['name']);
            list($txt, $ext) = explode(".", $name);
            $name = $txt.time();
            $name = $name.".".$ext;

            $target_path = '/home/virtualt/public_html/api/upload/';

            if(!$_FILES['userfile']['name']) die('have no files to uploads');
            if($ext == "jpg" or $ext == "png" or $ext == "gif"){

                $target_path = $target_path . trim($name);

                if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
                    //echo "The file ".  basename( $_FILES['userfile']['name']). " has been uploaded";
                    $place_image = $target_path;
                } else{
                    //echo "There was an error uploading the file, please try again!";
                }
            }

            //$status = parent::is_image($image);
        }

        //if($status == false) FUNCTIONS::xml_msg(0); exit();

        mysql_query("INSERT INTO `places_images`
        (`id`,`place_id` ,`place_image` ,`place_info` ,`user_id`) VALUES
        (NULL , '{$place_id}' ,'{$place_image}', '{$place_info}', '{$user_id}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        if(mysql_affected_rows() > -1){
            FUNCTIONS::xml_msg(1);
            exit();
        }else{
            FUNCTIONS::xml_msg(0);
            exit();
        }
    }


    public function __destruct()
    {
    	
    }
    
}
