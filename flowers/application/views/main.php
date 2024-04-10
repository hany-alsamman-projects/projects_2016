   
<?php

			$result = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `extra` = '0' and `available` = '1' ORDER BY id DESC LIMIT 6");
			
			while($row = mysql_fetch_object($result)){
			    
              $row->available = ($row->available == 0) ? 'NOT' : '';
    
              echo '<div id="product">            
                        <div id="price">Price <b>'.$row->prodcut_price.' &#36;</b></div>                
                        <div id="pic"><a title="'.$row->prodcut_details.'" href="index.php?action=MyOrder&id='.$row->id.'"><img src="upload/'.$row->prodcut_picture.'" /></a></div>                
                        <div id="desc"><h1><b>'.$row->prodcut_name.'</b></h1><small>'.$row->prodcut_details.'</small></div>  
                        <div style="float: right; padding:10px" id="buy"><a href="index.php?action=MyOrder&id='.$row->id.'">Order Now</a></div>          
                    </div>';
           			    
            }## end

?>