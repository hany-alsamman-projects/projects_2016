<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Add Category</h3>
						</div>
						<form class="fields" action="index.php?section=Addcity" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                                    
                                    print '<div class="msg msg-ok">
                                            <p>The new category was <strong>created</strong> successfully !</p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                    $error = 'error';
                                    $label = 'class="error"';
                                }
                                
                                ?>
                                
								<label <?=$label?> for="some21">* Name in English:</label>
								<input class="txt <?=$error?>" name="d_name_en" size="30" type="text">
								<small>english title</small>
                                
                                
								<label <?=$label?> for="some21">Name in Arabic:</label>
								<input class="txt <?=$error?>" name="d_name_ar" size="30" type="text">
								<small>arabic title</small>

                                <label for="some210">Select:</label>
                                <select id="some210" name="d_type" id="type-select">
                                    <option value='city'>City</option>
                                    <option value='cat'>Category</option>
                                </select>

								<div class="sep">
									<label class="radio"><input class="radio" name="d_active" value="1" type="radio" checked>enable</label>
									<label class="radio"><input class="radio" name="d_active" type="radio">disable</label>
								</div>
									
								
								<div class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
						</form>
					</div>
				</div>