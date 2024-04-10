				</div>
				
				<ul class="message no-margin">
					<li>Results <strong><?=$view_now?></strong></li>
				</ul>
				
				<div class="block-footer">
<!--
					<div class="float-right">
						<label for="table-display" style="display:inline">Display mode</label>
						<select name="table-display" id="table-display" class="small">
							<option value="table">Table</option>
							<option value="grid" selected="selected">Grid</option>
						</select>
					</div>
-->
					
					<img src="system/codexfw/assets/img/admin/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 

                    
                    <input type="button" onclick="SetAllCheckBoxes('table_form', 'tid[]', true);" class="button" value="Check all" />
                   <input type="button" onclick="SetAllCheckBoxes('table_form', 'tid[]', false);" class="button" value="Un Check all" /> 

					<span class="sep"></span>
					<select name="operation" id="table-action" class="small">
						<option value="">Action for selected...</option>
						<option value="1">MOVE TO ARCHIVES</option>
                        <option value="2">DELETE</option>
                        <option value="3">MODIFIED</option>
					</select>
					<button type="submit" class="small">Ok</button>
                    <ul class="controls-buttons">
                    
<?php


				if($this->step>1){
				
				echo '<li><a href="./?'.FUNCTIONS::clean_url($_SERVER['REQUEST_URI']).'&step='.($this->step-1).'"><img alt="" height="16" src="images/icons/fugue/navigation-180.png" width="16" /></a></li>';
					
				}
										
                    for($i = 1; $i <= $count_step; $i++) // show ($show) links 
                    { 
                    
                        if($this->step > $count_step){ // if p is greater then totalpages then display nothing 
                            echo ""; 
                        } 
                        else{						    
                    	    $pageClass = (isset($this->step) && $this->step == $i) ? "class='current'" : "";
                    		echo "<li><a href=\"./?".FUNCTIONS::clean_url($_SERVER['REQUEST_URI'])."&step=$i\" $pageClass><b>$i</b></a></li>";
                        }
                                                                 
                    }

				if($this->step>0){
				
				$next = ( ($this->step+1) <= $count_step ? ($this->step+1) : $this->step);
				
				echo '<li><a href="./?'.FUNCTIONS::clean_url($_SERVER['REQUEST_URI']).'&step='.($next).'"><img src="images/icons/fugue/navigation.png" width="16" height="16"></a></li>';
				
				}
?>                    
                    
					</ul>
                    
                    
				</div>
					
			</form></div>
		</section>