<?php 

 //@session_start();
 //error_reporting(0);
define("SITE_DIR","http://afadar-jewelry.com/en");

define("UPLOAD_URL","http://127.0.0.1/afadar/upload/");

define("UPLOAD_PATH",$_SERVER["DOCUMENT_ROOT"]."/afadar/upload/");

define("SITE_NAME","AFADAR JEWELRY");

define ('IN_SCRIPT', 1 );

## Site internal path
define("SITE_PATH", $_SERVER["DOCUMENT_ROOT"]."/afadar/en/public");

function __autoload($className)
{
	if (file_exists(SITE_PATH . '/includes/' . $className . '.php')) {
		require_once(SITE_PATH . '/includes/' . $className . '.php');
		
	}elseif (file_exists(SITE_PATH . '/admin/' . $className . '.php')) {
		require_once(SITE_PATH . '/admin/' . $className . '.php');
	
	}elseif (file_exists(SITE_PATH . '/library/' . $className . '.php')) {
		require_once(SITE_PATH . '/library/' . $className . '.php');

	}else{
		/* Error Generation Code Here */
	}
}


/** Check if environment is development and display errors **/

function setReporting() {
		// Report simple running errors
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_STRICT);
		//ini_set('display_errors','Off');
		//ini_set('log_errors', 'On');
		//ini_set('error_log', SITE_PATH.'/tmp/'.'/logs/'.'error.log');
}


?>