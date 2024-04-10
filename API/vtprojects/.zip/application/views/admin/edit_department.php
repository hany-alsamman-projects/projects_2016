<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Edit Department (<? print $d_name_en ?>)</h3>
						</div>
						<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                             
                                    print '<div class="msg msg-ok">
                                            <p>The selected DEPT was <strong>edited</strong> successfully !</p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                    $error = 'error';
                                    $label = 'class="error"';
                                }
                                
                                ?>
                                
								<label <?=$label?> for="some21">English Department name:</label>
								<input class="txt <?=$error?>" value="<? print $d_name_en ?>" name="d_name_en" size="30" type="text">
								<small>Show DEPT name in english page.</small>
                                
                                
								<label <?=$label?> for="some21">Arabic Department name:</label>
								<input class="txt <?=$error?>" value="<? print $d_name_ar ?>" name="d_name_ar" size="30" type="text">
								<small>Show DEPT name in arabic page.</small>


								<div class="sep">                                    
                        		<?
                        		if($stauts == 1){
                        		print '<label class="radio"><input type="radio" name="d_active" value="1" checked>enable</label>';
                        		}else{
                        		print '<label class="radio"><input type="radio" name="d_active" value="1" >enable</label>';		
                        		}
                        		
                        		if($stauts == 0){
                        		print '<label class="radio"><input type="radio" name="d_active" value="0" checked>disable</label>';
                        		}else{
                        		print '<label class="radio"><input type="radio" name="d_active" value="0">disable</label>';		
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