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
                    
                    <?php include_once("weather_".$this->prefix_lang.".php"); ?>
                    </div>
                <div id="bottom"></div>
            </div><!-- end nav list -->
            
            <div id="page_content">
            
            	<div id="content" style="width: 100%">
                    
                    <div id="title"><?=$this->title?></div>          
                    <div class="clear">
                    


<div id="container">

<div style=" clear: both; width: 100%">

    <div align="center">
      <?=$this->content?>
    </div>

</div>


<div class="contact">
				
		<fieldset style="float:left;">
		<p id="form_errors"></p>
		<p id="form_thanks"></p>
		<form name="contact" action="index.php?action=contactus" method="post" onsubmit="return validateForm();">

		<label>Company Name <span class="req">*</span></label>
		<input type="text" class="txt_input" name="company_name" />
		
        <label>Person Name <span class="req">*</span></label>
		<input type="text" class="txt_input" name="sender_name" />
        
        <label>Your E-Mail <span class="req">*</span></label>
		<input type="text" class="txt_input" name="sender_email" />
        
		<label>Telephone <span class="req">*</span></label>
		<input type="text" class="txt_input" name="sender_phone" />

		<label>Subject <span class="req">*</span></label>
		<input type="text" class="txt_input" name="sender_subject" />

		<label>Your Message : <span class="req">*</span></label>
		<textarea style="width: 250px; height: 100px" name="sender_message"></textarea>
		<br />
		<input type="submit" name="submitForm" value="Submit" />
		</form>
		</fieldset>
	</div>

<div style="margin: 75px 0px 0px 75px; float: left" id="logo"><img src="images/logo.jpg" /></div>

</div>

                  
                    
                    </div>
                    
                </div>

           </div><!-- end page content -->
            
            
        </div>
      <div id="inside_bottom"></div>     