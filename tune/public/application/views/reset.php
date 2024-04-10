<?
if($_GET['auth'] == 'yes'){
?>

<div class="registered">
<h1><?=$this->lang['LOGIN_MSG_SUCCESS']?></h3>
<h3><?=$this->lang['MSG_AUTO_REDI']?></h3>
<meta http-equiv="Refresh" content="2; URL=./index.php">
</div>

<? }else{ ?>



<div id="div-regForm">

<div class="form-title"><? print $this->lang['LABEL_forgetpass']?></div>
<div class="form-sub-title"></div>


<div class="msg msg-info">
<p><small>To change your lost password, please supply the name and e-mail address you submitted at registration. Your password will be e-mailed to you immediately. </small></p>
</div>

<form id="regForm" action="index.php?task=reset" method="post">

<div style="background: url(images/login_bg.png) center center no-repeat; margin: 0px auto; width: 450px; height: 371px; position: relative;">
    
    <div style="position: absolute; top: 70px; right:0; left:80px; width: 50%;">

        <label for="email"><?=$this->lang['LABEL_FIELD_LOGIN']?>:</label>
        <div class="input-container"><input name="email" id="email" type="text" /></div>
        
<!--
        <label for="newpass"><?=$this->lang['LABEL_FIELD_NEWPASS']?>:</label>
        <div class="input-container"><input name="newpass" id="newpass" type="text" /><a href="#" class="generate" id="generate"><small>Generate Password</small></a></div>
        
-->
        <input name="reset" id="reset" type="hidden" value="1" />
        <input type="submit" class="greenButton" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
        
        <div id="error" class="msg msg-warn">
        <p></p>
        </div>
    
    </div>

</div>

</form>



</div>

<? } ?>