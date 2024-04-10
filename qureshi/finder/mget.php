<?php

// Create a stream
//$opts = array(
//  'http'=>array(
//    'method'=>"GET",
//    'header'=>"Accept-language: en\r\n" .
//             "Cookie: foo=bar\r\n"
//  )
//);

//$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
//$file = file_get_contents('http://eservices.mci.gov.sa/Eservices/Commerce/CommercialRegisterGenralDetails.aspx?Loc=1010&CR=351048', false, $context);

//echo $file;

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if($isAjax){


function html2txt($document){
$search = array('@<script[^>]*?>.*?</script>@si');
$text = preg_replace($search, '', $document);
return $text;
} 

$dom = new DomDocument();
@$dom->loadHTMLFile('http://www.tamimi.com/en/section/lawyers?lawyername=Type+name&practice='.$_POST["pid"].'&location='.$_POST["lid"].'');

$classname="lawyer-description";
$finder = new DomXPath($dom);
$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
$tmp_dom = new DOMDocument(); 

foreach ($nodes as $node) 
    {

	$tmp_dom->appendChild($tmp_dom->importNode($node,true));	

    }
$innerHTML.=trim($tmp_dom->saveHTML()); 

$text = html2txt($innerHTML);

echo strip_tags($text, '<div><h3><p>'); 


}else{

die("keep out please");

}


?>
