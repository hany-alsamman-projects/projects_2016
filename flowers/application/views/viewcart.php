<div id="box1" class="box box-50"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Shopping Cart <?=$active_title = (isset($_GET['think'])) ? '(<small> ‰ Ÿ— «· ›⁄Ì·</small>)' : null;?></h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td style="width: 10px;" class="tc first">#</td>
												<td style="width: 110px;">Picture</td>
												<td>Name</td>
												<td style="width: 10px;" class="tc">Quantity</td>
												<td class="tc">Order Date</td>
                                                <td class="tc last">Price</td>
											</tr>
										</thead>

										<tbody>  
<?php

            ## get all order for account (in session)
    		$result = mysql_query("SELECT * FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and `order_status` = 'pending' OR `order_status` = 'unpaid' ORDER BY id") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
    		while($get = mysql_fetch_object($result)){
    		  
                //if (is_array($get->product_id)) 
                
                foreach(explode(",",$get->product_id) as $product_id){
                    
                    //static $x = 0;
                    
                    //$extra_attach = ($x>0) ? '<img src="images/extra.gif" />' : false;
                    //<img src="library/thumbnail.php?image='.$row->prodcut_picture.'" />
                    
            		$get_product = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `id` = '{$product_id}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            		

            		if($row = mysql_fetch_object($get_product)){
            		  
                      $prodcut_picture = ($row->extra == 1) ? '<img src="upload/'.$row->prodcut_picture.'" />' : '<img src="upload/'.$row->prodcut_picture.'" />';
                        
            		  
                      print '
                                        <tr class="first">
    										<td class="tc first">'.$extra_attach.'</td>
    										<td>'.$prodcut_picture.'</td>
    										<td>'.$row->prodcut_name.'</td>
    										<td style="text-align: center" class="tc">1</td>
                                            <td class="tc">'.date("F j, Y, g:i a",$get->order_date).'</td>
    										<td class="tc">'.$row->prodcut_price.'</td>
    									</tr>
                      ';
                      
                    }
                    
                    //$x++;
                
                }
                
                unset($x);

            }## end
            
           if(isset($_SESSION['user_name'])){
             $this->items = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and `order_status` != 'delivered'") ,0);
             $this->total = mysql_result(mysql_query("SELECT SUM(`price`) FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and `order_status` != 'delivered'") ,0);
           }

?>

            <tr class="first">
    			<td colspan="6" style="text-align: right;" class="tc last"><b>Total</b> : <?=$this->total?>  &#36;  </td>
    		</tr>
                                                
                                                                           
                                            
                                                                                        
										</tbody>
									</table>
								</fieldset>
						</div><!-- .content#box-1-holder -->
                </div>
</div>