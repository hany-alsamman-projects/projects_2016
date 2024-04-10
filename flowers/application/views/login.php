<?
if($_GET['auth'] == 'yes'){
?>

<div class="registered">
<h1>Login successful</h3>
<h3>now automatically redirect to main page</h3>
<meta http-equiv="Refresh" content="2; URL=./index.php">
</div>

<? }else{ ?>

<div style="width: 80%;" id="div-regForm">

<div class="form-title">Login</div>
<div class="form-sub-title"></div>

<form id="regForm" style="float: left;" action="index.php?task=login&order=<?=$_GET['order']?>" method="post">

<table>
  <tbody>
  <tr>
    <td><label for="email">Email :</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="pass">Password:</label></td>
    <td><div class="input-container"><input name="password" id="pass" type="password" /></div></td>
  </tr>
  
  <tr>
    <td><label for="pass">Register?:</label></td>
    <td><div class="input-container"><a href="index.php?action=Register" target="_self"><small><u>Click Here NOW !</u></small></a></div></td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td><input type="submit" class="greenButton" value="Login" /><img id="loading" src="images/loading.gif" alt="working.." />
</td>
  </tr>
  
  </tbody>
</table>

</form>

<div style="float: right; margin-bottom: 30px;">
<iframe src="http://www.facebook.com/plugins/likebox.php?id=131580500243152&width=292&connections=10&stream=false&=false&header=false&height=270" scrolling="no" frameborder="0" style="border:none; overflow:hidden; float:right; width:292px; height:270px;" allowTransparency="true"></iframe>
</div>

<div style="clear: both" class="msg msg-error" id="error"><p></p></div>


<?php

if($_GET['order']) print '<div style="clear: both" class="msg msg-warn"><p>your need login with account for access order product section.</p></div>';

?>

</div>



<? } ?>