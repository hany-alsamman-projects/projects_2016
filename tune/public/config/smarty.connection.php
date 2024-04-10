<?php

//#######################################
//# Use Smarty.class.php in this file. 
//#######################################

require_once(SMARTY_DIR.'Smarty.class.php');

//##############################
//# Create a new Smarty object 
//##############################

$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->caching = false;
$smarty->debugging = false; // Uncomment this if you want to see the debugging window pop up when you call a template!

//###########################################################
//# Setup the Smarty template engine's directory structure. 
//# (gnd is my personal project directory!) 
//###########################################################

$smarty->template_dir = ROOT . DS . 'application' . DS . 'views';
$smarty->template_style = ROOT . DS . 'files'. DS . 'img'. DS;
$smarty->compile_dir = ROOT . DS .'tmp'. DS . 'views_cache';
$smarty->config_dir = ROOT.'configs';
$smarty->cache_dir = ROOT.'cache';

$smarty->assign('IMAGE_DIR',$smarty->template_style);

define("IMAGE_DIR", $smarty->template_style);

?>
