<div class="content">

<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

							<fieldset class="last">
								<legend><strong>����� ����</strong></legend>
								
                                
                                <?php
                                
                                if($ok == 1){                            
                                    print '<div class="msg msg-ok">
                                            <p>�� ����� ��� ������ �����</p>
                                            </div>';
                                
                                }
								
								if( isset($_POST['prodcut_name']) && empty($_POST['prodcut_name']) ){
									
                                    print '<div class="msg msg-error">
                                            <p>��� ������� ���� ������</p>
                                            </div>';
                                }
                                
                                ?>
                                
                                
                                <div style="float: right" id="upload_box">
                                    	
                                        
                                        <form name="form" action="" method="POST" enctype="multipart/form-data">     
                                        <label>������ ������ ������</label>                        
                                            <input id="bfileToUpload" type="file" name="bfileToUpload" class="file">
                                            <span class="loading">���� �� ���߅</span>
                                    		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('bfileToUpload');">����</button>
<!--
                                        <label>������ �������</label>
                                            <input id="sfileToUpload" type="file" name="sfileToUpload" class="file">
                                            <span class="loading">���� �� ���߅</span>
                                    		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('sfileToUpload');">����</button>
-->
                                    	</form>  
                                </div>
                                
                                <div style="width:100%; float: right">
                                <span style="cursor: pointer; float: right;" id="get_upload_box"><img alt="���� �����" src="images/admin/box_upload.png" /></span>
                                </div>
                                        
                                <div style="float: right;">
                                
								<label for="some21">�����:</label>
								<input class="txt" name="prodcut_name_ar" size="50" type="text">
                                
<!--
                                
								<label for="some21">�����:</label>
								<input class="txt" name="prodcut_price_ar" size="50" type="text">
								
-->
                                
<!--
                                <label for="some21">�������:</label>
    
-->                            
								<?php
                             
//                                include('./fckeditor.php');
//                                
//                                $sBasePath = $_SERVER['PHP_SELF'] ;
//                                $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
//                                
//                                $oFCKeditor = new FCKeditor('prodcut_details_ar') ;
//                                $oFCKeditor->BasePath	= $sBasePath ;
//                                $oFCKeditor->Height	    = 400;
//                                $oFCKeditor->Width	    = 600;
//                                $oFCKeditor->Value		= '' ;
//                                $oFCKeditor->Create() 
                                ?>
                                
                                </div>
                                
                                <div style="clear:both">
                                
                                <div style="float:right; overflow:hidden">
                                
                  
                                <label for="some21">�� ��� ��� ������:</label>                                
                                <select name="extra">
                                    <option id="product" value="0">����</option>                           
                                </select>  
                                
                                                               
                                </div>
                                
                                
                                <div style="float:right; margin-right:125px; overflow:hidden">
                                
                                    <div id="choicedept">
                                        <label for="some210">���� �����:</label>
          
        								<?php
                                        
                                            $result = mysql_query("SELECT * FROM `departments` WHERE `d_active` = '1' and `d_type` = 'cat' and `d_parent` != '0' ORDER BY d_name") or die(mysql_error());
                                            
                                                print "<select size='1' name='in_dept'>";
                                                
                                                while($row = mysql_fetch_object($result)){
                                                    print "<option value='$row->id'>$row->d_name</option>";   
                                                }
                                        
                                                
                                                print "</select>";
                                                
                                        ?>    
                                    </div>                                
                                
                                </div>
                                
                                </div>
								
								<div style="clear:both" class="sep">
                                    <br />
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value=" ����� " type="submit">
								</div>
							</fieldset>
</form>

					</div>