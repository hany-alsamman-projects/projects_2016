<?php



/** Check if environment is development and display errors **/



function setReporting() {

    if (DEVELOPMENT_ENVIRONMENT == true) {
    
    	error_reporting(7);
    
    	ini_set('display_errors','On');
    
    } else {
    
    	error_reporting(7);
    
    	ini_set('display_errors','Off');
    
    	ini_set('log_errors', 'On');
    
    	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    
    }

}



/** Check for Magic Quotes and remove them **/



function stripSlashesDeep($value) {

	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);

	return $value;

}



function removeMagicQuotes() {

if ( get_magic_quotes_gpc() ) {

	$_GET    = stripSlashesDeep($_GET   );

	$_POST   = stripSlashesDeep($_POST  );

	$_COOKIE = stripSlashesDeep($_COOKIE);

}

}



/** Check register globals and remove them **/



function unregisterGlobals() {

    if (ini_get('register_globals')) {

        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');

        foreach ($array as $value) {

            foreach ($GLOBALS[$value] as $key => $var) {

                if ($var === $GLOBALS[$key]) {

                    unset($GLOBALS[$key]);

                }

            }

        }

    }

}



/** Autoload any classes that are required **/



function __autoload($className) {

	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.php')) {

		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.php');

	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {

		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');

	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {

		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {

		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');

	} else if (file_exists(ROOT . DS . 'admin' . DS . $className . '.php')) {

		require_once(ROOT . DS . 'admin' . DS . $className . '.php');

	} else {

		/* Error Generation Code Here */

	}

}



// Is compression requested?

if (COMPRESS_OUTPUT === TRUE)

{

	if (extension_loaded('zlib'))

	{

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)

		{

			ob_start('ob_gzhandler');

		}

	}else{

	

		ob_start();

	

	}

}



setReporting();

removeMagicQuotes();

unregisterGlobals();