<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
    <head>
	
        <meta http-equiv="content-type" content="text/html; charset=windows-1256" />
        <meta http-equiv="content-style-type" content="text/css" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        
        <title>Control Panel :: Login</title>
        
        <link rel="stylesheet" type="text/css" href="css/blue.css" media="screen, projection, tv" />  
        <!--[if lte IE 7.0]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen, projection, tv" /><![endif]-->
		<!--[if IE 8.0]>
			<style type="text/css">
				form.fields fieldset {margin-top: -10px;}
			</style>
		<![endif]-->

		
		<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
		<!-- Adding support for transparent PNGs in IE6: -->
		<!--[if lte IE 6]>
			<script type="text/javascript" src="js/ddpng.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('h3 img');
			</script>
		<![endif]-->
		
    </head>
    <body id="login">

		<div class="box box-50 altbox">
			<div class="boxin">
				<div class="header">

					<h3>Control Panel</h3>
					<ul>
						<li><a href="#" class="active">login</a></li><!-- .active for active tab -->
					</ul>
				</div>
				<form class="table" action="index.php" method="post"><!-- Default forms (table layout) -->
					<div class="inner-form">

						<div class="msg msg-info">
							<p><? if($message != ''){print $message;}?></p>
						</div>
						<table cellspacing="0">
							<tr>
								<th><label for="some1">Name:</label></th>
								<td><input class="txt" type="text" id="some1" name="username" /></td>

							</tr>
							<tr>
								<th><label for="some3">Password:</label></th>
								<td><input class="txt pwd" type="password" id="some3" name="password" /></td><!-- class error for wrong filled inputs -->
							</tr>
							<tr>
								<th></th>
								<td class="tr proceed">
                                    <input type="hidden" name="sub_ok" value="1" />
									<input class="button" type="submit" value="Log in" />
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>

    </body>
</html>