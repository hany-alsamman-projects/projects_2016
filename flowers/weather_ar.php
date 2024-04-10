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
		
		$days = array("Sat" => 'วแำศส', 
		              "Sun" => 'วแรอฯ',
		              "Mon" => 'วแรหไํไ', 
		              "Tue" => 'วแหแวหวม', 
					  "Wed" => 'วแรัศฺวม', 
					  "Thu" => 'วแฮใํำ', 
					  "Fri" => 'วแฬใฺษ');
					  
for($i=0; $i<count($mycountry); $i++){

$weather_chile = new weather($mycountry[$i], 60*60*24, "c");

$weather_chile->parsecached(); // => RECOMMENDED!

switch($weather_chile->city){
	
	case 'Damascus':
		$city = 'ฯใิÞ';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Hims':
		$city = 'อใี';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Aleppo':
		$city = 'อแศ';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Dara\'A':
		$city = 'ฯัฺว';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;

	case 'Kamishli':
		$city = 'วแÞวใิแํ';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Idlib':
		$city = 'ลฯแศ';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Deir Ezzor':
		$city = 'ฯํั วแาๆั';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
}	
	  ?>

	 <?
	 if($i == 0){
	 ?>
	 <div style="color:white; font-size:11pt; padding:8px">
	 <img align="right" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
	 <b><?=$city?></b></div>
	 <div style="color:white; font-size:9pt; padding:8px">วแอัวัษ วแยไ : <b><?=$weather_chile->fore_day1_thigh?></b> วฺแ์ / <b><?=$weather_chile->fore_day1_tlow?></b> วฯไ์ </div>
	 
	 <div style="width: 100%; overflow: hidden; padding:0px" class="sub_menu_ul" id="sub_menu">
		 
	 <?
	 }else{
	 ?>
	 
	 	<div style="color:white; font-size:11pt; padding:8px">
		 <img align="right" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
		 <b><?=$city?></b></div>
		 <div style="color:white; font-size:9pt; padding:8px">วแอัวัษ วแยไ : <b><?=$weather_chile->fore_day1_thigh?></b> วฺแ์ / <b><?=$weather_chile->fore_day1_tlow?></b> วฯไ์ </div>
	 
	 
<?
}
}
?>
</div>
<div style="padding:5px" id="sub_menu_link"><b>วแใาํฯ</b></div>