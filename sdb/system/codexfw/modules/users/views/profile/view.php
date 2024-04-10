{pyro:theme:css file="profile-screen/screen.css"}

{pyro:theme:js file="profile-js/easySlider1.7.js"}

	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: false, 
				continuous: true
			});
		});	
	</script>


<!-- Container for the user's profile -->

{pyro:theme:js file="jquery-ui-1.8.14.custom.min.js"}

{pyro:theme:js file="skinable_tabs.js"}

					<div class="tabs_holder" style="width: 95%; margin: 0px auto;">
						<ul>
                        <li class="tab_selected"><a href="#tabs-1">معلومات المشترك</a></li>
                        <li><a href="#tabs-2">نبذة عامة</a></li>
                        <li><a href="#tabs-3">الأعمال</a></li>
						<li><a href="#tabs-4">الجوائز والتكريمات</a></li>
                        <?php if(empty($this->user->id)) print '<li><a href="#tabs-5">راسلني</a></li>'; ?>                        
                       
													
						</ul>
						<div class="content_holder">
							<div id="tabs-1">
                                <div style="width: 130px; right: 10px; top:10px; position: absolute;">
                                
                              <?

                              if(!empty($view_user->gravatar)) {
                                
                                    print '<img src="'.site_url() . 'files/thumb/' . $view_user->gravatar.'/140' .'" />';
                              }else{
                                    print '<img src="'.site_url() . 'uploads/files/no_avatar.jpg" />';
                              }
                              
                              ?>                               
                               
                                
                                </div>
								<p>	
								<div id="profile_info_r" style="margin-right:100px; height: 150px;">
                                    <li><?php echo $view_user->display_name;?> <p>: اسم المشترك</p></li>
                                    <li><?php echo $view_user->group_description; ?><p> : طبيعة العمل</p></li>
                                    
                                    <?php                                    
                                        if(!empty($this->user->id)){
                                            print '<li>'.$view_user->email.' <p> : البريد الالكتروني</p></li>';
                                                                            
                                            print '<li>'.$profile->mobile.' <p>: موبايل</p></li>';
                                        }                                 
                                    ?>
                                                                                           
                                </div>                        
								</p>
							</div><!-- /#tabs-1 -->
							<div id="tabs-2">
								<p>
                                   <?php echo nl2br($profile->bio); ?>
								</p>
							</div><!-- /#tabs-2 -->
							<div id="tabs-3">
								<p>	
                                   <?php echo nl2br($profile->address_line3); ?>
								</p>
							</div><!-- /#tabs-3 -->
							<div id="tabs-4">
								<p>	
                                   <?php echo nl2br($profile->address_line2); ?>
								</p>
							</div><!-- /#tabs-4 -->
                            
                            <?php if(empty($this->user->id)): ?>
                            <div id="tabs-5">
							<div id="c_us_form">
                            <?php if (validation_errors()): ?>
                            <div class="error-box">
                            	<?php echo validation_errors(); ?>
                            </div>
                            <?php elseif (isset($messages['error'])): ?>
                            <div class="error-box">
                            	<p><?php echo $messages['error']; ?></p>
                            </div>
                            <?php endif; ?>
                            <?php echo form_open(current_url());?>
                            <div id="comment_form_lable_in">
                            	<p>    
                            		<label for="contact_name">الاسم</label>	
                            	</p>
                            	<p>
                            		<label for="contact_email">البريد الالكتروني</label>
                            	</p>
                            	<p>
                            		<label for="company_name">عنوان الرسالة </label>		
                            	</p>
                               
                            	<p>
                            		<label for="message">نص الرسالة</label>		
                            	</p>
                             </div>
                                <div id="comment_form_input_in">
                                <p>
                                <?php echo form_input('contact_name', $form_values->contact_name, 'id="contact_name"');?>
                                </p>
                                <p>
                                <?php echo form_input('contact_email', $form_values->contact_email, 'id="contact_email"');?>
                                </p>
                              	<p>
                                <?php echo form_input('company_name', $form_values->company_name, 'id="company_name"');?>
                                  </p>	  	
                                      <p>
                                     <?php echo form_textarea ('message', $form_values->message, 'id="message"'); ?>
                                      </p>  
                                </div>
                            	<p  id="comment_form_submet_in">
                            		<input style="width: 60PX; height: 22px;"type="submit" value="أرسل"  />
                            	</p>
                                
                            <?php echo form_close(); ?>
                            </div>
							</div><!-- /#tabs-5 -->
                            <?php endif; ?>
						</div><!-- /.content_holder -->
					</div><!-- /.tabs_holder -->
                    
                	<script type="text/javascript">
                		$('.tabs_holder').skinableSkins({
                		   effect: 'basic_display',
                		   skin: 'skin7',
                		   position: 'top',
                		   skin_path: BASE_URI+'addons/themes/conjuction/'
                		 });
                	</script>
                    
                    
                    <div id='flashmessage'>
                        <div id="flash" align="left"  ></div>
                    </div>
                    
<?php

//check if the user have any images in own gallery
if(is_array($gallery_images) and sizeof($gallery_images) > 0):

?>  
                    
{pyro:theme:css file="colorbox.css"}                  
{pyro:theme:js file="jquery.colorbox.js"}

<script>
	$(document).ready(function(){
		$("a[rel='profile_images']").colorbox({transition:"fade",slideshow:true, slideshowAuto:false});
	});
</script>
    
    <div style="position:relative; width:100%; height:100px; float:left; margin:30px 10px 0 0">
        <div id="slider">
         <ul>
	<?php
 
            $i=0; 
            print '<li>';

                foreach ( $gallery_images as $image ):   

                    print '<a href="'.site_url() . 'uploads/files/' . $image->filename .'" rel="profile_images">
            					 '. img(array('src' => site_url() . 'files/thumb/' . $image->id, 'alt' => $image->description)). form_hidden('action_to[]', $image->id) .'
                            </a>';

        			$i++;

                if($i%4 == 0) echo '</li><li>';

                endforeach;        

		    print '</li>';        

    ?>
        </ul>
        </div><!--slider-->
    </div>
<?php

endif; 

?>             
    
    {pyro:wall:entries uid="0" limit="5"}
 
    
    <div id="prof_vid">
    	<a href="#"><img src="img/pro_vid.jpg" /></a>
        <a href="#"><img src="img/pro_vid.jpg" /></a>
        <a href="#"><img src="img/pro_vid.jpg" /></a>
    </div>

</div>