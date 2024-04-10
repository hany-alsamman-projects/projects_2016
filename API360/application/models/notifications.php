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
 * notifications.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @pattern private
 * @copyright (c) 2013 vip4it.sa. All Rights Reserved
 * @access TEAM
 */

class NOTIFICATIONS extends CONTROLLERS{

    public function __construct()
    {

    }

    public function SUPPORT_USER(){

        ## account "ID"
        (int) $uid = trim($_REQUEST['uid']);

        ## device UUID
        $uuid = trim($_REQUEST['uuid']);

        // we check if everything is filled in
        if( empty($uuid)  )
        {
            FUNCTIONS::xml_msg(0);
            exit();
        }

        $get_uuid = @mysql_result(mysql_query("SELECT uuid FROM `notifications` WHERE `uuid` = '{$uuid}'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

        if( $uid == false OR $uid == true) {
            ## if the user not exits
            mysql_query("INSERT INTO `notifications`
            (`id`,`uuid`) VALUES
            (NULL , '{$uuid}')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

            if(mysql_affected_rows() > -1){
                FUNCTIONS::xml_msg(1);
                exit();
            }
        }elseif(!is_null($get_uuid) && $get_uuid > 0){
                ## update the exits user
                mysql_query("UPDATE `notifications` SET `user_id` = '{$uid}' WHERE `uuid` = '{$uuid}'");

                if(mysql_affected_rows() > -1){
                    FUNCTIONS::xml_msg(1);
                    exit();
                }
        }elseif( $uid > 0 && $uuid > 0) {

            $uid = @mysql_result(mysql_query("SELECT uuid FROM `notifications` WHERE `user_id` = '{$uid}'"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

            mysql_query("UPDATE `notifications` SET `user_id` = '{$uid}' WHERE `uuid` = '{$uuid}'");

            if($uid > 0){
                FUNCTIONS::xml_msg(2);
                exit();
            }
        }

        FUNCTIONS::xml_msg(0);
        exit();

    }

    public function __destruct()
    {

    }

} 