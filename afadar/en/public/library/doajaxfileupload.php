<?php

require_once('../configs.php');

@session_start();
	
	if(session_is_registered("admin") || session_is_registered("mod")){
	   
	$error = "";
	$msg = "";
    $allowed_ext = array('jpg', 'jpeg', 'gif', 'bmp', 'png', 'ppt', 'pdf');
    $uploads_dir = UPLOAD_PATH;
   
    
	$fileElementName = (isset($_FILES['sfileToUpload'])) ? 'sfileToUpload' : 'bfileToUpload';
    
     $name = $_FILES[$fileElementName]['name'];
    
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
    
    
    }elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
        
	}else{
	   
        ## check the ext if safe in array of allowed ext   
        if (!in_array(strtolower(trim(strrchr($name, '.'), '.')), $allowed_ext)){  
            
            $error = 'Sorry upload vaild, your file does not have true ext';
        
        }else{

            move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $uploads_dir.$name);
            @chmod($uploads_dir.$name, 0777);
            
            if (getimagesize($uploads_dir.$name) == false) {
                $error = 'someone trying to hack me';
                unlink($uploads_dir.$name);
            }
            
            $filecode = @file_get_contents($uploads_dir.$name);
            
			if (ereg("echo",$filecode) OR ereg("zend",$filecode) OR  ereg("print",$filecode) OR ereg("phpinfo",$filecode) OR ereg("symlink",$filecode) OR ereg("ini_set",$filecode) OR  ereg("telnet",$filecode) OR ereg("cgi",$filecode)
			    ) {
                $error = 'someone trying to hack me';
                unlink($uploads_dir.$name);
	        }
            
			$msg .= "Your picture (" . $_FILES[$fileElementName]['name'] . ") was uploaded!";
			//$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
            
			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);
        }
	 
     
     }	
     
    	echo "{";
    	echo				"error: '" . $error . "',\n";
        echo				"msg: '" . $msg . "',\n";
    	echo				"picture: '" . $name . "'\n";
    	echo "}";     
    
	 }else{
		
	   print 'out ya rabit :)';
	
	 }
?>