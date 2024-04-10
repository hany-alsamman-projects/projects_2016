<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

    	<fieldset class="last">
    		<legend><strong> ⁄œÌ· „‰ Ã</strong></legend>
    		
            
            <?php
            
            if($ok == 1){                             
                print '<div class="msg msg-ok">
                        <p> „  ⁄œÌ· Â–« «·„‰ Ã »‰Ã«Õ</p>
                        </div>';
            
            }
    		
    		if( isset($_POST['prodcut_name']) && empty($_POST['prodcut_name']) ){
    			
                print '<div class="msg msg-error">
                        <p>ÌÃ» ≈” ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·</p>
                        </div>';
            }
            
            ?>
            
                                            
    		<label for="some21">«·«”„:</label>
    		<input class="txt" name="prodcut_name" value="<?=$prodcut_name?>" size="50" type="text">
            
            
    		<label for="some21">«·’Ê—…: </label>
    		<input style="text-align: left; direction: ltr" class="txt" name="prodcut_picture" value="<?=$prodcut_picture?>" size="50" type="text"> <small><span style="cursor: pointer;" id="get_upload_box">—›⁄ ’Ê—…</span></small>
            <div id="upload_box">
                	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                        <input id="fileToUpload" type="file" name="fileToUpload" class="file">
                        <span class="loading">·ÕŸ… „‰ ›÷·ﬂÖ</span>
                		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">«—›⁄</button>
                	</form>   
            </div>
            
    		<label for="some21">«·”⁄—:</label>
    		<input class="txt" name="prodcut_price" value="<?=$prodcut_price?>" size="50" type="text">
    		
            
            <label for="some21">„⁄·Ê„« :</label>
            
            <textarea name="prodcut_details" id="some2" cols="47" rows="5"><?=$prodcut_details?></textarea>
            
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
            
            <div style="float:right; overflow:hidden">
        
            <label for="some21">„« ‰Ê⁄ Â–« «·„‰ Ã:</label>                                
            <select name="extra">            
                <option id="product" value="0">„‰ Ã</option> 
                <option id="extra" value="1" <?=$extra=$extra ? "selected" : "";?>>≈÷«›Ì…</option>                              
            </select>  
            
            
            <label for="some210">≈Œ — «··€…:</label>
    		<?
            
                print "<select size='1' name='used_lang'>";
            
                foreach($this->my_language as $lang_name => $lang_table){
                   if($lang_table == $_GET['lang']){
                        print "<option value='$lang_table' selected>$lang_name</option>";
                   }else{
                        print "<option value='$lang_table'>$lang_name</option>";
                   }                 
                }
                
                print "</select>";
            ?>
                                           
            </div>
            
            
            <div style="float:right; margin-right:125px; overflow:hidden">
            
            <div id="choicedept">              
                <label for="some210">≈Œ — «·ﬁ”„:</label>
        
    			<select id="some210" name="in_dept">
                    
                 <?
                    $result = mysql_query("SELECT id,ar_d_name FROM `departments` WHERE `d_type` = 'cat' and `d_parent` != '0' ORDER BY ar_d_name") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);                              	
                	while($row = mysql_fetch_object($result)){
                	   
                       if($in_dept == $row->id){
                            print "<option value='$row->id' selected>$row->ar_d_name</option>";
                       }else{
                            print "<option value='$row->id'>$row->ar_d_name</option>";
                       } 
                	}
                ?>
                    
    			</select> 
            </div>                         
                
            <label for="some21">Â· Â–« «·„‰ Ã „ «Õ:</label>
            <select name="available" id="type-select">
                <option value="1">„ «Õ</option> 
                <option value="0">€Ì— „ «Õ</option>                              
            </select>  
            
            </div>
            
            </div>
    		
    		<div style="clear:both" class="sep">
                <input type="hidden" name="sub_ok" value="1">
    			<input class="button" value="Submit" type="submit">
    		</div>
    	</fieldset>
</form>