	
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		<style type="text/css"> 
			

			#ui-datepicker-div{ position:  absolute; font-size: 80%; }			
			/* css for timepicker */
			.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
			.ui-timepicker-div dl{ text-align: left; }
			.ui-timepicker-div dl dt{ height: 25px; }
			.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
			.ui-timepicker-div td { font-size: 90%; }

			
		</style> 

    <script>
	$(function() {
//		$( "#datepicker1" ).datepicker({
//			showOn: "button",
//			buttonImage: "images/cal_icon.jpg",
//			buttonImageOnly: true
//		});


		//$( "#datepicker" ).datetimepicker({showAnim: 'clip', appendText: ' dd--mm--yy',yearRange: '2011:2012', firstDay: 0, gotoCurrent: false, dateFormat: 'dd/mm/yy', defaultDate: +1});

        var date = new Date(); // Ensure double digits
        
        //var outStr = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
        //var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();        
        
                
        $("#datepicker").datetimepicker({ showOptions: {direction: 'up' } , appendText: ' dd--mm--yy', separator: ' @ ', minDate: new Date(2011, date.getMonth(), date.getDate()+1, 0, 0),maxDate: new Date(2011, 12, 0, 0, 0), dateFormat: 'dd/mm/yy', showAnim: 'clip', stepMinute: 30, defaultDate: +1,firstDay: 0});

        $('html, body').animate({scrollTop: $("#datepicker").offset().top}, 1500);



	});

	</script>

<div id="div-regForm" style="width: 85%;">

<div class="clear form-title"><img align="left" src="images/Calender.gif" /><div style="margin: 5px; float: left;"><h2>Start Order</h2></div></div>
<div class="clear form-sub-title"></div>

<?php

		$result = mysql_query("SELECT * FROM `".$this->prefix_lang."_products` WHERE `id` = '{$this->_ID}' and `available` = '1' ORDER BY id") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
		if($row = mysql_fetch_object($result)){
		    
          $row->available = ($row->available == 0) ? 'NOT' : '';

              echo '<div id="myproduct">            
                        <div id="price">Price <b>'.$row->prodcut_price.' &#36;</b></div>                
                        <div id="pic"><a title="'.$row->prodcut_details.'" href="index.php?action=MyOrder&id='.$row->id.'"><img src="upload/'.$row->prodcut_picture.'" /></a></div>                
                        <div id="desc"><h1><b>'.$row->prodcut_name.'</b></h1><small>'.$row->prodcut_details.'</small></div>  
         
                    </div>';
       			    
        }## end

?>

<div style="width: 51%; padding: 15px;" id="order_form">

<div class="clear form-sub-title"><b>Jasmin</b> Delivery Guarantees</div>


<form id="DataProcess"  action="index.php?action=MyOrder" method="post">

<label>Delivery date</label>

<input id="datepicker" name="delivery_date" value="<?=$this->pro_delivery?>" style="width: 100%;" type="text" />

<br />

<div style="clear: both; margin-top: 30px;" class="msg msg-warn" >
<p>
Jasmin offers a wide variety of fresh, beautiful flowers available for same day-delivery!
</p></div>

<input type="hidden" name="PROD_ID" value="<?=$_GET['id']?>" />
<input type="hidden" name="NextPage" value="delivery_info" />
<input type="hidden" name="Process" value="true" />
<input type="submit" class="greenButton" value="Process" /><img id="loading" src="images/loader.gif" alt="working.." />
</form>


</div>

<div class="clear" style="float: right"><img src="http://www.netcommerce.com.lb/logo/NCseal_S.gif" /></div>

</div>