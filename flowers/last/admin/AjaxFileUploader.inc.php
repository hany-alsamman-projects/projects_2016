<?php
 
@session_start();
class AjaxFileuploader {

	private $uploadDirectory='';
	private $uploaderIdArray=array();

	public function AjaxFileuploader($uploadDirectory) {
		if (trim($uploadDirectory) != '' && is_dir($uploadDirectory)) {
			$this->uploadDirectory=trim($uploadDirectory);
		}
		else {
			die("<b>ERROR:</b> Failed to open Directory: $uploadDirectory");
		}
	}
	
	public function getAllUploadedFiles() {
		$returnArray = array();
		$allFiles = $this->scanUploadedDirectory();
		return $returnArray;
	}

	private function scanUploadedDirectory() {
		$returnArray = array();
		if ($handle = opendir($this->uploadDirectory)) {
			while (false !== ($file = readdir($handle))) {
				if (is_file($this->uploadDirectory."/".$file)) {
					$returnArray[] = $file;
				}
			}
			closedir($handle);
		}
		else {
			die("<b>ERROR: </b> Could not read directory: ". $this->uploadDirectory);
		}
		return $returnArray;
	}

	public function showFileUploader($uploaderId) {
		if (in_array($uploaderId, $this->uploaderIdArray)) {
			die($uploaderId." already used. please choose another id.");
			return '';
		}
		else {
			$this->uploaderIdArray[] = $uploaderId;
			return '<form id="formName'.$uploaderId.'" method="post" enctype="multipart/form-data" action="imageupload.php?dirname='.$this->uploadDirectory.'" target="iframe'.$uploaderId.'">
						<input type="hidden" name="id" value="'.$uploaderId.'" />							
						<span id="uploader'.$uploaderId.'" style="font-family:verdana;font-size:10;">
						<input name="'.$uploaderId.'" type="file" value="'.$uploaderId.'" onchange=\'return uploadFile(this,"'.$this->uploadDirectory.'")\' /></span>
						<span id="loading'.$uploaderId.'"></span>						
						<iframe name="iframe'.$uploaderId.'" src="imageupload.php" width="400" height="100" style="display:none"> </iframe>
					</form>';
		}
	}
}
?>