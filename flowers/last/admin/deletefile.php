<?php

@session_start();

if(session_is_registered("admin")){
 
$homepage="index.php?";
if (isset($_GET['filename'])) {	
	if (unlink($_GET['filename'])) {
		print "Picture has been deleted";
	}
	else {
		echo "<script type='text/javascript'> alert('Failed to delete: ".$_GET['filename'].". Please try again.');</script>";
	}
}
else {
	echo "File deleted";
}

}else{
print 'out ya rabit :)';
}
?>