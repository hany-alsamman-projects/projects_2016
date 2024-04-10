<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','0');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');
define('ADD_LAST_ACTIVITY','1');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */


// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',					'localhost'								);
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				'mhd'									);
define('DB_PASSWORD',				'databaseelect'								);
define('DB_NAME',					'syriandb_sdb'								);
define('TABLE_PREFIX',				''										);
define('DB_USERTABLE',				'profiles'									);
define('DB_USERTABLE_NAME',			'display_name'								);
define('DB_USERTABLE_USERID',		'user_id'								);
define('DB_USERTABLE_LASTACTIVITY',	'lastactivity'							);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;
	
	if (!empty($_SESSION['userid'])) {
		$userid = $_SESSION['userid'];
	}

	return $userid;
}


function getFriendsList($userid,$time) {

    $sql = ("SELECT DISTINCT profiles.user_id AS userid, profiles.display_name AS username, profiles.lastactivity, cometchat_status.message, cometchat_status.status
             FROM profiles
             LEFT JOIN cometchat_status ON profiles.user_id = cometchat_status.userid
             WHERE user_id <> '".mysql_real_escape_string($userid)."' ORDER BY display_name ASC");
    
    return $sql;
}

function getUserDetails($userid) {
	$sql = ("select profiles.user_id AS userid, profiles.display_name, profiles.lastactivity, cometchat_status.message, cometchat_status.status from 
profiles left join cometchat_status on user_id = cometchat_status.userid where user_id = ".mysql_real_escape_string($userid)." ");
	return $sql;
}


function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select ".TABLE_PREFIX."users.status message, cometchat_status.status from ".TABLE_PREFIX."users left join cometchat_status on ".TABLE_PREFIX."users.user_id = cometchat_status.userid where ".TABLE_PREFIX."users.user_id = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function getLink($link) {
	return "http://www.syriandramabook.com/users/profile/view/".$link;
}

function getAvatar($image) {

	return "http://www.syriandramabook.com/uploads/files/no_avatar.jpg";

}


function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
//	$sql = ("update ".TABLE_PREFIX."users set status = '".mysql_real_escape_string($statusmessage)."', status_date = '".getTimeStamp()."' where user_id = '".mysql_real_escape_string($userid)."'");
// 	$query = mysql_query($sql);
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

// Fuck You Nadri, XripX and all other leechers who will steal my Cometchat and post it on your gay forum without giving credit to the original poster
// Remember! SEF is the no1 forum and nobody can beat us
// Long life to SEF

$p_ = 4;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


