<?
if($_GET['auth'] == 'yes'){
?>

<div class="registered">
<h1><?=$this->lang['LOGIN_MSG_SUCCESS']?></h3>
<h3><?=$this->lang['MSG_AUTO_REDI']?></h3>
<meta http-equiv="Refresh" content="2; URL=https://tune-forex.com/en/index.php" />
</div>

<? }else{ ?>

<div id="div-regForm">

<div class="form-title"><?=$this->lang['LABEL_LOGIN']?></div>
<div class="form-sub-title"></div>


<div class="msg msg-info">
<p><small>welcome to tune forex client secured area . please log in by entering yoru email ID and password</small></p>
</div>

<form id="regForm" action="index.php?task=login" method="post">

<div style="background: url(images/login_bg.png) center center no-repeat; margin: 0px auto; width: 450px; height: 371px; position: relative;">
    
    <div style="position: absolute; top: 80px; right:0; left:80px; width: 50%;">
    

        <label for="email"><?=$this->lang['LABEL_FIELD_LOGIN']?>:</label>
        <div class="input-container"><input name="email" id="email" type="text" /></div>
        
        <label for="pass"><?=$this->lang['LABEL_FIELD_PASS']?>:</label>
        <div class="input-container"><input name="password" id="pass" type="password" /></div>
        
        <div class="input-container"><a href="index.php?action=reset"><? print $this->lang['LABEL_forget']?></a></div>
        
        
        <input type="submit" class="greenButton" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />

        
        <div id="error" class="msg msg-error">
        <p></p>
        </div>
    
    </div>

</div>

</form>



</div>

<? } ?>