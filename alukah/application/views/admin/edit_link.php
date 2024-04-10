<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Edit Link (<?= $title ?>)</h3>
						</div>
						<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                             
                                    print '<div class="msg msg-ok">
                                            <p>The selected Link was <strong>edited</strong> successfully !</p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                    $error = 'error';
                                    $label = 'class="error"';
                                }
                                
                                ?>
                                
								<label for="some21">Title:</label>
								<input class="txt" value="<? print $title ?>" style="width: 250px" name="title" type="text">
 
								<label for="some21">URL:</label>
								<input class="txt" value="<? print $url ?>" style="width: 250px" name="url" type="text">
                                
 								<label for="some21">Thumbnail: (<a href="<?=$thumbnail?>" rel="facebox">preview</a>)</label>
								<input class="txt" value="<? print $thumbnail ?>" style="width: 250px" id="thumbnail" name="thumbnail" type="text">
								<small><span style="cursor: pointer;" id="get_upload_box">Upload new one</span></small>
                                
                                <div id="upload_box">
                                    	<form name="form" action="" method="POST" enctype="multipart/form-data">                             
                                            <input id="fileToUpload" type="file" name="fileToUpload" class="file">
                                            <span class="loading">uploading…</span>
                                    		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Upload</button>
                                    	</form>   
                                </div>
                                
                                <label for="some21">Description:</label>
                                
                                <textarea name="desc" id="some2" cols="45" rows="5"><? print $desc ?></textarea>
                                
								<label for="some210">Select Department:</label>
								<select id="some210" name="in_dept">
                                    
                                 <?
                                    $result = mysql_query("SELECT id,d_name_en FROM `departments` WHERE `d_type` = 'cat' ORDER BY d_name_en") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);                              	
                                	while($row = mysql_fetch_object($result)){
                                	   
                                       if($in_dept == $row->id){
                                            print "<option value='$row->id' selected>$row->d_name_en</option>";
                                       }else{
                                            print "<option value='$row->id'>$row->d_name_en</option>";
                                       } 
                                	}
                                ?>
                                    
								</select>

								<div class="sep">   
                                <label for="some210">Approve Status:</label>                                 
                        		<?
                        		if($approved == 2){
                        		if(session_is_registered('admin')) print '<label class="radio"><input type="radio" name="approved" value="2" checked>approved</label>';
                        		}else{
                        		if(session_is_registered('admin')) print '<label class="radio"><input type="radio" name="approved" value="2" >approved</label>';		
                        		}
                                
                        		if($approved == 1){
                        		print '<label class="radio"><input type="radio" name="approved" value="1" checked>enable</label>';
                        		}else{
                        		print '<label class="radio"><input type="radio" name="approved" value="1" >enable</label>';		
                        		}
                        		
                        		if($approved == 0){
                        		print '<label class="radio"><input type="radio" name="approved" value="0" checked>disable</label>';
                        		}else{
                        		print '<label class="radio"><input type="radio" name="approved" value="0">disable</label>';		
                        		}
                        		?>
                                    
								</div>
									
								
								<div class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
						</form>
					</div>
				</div>