<form class="fields" method="post"><!-- Forms (plain layout, cleaner) -->

							<fieldset class="last">
								<legend><strong>����� ����</strong></legend>
								
                                
                                <?php
                                
                                if($ok == 1){                             
                                    print '<div class="msg msg-ok">
                                            <p>�� ����� ������ �����</p>
                                            </div>';
                                
                                }elseif($ok == 2){  
                                    print '<div class="msg msg-warn">
                                            <p>���� : ������� ������� �������� ����� �����</p>
                                            </div>';
                                            
                                }elseif($ok == 3){  
                                    print '<div class="msg msg-warn">
                                            <p>���� : ���� ������ �� ������� ������� ��������</p>
                                            </div>';
                                            
                                }else{
									
                                    if(isset($_POST['sub_ok'])) print '<div class="msg msg-error">
                                            <p>��� ������� ���� ������</p>
                                            </div>';
                                }
                                
                                ?>
                                
                                                                
								<label for="some21">�����:</label>
								<input class="txt" name="user_name" size="50" type="text">

                                
								<label for="some21">���� ����: </label>
								<input class="txt" name="password" size="50" type="password">
                                <div id="iSM">
                                	<ul class="weak">
                                		<li id="iWeak">�����</li>
                                		<li id="iMedium">������</li>
                                		<li id="iStrong">����</li>
                                	</ul>
                                </div>
                                
                                
								<label for="some21">������ ����������:</label>
								<input class="txt" name="email" size="50" type="text">
                                
                                <div style="clear:both">
                                
                                <div style="float:right; overflow:hidden">
                                
                                <label for="some210">��������:</label>
                                  <select size="1" name="group_id">
                                		<option value="1">����</option>
                                        <option value="2">���� ���</option>
                                		<option id="get_cities_box" value="3">����</option>
                                        <option id="get_cities_box" value="4">����</option>
                                        <option value="5">�����</option>                                		
                               	  </select> 
                                                               
                                </div>
                                
                                
                                <div style="float:right; margin-right:125px; overflow:hidden">
                                

                                    <div id="cities_box">
                                          <label for="some21">���� �������:</label>
    								<?php
                                    
                                        $result = mysql_query("SELECT * FROM `cities` ORDER BY id") or die(mysql_error());
                                        
                                            print "<select size='1' name='oncity'>";
                                            
                                            while($row = mysql_fetch_object($result)){
                                                print "<option value='$row->id'>$row->city</option>";   
                                            }
                                    
                                            
                                            print "</select>";
                                            
                                    ?>   
                                    </div>   
                                    
                                    <label for="some21">������ ������:</label>                                
                                    <select name="approve" id="type-select">
                                        <option value="1">����</option> 
                                        <option value="-1" selected>��� ����</option>                              
                                    </select> 
                                
                                </div>
                                
                                </div>
								
								<div style="clear:both; margin-top: 50px" class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button" value="Submit" type="submit">
								</div>
							</fieldset>
</form>