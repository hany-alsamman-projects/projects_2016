<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>Thank You Deposit Order Submitted Successfully</h1>
<h3>Thank you for submitting a deposit order with Tune Forex an agent from the finance department will process your order shortly. Good Luck trading with us.</h3>
<meta http-equiv="Refresh" content="2; URL=index.php?action=usercp&pro=status&funds=deposit" />
</div>

<? }else{ ?>

<script type="text/javascript" src="js/NotsimpleCart.js"></script>

<script type="text/javascript">
	simpleCart.email = "info@tune-forex.com";
	simpleCart.currency = USD;
	simpleCart.cartHeaders = ["Price" , "Quantity", "Total","remove_noHeader","Thumb_image_noHeader"];
</script>

<script>

$(document).ready(function(){
    
    $('html, body').animate({scrollTop: $(".msg").offset().top}, 1500);
    
    //$("input[name=checkoutTo]").attr('disabled', true);
    
    // reset the form input
    $("select[name=gateway]").attr('disabled', true);
    $("input[id=amount]").val("");
    $("select[name=gateway]").val($('select[name=gateway] option:first').val());
    
    
    $(".reset").click(function(){
        
        simpleCart.empty();
        
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
                    
                       var myamount = $("#amount").val();
                       var myname = $(this).val();
                       
                           if(myname == 'BankWire'){
                            
                                //$("#bankwire").show();
                                //jQuery.facebox({ div: '#bankwire' }, function(){ $(this).delay(5000) }); 
                           }
                       
                       
                       $("#myway").attr("src","images/ways/"+myname.toLowerCase()+".jpg");
                       
                       if(myamount != false && myname != '') {
                            $(".simpleCart_checkout").attr('disabled', false);
                            $(this).attr('disabled', true);
                            simpleCart.add('name='+myname+'', 'price='+myamount+'','quantity=1','thumb=../upload/','remove=');
                            $("input[name=selected_gateway]").attr('value', myname);
                       }
                    
                });
                            
           }else{
                
                $("select[name=gateway]").attr('disabled', true);
            
           }
        
    });


 // simpleCart.empty();
  
});
</script>

<div class="msg msg-warn">
<p><small>When you choose the payment method and click checkout, the system will process it immediately.</small></p>
</div>

<div style="width: 100%; height:376px; background-image: url(images/moneydeposit.png); background-repeat: no-repeat;" id="div-regForm">

<div class="form-title"></div>
<div class="form-sub-title"></div>

<form id="regForm" action="index.php?task=deposit" method="post">

<table style="float: left; margin-left: 60px; margin-top: 90px; width: 50%;">
  <tbody>
  
  <tr>
    <td><label for="amount"><?=$this->lang['ADDLINK_LABEL_AMOUNT']?> : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="amount" name="amount" id="amount" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="tune_no">Tune Trader Account No : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="tune_no" name="tune_no" id="tune_no" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="add_by"><?//$this->lang['ADDLINK_LABEL_DEPT']?> Payment Methode: </label></td>
    <td><div class="input-container">
        <select name="gateway" class="gateway">

            <option value="0">Gateway:</option>
                        
            <?php
            /**
             * Array ( [0] => Array ( [id] => 1 [d_name] => World today [d_type] => cat [d_active] => 1 [last_update] => 0 ) 
             */            
            foreach ($this->Gateway as $way => $status) {
                if($way != 'InternalTransfer') //dont show this way
            	echo "<option value='".$way."'>".$way."</option>";                
            }
            ?>
            
        </select>
        <input name="selected_gateway" type="hidden" />
        </div>
    </td>
  </tr>
  
  <tr>
  <td></td>
  
  <td>
<!--
    <input type="button" class="greenButton submit simpleCart_checkout" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
    
-->
    <input name="checkoutTo" type="button" onclick="javascript:simpleCart.checkoutTo = $('select[name=gateway] option:selected').val().toLowerCase(); return false" class="simpleCart_checkout greenButton" value="Checkout" />
   
    <input type="button" class="greenButton reset" value="Undo" />

    
  </td>
  
  </tr>
  
  </tbody>
</table>

<div id="bankwire" style="width: 100%; display: none">
<table border="0" cellspacing="0" cellpadding="0" width="626">
  <tr>
    <td width="626" colspan="3" valign="top" align="center"><p>DETAILS    OF BENEFICIARY </p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">SWIFT Field</p></td>
    <td width="238" valign="top"><p align="center">Title </p></td>
    <td width="333" valign="top"><p align="center">Details </p></td>
  </tr>
  <tr>
    <td width="626" colspan="3" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">54 </p></td>
    <td width="238" valign="top"><p align="center">Receiver&rsquo;s    Correspondent: </p></td>
    <td width="333" valign="top"><p align="center">COBAUS3X </p></td>
  </tr>
  <tr>
    <td width="626" colspan="3" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">56 </p></td>
    <td width="238" valign="top"><p align="center">Intermediary    Bank: </p></td>
    <td width="333" valign="top"><p align="center">CommerzBank AG, Frankfurt,    Germany </p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Address of Beneficiary Bank </p></td>
    <td width="333" valign="top"><p align="center">D - 60261 Frankfurt am Main, Germany</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">SWIFT code: </p></td>
    <td width="333" valign="top"><p align="center">COBADEFF </p></td>
  </tr>
  <tr>
    <td width="626" colspan="3" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">57 </p></td>
    <td width="238" valign="top"><p align="center">Beneficiary Bank: </p></td>
    <td width="333" valign="top"><p align="center">Loyal Bank Limited </p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Address: </p></td>
    <td width="333" valign="top"><p align="center">Cedar Hill Crest, Villa,    St. Vincent and the <br />
      Grenadines,    West Indies</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">SWIFT code: </p></td>
    <td width="333" valign="top"><p align="center">LOYAVCVX </p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Acc. Number: </p></td>
    <td width="333" valign="top"><p align="center">4008712192 </p></td>
  </tr>
  <tr>
    <td width="626" colspan="3" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">59 </p></td>
    <td width="238" valign="top"><p align="center">Beneficiary: </p></td>
    <td width="333" valign="top"><p align="center">TUNE    INTERNATIONAL INVESTMENTS Inc</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Address: </p></td>
    <td width="333" valign="top"><p align="center">IPASA    Building , 3rd Floor<br />
      41st    Street and Balboa Avenue , Panama City , Panama</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Beneficiary account number: </p></td>
    <td width="333" valign="top"><p align="center">104007808705840</p></td>
  </tr>
  <tr>
    <td width="56" valign="top"><p align="center">&nbsp;</p></td>
    <td width="238" valign="top"><p align="center">Customer ID: </p></td>
    <td width="333" valign="top"><p align="center">20558299</p></td>
  </tr>
  <tr>
    <td width="626" colspan="3" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
</table>
</div>

<div id="totalam" style="float: right; width: 50%; display: none">
        <div style="width: 100%; display: none" class="simpleCart_items">

        </div>
    
		<b>Total Amount</b>: <span class="simpleCart_total"></span> <br />
		Tax: <span class="simpleCart_taxCost"></span> <br />
		-----------------------------<br />
        <label>Final Total:</label>
        <span class="simpleCart_finalTotal"></span>
        <br />
</div>

<div style="float: right; width: 50%">
    <img  id="myway" src="" />
</div>

<input type="hidden" value="<?=$_SESSION["user_id"]?>" name="added_by" />

</form>

<div id="error">
&nbsp;
</div>

</div>

<? } ?>