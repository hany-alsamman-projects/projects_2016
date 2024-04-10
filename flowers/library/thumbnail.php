<?php

if(!isset($_GET['image'])) die();

$path = 'http://127.0.0.1/flowers/upload/';

$image = str_replace(" ", "%20", $_GET['image']);

//if( eregi('dandanh.com',$image)){
    $myimage = trim($path.$image);
//}else{
//    $myimage = trim($path.$image);
//}

list($width, $height, $type, $attr) = getimagesize($myimage);

$width = (isset($_GET['width']) == false) ? (ceil($width/1.2)) : $_GET['width'];

$height = (isset($_GET['height']) == false) ? (ceil($height/2)) : $_GET['height'];


if ( $myimage && getimagesize($myimage) ) {
	mkThumb($myimage,$width,$height);
}else{
    $nophoto = $path.'no_photo.gif';
    mkThumb($nophoto,$width,$height);
}


function mkThumb ($imgFile,$W,$H) {
	$Type = getimagesize($imgFile);	
	
	if ( $Type['mime'] == 'image/jpeg' ) {
		$img = imagecreatefromjpeg($imgFile);
	}else if ( $Type['mime'] == 'image/png' ) {		
		$img = imagecreatefrompng($imgFile);
	}else if ( $Type['mime'] == 'image/gif' ) {		
		$img = imagecreatefromgif($imgFile);
	}

	# get image height 
	$Height = imagesy($img);
	# get image width 
	$Width  = imagesx($img);

	// calculate the new width/height for the thumbnail 
	if ( $Width > $Height ) {
		$Thumb_W = $W;
		$Thumb_H = $Height * ($H/$Width);
	}

	if ( $Height > $Width ) {
		$Thumb_W = $Width * ($W/$Height);			
		$Thumb_H = $H;
	}

	if ( $Height == $Width ) {
		$Thumb_W = $W;
		$Thumb_H = $H;
	}

	$Thumb = ImageCreateTrueColor($Thumb_W,$Thumb_H);
	imagecopyresampled($Thumb,$img,0,0,0,0,$Thumb_W,$Thumb_H,$Width,$Height);
	

	header('content-type: ' . $Type['mime']);
	if ( $Type['mime'] == 'image/jpeg' ) {
		imagejpeg($Thumb);
	}else if ( $Type['mime'] == 'image/png' ) {		
		imagepng($Thumb);
	}else if ( $Type['mime'] == 'image/gif' ) {		
		imagegif($Thumb);
	}
    
    imagedestroy($Thumb);
}


?>