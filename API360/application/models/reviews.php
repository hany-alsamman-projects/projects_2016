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
 * Reviews.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @pattern private
 * @copyright (c) 2013 vip4it.sa. All Rights Reserved
 * @access TEAM
 */

class REVIEWS extends CONTROLLERS
{

    public function __construct()
    {

    }

    /**
     * Get reviews for an place by passing place id
     * @guide API to get the reviews, photos and ratings by passing the place_id
     * @link index.php?task=api&do=get_review&place_id=<int>
     * @string (int) $place_id
     * @return print xml feed
     */
    public function GET_REVIEW(){


        $place_id = trim($_REQUEST['place_id']);

        $result = @mysql_query("SELECT id as review_id, id as review_user, user_id as review_user_image , user_id as review_user_id , review_time_stamp, review_description, review_rating FROM `reviews` WHERE place_id = '{$place_id}'");

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


                if($col == "review_user"){
                    $val = @mysql_result(mysql_query("SELECT name FROM `members` WHERE `id` = '{$val}'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                }

                if($col == "review_user_image"){
                    $val = @mysql_result(mysql_query("SELECT avatar FROM `members` WHERE `id` = '{$val}'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
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
     * Submit review into an place by place id
     * @guide API to send the review and rating for the place.
     * @link index.php?task=api&do=add_review
     * @string (int) $uid
     * @string (int) $place_id
     * @string (text) $review_description
     * @string (float) $review_rating
     * @return status
     */
    public function ADD_REVIEW(){

        // we check if everything is filled in
        if( empty($_POST['uid']) )
        {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        $user_id = @mysql_result(mysql_query("SELECT id FROM `members` WHERE `id` = '{$_POST[uid]}' and `activated` = '1'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        $place_id = $_POST['place_id'];

        if(empty($user_id)){
            FUNCTIONS::xml_msg(0);
            exit();
        }

        $review_description = trim($_POST['review_description']);

        $review_rating = (trim($_POST['review_rating']) == false) ? null : trim($_POST['review_rating']);

        mysql_query("INSERT INTO `reviews`
        (`id` ,`user_id` ,`review_description`,`review_rating` ,`place_id`) VALUES
        (NULL , '{$user_id}', '{$review_description}', '{$review_rating}' , '{$place_id}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


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
