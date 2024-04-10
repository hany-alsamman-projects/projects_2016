<?
if($_GET['auth'] == 'yes'){
?>

<div class="registered">
<h1><?=$this->lang['LOGIN_MSG_SUCCESS']?></h3>
<h3><?=$this->lang['MSG_AUTO_REDI']?></h3>
<meta http-equiv="Refresh" content="2; URL=./index.php?action=usercp">
</div>

<? }else{ ?>

<div id="div-regForm">

<div class="form-title"><?=$this->lang['LABEL_LOGIN']?></div>
<div class="form-sub-title"></div>

<form id="regForm" action="index.php?task=login" method="post">

<table>
  <tbody>
  <tr>
    <td><label for="email"><?=$this->lang['LABEL_FIELD_LOGIN']?>:</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="pass"><?=$this->lang['LABEL_FIELD_PASS']?>:</label></td>
    <td><div class="input-container"><input name="password" id="pass" type="password" /></div></td>
  </tr>
  <tr>
  <tr>
  <td>&nbsp;</td>
  <td><input type="submit" class="greenButton" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
</td>
  </tr>
  
  
  </tbody>
</table>

</form>

<div id="error">
&nbsp;
</div>

</div>

<? } ?>