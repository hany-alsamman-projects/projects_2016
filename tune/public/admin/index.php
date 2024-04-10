<?
/**
 * index.php
 *
 * @package FOREX
 * @programmer Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

## Start the game
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"]. DS . 'tune'. DS .'public');

## Site configs
require_once (ROOT . DS . 'config' . DS . 'configs.php');
## Site shared
require_once (ROOT . DS . 'library' . DS . 'shared.php');
## Site profiler
require_once (ROOT . DS . 'config' . DS . 'profiler.php');

#define('SMARTY_DIR', dirname(__FILE__) . DS . 'library' . DS . 'smarty'. DS);

## world countries
require_once (ROOT . DS . 'library' . DS . 'countries.php');

## ADMIN TEMPLATE
define("TEMPLATE" , ROOT . DS . 'application' . DS . 'views' . DS . 'admin');


header('Content-Type: text/html; charset=utf-8');

$panel = new FOREX_CPANEL();
 
$panel->DASHBOARD();

#ob_end_flush();

?>