<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "<h1>Incorrect access</h1>You cannot access this file directly.";
        exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
<meta content="ar-sy" http-equiv="Content-Language" />
<title><? print SITE_NAME ?></title>

</head>

<body>

<table width="800" style="border:solid; border-color:#000000; border-width:1px" align="center" cellpadding="5" cellspacing="0">
  <tr>
  <td width="237" rowspan="3"><img src="images/logo.jpg" /></td>
    <td height="33%" align="left" style="padding-top:0; padding-bottom:0"><? print SITE_NAME ?> :: <a href="#" onclick="javascript:PrintPage()">PRINT NOW</a></td>
  </tr>
  <tr>
    <td height="33%" align="right" valign="top" style="font-family:tahoma; font-size:12px; padding-top:0; padding-bottom:0">
	Publish Date : <?php echo @date("F j, Y, g:i a",$GetNews[0]['start_date'])?>  </td>
  </tr>
  <tr>
    <td height="33%" align="right" valign="top" style="font-family:tahoma; font-size:12px; padding-top:0; padding-bottom:0">
    Views Count : <?php echo $GetNews[0]['views']; ?> </td>
  </tr>  
  </tr>
  <tr>
  	<td align="center" colspan="2">
	<div>
    	<div style="padding-right:10px"> 
			<div align="right">
            <br>
			 <b><?php echo stripslashes($GetNews[0]['t_title']); ?></b>		      
             </div>
    	</div>
      <div style="padding:10px;">
                <div align="justify" dir="rtl" style="font-family:tahoma; font-size:12px">
                	<?php echo htmlspecialchars_decode(stripslashes($GetNews[0]['t_content'])); ?>
				</div>
      </div>
	<br>
		<div>
			<div align="center" style="font-family:tahoma; font-size:12px" >All Rights Reserved © 2011 for <? print SITE_NAME ?></div>
        </div>
      </div>    	
      </td>
    </tr>
</table>

<script language="JavaScript">
function PrintPage()
{
	window.print();
}
</script>

</body>

</html>