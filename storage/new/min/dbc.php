<?php
//if($_SERVER['HTTP_HOST']=='localhost'){
	define("_path","/storage/");
	define("_server","localhost");
	define("_database","storage");
	define("_username","root");
	define("_password","");
	
/*}else{
	define("_path","/storage/");
//	define("_up_path","/uploads/");
	define("_server","localhost");
	define("_database","sajcom_storage");
	define("_username","sajcom_cvs");
	define("_password","&[s9_GyRb!Dh");
}*/

$link= mysql_connect("localhost",_username,_password);
mysql_select_db(_database,$link);

?>
