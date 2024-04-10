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
		
		$days = array("Sat" => '�����', 
		              "Sun" => '�����',
		              "Mon" => '�������', 
		              "Tue" => '��������', 
					  "Wed" => '��������', 
					  "Thu" => '������', 
					  "Fri" => '������');
					  
for($i=0; $i<count($mycountry); $i++){

$weather_chile = new weather($mycountry[$i], 60*60*24, "c");

$weather_chile->parsecached(); // => RECOMMENDED!

switch($weather_chile->city){
	
	case 'Damascus':
		$city = '����';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Hims':
		$city = '���';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Aleppo':
		$city = '���';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Dara\'A':
		$city = '����';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;

	case 'Kamishli':
		$city = '��������';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Idlib':
		$city = '����';
		$day1  = $days[$weather_chile->fore_day1_day];
		$day2  = $days[$weather_chile->fore_day2_day];
	break;
	
	case 'Deir Ezzor':
		$city = '��� �����';
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
	 <div style="color:white; font-size:9pt; padding:8px">������� ���� : <b><?=$weather_chile->fore_day1_thigh?></b> ���� / <b><?=$weather_chile->fore_day1_tlow?></b> ���� </div>
	 
	 <div style="width: 100%; overflow: hidden; padding:0px" class="sub_menu_ul" id="sub_menu">
		 
	 <?
	 }else{
	 ?>
	 
	 	<div style="color:white; font-size:11pt; padding:8px">
		 <img align="right" src="images/weahter/<?=$weather_chile->fore_day1_imgcode?>.png" />	
		 <b><?=$city?></b></div>
		 <div style="color:white; font-size:9pt; padding:8px">������� ���� : <b><?=$weather_chile->fore_day1_thigh?></b> ���� / <b><?=$weather_chile->fore_day1_tlow?></b> ���� </div>
	 
	 
<?
}
}
?>
</div>
<div style="padding:5px" id="sub_menu_link"><b>������</b></div>