<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>Thank You Withdrawal Request Submitted Successfully </h1>
<h3>Thank you for submitting a withdrawal order with Tune Forex an agent from the finance department will process your order shortly. Good Luck trading with us.</h3>
<meta http-equiv="Refresh" content="2; URL=index.php?action=usercp&pro=status&funds=withdrawal" />
</div>

<? }else{ ?>

<script>

$(document).ready(function(){
    
    $('html, body').animate({scrollTop: $("#encrypted").offset().top}, 1500);
    
    //$("input[name=checkoutTo]").attr('disabled', true);
    
    // reset the form input
    $("select[name=gateway]").attr('disabled', true);
    $("input[id=amount]").val("");
    $("select[name=gateway]").val($('select[name=gateway] option:first').val());
    $("#recipient_tune_no").hide();
    
    $("#bankinfo, #encrypted").hide();
    
    
    $('.back').click(function(){
         //$('#bankinfo, #encrypted').toggle();
         //$('#theform').toggle(); 
         
         $('#theform').show(); 
         $('#bankinfo, #encrypted').hide();
         
      });
    
    
    $(".reset").click(function(){
        
        $("select[name=gateway]").attr('disabled', false);
        
        $("select[name=gateway]").val($('select[name=gateway] option:first').val());
        
         $("select[name=gateway]").attr('disabled', true);
        
        $("input[id=amount]").val("");
        
    });
    
//    $(".simpleCart_checkout").click(function(){        
//
//          //simpleCart.checkoutTo = alertpay;        
//        
//    });
    
    //check amount input
    $("#amount").live('keyup',function(){
        
           //check if not have zero value
           if($(this).val() >  0){
                
                $("select[name=gateway]").attr('disabled', false);                 
                
                $(".gateway").live('change',function(){
                    
                       var myname = $(this).val();
                       
                           if(myname == 'InternalTransfer'){
                            
                            $("#recipient_tune_no").show();
                            
                           }
                           
                           else if (myname == 'BankWire') {
                            
                                 $('#theform').hide(); 
                                 $('#bankinfo, #encrypted').show();
                           }
                    
                       var myamount = $("#amount").val();
                       
                       
                       $("#myway").attr("src","images/ways/"+myname.toLowerCase()+".jpg");
                       
                       if(myamount != false && myname != '') {

                            //$(this).attr('disabled', true);
                            
                       }
                    
                });
                            
           }else{
                
                $("select[name=gateway]").attr('disabled', true);
            
           }
        
    });


 // simpleCart.empty();
  
});
</script>

<style type="text/css">
<!--
	#regForm td label{
	   width: 100px;
	}
-->
</style>


<div id="encrypted" class="msg msg-warn">
    <p><small>NOTE: all bank data information will be encrypted in a complex value .</small></p>
</div>

<div style="width: 100%; height:500px; background-image: url(images/withdrawal.png); background-repeat: no-repeat;" id="div-regForm">

<div class="form-title"></div>
<div class="form-sub-title"></div>

<form id="regForm" action="index.php?task=withdrawal" method="post">

<table id="bankinfo" style="float: left; margin-left: 80px; margin-top: 80px; width: 80%;">
  <tbody>
  
  <tr>
    <td><label for="amount">Beneficiary Bank : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Beneficiary_Bank" type="text" /></div></td>
  </tr>
  
  
  <tr>
    <td><label for="amount">Beneficiary Bank Address: </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Beneficiary_Bank_Address" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="amount">Swift or BIC : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Swift_or_BIC" type="text" /></div></td>
  </tr>
  
  
  <tr>
    <td><label for="amount">IBAN <small>(if in Europe)</small> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="IBAN" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="amount">Intermediary bank <small>(if available)</small> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Intermediary_bank" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="amount">Beneficiary <small>Name</small> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Beneficiary_Name" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="amount">Beneficiary <small>Address</small> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Beneficiary_Address" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="amount">Beneficiary <small>Account NO</small> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="Beneficiary_Account_Number" type="text" /></div></td>
  </tr>  
    
  <tr>
      <td colspan="2" style="text-align: right;">
        <input type="button" class="greenButton back" value="Back" />    
      </td>  
  </tr>
  
  </tbody>
</table>



<table id="theform" style="float: left; margin-left: 60px; margin-top: 90px; width: 50%;">
  <tbody>
  
  <tr>
    <td><label for="amount"><?=$this->lang['ADDLINK_LABEL_AMOUNT']?> : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="amount" name="amount" id="amount" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="amount">Currency : </label></td>
    <td><div class="input-container">
    <select size="1" name="currency">
    	<option value="usd" selected="1">USD</option>
    </select>
    </div></td>
  </tr>
  
  <tr>
    <td><label for="purse_account">Account No / Purse : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="purse_account" name="purse_account" id="purse_account" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="trans_id">Transaction No : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="trans_no" name="trans_no" id="trans_no" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="tune_no">Tune Trader Account No : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="tune_no" name="tune_no" id="tune_no" type="text" /></div></td>
  </tr>
  
  
  <tr id="recipient_tune_no">
    <td><label for="recipient_tune_no">Recipient’s Tune Trader Account No : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="recipient_tune_no" name="recipient_tune_no" id="recipient_tune_no" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="add_by"><?//$this->lang['ADDLINK_LABEL_DEPT']?> Payment Method: </label></td>
    <td><div class="input-container">
        <select name="gateway" class="gateway">

            <option value="0">Gateway:</option>
                        
            <?php
            /**
             * Array ( [0] => Array ( [id] => 1 [d_name] => World today [d_type] => cat [d_active] => 1 [last_update] => 0 ) 
             */            
            foreach ($this->Gateway as $way => $status) {             
            	echo "<option value='".$way."'>".$way."</option>";                
            }
            ?>
            
        </select>
        </div>
    </td>
  </tr>
  
  <tr>
  <td></td>
  
  <td>
<!--
    <input type="button" class="greenButton submit simpleCart_checkout" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
    
-->

    <div id="error" class="msg msg-warn">
    <p></p>
    </div>
    
    <input type="submit" class="simpleCart_checkout greenButton" value="Checkout" />
   
    <input type="button" class="greenButton reset" value="Undo" />

    
  </td>
  
  </tr>
  
  </tbody>
</table>


<div style="float: right; width: 50%">
    <img  id="myway" src="" />
</div>

<input type="hidden" value="<?=$_SESSION["user_id"]?>" name="added_by" />

</form>


</div>

<? } ?>