<script type='text/javascript'>

function formValidator(){
	// Make quick references to our fields
	var senderto_name = document.getElementById('senderto_name');
    
    var senderto_address = document.getElementById('senderto_address');

	var senderto_city = document.getElementById('senderto_city');

	var senderto_phone = document.getElementById('senderto_phone');
    
    var sender_oncard = document.getElementById('sender_oncard');

	
	// Check each input in the order that it appears in the form!
	if(!lengthRestriction(senderto_name, 5, 255)) return false;

	if(!lengthRestriction(senderto_address, 5, 255)) return false;

	if(!isNumeric(senderto_phone, "Please enter number only")) return false;

	if(!lengthRestriction(sender_oncard, 2, 255)) return false;
	
	return true;
}

function isEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return true;
	}
	return false;
}

function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function lengthRestriction(elem, min, max){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		alert("Please enter between " +min+ " and " +max+ " characters");
		elem.focus();
		return false;
	}
}
</script>

<div id="div-regForm">

<div class="form-title">Delivery Details</div>
<div class="form-sub-title"><small>When inputting the delivery details please make sure that you enter as much information as possible.</small></div>

<form id="DeliveryDetails" action="index.php?action=MyOrder" method="post" onsubmit="return formValidator()">

<table>
  <tbody>
  <tr>
    <td><label for="fname">Full Name:</label></td>
    <td><div class="input-container"><input name="senderto_name" id="senderto_name" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="email">Address:</label></td>
    <td><div class="input-container"><input name="senderto_address" id="senderto_address" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="address">Telephone:</label></td>
    <td><div class="input-container"><input name="senderto_phone" id="senderto_phone" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="account-type">City:</label></td>
    <td>
    <div class="input-container">
    <select name="senderto_city" id="type-select">
    <option value="0">Select Type:</option>
    <option value="damascus">Damascus</option>
    <option value="aleppo">Aleppo</option>
    <option value="latakia">Latakia</option>
    <option value="tartus">Rartus</option>
    <option value="edleb">Edleb</option>
    <option value="hims">Hims</option>
     <option value="hamah">Hamah</option>
      <option value="jablah">Jablah</option>
       <option value="baniyas">Baniyas</option>
    </select>
    </div>
    
    </td>
  </tr>

  
  <tr>
    <td><label for="Card">Card Message:</label></td>
    <td><div class="input-container"><textarea name="sender_oncard" rows="5" cols="25" id="sender_oncard"></textarea></div></td>
  </tr>
  
  <tr>
    <td><label>I agree</label></td>
    <td><div class="input-container"><a href="http://jasmin.3njoom.com/en/index.php?action=terms"><u>Terms and Conditions</u></a></div></td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td>
  <input type="hidden" name="Process" value="true" />
  <input type="hidden" name="NextPage" value="checkout" />
  <input type="hidden" id="PROD_ID" name="PROD_ID" value="<?=$_POST['PROD_ID']?>" />
  <input type="hidden" id="OrderID" name="OrderID" value="<?=$this->order_id?>" />
  <input type="submit" class="greenButton" value="Continue to billing details" />
</td>
  </tr>
  
  
  </tbody>
</table>

</form>

<div class="msg msg-error" id="error"><p></p></div>
</div>