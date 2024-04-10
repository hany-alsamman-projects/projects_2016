<div class="box box-50 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Add Member</h3>
						</div>
						<form class="fields" action="index.php?section=AddMember" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>
								
                                <?php
                                
                                if($ok == 1){                                    
                                    print '<div class="msg msg-ok">
                                            <p>The Member ('.$_POST['name'].') was <strong>created</strong> successfully !</p>
                                            </div>';
                                
                                }elseif($ok == 2){
                                  print '<div class="msg msg-error">
                                            <p>The Member with ('.$_POST['email'].') was <strong>exists</strong></p>
                                            </div>';

                                }elseif($ok == 3){
                                    print '<div class="msg msg-error">
                                            <p>here the errors or not valid contents</p>
                                            <p>'.$message.'</p>
                                            </div>';
                                }
                                ?>
                                
								<label for="some21">Owner name:</label>
								<input class="txt" name="name" size="30" type="text">
								<small></small>


                                <label for="some21">Member Email: As login ID</label>
                                <input class="txt" name="email" size="30" type="text">
                                <small></small>

                                <label for="some21">Company name:</label>
                                <input class="txt" name="company_name" size="30" type="text">
                                <small></small>

                                <label for="some21">Phone number:</label>
                                <input class="txt" name="phone_number" size="30" type="text">
                                <small></small>

                                <label for="some21">Fax number:</label>
                                <input class="txt" name="fax_number" size="30" type="text">
                                <small></small>

                                <label for="some21">Company website:</label>
                                <input class="txt" name="website" size="30" type="text">
                                <small></small>

                                <label for="some21">latitude/longtitue code: 33.525941,-7.599106</label>
                                <input class="txt" name="gmap" size="30" type="text">
                                <a href="https://maps.google.com.eg/maps?q=33.525941,-7.599106&num=1&gl=eg&t=m&z=11"><small>example</small></a>

                                <label for="some21">Owner Password:</label>
								<input class="txt" name="password" size="30" type="text">
								<small></small>

                                <label for="some210">Select City:</label>
                                <select id="some210" name="city_id" id="type-select">
                                    <option value="0">Select:</option>

                                    <?
                                    //check and get admin row
                                    $a = mysql_query("SELECT * FROM `departments` WHERE `d_type` = 'city'");
                                    //check rows == 1
                                    if(mysql_num_rows($a) > 0){

                                        while($row = mysql_fetch_object($a) ){
                                            echo '<option value="'.$row->id.'">'.$row->d_name_en.'</option>';
                                        }
                                    }
                                    ?>

                                </select>
                                
                                <label for="some210">Select Group:</label>
                                <select id="some210" name="group_id" id="type-select">
                                <option value="0">Select type:</option>
                                	<option value='1'>Client</option>
                                	<? 
                                    if(session_is_registered('admin')){ 
                                    //print "<option value='3'>Mod</option>";
                                    //print " <option value='4'>Admin</option>";
                                    }
                                    ?>
                                </select>
                                
                                
                                <label for="some21">Activate Status:</label>
								<div class="sep">
									<label class="radio"><input class="radio" name="activated" value="1" type="radio">enable</label>
									<label class="radio"><input class="radio" name="activated" value="0" type="radio" checked>disable</label>
								</div>
									
								
								<div class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
						</form>
					</div>
				</div>