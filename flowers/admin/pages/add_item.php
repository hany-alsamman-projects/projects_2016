<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

							<fieldset class="last">
								<legend><strong>≈÷«›… „‰ Ã</strong></legend>
								
                                
                                <?php
                                
                                if($ok == 1){                            
                                    print '<div class="msg msg-ok">
                                            <p> „ ≈÷«›… Â–« «·„‰ Ã »‰Ã«Õ</p>
                                            </div>';
                                
                                }
								
								if( isset($_POST['prodcut_name']) && empty($_POST['prodcut_name']) ){
									
                                    print '<div class="msg msg-error">
                                            <p>ÌÃ» ≈” ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·</p>
                                            </div>';
                                }
                                
                                ?>
                                
                                
                                <div style="float: right" id="upload_box">
                                    	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                                            <input id="fileToUpload" type="file" name="fileToUpload" class="file">
                                            <span class="loading">·ÕŸ… „‰ ›÷·ﬂÖ</span>
                                    		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">«—›⁄</button>
                                    	</form>   
                                </div>
                                
                                <div style="width:100%; float: right">
                                <span style="cursor: pointer; float: right;" id="get_upload_box"><img src="images/admin/box_upload.png" /></span>
                                </div>
                                        
                                <div class="add_item_right">
                                
								<label for="some21">«·«”„:</label>
								<input class="txt" name="prodcut_name_ar" size="50" type="text">
                                
                                
								<label for="some21">«·”⁄—:</label>
								<input class="txt" name="prodcut_price_ar" size="50" type="text">
								
                                
                                <label for="some21">„⁄·Ê„« :</label>
                                
                                <textarea name="prodcut_details_ar" id="some2" cols="47" rows="5"></textarea>
                                
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
                                
                                </div>
                                                                
                                <div class="add_item_left">
                                
								<label for="some21">Name:</label>
								<input class="txt" name="prodcut_name_en" size="50" type="text">
                                
                                
								<label for="some21">Price:</label>
								<input class="txt" name="prodcut_price_en" size="50" type="text">
								
                                
                                <label for="some21">Details:</label>
                                
                                <textarea name="prodcut_details_en" id="some2" cols="47" rows="5"></textarea>
                                
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
                                
                                </div>
                                
                                <div style="clear:both">
                                
                                <div style="float:right; overflow:hidden">
                                
                  
                                <label for="some21">„« ‰Ê⁄ Â–« «·„‰ Ã:</label>                                
                                <select name="extra">
                                    <option id="product" value="0">„‰ Ã</option> 
                                    <option id="extra" value="1">≈÷«›Ì…</option>                              
                                </select>  
                                
                                
                                <label for="some210">≈Œ — «··€…:</label>
								<?
                                
                                    print "<select size='1' name='used_lang'>";
                                    print "<option value='0'>«·ﬂ·</option>"; 
                                
//                                    foreach($this->my_language as $lang_name => $lang_table){    
//                                    print "<option value='$lang_table'>$lang_name</option>";   
//                                    }
                                    
                                    print "</select>";
                                ?>
                                                               
                                </div>
                                
                                
                                <div style="float:right; margin-right:125px; overflow:hidden">
                                
                                <div id="choicedept">
                                    <label for="some210">≈Œ — «·ﬁ”„:</label>
      
    								<?php
                                    
                                        $result = mysql_query("SELECT * FROM `departments` WHERE `d_active` = '1' and `d_type` = 'cat' and `d_parent` != '0' ORDER BY en_d_name") or die(mysql_error());
                                        
                                            print "<select size='1' name='in_dept'>";
                                            
                                            while($row = mysql_fetch_object($result)){
                                                print "<option value='$row->id'>$row->ar_d_name</option>";   
                                            }
                                    
                                            
                                            print "</select>";
                                            
                                    ?>    
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