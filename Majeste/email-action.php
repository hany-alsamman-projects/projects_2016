<?php
/**
*hotel_service - on
fligh_service - on
*departure - United States
*arrival - United Kingdom
*hotel_name - sherton
*departure_date - 05/27/2013
*arrival_date - 05/27/2013
*fce - 01
*fcf - 01
*fcg - 01
*full_name - hany
*mobile_number - 201008215175
*email_address - hany.alsamman@gmail.com
*adv_way - mazen
**/

	function send_message($number, $my){
		
		$text = urlencode($my);
		$url = "http://expressarab.net/sms/api/sendsms.php?username=Majeste&password=Majeste=2013&numbers=$number&message=$text&sender=Majeste";

		$context = stream_context_create(array('http' => array(
		'method' => 'GET',
		'header' => "Content-Type: text/html\r\n",
		'content' => $body
		)));

		// workaround for php bug where http headers don't get sent in php 5.2 
		if(version_compare(PHP_VERSION, '5.3.0') == -1){ 
		ini_set('user_agent', 'PHP-SOAP/' . PHP_VERSION . "\r\n" . $params['http']['header']); 
		}

		$context = stream_context_create($params);
		$response = file_get_contents($url, false, $context); 

	}

	foreach($_POST as $key => $value){


	if($key = "hotel_service"){
		$key = "الخدمة المطلوبة";
	}elseif($key = "fligh_service"){

		$key = "حجز طيران";

	}elseif($key = "departure"){

		$key = "بلد المغادرة";

	}elseif($key = "arrival"){

		$key = "بلد الوصول";

	}elseif($key = "hotel_name"){

		$key = "اسم الفندق";

	}elseif($key = "departure_date"){

		$key = "تاريخ العودة";

	}elseif($key = "arrival_date"){

		$key = "تاريخ الوصول";

	}elseif($key = "fce"){

		$key = "عدد الغرف";

	}elseif($key = "fcf"){

		$key = "عدد الأشخاص";

	}elseif($key = "fcg"){

		$key = "عدد الأطفال";

	}elseif($key = "full_name"){

		$key = "الاسم الكامل";

	}elseif($key = "mobile_number"){

		$key = "رقم الموبايل";

	}elseif($key = "email_address"){

		$key = "الإيميل";

	}elseif($key = "adv_way"){

	}	


		$meta .= $key . ' - ' . $value. "<br>";

		unset($key);
	}


	// multiple recipients
	//$to  = 'mazen@majeste.net' . ', '; // note the comma
	$to = $_POST['email_address'];

	// subject
	$subject = 'طلب خدمة حجز من ماجستي نت';

	// message
	$message = '
	<html>
	<head>
	  <title>هنا معلومات طلب خدمة</title>
	</head>
	<body>
	  <p>السلام عليكم</p>
	  <table>
	    <tr>
	      <td>'.$meta.'</td>
	    </tr>
	  </table>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	// Additional headers
	$headers .= 'To: Hotels Team <hotels@majeste.net>' . "\r\n";
	$headers .= 'From: Majeste Booking <no-replay@majeste.net>' . "\r\n";

	// Mail it
	if( mail($to, $subject, $message, $headers) ){

	echo 'sent';
	send_message($_POST['mobile_number'], 'لقد تم تقديم طلبك بنجاح سوف يتم اعلامك عند اتمامه شكرا لك');
	
	}else{
		echo 'not';
	}
?> 

