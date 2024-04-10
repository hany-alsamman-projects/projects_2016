<div class="registered">
<div style="float: left; padding: 25px;">
    <img align="left" src="images/PaymentSuccess.jpg" />
</div>
    <?php
    
/**
*   $_POST['RespVal']; “1”: Authorized and “0”: Refused
*   $_POST['RespMsg']; Payment response message
*   $_POST['txtIndex']; Order ID reference (unique)
*   $_POST['txtMerchNum']; Merchant Number
*   $_POST['txtNumAut']; Authorization number
*   $_POST['txtAmount']; Total Amount
*   $_POST['txtCurrency']; USD or LBP
*   $_POST['signature']; Is an encrypted checksum value for the Merchant to identify NetCommerce response and prevent any modification to the corresponding transaction
response values.
*/

        
        echo '<div class="form-sub-title"><b>Testing</b> informations : </div><br><br>';
        
        echo 'Order ID: ' .$_POST['txtIndex'].'<br>';
        echo 'Amount: ' .$_POST['txtAmount'].'<br>';        
        echo 'Authorization number: ' .$_POST['txtNumAut'].'<br>';
        echo "<br><br>"; 

        $query = mysql_query("SELECT id AS txtIndex, transaction_id AS txtNumAut , order_date, price AS txtAmount FROM `orders` WHERE `id` = '{$_POST['txtIndex']}'") or $this->_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
        if($row = mysql_fetch_object($query)){
            
            //$row->txtAmount = number_format($row->txtAmount, 2, '.');

            # -invalid billId "Error - 2"
            if($_POST['txtIndex'] != $row->txtIndex){

                //echo '2';
                echo 'invalid Order ID';

            ## -invalid amount you should respose "Error - 3"    
            }elseif($_POST['txtAmount'] != $row->txtAmount){
                
                //echo '3';
                echo 'invalid amount';

            }else{
                
                ## update the order when correctly check
                if($_POST['RespVal'] == 1){
                    
                    mysql_query("UPDATE `orders` SET `order_status` = 'paid', `transaction_id` = '{$_POST['txtNumAut']}' WHERE `id` = '{$_POST['txtIndex']}'") or $this->_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

                        echo "<h1>We've received the amount successfully, Thanks for your order with us</h1>";
                }else{
                    
                    if ($_POST['RespVal'] == false) echo "<h1 style='color:red'><span style='color:red'>We're sorry but something wrong and your payment has been refused</span></h1>";
                }                         
            
            }## end check

        }

    ?>


</div>