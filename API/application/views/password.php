<div>

<a href="index.php?action=usercp&pro=profile"><span><?=$this->lang['USERCP_LABEL_CHPRO']?></span></a> -- 
<a href="index.php?action=usercp&pro=password"><span><?=$this->lang['USERCP_LABEL_CHPASS']?></span></a> -- 
<a href="index.php?action=usercp&pro=picture"><span><?=$this->lang['USERCP_LABEL_CHPIC']?></span></a>

</div>

<div id="div-regForm">

<div class="form-title"></div>
<div class="form-sub-title">Change Password Area</div>

<form id="regForm" action="index.php?task=password" method="post">

<table style="line-height: 35px;">
  <tbody>
  
  <tr>
    <td><label for="old_password">Old Password:</label></td>
    <td><div class="input-container"><input name="old_password" id="old_password" type="password" /></div></td>
  </tr>
  
  <tr>
    <td style="vertical-align: top"><label for="new_password">New Passowrd:</label></td>
    <td>
    
    <div class="input-container"><input name="password" id="pass" type="password" /></div>
        <div id="iSM">
        	<ul class="weak">
        		<li id="iWeak"><?=$this->lang['SIGNUP_PASS_WEAK']?></li>
        		<li id="iMedium"><?=$this->lang['SIGNUP_PASS_MEDIUM']?></li>
        		<li id="iStrong"><?=$this->lang['SIGNUP_PASS_STRONG']?></li>
        	</ul>
        </div>
    </td>
  </tr>
  
  <tr>
    <td><label for="c_new_password">Confirm Password:</label></td>
    <td><div class="input-container"><input name="c_new_password" id="c_new_password" type="password" /></div></td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td>
  
  <input type="submit" class="greenButton" value="Change" /><img id="loading" src="images/loading.gif" alt="working.." />
</td>
  </tr>  
  
  </tbody>
</table>

</form>

<div id="error">
&nbsp;
</div>

</div>