<!DOCTYPE html>
<html lang="en">
<head>

	<title><? print SITE_NAME ?></title>
	<meta charset="utf-8">
	
	<!-- Combined stylesheets load -->
	<link href="css/mini.php?files=reset,common,form,standard,special-pages" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	
	<!-- Combined JS load -->
	<!-- html5.js has to be loaded before anything else -->
	<script type="text/javascript" src="js/mini.php?files=html5,jquery.min,old-browsers,common,standard,jquery.tip.js"></script>
	<!--[if lte IE 8]><script type="text/javascript" src="js/standard.ie.js"></script><![endif]-->
	
	<!-- example login script -->
	<script type="text/javascript">
	
		$(document).ready(function()
		{
			// We'll catch form submission to do it in AJAX, but this works also with JS disabled
			$('#login-form').submit(function(event)
			{
				// Stop full page load
				event.preventDefault();
				
				// Check fields
				var login = $('#login').val();
				var pass = $('#pass').val();
				
				if (!login || login.length == 0)
				{
					$('#login-block').removeBlockMessages().blockMessage('Please enter your user name', {type: 'warning'});
				}
				else if (!pass || pass.length == 0)
				{
					$('#login-block').removeBlockMessages().blockMessage('Please enter your password', {type: 'warning'});
				}
				else
				{
					var submitBt = $(this).find('button[type=submit]');
					submitBt.disableBt();
					
					// Target url
					var target = $(this).attr('action');
					if (!target || target == '')
					{
						// Page url without hash
						target = document.location.href.match(/^([^#]+)/)[1];
					}
					
					// Request
					var data = {
						a: $('#a').val(),
						username: login,
						password: pass,
						'keep-logged': $('#keep-logged').attr('checked') ? 1 : 0
					};
					var redirect = $('#redirect');
					if (redirect.length > 0)
					{
						data.redirect = redirect.val();
					}
					
					// Start timer
					var sendTimer = new Date().getTime();

					// Send
					$.ajax({
						url: target,
						dataType: 'json',
						type: 'POST',
						data: data,
						success: function(data, textStatus, XMLHttpRequest)
						{
						  
							if (data.valid)
							{
								// Small timer to allow the 'cheking login' message to show when server is too fast
								var receiveTimer = new Date().getTime();
								if (receiveTimer-sendTimer < 500)
								{
									setTimeout(function()
									{
										document.location.href = data.redirect;
										
									}, 500-(receiveTimer-sendTimer));
								}
								else
								{
									document.location.href = data.redirect;
								}
							}
							else
							{
								// Message
								$('#login-block').removeBlockMessages().blockMessage(data.error || 'An unexpected error occured, please try again', {type: 'error'});
								
								submitBt.enableBt();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown)
						{
							// Message
							$('#login-block').removeBlockMessages().blockMessage('Error while contacting server, please try again', {type: 'error'});
							
							submitBt.enableBt();
						}
					});
					
					// Message
					$('#login-block').removeBlockMessages().blockMessage('Please wait, cheking login...', {type: 'loading'});
				}
			});
		});
	
	</script>
	
</head>

<!-- the 'special-page' class is only an identifier for scripts -->
<body class="special-page login-bg">
<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie, .ie7 or .ie6 prefix to your css selectors when needed -->
<!--[if lt IE 9]><div class="ie"><![endif]-->
<!--[if lt IE 8]><div class="ie7"><![endif]-->

	<section id="message">
		<div class="block-border"><div class="block-content no-title dark-bg">
			<p class="mini-infos">For demo website, use <b>admin</b> / <b>admin</b></p>
		</div></div>
	</section>
	
	<section id="login-block">
		<div class="block-border"><div class="block-content">
			
			<!--
			IE7 compatibility: if you want to remove the <h1>, 
			add style="zoom:1" to the above .block-content div
			-->
			<h1>Codex CMS</h1>
			<div class="block-header">Please login</div>
				
			<?php
			
			if ($error)
			{
				?><p class="message error no-margin"><?php echo htmlspecialchars($error); ?></p>
			
			<?php
			}
			
			?><form class="form with-margin" name="login-form" id="login-form" method="post" action="">
				<input type="hidden" name="a" id="a" value="send">
				<?php
				
				// Check if a redirect page has been forwarded
				if (isset($_REQUEST['redirect']))
				{
					?><input type="hidden" name="redirect" id="redirect" value="<?php echo htmlspecialchars($_REQUEST['redirect']); ?>">
				<?php
				}
				
				?><p class="inline-small-label">
					<label for="login"><span class="big">User name</span></label>
					<input type="text" name="username" id="login" class="full-width" value="<?php if (isset($_POST['username'])) { echo htmlspecialchars($_POST['username']); } ?>">
				</p>
				<p class="inline-small-label">
					<label for="pass"><span class="big">Password</span></label>
					<input type="password" name="password" id="pass" class="full-width" value="">
				</p>
				
				<button type="submit" class="float-right">Login</button>
				<p class="input-height">
					<input type="checkbox" name="keep-logged" id="keep-logged" value="1" class="mini-switch"<?php if (!isset($_POST['keep-logged']) or $_POST['keep-logged'] == 1) { echo ' checked="checked"'; } ?>>
					<label for="keep-logged" class="inline">Keep me logged in</label>
				</p>
			</form>
			
			<form class="form" id="password-recovery" method="post" action="">
				<fieldset class="grey-bg no-margin collapse">
					<legend><a href="#">Lost password?</a></legend>
					<p class="input-with-button">
						<label for="recovery-mail">Enter your e-mail address</label>
						<input type="text" name="recovery-mail" id="recovery-mail" value="">
						<button type="button">Send</button>
					</p>
				</fieldset>
			</form>
		</div></div>
	</section>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->
</body>
</html>