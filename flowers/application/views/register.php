<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>You've been registered </h1>
<h2>Have a great day!</h2>
</div>

<? }elseif($_GET['active'] == '1'){ ?>

<div class="registered">
<h1>Congratulations!</h1>
<h2>Your account has been fully activated</h2>
</div>

<? }else{ ?>

<div id="div-regForm">

<div class="form-title">Register</div>
<div class="form-sub-title">enjoy for free</div>

<form id="regForm" action="index.php?task=register" method="post">

<table>
  <tbody>
  <tr>
    <td><label for="fname">Full Name:</label></td>
    <td><div class="input-container"><input name="name" id="name" type="text" /></div></td>
  </tr>
<!--
  <tr>
    <td><label for="lname">Picture:</label></td>
    <td><div class="input-container"><input name="picture" id="picture" type="text" /></div></td>
  </tr>
-->
  <tr>
    <td><label for="email">Your Email:</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  
  <tr>
    <td style="vertical-align: top;"><label for="pass">New Password:</label></td>
    <td>
    <div class="input-container"><input name="password" id="pass" type="password" /></div>
        <div id="iSM">
        	<ul class="weak">
        		<li id="iWeak">Weak</li>
        		<li id="iMedium">Medium</li>
        		<li id="iStrong">Strong</li>
        	</ul>
        </div>
    </td>
  </tr>
  
  <tr>
    <td><label for="address">Your Phone:</label></td>
    <td><div class="input-container"><input name="phone" id="phone" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="account-type">Account type:</label></td>
    <td>
    <div class="input-container">
    <select name="account" id="type-select">
    <option value="0">Select Type:</option>
    <option value="1">Customer</option>
    <option value="2">Sale Point</option>
    </select>
    </div>
    
    </td>
  </tr>

  <tr>
    <td><label>Birthday:</label></td>
    <td>
    <div class="input-container">
    <select name="month"><option value="0">MONTH:</option><?=FUNCTIONS::generate_options(1,12,true)?></select>
    <select name="day"><option value="0">DAY:</option><?=FUNCTIONS::generate_options(1,31)?></select>
	<select name="year"><option value="0">YEAR:</option><?=FUNCTIONS::generate_options(date('Y'),1900)?></select>
    </div>
    </td>
  </tr>
  
  <tr>
    <td><label for="phone">Your Address:</label></td>
    <td><div class="input-container"><textarea name="address" rows="5" cols="25" id="address"></textarea></div></td>
  </tr>
  
  <tr>
    <td><label>I agree</label></td>
    <td><div class="input-container"><a href="http://jasmin.3njoom.com/en/index.php?action=terms"><u>Terms and Conditions</u></a></div></td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td><input type="submit" class="greenButton" value="Register" /><img id="loading" src="images/loading.gif" alt="working.." />
</td>
  </tr>
  
  
  </tbody>
</table>

</form>

<div class="msg msg-error" id="error"><p></p></div>
</div>


<? } ?>