<?
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

## Start the game
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"].'' . DS . 'API');

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
