<?php
/*
This file simply checks if the entered reCAPTCHA is correct or not.
If correct it will return "success", if not "unsuccess".
This file is called by the file contact_lib/js/functions.js
*/
require_once('recaptchalib.php');
require_once('../config.php');

$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if ($resp->is_valid) {
    ?>success<?
}
else 
{
  ?>unsuccess<?
}
?>
