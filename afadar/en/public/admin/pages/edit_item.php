<link href="css/uploadify.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/usercp.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.4.min.js"></script>



<script type="text/javascript">
$(document).ready(function() {

	$("#main").uploadify({
	    'fileDataName'   : 'Filedata',
        //'scriptData'     : {'ptype' : '<?php echo $_GET['ptype'] ?>'},
		'uploader'       : 'js/uploadify.swf',
		'script'         : 'uploadify.php',
		'cancelImg'      : 'images/cancel.png',
        'fileExt'        : '*.jpg;*.gif;*.png',
		'folder'         : '/afadar/upload/p_<?=$_GET['id']?>',  
        //'folder'         : 'upload/p_<?=$_GET['id']?>',          
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : true
//        'onCancel'       : function(event, ID, fileObj) { $("#upmain").val("0"); },
//        'onComplete'     : function(event, ID, fileObj) { $("#upmain").val(""+fileObj.name+""); }
        
	});    
    
});
</script>

<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->
        
     
    	<fieldset class="last">
    		<legend><strong> ⁄œÌ· „‰ Ã</strong></legend>
    		
            
            <?php
            
            if($ok == 1){                             
                print '<div class="msg msg-ok">
                        <p> „  ⁄œÌ· Â–« «·„‰ Ã »‰Ã«Õ</p>
                        </div>';
                        
                        return false;
            
            }
    		
    		if( isset($_POST['prodcut_name']) && empty($_POST['prodcut_name']) ){
    			
                print '<div class="msg msg-error">
                        <p>ÌÃ» ≈” ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·</p>
                        </div>';
            }
            
            ?>
            

                                            
    		<label for="some21">«·«”„:</label>
    		<input class="txt" name="prodcut_name" value="<?=$prodcut_name?>" size="50" type="text">
            
            
    		<label for="some21">«·’Ê—… »«·ÕÃ„ «·ﬂ«„·: </label>
    		<input style="text-align: left; direction: ltr" class="txt" name="prodcut_picture_big" value="<?=$prodcut_picture_big?>" size="50" type="text"> <small><span style="cursor: pointer;" id="get_upload_box">—›⁄ ’Ê—…</span></small>
            <div id="upload_box">
                	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                        <input id="bfileToUpload" type="file" name="bfileToUpload" class="file">
                        <span class="loading">·ÕŸ… „‰ ›÷·ﬂÖ</span>
                		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('bfileToUpload');">«—›⁄</button>
                	</form>   
            </div>
<!--
            
    		<label for="some21">«·’Ê—… «·„’€—…: </label>
    		<input style="text-align: left; direction: ltr" class="txt" name="prodcut_picture" value="<?=$prodcut_picture?>" size="50" type="text"> <small><span style="cursor: pointer;" id="get_upload_box2">—›⁄ ’Ê—…</span></small>
            <div id="upload_box2">
                	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                        <input id="sfileToUpload" type="file" name="sfileToUpload" class="file">
                        <span class="loading">·ÕŸ… „‰ ›÷·ﬂÖ</span>
                		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('sfileToUpload');">«—›⁄</button>
                	</form>   
            </div>
-->
            
            <div style="clear: both; overflow:hidden; margin-bottom: 20px;">
                
                <div id="choicedept" style="float: right;">  
                    <label for="some21">„« ‰Ê⁄ Â–« «·„‰ Ã:</label>                                
                    <select name="extra">            
                        <option id="product" value="0">√·»Ê„</option>                           
                    </select>                          
                </div>
                
                <div id="choicedept" style="float: right; margin-right: 30px;">              
                    <label for="some210">≈Œ — «·ﬁ”„:</label>
            
        			<select id="some210" name="in_dept">
                        
                     <?
                        $result = mysql_query("SELECT id,d_name FROM `departments` WHERE `d_type` = 'cat' and `d_parent` != '0' ORDER BY d_name") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);                              	
                    	while($row = mysql_fetch_object($result)){
                    	   
                           if($in_dept == $row->id){
                                print "<option value='$row->id' selected>$row->d_name</option>";
                           }else{
                                print "<option value='$row->id'>$row->d_name</option>";
                           } 
                    	}
                    ?>
                        
        			</select> 
                </div> 
            
            </div>  
<!--
            
            <label for="some21">„⁄·Ê„« :</label>
            
-->
			<?php
         
//            include('./fckeditor.php');
//            
//            $sBasePath = $_SERVER['PHP_SELF'] ;
//            $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
//            
//            $oFCKeditor = new FCKeditor('prodcut_details') ;
//            $oFCKeditor->BasePath	= $sBasePath ;
//            $oFCKeditor->Height	    = 400;
//            $oFCKeditor->Width	    = 600;
//            $oFCKeditor->Value		= $prodcut_details;
//            $oFCKeditor->Create() 
            ?>
    		<?php
    /*                                
            include('./fckeditor.php');
            
            $sBasePath = $_SERVER['PHP_SELF'] ;
            $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
            
            $oFCKeditor = new FCKeditor('desc') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Height	    = 500 ;
            $oFCKeditor->Value		= '<p>This is some <strong>sample text</strong>' ;
            $oFCKeditor->Create() ;*/
            ?>
            
            <div style="clear:both">

            <label for="some21"><b>—›⁄ «·’Ê—</b>:</label>
            <div style="margin-top: 15px;"><p><input name="file1" type="file" id="main" class="textBox" size="50"> <a href="javascript:jQuery('#main').uploadifyUpload();">Upload</a></p></div>
            
            <div id="fileQueue" style="margin-bottom: 15px;"></div> 
            
            
            <?php
            
                $folderID = "p_".$_GET['id']."/";
                                    
                $GetData = @FUNCTIONS::getDirectoryTree(UPLOAD_PATH.$folderID);
                
            ?>
            
            <ul id="mylinks">
            
            	<?php

                    if(!is_array($GetData)) echo 'you can upload some photos to this product!';
                    else
                    foreach ($GetData as $pic) {	
                        $fileParts  = pathinfo($pic);
            		    static $i=1;
                        if($fileParts['extension'] == 'jpg' || $fileParts['extension'] == 'gif' || $fileParts['extension'] == 'png')
                        echo '<li id="list'.$i.'">
                        		<img src="'.UPLOAD_URL.$folderID.$pic.'" /> <span class="del"><a href="#" class="delete" title="Delete this Picture" id="'.$i.'">X</a></span>
                        		<a target="_blank" href="'.UPLOAD_URL.$folderID.$pic.'" class="user-title">'.$pic.'</a>
                                <input id="picid" name="picid" type="hidden" value="'.$pic.','.$_GET['id'].'" />
                    	     </li>';
                     $i++;
                    }## end for
                        
                    
                ?>	
            	
            </ul>
             
             
            </div>
    		
            
    		<div style="clear:both" class="sep"><br />
                <input type="hidden" name="used_lang" value="ar" />
                <input type="hidden" name="sub_ok" value="1" />
    			<input class="button" value=" ⁄œÌ·" type="submit" />
    		</div>
    	</fieldset>
</form>