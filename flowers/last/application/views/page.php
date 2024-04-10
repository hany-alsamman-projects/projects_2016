      <div id="inside_top"></div>
       	<div id="inside_bg">
        
        	<div id="nav_list">
            	<div id="title"><b>Activities</b></div>
                <div id="top"></div>
                	<div id="content">
                    
                    <ul class="menu">
              
<?php

//                   $subcat = mysql_query("SELECT i.p_name,i.p_content,i.in_parent,i.last_update,d.id AS dept_id,
//                                          d.".$DEPT_NAME."
//                                          FROM `departments` d, `".$this->prefix_lang."_items` i WHERE i.in_parent = d.id");

				$result = mysql_query("SELECT * FROM `departments` WHERE `id` != '19' and `d_parent` = '0' ORDER BY en_d_name");
						
				$DEPT_NAME = $this->prefix_lang.'_d_name';
				
				while($row = mysql_fetch_object($result)){
				    
                    echo '<li><span style="color:#095f94"><b>'.$row->$DEPT_NAME.'</b></span></li>';
                    
                   $subcat = mysql_query("SELECT i.id AS item_id,i.p_name,i.p_content,i.in_parent,i.last_update,d.id AS dept_id,
                                         d.".$DEPT_NAME."
                                         FROM `departments` d, `".$this->prefix_lang."_items` i WHERE `d_parent` = '{$row->id}' and i.in_parent = d.id");
                   
                        while($sub = mysql_fetch_object($subcat)){
                            
                            echo '<ul>';
                                echo '<li><a href="index.php?action=ViewPage&id='.$sub->item_id.'"><span>'.$sub->$DEPT_NAME.'</span></a></li>';                            
                            echo '</ul>';
                        }## end sub				    
                }## end dept
?>
                        
                    </ul>

                    </div>
                <div id="bottom"></div>
            </div><!-- end nav list -->
            
            <div id="page_content">
            
            	<div id="content" style="width: 100%">
                    
                    <div id="title"><?=$this->title?></div>          
                    <div class="clear"><?=$this->content?></div>
                    
                </div>
            
            </div><!-- end page content -->
            
            
        </div>
      <div id="inside_bottom"></div>     