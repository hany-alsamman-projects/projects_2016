<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>لقد تم الاشتراك بنجاح <img src="images/accept.png"> </h1>
<h2>دعنا نبدأ العمل على موقعك الآن !!</h2>
</div>

<? }else{ ?>

<div id="div-regForm">

<div class="form-title"><?=$this->lang['SIGNUP_LABEL_TITLE']?></div>
<div class="form-sub-title"><?=$this->lang['SIGNUP_LABEL_ALT']?></div>

<form id="regForm" action="index.php?task=signup" method="post">

<table>
  <tbody>
  <tr>
    <td><label for="fname"><?=$this->lang['SIGNUP_LABEL_NAME']?>:</label></td>
    <td><div class="input-container"><input name="name" id="name" type="text" /></div></td>
  </tr>
<!--
  <tr>
    <td><label for="lname">Picture:</label></td>
    <td><div class="input-container"><input name="picture" id="picture" type="text" /></div></td>
  </tr>
-->
  <tr>
    <td><label for="lname"><?=$this->lang['SIGNUP_LABEL_NAT']?>:</label></td>
    <td><div class="input-container"><input name="pre_nationality" id="ac_country" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="email"><?=$this->lang['SIGNUP_LABEL_EMAIL']?>:</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  <tr>
    <td style="vertical-align: top;"><label for="pass"><?=$this->lang['SIGNUP_LABEL_PASS']?>:</label></td>
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
    <td><label for="account-type"><?=$this->lang['SIGNUP_LABEL_TYPE']?>:</label></td>
    <td>
    <div class="input-container">
    <select name="account" id="type-select">
    <option value="0"><?=$this->lang['SIGNUP_TYPE_0']?>:</option>
    <option value="1"><?=$this->lang['SIGNUP_TYPE_1']?></option>
    <option value="2"><?=$this->lang['SIGNUP_TYPE_2']?></option>
    </select>
    </div>
    
    </td>
  </tr>
  <tr>
    <td><label for="sex-select"><?=$this->lang['SIGNUP_LABEL_GENDER']?>:</label></td>
    <td>
    <div class="input-container">
    <select name="gender" id="sex-select">
    <option value="0"><?=$this->lang['SIGNUP_SEX_1']?>:</option>
    <option value="1"><?=$this->lang['SIGNUP_SEX_2']?></option>
    <option value="2"><?=$this->lang['SIGNUP_SEX_3']?></option>
    </select>
    </div>
    
    </td>
  </tr>
  <tr>
    <td><label><?=$this->lang['SIGNUP_LABEL_BRITHDAY']?>:</label></td>
    <td>
    <div class="input-container">
    <select name="month"><option value="0"><?=$this->lang['SIGNUP_MONTH']?>:</option><?=FUNCTIONS::generate_options(1,12,true)?></select>
    <select name="day"><option value="0"><?=$this->lang['SIGNUP_DAY']?>:</option><?=FUNCTIONS::generate_options(1,31)?></select>
	<select name="year"><option value="0"><?=$this->lang['SIGNUP_YEAR']?>:</option><?=FUNCTIONS::generate_options(date('Y'),1900)?></select>
    </div>
    </td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td><input type="submit" class="greenButton" value="<?=$this->lang['SIGNUP_LABEL_TITLE']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
</td>
  </tr>
  
  
  </tbody>
</table>
<input type="hidden" name="nationality" id="fixed_nat"/>
</form>

<div id="error">
&nbsp;
</div>

</div>


<? } ?>