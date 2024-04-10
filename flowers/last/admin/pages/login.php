<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<title><? print SITE_NAME ?> - <? print $lang['login'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<meta http-equiv="Content-Language" content="ar-sy" />

<link rel="stylesheet" type="text/css" href="css/login.css" />
    
</head>
 
<body>
 
<div id="content" class="wrap">
	
	<div style="color: #eee; text-align: center; font-size: 0.90em; position: relative; top: 40px;"><strong>*</strong> Press <strong>Login</strong> to log into the <? print SITE_NAME ?> Control Panel. <strong>*</strong></div>
 
	<div id="loginContainer">
		<div id="loginBox">
			<div id="logo"></div>
			<div id="message"><span class="red"><?php print $message = ($message != '') ? $message : ''; ?> </span></div>
			
			<form id="loginForm" method="post" action="./index.php" name="loginForm">
				<div class="formRow clearfix">
					<div class="formImage"><img src="images/admin/user_image.jpg" alt="User" /></div>
					<div class="formField">
						<input type="text" maxlength="300" name='username' id="userName" value="" alt="username"/>
					</div>
				</div>
				
				<div class="formRow clearfix">
					<div class="formImage"><img src="images/admin/pass_image.jpg" alt="Pass" /></div>
					<div class="formField">
						<input type="password" maxlength="300" name='password' id="password" value="" alt="password"/>
					</div>
				</div>
 
				<div class="buttonRow clearfix">
					<input id="loginButton" type="image" value="login" src="images/admin/login_button.jpg" alt="Login" />
				</div>
                <input type="hidden" name="sub_ok" value="1" />
				<br />
			</form>
 
			<div id="loadingBox"></div>
		</div> <!-- end #loginBox -->
	</div> <!-- end #loginContainer -->
 
	<div id="footer">
		<p><strong><? print SITE_NAME ?></strong>. Copyright © 2009-2010 | All Rights Reserved</p>
	</div> <!-- end #footer -->
	
</div> <!-- end #content .wrap -->
 
</body>
</html>