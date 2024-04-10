<script type="text/javascript">
$.extend({
  password: function (length, special) {
    var iteration = 0;
    var password = "";
    var randomNumber;
    if(special == undefined){
        var special = false;
    }
    while(iteration < length){
        randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
        if(!special){
            if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
            if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
            if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
            if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
        }
        iteration++;
        password += String.fromCharCode(randomNumber);
    }
    return password;
  }
});


$(document).ready(function() {

    $('.generate').click(function(e){
        
            e.preventDefault();
            
            // If the generate link then create the password variable from the generator function
            password = $.password(8);
            
            //If the confirm link is clicked then input the password into our form field
            $('#newpass').val(password);

            
    });
});
</script>

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
    
    <div class="input-container"><input name="password" id="newpass" type="text" /></div>
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
    <td></td>
    <td><div class="input-container"><a href="#" class="generate" id="generate"><small>Generate Password</small></a></div></td>
  </tr>
  
  
  <tr>
  <td>&nbsp;</td>
  <td>
  
  <input type="submit" class="greenButton" value="Change" /><img id="loading" src="images/loading.gif" alt="working.." />
</td>
  </tr>  
  
  </tbody>
</table>

<div id="error" class="msg msg-info">
<p></p>
</div>

</form>


</div>