<?php
	/*
	The below PHP lines of code are required.
	Just copy and paste them at the top of your
	PHP file. Remember to open and close the PHP tags
	i.e. <?php Code_goes_here ?>
	*/
	require_once('contact_lib/recaptcha/recaptchalib.php');
	require_once('contact_lib/config.php');
	$resp = null;
	$error = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AFADAR JEWELRY :: Send Your Design</title>
<!-- BEGIN CSS -->
<link rel="stylesheet" type="text/css" href="contact_lib/style/css/body.css" media="screen" />
<link rel="stylesheet" type="text/css" href="contact_lib/style/css/contact.css" media="screen" />
<link href="contact_lib/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!-- END CSS -->
<!-- BEGIN SCRIPTS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="contact_lib/uploadify/swfobject.js"></script>
<script type="text/javascript" src="contact_lib/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script src="contact_lib/js/functions.js" type="text/javascript"></script>
<!-- END SCRIPTS -->
</head>
<body>
<!-- BEGIN CONTACT FORM CONTAINER-->
<div id="middle">

	<div class="midle_border">
		<h2>AFADAR JEWELRY</h2>
		<?
		/*
		The below PHP lines check if AddThis is enabled
		or disabled in the configuration file contact_lib/config.php.
		If it is enabled the AddThis feature will be added to the Contact Form.
		*/
		if($addthis) {
		?>

		<?}?>
		
		<p class="formTitle">Send Your Idea !</p>
		
		<form action="#" method="post" id="sendEmail" name="sendEmail">
				<div id="fields">
				<fieldset>
					<label for=nameFrom><span class="mandatory">* </span>Your Name:</label>
					<input type="text" name="nameFrom" id="nameFrom" value=""  class="textfield" autocomplete="off"/>
					<label for=emailFrom><span class="mandatory">* </span>Your Email:</label>
					<input type="text" name="emailFrom" id="emailFrom" value="" class="textfield" autocomplete="off"/>
					<?
						/*
						The below PHP lines check if GeoLocation is enabled
						or disabled in the configuration file contact_lib/config.php.
						If it is enabled the GeoLocation feature will be added to the Contact Form.
						*/
						if($location){
					?>
					<!-- GeoLocation BEGIN -->
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
					<script src="contact_lib/js/geolocation.js" type="text/javascript"></script>
					<article>
						<label for=location> Your Location:</label>
						<input type="text" name="location" id="location" value="" class="textfield" autocomplete="off"/>
						<div class="location_img"><img src="contact_lib/style/img/location.png"></div>
					</article>
					<!-- GeoLocation END -->
					<?}?>
					<label for=subject><span class="mandatory">* </span>Contacting us for?</label>
					<input type="text" name="subject" id="subject" value="" class="textfield" autocomplete="off"/>
					<div id="displayLater" style="display:none">
						<!-- BEGIN DISPLAY LATER -->
						<label for=message><span class="mandatory">* </span>Your Comment:</label>
						<textarea name="message" id="message"><?= $_POST['message'];?></textarea>
					
					<?php 
/*
The below PHP lines check if Uploadify is enabled
or disabled in the configuration file contact_lib/config.php.
If it is enabled the Upload feature will be added to the Contact Form.
*/
if($uploadify) {
echo "<label for=file_upload>Have Files?</label><input id=\"file_upload\" name=\"file_upload\" type=\"file\" />";
}

/*
The below PHP lines check if reCAPTCHA is enabled
or disabled in the configuration file contact_lib/config.php.
If it is enabled the reCAPTCHA feature will be added to the Contact Form.
*/
if($reCAPTCHA) {
?>
					<!-- BEGIN reCAPTCHA -->
					<div id="recaptcha_widget" style="display:none">
						<div id="recaptcha_image"></div>
						<div class="reload_recaptcha"><a href="javascript:Recaptcha.reload()"><img src="contact_lib/style/img/recaptcha.png"></a></div>
						<label for=recaptcha_response_field>Write what you see: </label>
						<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" size="25" autocomplete="off"/>
						<?= $_POST['recaptcha_response_field'];?>
					</div>
					<?php 
echo recaptcha_get_html($publickey, $error);
}
?>
					<!-- END reCAPTCHA -->
					<input type="submit" value="Ok, Done." name="submit" id="submit" class="submit"/>
					<div id="success" style="display:none">Thank you! Email sent successfully. We will answer as soon as possible.</div>
				</div>
				</fieldset>
			</div>
			<!-- END DISPLAY LATER -->
		</form>
	</div>
</div>
<!-- END CONTACT FORM CONTAINER -->
</body>
</html>
