<?php


	foreach($_POST as $key => $value){
		$meta .= $key . ' - ' . $value. "<br>";
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
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: USER <'.$to.'>' . "\r\n";
	$headers .= 'From: Majeste Booking <no-replay@majeste.net>' . "\r\n";

	// Mail it
	if( mail($to, $subject, $message, $headers) ){
		
		echo 'sent';
	
	}else{
		echo 'not';
	}
?> 

