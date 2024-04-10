<?php
	  include("".SITE_PATH."/library/class.xml.parser.php");
      include("".SITE_PATH."/library/class.weather.php");

		$mycountry = array('0' => 'SYXX0004', //damas
						   '1' => 'SYXX0008', //homs
						   '2' => 'SYXX0003', //Aleppo
						   '3' => 'SYXX0017', //Dara'A
						   '4' => 'SYXX0013', //Kamishli
						   '5' => 'SYXX0009', //Idlib
						   '6' => 'SYXX0015'  //Deir Ezzor
						  );
					  
for($i=0; $i<count($mycountry); $i++){

$weather_chile = new weather($mycountry[$i], 60*60*24, "c");

$weather_chile->parsecached(); // => RECOMMENDED!

	  ?>

	 <?
	 if($i == 0){
	 ?>
	 <div style="color:white; font-size:11pt; padding:8px">
	 <img align="left" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
	 <b><?=$weather_chile->city?></b></div>
	 <div style="color:white; font-size:9pt; padding:8px">Weather: <b><?=$weather_chile->fore_day1_thigh?></b> High / <b><?=$weather_chile->fore_day1_tlow?></b> Low </div>
	 
	 <div style="width: 100%; overflow: hidden; padding:0px" class="sub_menu_ul" id="sub_menu">
		 
	 <?
	 }else{
	 ?>
	 
	 	<div style="color:white; font-size:11pt; padding:8px">
		 <img align="left" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
		 <b><?=$weather_chile->city?></b></div>
		 <div style="color:white; font-size:9pt; padding:8px">Weather: <b><?=$weather_chile->fore_day1_thigh?></b> High / <b><?=$weather_chile->fore_day1_tlow?></b> Low </div>
	 
	 
<?
}
}
?>
</div>
<div style="padding:5px" id="sub_menu_link"><b>More</b></div>