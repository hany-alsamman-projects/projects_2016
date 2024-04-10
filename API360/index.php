<?php

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

session_name("UI");
@session_start();

header('Cache-control: private'); // IE 6 FIX

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"].'' . DS . 'API360');
define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);

error_reporting(7);

## Site configs
require_once (ROOT . DS . 'config' . DS . 'configs.php');

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
