<?
/**
 * index.php
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', ''.$_SERVER["DOCUMENT_ROOT"].'');

session_start();

## Site Lang
require_once (ROOT . DS . 'library' . DS . 'lang.php');

## Site Config
require_once (ROOT . DS . 'config' . DS . 'configs.php');

## Site shared
require_once (ROOT . DS . 'library' . DS . 'shared.php');


$panel = new CLIMA_CPANEL();

$panel->DASHBOARD();


?>