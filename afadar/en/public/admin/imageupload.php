<?php

@session_start();
	
	if(session_is_registered("admin") || session_is_registered("super_mod") || session_is_registered("mod") || session_is_registered("agent")){
		
		if (isset($_POST['id'])) {
			$uploadFile=$_GET['dirname']."/".$_FILES[$_POST['id']]['name'];
			if(!is_dir($_GET['dirname'])) {
				echo '<script> alert("Failed to find the final upload directory: "+'.$_GET['dirname'].');</script>';
			}
			if (!copy($_FILES[$_POST['id']]['tmp_name'], $_GET['dirname'].'/'.$_FILES[$_POST['id']]['name'])) {	
				echo '<script> alert("Failed to upload file");</script>';
			}
		}
		else {
			$uploadFile=$_GET['dirname']."/".$_GET['filename'];
			if (file_exists($uploadFile)) {
				echo "File uploaded: ";
				echo "<a target='_blank' href='$uploadFile'>Open File</a> &nbsp;&nbsp;&nbsp; 
				      <a target='_blank' href='deletefile.php?filename=".$uploadFile."'>Delete File</a>";	
			}
			else {
				echo "<img src='../images/admin/loading.gif' alt='loading...' />";
			}
		}
	
	}else{
		
	print 'out ya rabit :)';
	
	}
?>