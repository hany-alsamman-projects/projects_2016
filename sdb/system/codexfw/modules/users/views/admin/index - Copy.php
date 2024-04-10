<?php if (!empty($users)): ?>

        <section class="grid_9">
			<div class="block-border">
            <form class="block-content form" name="table_form" id="table_form" method="post" action="admin/users/action">
				<h1>
					Grid view
					<a href="#"><img src="system/codexfw/assets/img/admin/icons/fugue/plus-circle-blue.png" width="16" height="16"> add</a>
				</h1>
				
				<div class="block-controls">
                     
					<ul class="controls-buttons">
 
                       <?php $this->load->view('admin/partials/users_pagination'); ?>	
                      
					   <li><a href="#"><img src="system/codexfw/assets/img/admin/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
                    
                     </ul>			
				</div>

				
				<div class="with-head no-margin">
					
<!--
					<div class="head">
						<div class="black-cell with-gap"><span class="success"></span></div>
						<div class="black-cell">Sort by</div>
						<div>
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up active"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>
							Name
						</div>
						<div>
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>
							Date
						</div>
						<div>
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>
							Status
						</div>
					</div>
-->
					
					<ul class="grid dark-grey-gradient">
					

        				<?php foreach ($users as $member): ?>        			
						<li>
							<div class="grid-picto user">
								<small title="<?php echo format_date($member->created_on); ?>"><?php echo $member->group_name; ?></small>
								<p class="grid-name"><?php echo anchor('admin/users/preview/' . $member->id, $member->full_name, 'target="_blank" class="modal-large"'); ?></p>
								<p class="grid-details"><?php echo mailto($member->email); ?><br>
								<strong>Active</strong>: <b><?php echo $member->active ? lang('dialog.yes') : lang('dialog.no') ; ?></b><br>
								Last login: <b><?php echo ($member->last_login > 0 ? format_date($member->last_login) : lang('user_never_label')); ?></b></p>
							</div>
							<ul class="grid-actions">
                                <li><?php echo anchor('admin/users/edit/' . $member->id, '<img src="system/codexfw/assets/img/admin/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>lang('user_edit_label'))); ?></li>
                                <li><?php echo anchor('admin/users/delete/' . $member->id, '<img src="system/codexfw/assets/img/admin/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'confirm with-tip','title'=>lang('user_delete_label'))); ?></li>
								<li><?php echo form_checkbox('action_to[]', $member->id); ?></li>
							</ul>
						</li>                        
                        <?php endforeach; ?>
                                                      
                    </ul>

				</div>
				
				<ul class="message no-margin">
					<li>Results <strong><?=$total_users?></strong></li>
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
                    
					<a href="#" class="button check-all-users">Select All</a> 

					<span class="sep"></span>
					<select name="btnAction" id="table-action" class="small">
						<option value="">Action for selected...</option>
						<option value="delete"><?php echo lang('buttons.delete');?></option>
					</select>
					<button type="submit" class="small">Ok</button>
				</div>
					
			</form></div>
		</section>
        
    <?php else: ?>
    
    	<div class="blank-slate">
    
    		<img src="<?php echo site_url('system/codexfw/modules/users/img/user.png') ?>" />
    
    		<h2><?php echo lang($this->method == 'index' ? 'user_no_registred' : 'user_no_inactives');?></h2>
    	</div>
        
    <?php endif; ?>        