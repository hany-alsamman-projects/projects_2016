<?php

/**
 * INDEX.php
 *
 * @package INDEX
 * @author Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access CODEXC TEAM
 */
 
## Start the game
@session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER["DOCUMENT_ROOT"]. DS . "flowers");
define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);
define('DEVELOPMENT_ENVIRONMENT',true); 
define('COMPRESS_OUTPUT',true);
define("DEFAULT_LANG", "en");

## Site configs
require_once (ROOT . DS . 'config' . DS . 'configs.php');

## Site shared
require_once (ROOT . DS . 'library' . DS . 'shared.php');

## Site lang
require_once (ROOT . DS . 'library' . DS . 'lang.php');

require_once (ROOT . DS . 'config' . DS . 'smarty.connection.php');

## Safely initialize an object from the class
$core = new CONTROLLERS();

header('Content-type: text/html; charset=windows-1256');

echo $core->MAIN_DISPLAY();

//ob_end_flush();

?>