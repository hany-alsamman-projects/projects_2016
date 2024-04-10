<?php

/** Check if environment is development and display errors **/

function setReporting() {
	error_reporting(E_ALL);
	//ini_set('display_errors','Off');
	//ini_set('log_errors', 'On');
	//ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}

setReporting();