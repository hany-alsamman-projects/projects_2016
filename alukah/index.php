<?php

/**
 * INDEX.php
 *
 * @package INDEX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11
 * @access TEAM
 */

session_name("UI");
@session_start();

header('Cache-control: private'); // IE 6 FIX
Header("Cache-Control: no-transform");

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"].'' . DS . 'alukah');
define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);

## Site configs
require_once (ROOT . DS . 'config' . DS . 'profiler.php');
## world countries
require_once (ROOT . DS . 'library' . DS . 'countries.php');

require_once (ROOT . DS . 'lang' . DS . LANG_FILE);

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

//sheader('Content-Type: text/html; charset=UTF-8');

## Safely initialize an object from the class
$core = new CONTROLLERS();
echo $core->MAIN_DISPLAY();

ob_end_flush();

?>
