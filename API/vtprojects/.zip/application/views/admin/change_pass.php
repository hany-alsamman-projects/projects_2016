<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Change Password Area</h3>
						</div>
						<form action="index.php?section=ChangePassword" class="fields" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                                    
                                    print '<div class="msg msg-ok">
                                            <p>The new Password was <strong>SET</strong> successfully !</p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                    $error = 'error';
                                    $label = 'class="error"';
                                }
                                
                                ?>
                                
								<label <?=$label?> for="some21">YOUR OLD PASSWORD:</label>
								<input class="txt <?=$error?>" name="old_pass" size="30" type="text">
								<small>A little description.</small>

								
                               <label for="some21">YOUR NEW PASSWORD:</label>
                               <input class="txt" name="new_pass" size="30" type="text">
                               <small>A little description.</small>
                                
								
                                <div id="iSM">
                                	<ul class="weak">
                                		<li id="iWeak">weak</li>
                                		<li id="iMedium">Medium</li>
                                		<li id="iStrong">Strong</li>
                                	</ul>
                                </div>
                                
                                
								<label for="some21">YOUR NEW PASSWORD CONFIREM:</label>
								<input class="txt" name="c_new_pass" size="30" type="text">
								<small>A little description.</small>
								
								<div class="sep">
                                    <input type="hidden" name="change" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
						</form>
					</div>
				</div>