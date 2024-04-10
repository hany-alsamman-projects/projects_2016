<?php
	  include("".SITE_PATH."/library/class.xml.parser.php");
      include("".SITE_PATH."/library/class.weather.php");

		$mycountry = array('0' => 'SYXX0004'
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
	
}	
	  ?>

	 <div style="color:#0373bb; font-size:12pt; margin-top:20px; padding:8px">
    	 <img align="left" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
    	 <b><?=$city?></b>
     </div>
	 <div style="color:#0373bb; font-size:10pt; padding:8px">
     วแอัวัษ วแยไ : <b><?=$weather_chile->fore_day1_thigh?></b> วฺแ์ / <b><?=$weather_chile->fore_day1_tlow?></b> วฯไ์ 
     </div>
	 
	 
<?
}
?>