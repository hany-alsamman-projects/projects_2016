<?
/**
 * index.php
 *
 * @package afadar-jewelry
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

session_start();

require_once('../configs.php');
require_once('../lang/en.php');

//setReporting();

$panel = new AFADAR_CPANEL();

$panel->DASHBOARD();


?>