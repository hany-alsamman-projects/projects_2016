<?php if ($categories): ?>        
        <section class="grid_12">
			<div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="admin/blog/categories/delete">
				<h1><?php echo lang('cat_list_title'); ?></h1>
				
				<div class="block-controls">
					
					<ul class="controls-buttons">
						<?php $this->load->view('admin/partials/pagination'); ?>
						<li class="sep"></li>
						<li><a href="#"><img src="system/codexfw/assets/img/admin/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
					</ul>
					
				</div>
			
				<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				
					<thead>
						<tr>
							<th class="black-cell"><span class="loading"></span></th>
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up active"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Title
							</th>
                            
							<th scope="col" class="table-actions">Actions</th>
						</tr>
					</thead>
					
					<tbody>
                                            
                        
                        <?php foreach ($categories as $category): ?>						
						<!-- Data while -->
                        <tr>
							<th scope="row" class="table-check-cell grid-actions"><?php echo form_checkbox('action_to[]', $category->id); ?></th>
							<td><?php echo $category->title; ?></td>

							<td class="table-actions">
                            
                            
                            
                            
        					<?php echo anchor('admin/blog/categories/edit/' . $category->id, lang('cat_edit_label').'<img src="system/codexfw/assets/img/admin/icons/fugue/pencil.png" width="16" height="16">', 'class="edit"'); ?>
        					<?php echo anchor('admin/blog/categories/delete/' . $category->id, lang('cat_delete_label').'<img src="system/codexfw/assets/img/admin/icons/fugue/cross-circle.png" width="16" height="16">', 'class="confirm delete"') ;?>
<!--
								<a href="#" title="Edit" class="with-tip"><img src="system/codexfw/assets/img/admin/icons/fugue/pencil.png" width="16" height="16"></a>
								<a href="#" title="Delete" class="with-tip"><img src="system/codexfw/assets/img/admin/icons/fugue/cross-circle.png" width="16" height="16"></a>
-->
							</td>
						</tr>
                        <?php endforeach; ?>
						
					</tbody>
				
				</table></div>
				
				<ul class="message no-margin">
					<li>Results 1 - 5 out of 23</li>
				</ul>
				
				<div class="block-footer">

					<img src="system/codexfw/assets/img/admin/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
					<a href="#" class="button check-all-users">Select All</a> 
					<span class="sep"></span>
					<select name="btnAction" id="table-action" class="small">
						<option value="">Action for selected...</option>
						<option value="delete">Delete</option>
					</select>
					
                    <button type="submit" class="small">Ok</button>

                    <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
				</div>
					
			</form></div>
		</section>
<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('cat_no_categories'); ?></h2>
	</div>
<?php endif; ?>