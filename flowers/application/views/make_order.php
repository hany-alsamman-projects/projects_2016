<script type="text/javascript" src="js/NotsimpleCart.js"></script>
<script type="text/javascript">
	simpleCart.email = "orders@3njoom.com";
//  simpleCart.checkoutTo = Bank;
//	simpleCart.merchantId = "118575326044237";
//	simpleCart.checkoutTo = GoogleCheckout;
	simpleCart.currency = USD;
//	simpleCart.taxRate  = 0.08;
//	simpleCart.shippingFlatRate = 5.25;
//	simpleCart.shippingQuantityRate = 1.00;
/*	CartItem.prototype.shipping = function(){
		if( this.size ){
			switch( this.size.toLowerCase() ){
				case 'small':
					return this.quantity * 10.00;
				case 'medium':
					return this.quantity * 12.00;
				case 'large':
					return this.quantity * 15.00;
				case 'bull':
					return 45.00;
				default:
					return this.quantity * 5.00;
			}
		}
	};
*/

    //alert(simpleCart.removeextra);
	
	simpleCart.cartHeaders = ["Price" , "Quantity", "Total","remove_noHeader","Thumb_image_noHeader"];
</script>

<style >


 	.itemContainer{
		width:100%;
		float:left;
	}
	
	.itemContainer div{
		float:left;
		margin: 15px 5px 5px 6px ;
	}
	
	.itemContainer a{
		text-decoration:none;
	}
	
	.cartHeaders{
		width:100%;
		float:left;
	}
	
	.cartHeaders div{
		float:left;
		margin: 0px 5px 5px 10px ;
        font-weight: bold;
	}

    .itemPrice{
        width: 60px;
    }
	.itemThumb{
	    width: 16px;
	}
	.itemTotal{
	    width: 70px;
	}
	.itemQuantity{
	    text-align: center;
	    width: 50px;
	}
    


</style>

<?php
        
        //TODO:get all product saved in an opend orders
        
        ## check if have order submited for this product
        $HasOrder = @mysql_fetch_row(mysql_query("SELECT id,product_id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and FIND_IN_SET({$_POST['PROD_ID']},product_id) LIMIT 1"));
        if($HasOrder[0]){           
            
            
            ## WHERE O.id = '{$HasOrder[0]}' and O.sender_id = '{$_SESSION['user_id']}' and P.id IN ($HasOrder[1])
            
//            $GetOrder = mysql_query("SELECT O.id AS order_id, O.sender_id, O.product_id, P.id, P.prodcut_name, P.prodcut_details, P.prodcut_picture, P.prodcut_price, P.extra
//                FROM `orders` O, `en_products` P
//                WHERE O.id = '{$HasOrder[0]}' and O.sender_id = '{$_SESSION['user_id']}' and P.id IN ($HasOrder[1])") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);         
            
            ## check if have extra product            
            $GetOrder = mysql_query("SELECT * FROM `orders` WHERE id = '{$HasOrder[0]}' and sender_id = '{$_SESSION['user_id']}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
            if($MyOrder = mysql_fetch_object($GetOrder)){
                
                $myids = explode(",",$MyOrder->product_id);
                
                foreach($myids AS $GET_PROD_ID){                    

                $GetProducts = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `id` = '{$GET_PROD_ID}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
  
                    if($MyProduct = mysql_fetch_object($GetProducts)){
                        
                        static $i = 0;
    
                    if(sizeof($myids) == 1){
                        
                        $PRI_PRODUCT = "simpleCart.add('remove=','price=$MyProduct->prodcut_price','quantity=1','thumb=../upload/$MyProduct->prodcut_picture');";
                        
                        $EXTRA_PRODUCT = false;
                        
                    }else{
                        
                        ## check if this primary product
                        if($MyProduct->extra == false){
                            $PRI_PRODUCT = "simpleCart.add('remove=','price=$MyProduct->prodcut_price','quantity=1','thumb=../upload/$MyProduct->prodcut_picture');";
                        }else{
                            $EXTRA_PRODUCT .= "simpleCart.add('myremove=$myids[$i]','price=$MyProduct->prodcut_price','quantity=1','thumb=../upload/$MyProduct->prodcut_picture');";    
                        }               

                    }
                                
                        $i++;
                    
                    } ## end while
                
                }            
                
            }
            
        }else{
            
            ## get primary product
    		$result = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `id` = '{$_POST['PROD_ID']}' and `available` = '1' ORDER BY id") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
    		
    		if($get = mysql_fetch_object($result)){
    		      
              $id = $get->id;
              $available = ($get->available == 0) ? 'NOT' : '';
              $prodcut_price = $get->prodcut_price.' &#36;';
              $prodcut_picture = $get->prodcut_picture;
              $prodcut_details = $get->prodcut_details;    
    
              $_SESSION['PRI_PRODUCT_'.$id.''] = "simpleCart.add('name=', 'price=$prodcut_price','quantity=1','thumb=../upload/$prodcut_picture','remove=')";
    
            }## end
        
        }

        ## get all extra gifts
		$result = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `extra` = '1' and `available` = '1' ORDER BY id") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
		while($row = mysql_fetch_object($result)){
		    
          $row->available = ($row->available == 0) ? 'NOT' : '';

          $myextra .= '<div id="myextra">            
                                  
                    <div id="pic"><a href="javascript:;" class="addextra" id="'.$row->id.'" onclick="simpleCart.add(\'myremove='.$row->id.'\', \'price='.$row->prodcut_price.'\',\'quantity=1\',\'thumb=../upload/'.$row->prodcut_picture.'\');" ><img src="../upload/'.$row->prodcut_picture.'" /></a></div>                
                    <div id="desc">'.$row->prodcut_details.'</div>   
                    <div id="price">'.$row->prodcut_price.' &#36;</div>         
                </div>';
       			    
        }## end
        
?>
<script>

$(document).ready(function(){

    $(".addextra").click( function(){
        
        var extra = this.id;
        var product = <?=$_POST['PROD_ID']?>;
        
        $.ajax({
           type: "POST",
           url: "index.php?task=updateorder",
           data: "extra_id="+extra+"&product_id="+product+"",
           success: function(msg){
             jQuery.facebox("Added Ok");
           }
        });
        
    });

 // simpleCart.empty();
  <?php
     echo $PRI_PRODUCT."\n";
     echo $EXTRA_PRODUCT."\n";
     unset($PRI_PRODUCT,$EXTRA_PRODUCT);
     //$myextra = serialize();
  ?>
  
});
</script>



<div id="div-regForm" style="width: 85%;">

<div class="clear form-title"><img align="left" src="images/mycart.gif" /><div style="margin: 5px; color: #7c4199; float: left;"> Cart: <span class="simpleCart_total"></span> <small>(<span class="simpleCart_quantity"></span> items)</small> </div> <!--
<small><a href="javascript:;" class="simpleCart_empty">empty cart</a></small>
--></div>
<div class="clear form-sub-title"></div>
	
    <?=$myextra?>
            
    <div id="process_form">
    
        <form method="POST" name="myform" action="<?=$_SERVER["REQUEST_URI"]?>" >
        
        <div id="primary_product" class="simpleCart_items">

        </div>
        
        <div class="clear"><hr /></div>

		SubTotal: <span class="simpleCart_total"></span> <br />
		Tax: <span class="simpleCart_taxCost"></span> <br />
		Shipping: <span class="simpleCart_shippingCost"></span> <br />
		-----------------------------<br />
        <label>Final Total:</label>
        <span class="simpleCart_finalTotal"></span>
        
        <div id="order_via">
            
        </div>


        <input type="hidden" id="OrderID" name="OrderID" value="<?=$_POST['OrderID']?>" />
        
        <input type="hidden" name="Process" value="true" />
        <br /><br />
        
        <a onclick="simpleCart.checkoutTo = GoogleCheckout" href="javascript:;" class="simpleCart_checkout">Checkout</a>
        
		<!--
<a onclick="simpleCart.checkoutTo = Bank" href="javascript:;" class="simpleCart_checkout">Bank</a><img id="loading" src="images/loader.gif" alt="working.." />
-->
    </form>
    
    </div>

    <div class="clear" style="float: right">
    
    <img src="http://www.netcommerce.com.lb/logo/NCseal_S.gif" />

    </div>
</div>