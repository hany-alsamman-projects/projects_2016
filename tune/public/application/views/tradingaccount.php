<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>An Order to Add a New Trading Account is Submitted Successfully </h1>
<h3>Thank you for choosing Tune Forex. An order to add a new MetaTrader trading account has been submitted. A company agent will attend you request and send your platform login information shortly. Good luck trading.</h3>
<meta http-equiv="Refresh" content="4; URL=index.php?action=usercp" />
</div>

<? }else{ ?>

<script>

$(document).ready(function(){
    
    $('html, body').animate({scrollTop: $("#div-regForm").offset().top}, 1500);

  
});
</script>

<style type="text/css">
<!--
	#regForm td label{
	   width: 100px;
	}
-->
</style>


<div style="width: 100%; height:411px; background-image: url(images/tradingaccount.png); background-repeat: no-repeat;" id="div-regForm">

<div class="form-title"></div>
<div class="form-sub-title"></div>

<form id="regForm" action="index.php?task=tradingaccount" method="post">

<table style="float: left; margin-left: 60px; margin-top: 90px; width: 50%;">
  <tbody>
  
  <tr>
    <td><label for="Client name">Client name : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="name" name="name" id="name" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="Client E-mail">Client E-mail : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="email" name="email" id="email" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="Client Phone">Client Phone : </label></td>
    <td><div class="input-container"><input style="width: 250px" class="phone" name="phone" id="phone" type="text" /></div></td>
  </tr>  
  
  <tr>
    <td><label for="Account Type">Account Type: </label></td>
    <td><div class="input-container">
        <select name="type" class="type">

            <option value="0">Type:</option>
                        
            <?php
          
            foreach ($this->AccountTypes as $type => $status) {             
            	echo "<option value='".$type."'>".$type."</option>";                
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
    
    <input type="submit" class="greenButton" value="Add Now!" />

    
  </td>
  
  </tr>
  
  </tbody>
</table>

</form>


</div>

<? } ?>