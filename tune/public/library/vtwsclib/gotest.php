<?php

include_once('Vtiger/WSClient.php');
$url = 'http://en.vtiger.com/wip';
$client = new Vtiger_WSClient($url);
$login = $client->doLogin('admin', 'KpS9EjNz16JtPmoe');
if(!$login) echo 'Login Failed';
else echo 'Login Successful';

?>