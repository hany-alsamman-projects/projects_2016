      <div id="inside_top"></div>
       	<div id="inside_bg">
        
        	<div id="nav_list">
            	<div id="title"><b><?=$this->lang['activities']?></b></div>
                <div id="top"></div>
                	<div id="content">
                    
                    <ul class="menu">
              
<?php

//                   $subcat = mysql_query("SELECT i.p_name,i.p_content,i.in_parent,i.last_update,d.id AS dept_id,
//                                          d.".$DEPT_NAME."
//                                          FROM `departments` d, `".$this->prefix_lang."_items` i WHERE i.in_parent = d.id");

				$result = mysql_query("SELECT * FROM `departments` WHERE `id` != '19' and `id` != '22' and `d_parent` = '0' ORDER BY en_d_name");
						
				$DEPT_NAME = $this->prefix_lang.'_d_name';
				
				while($row = mysql_fetch_object($result)){
				    
                    echo '<li><span style="color:#FFF"><b>'.$row->$DEPT_NAME.'</b></span></li>';
                    
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
                    
                    <?php //include_once("weather_".$this->prefix_lang.".php"); ?>
                    </div>
                <div id="bottom"></div>
            </div><!-- end nav list -->
            
            <div id="page_content">
            
            	<div id="content" style="width: 100%">
                    
                    <div id="title"><?=$this->title?></div>          
                    <div class="clear"><?=$this->content?></div>
                    
                </div>
                    
            <?php 
			if($_GET['id'] == '2' OR $_GET['id'] == '3' OR $_GET['id'] == '4' OR $_GET['id'] == '12' OR $_GET['id'] == '6' ){
			?>
            <div id="photo_banners"></div>
          
            <script type="text/javascript">            
				var flashvars = {
				  dataFile: "images/clima.xml", 
				  showLogo: "false"
				};             
            swfobject.embedSWF("images/monoslideshow.swf", "photo_banners", "600", "180", "9.0.0","expressInstall.swf", flashvars);             </script>
            
            <?php
			}
			?>
            
            </div><!-- end page content -->
            
            
        </div>
      <div id="inside_bottom"></div>     