<div>

<a href="index.php?action=usercp&pro=profile"><span><?=$this->lang['USERCP_LABEL_CHPRO']?></span></a> -- 
<a href="index.php?action=usercp&pro=password"><span><?=$this->lang['USERCP_LABEL_CHPASS']?></span></a> -- 
<a href="index.php?action=usercp&pro=picture"><span><?=$this->lang['USERCP_LABEL_CHPIC']?></span></a>

</div>

<div id="div-regForm">

    <div class="form-title">Upload Box</div>
    <div class="form-sub-title">Select an image file on your computer (4MB max):</div>

    <table>
      <tr>
        <th style="width:50%" scope="col">
        	
            <div id="profile_picture">
            	<img id="mypicture" width="200" height="150" src="upload/<?=$this->Picture?>" />
            </div>
        	
        </th>
        <th style="width:50%" scope="col">
            
            <div id="upload_box">
                	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                        <input id="fileToUpload" type="file" name="fileToUpload" class="file">
                        <span id="myloading" class="loading">uploading…</span>
                		<button class="greenButton" id="buttonUpload" onclick="return ajaxFileUpload();">Upload</button>
                	</form>   
            </div>
                
        </th>
      </tr>
    </table>
    
</div>