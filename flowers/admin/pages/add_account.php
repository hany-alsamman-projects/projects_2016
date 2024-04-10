<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

							<fieldset class="last">
								<legend><strong>≈÷«›… Õ”«»</strong></legend>
								
                                
                                <?php
                                
                                if($ok == 1){                             
                                    print '<div class="msg msg-ok">
                                            <p> „ ≈÷«›… «·Õ”«» »‰Ã«Õ</p>
                                            </div>';
                                
                                }elseif($ok == 2){  
                                    print '<div class="msg msg-warn">
                                            <p>⁄–—« : «·⁄‰Ê«‰ «·»—ÌœÌ «·„” Œœ„ „ÊÃÊœ ”«»ﬁ«</p>
                                            </div>';
                                            
                                }elseif($ok == 3){  
                                    print '<div class="msg msg-warn">
                                            <p>⁄–—« : Ì—ÃÏ «· √ﬂœ „‰ «·⁄‰Ê«‰ «·»—ÌœÌ «·„” Œœ„</p>
                                            </div>';
                                            
                                }else{
									
                                    if(isset($_POST['sub_ok'])) print '<div class="msg msg-error">
                                            <p>ÌÃ» ≈” ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·</p>
                                            </div>';
                                }
                                
                                ?>
                                
                                                                
								<label for="some21">«·«”„:</label>
								<input class="txt" name="user_name" size="50" type="text">

                                
								<label for="some21">ﬂ·„… «·”—: </label>
								<input class="txt" name="password" size="50" type="password">
                                <div id="iSM">
                                	<ul class="weak">
                                		<li id="iWeak">÷⁄Ì›…</li>
                                		<li id="iMedium">„ Ê”ÿ…</li>
                                		<li id="iStrong">ﬁÊÌ…</li>
                                	</ul>
                                </div>
                                
                                
								<label for="some21">«·»—Ìœ «·≈·ﬂ —Ê‰Ì:</label>
								<input class="txt" name="email" size="50" type="text">
                                
                                <div style="clear:both">
                                
                                <div style="float:right; overflow:hidden">
                                
                                <label for="some210">«·„Ã„Ê⁄…:</label>
                                  <select size="1" name="group_id">
                                		<option value="1">“»Ê‰</option>
                                        <option value="2">‰ﬁÿ… »Ì⁄</option>
                                		<option id="get_cities_box" value="3">„Ê“⁄</option>
                                        <option id="get_cities_box" value="4">ÊﬂÌ·</option>
                                        <option value="5">≈œ«—Ì</option>                                		
                               	  </select> 
                                                               
                                </div>
                                
                                
                                <div style="float:right; margin-right:125px; overflow:hidden">
                                

                                    <div id="cities_box">
                                          <label for="some21">≈Œ — «·„‰ÿﬁ…:</label>
    								<?php
                                    
                                        $result = mysql_query("SELECT * FROM `cities` ORDER BY id") or die(mysql_error());
                                        
                                            print "<select size='1' name='oncity'>";
                                            
                                            while($row = mysql_fetch_object($result)){
                                                print "<option value='$row->id'>$row->city</option>";   
                                            }
                                    
                                            
                                            print "</select>";
                                            
                                    ?>   
                                    </div>   
                                    
                                    <label for="some21">›⁄«·Ì… «·Õ”«»:</label>                                
                                    <select name="approve" id="type-select">
                                        <option value="1">„›⁄·</option> 
                                        <option value="-1" selected>€Ì— „›€·</option>                              
                                    </select> 
                                
                                </div>
                                
                                </div>
								
								<div style="clear:both; margin-top: 50px" class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
</form>