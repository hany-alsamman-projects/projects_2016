<ul id="status-infos">
           
			<li class="spaced"> <?php echo sprintf(lang('cp_logged_in_welcome'), ': <strong>'.$user->display_name.'</strong>'); if ($this->settings->enable_profiles) echo ' | '.anchor('edit-profile', lang('cp_edit_profile_label'));  echo ' | '. anchor('', lang('cp_view_frontend'), 'target="_blank class=""'); ?></li>

			
<?php

	// Not FALSE? Return it
	if ($cached_response = $this->pyrocache->get('codex_box'))
	{
		$messages = $cached_response['messages'];
		$count_emails = $cached_response['count_emails'];

	}
	elseif(ENVIRONMENT == 'sssss' && !$cached_response){
 	  
            $this->load->config('imap');
            $this->load->library('imap');
            
            if($this->imap->connect())
            {
                //$this->data['connected'] = TRUE;
                //$mailbox = $this->imap->mailbox_info('array');
                $messages = $this->imap->msg_list();
                $count_emails = $this->imap->msg_count();
                
            	// Call the model or library with the method provided and the same arguments
            	$this->pyrocache->write(array('count_emails' => $count_emails, 'messages' => $messages), 'codex_box', 60 * 60 * 1); // 1 hours            
            
            }
            
      }

?>      
                <li>
				<a href="#" onclick="return false;" class="button" title="<?=$count_emails?> messages"><img src="system/codexfw/assets/img/admin/icons/fugue/mail.png" width="16" height="16"> <strong><?=$count_emails?></strong></a>
				<div id="messages-list" class="result-block">
					<span class="arrow"><span></span></span>
					
					<ul class="small-files-list icon-mail">
                        
    
                        <?php
                        //print_r($messages);
                        if(ENVIRONMENT == 'sssss'){
                            foreach($messages as $mail){
                                    
                                    print 
                                    '
            						<li>
            							<a href="#" class="codex_box" onclick="return false;"><strong>'.$mail['fromaddress'].'</strong><br>
            							<small>From: '.$mail['from']['personal'].'</small></a>
                                        <div class="mail_subject" style="display: none">From : '.$mail['fromaddress'].'</div>
                                        <div class="mail_body" style="display: none"></div>
            						</li>
                                    ';
                            } 
                        }                                                              
                        
                        ?> 

					</ul>
					
					<p id="messages-info" class="result-info"><a href="http://webmail.syriandramabook.com/">Go to inbox &raquo;</a></p>
				</div>
			</li>

			<li><?php echo anchor('admin/logout', lang('cp_logout_label'),'class="button red"'); ?></li>
		</ul>
