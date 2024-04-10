<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

							<fieldset class="last">
								<legend><strong>تعديل حساب</strong></legend>
								
                                
                                <?php
                                
                                if($ok == 1){                             
                                    print '<div class="msg msg-ok">
                                            <p>تم تعديل الحساب بنجاح</p>
                                            </div>';
                                                                            
                                }else{
									
                                    if(isset($_POST['sub_ok'])) print '<div class="msg msg-error">
                                            <p>يجب إستكمال جميع الحقول</p>
                                            </div>';
                                }
                                
                                ?>
                                
                                                                
								<label for="some21">الاسم:</label>
								<input class="txt" name="user_name" value="<?=$user_name?>" size="50" type="text">

                                
								<label for="some21">كلمة السر: </label>
								<input class="txt" name="password" value="<?=$mypassword?>" size="32" type="password">
                                <div id="iSM">
                                	<ul class="weak">
                                		<li id="iWeak">ضعيفة</li>
                                		<li id="iMedium">متوسطة</li>
                                		<li id="iStrong">قوية</li>
                                	</ul>
                                </div>
                                
                                
								<label for="some21">البريد الإلكتروني:</label>
								<input class="txt" name="email" value="<?=$email?>"  size="50" type="text">
                                
                                <div style="clear:both">
                                
                                <div style="float:right; overflow:hidden">
                                
                                <label for="some210">المجموعة:</label>
                                  <select size="1" name="group_id">
                                		<?php
                                        
                                        foreach($this->groups as $id => $title){
                                            
                                            if($id == $group_id){
                                                echo '<option value="'.$id.'" selected=true>'.$title.'</option>';                                                
                                            }elseif($id == 3 OR $id == 4){
                                                echo '<option id="get_cities_box" value="'.$id.'">'.$title.'</option>';
                                            }else{
                                                echo '<option value="'.$id.'">'.$title.'</option>';
                                            }
                                            
                                        }
                                        
                                        ?>
                                                                      		
                               	  </select> 
                                                               
                                </div>
                                
                                
                                <div style="float:right; margin-right:125px; overflow:hidden">
                                

                                    <div id="cities_box">
                                          <label for="some21">إختر المنطقة:</label>
    								<?php
                                    
                                        $result = mysql_query("SELECT * FROM `cities` ORDER BY id") or die(mysql_error());
                                        
                                            print "<select size='1' name='oncity'>";
                                            
                                            while($row = mysql_fetch_object($result)){
                                                    
                                                if($row->city == $cities){
                                                    print "<option value='$row->id' selected=true>$row->city</option>";  
                                                }else{
                                                    print "<option value='$row->id'>$row->city</option>";  
                                                }

                                            }
                                    
                                            
                                            print "</select>";
                                            
                                    ?>   
                                    </div>
                                    
                                    <label for="some21">فعالية الحساب:</label>                                
                                    <select name="approve" id="type-select">
                                    <?php
                                    
                                        if($approve == 1){
                                            print '<option value="1">مفعل</option> ';  
                                        }else{
                                            print '<option value="-1" selected>غير مفغل</option>';  
                                        }
                                    
                                    ?>                                    
                                                               
                                    </select> 
                                
                                </div>
                                
                                </div>
								
								<div style="clear:both; margin-top: 50px" class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
</form>