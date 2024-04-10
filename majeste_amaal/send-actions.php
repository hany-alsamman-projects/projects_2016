<?php

// multiple recipients
#$to  = 'vip@bp.sa' . ', '; // note the comma
$to = 'vip@bp.sa';

$site_url = 'http://bp.sa/files/';

$type = $_POST['form_type'];

switch ($type) {
    case "rental":
        $full_name = $_POST['full_name'];
        $mobile_number = $_POST['mobile_number'];
        $location = $_POST['location'];
        $video_url = $_POST['video_url'];
        $budget = $_POST['budget'];
        $adv_type = $_POST['adv_type'];
        $service = "بتأجيره";
        // subject
        $subject = "العميل $full_name يرغب $service عقاره بقيمة $budget";
    case "sale":
        $full_name = $_POST['full_name'];
        $mobile_number = $_POST['mobile_number'];
        $location = $_POST['location'];
        $video_url = $_POST['video_url'];
        $budget = $_POST['budget'];
        $adv_type = $_POST['adv_type'];
        $service = "بتأجيره";
        // subject
        $subject = " بيع : العميل $full_name من طرف $adv_type";	
    case "develop":
        $full_name = $_POST['full_name'];
        $mobile_number = $_POST['mobile_number'];
        $location = $_POST['location'];
        $video_url = $_POST['video_url'];
        $budget = $_POST['budget'];
        $adv_type = $_POST['adv_type'];
        $service = "بتأجيره";
        // subject
        $subject = " بيع : العميل $full_name من طرف $adv_type";	
}

if(count($_POST["IMUFiles"])>0)
{
	for($i=0; $i<count($_POST["IMUFiles"]); $i++){	
		$exts = array('jpg','png','gif','avi','wmv','fla'); 

		if(in_array(end(explode(".", $_POST["IMUFiles"][$i])), $exts)) $uploaded .= $site_url . rawurlencode($_POST["IMUFiles"][$i]) . "\r\n";
	}
}

$str = <<<EOF
هنا معلومات المرسلة من الزبون :
$full_name الاسم الكامل :
$mobile_number رقم الهاتف :
$location مكان العقار:
$video_url رابط الفيديو :
$budget التكلفة المتوقعة بالريال :
$adv_type اسم المسوق الذي ارشدك الينا :
الملفات المرفقة : 
$uploaded
EOF;

// message
$message = $str;


// subject
#$subject = $subject;

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Additional headers

$headers = 'From: مشروعات الاعمال التجارية <vip@bp.sa>' . "\r\n" .
    'Reply-To: no-replay@bp.sa' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Mail it
if( mail($to, $subject, $message, $headers) ){

    echo '<p> تم الارسال بنجاح !</p>
<p> تم تلقي طلبك وإرسال لإدارة الأصول في شركة مشروعات الأعمال التجارية شكرا لوقتك</p>';

}else{
    echo '<p> يوجد خطأ !</p>';
}
?> 
