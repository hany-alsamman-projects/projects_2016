<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Add license</h3>
						</div>
						<form class="fields" action="index.php?section=AddLicense" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                                    
                                    print '<div class="msg msg-ok">
                                            <p>The new license was <strong>created</strong> successfully ! :: <a href="index.php?section=Showlicenses">Show licenses </a></p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                    $error = 'error';
                                    $label = 'class="error"';
                                }
                                
                                ?>
                                
								<label <?=$label?> for="some21">Enter NiaQaty license:</label>
								<input autocomplete="off" style="width: 270px" class="txt <?=$error?>" name="gkey" type="text">
								<small><a id="createlic" href="#">Get License</a></small>


                                <label <?=$label?> for="some21">Enter Domain:</label>
                                <input autocomplete="off" class="txt <?=$error?>" name="domain" type="text">

									
								
								<div class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Generate license" type="submit">
								</div>
							</fieldset>
						</form>
					</div>
				</div>