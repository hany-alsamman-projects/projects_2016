<?
/**
 * index.php
 *
 * @package WIX
 * @programmer Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

## Start the game
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"].'' . DS . 'API360');

## Site configs
require_once (ROOT . DS . 'config' . DS . 'configs.php');
## Site configs
require_once (ROOT . DS . 'config' . DS . 'profiler.php');
#define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);
## world countries
require_once (ROOT . DS . 'library' . DS . 'countries.php');

## ADMIN TEMPLATE
define("TEMPLATE" , ROOT . DS . 'application' . DS . 'views' . DS . 'admin');

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

header('Content-Type: text/html; charset=UTF-8');

$panel = new LINKS_CPANEL();

$panel->DASHBOARD();

ob_end_flush();

?>
