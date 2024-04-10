<?php

/**
 * INDEX.php
 *
 * @package INDEX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 م
 * @access TEAM
 */
 
@session_start();

error_reporting(7);

header('Cache-control: private'); // IE 6 FIX

if ( !defined( 'DIRECTORY_SEPARATOR' ) ) define( 'DIRECTORY_SEPARATOR',strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/') ;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"]. DS . 'tune' . DS . 'public');
define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);



## Site configs
require_once (ROOT . DS . 'config' . DS . 'configs.php');
## Site shared
require_once (ROOT . DS . 'library' . DS . 'shared.php');
## Site profiler
require_once (ROOT . DS . 'config' . DS . 'profiler.php');
## world countries
require_once (ROOT . DS . 'library' . DS . 'countries.php');

require_once (ROOT . DS . 'lang' . DS . LANG_FILE);


header('Content-Type: text/html; charset=utf-8');

## Safely initialize an object from the class
$core = new CONTROLLERS();
echo $core->MAIN_DISPLAY();

ob_end_flush();

?>
