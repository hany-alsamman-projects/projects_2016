<?php
/*
This email can work with HTML tags. You are free to modify the template of this email.
Just have in mind that many Email services, like Gmail, do not accept complex email
templates. So use very basic HTML tags and do not include stylesheets or javascript codes.
Is also a good practice to use Tables instead of DIVs.
*/
require_once('config.php');
require_once('uploadify/uploadify.php');

$subject = $_POST['subject'];
$headers = "From: " . strip_tags($_POST['emailFrom']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message .= '<html><body>';
$message .="<strong>Name:</strong> ".$_POST['emailTo']."<br/>";
if($location){
$message .= "<strong>Location:</strong> ".$_POST['location']."<br/>";
}
$message .="<strong>Message:</strong> ".$_POST['message']."<br/>";
if($uploadify){
$message .= "<strong>Files:</strong> ".$_POST['uploadifyFiles'];
}
$message .= '</body></html>';
mail($mailTo, $subject, $message, $headers);
?>