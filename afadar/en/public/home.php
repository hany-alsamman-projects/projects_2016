<?php
/**
 * index.php
 *
 * @package afadar-jewelry
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @author Hany alsamman (Project administrator && Original founder)
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */

//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require_once ('./configs.php'); //configs for site
//require_once ('./lang/en.php'); //lang as selected

//ob_start();
setReporting();

// Safely initialize an object from the class
$core = new AFADAR_CORE();

echo $core->MAIN_DISPLAY();

//ob_end_flush();

?>