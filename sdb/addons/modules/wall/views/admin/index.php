<?php if ($vcard): ?>

<section class="grid_12">

    <div class="block-border">
        <div class="block-content">
            <h1><?php echo lang('vcard.list') ?>
            
            <a href="admin/vcard/create"><img src="system/codexfw/assets/img/admin/icons/fugue/plus-circle-blue.png" width="16" height="16"> add</a>
            </h1>
            
				<div class="block-controls">
					
					<ul class="controls-buttons">
						<?php $this->load->view('admin/partials/pagination'); ?>
						<li class="sep"></li>
						<li><a href="#"><img src="system/codexfw/assets/img/admin/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
					</ul>
					
				</div>            	
            
                    <!-- Add the class 'table' -->
                    <div class="no-margin"><table class="table" cellspacing="0" width="100%">
                     <?php echo form_open('admin/vcard'); ?>
                        <thead>
                            <tr>
                                <!-- This is a special cell for loading statuses - see below for more -->
                                <th class="black-cell"><span class="loading"></span></th>
                                 
                                <th scope="col">
                                 
                                    <!-- Table sorting arrows -->
                                    <span class="column-sort">
                                        <a href="#" title="Sort up" class="sort-up active"></a>
                                        <a href="#" title="Sort down" class="sort-down"></a>
                                    </span>
                                     
                                    <?php echo lang('vcard.name'); ?>
                                </th>
                                <th scope="col"><?php echo lang('vcard.description') ?></th>
                                <th scope="col"><?php echo lang('vcard.creation_date'); ?></th>
                                <th scope="col">
                                 <?php echo lang('vcard.added_by'); ?>
                                </th>
                                <th scope="col" class="table-actions"><?php echo lang('vcard.actions'); ?></th>
                            </tr>
                        </thead>
                                              
                        <tbody>
                            
                            <?php foreach ($vcard as $post): ?> 
                            <tr>
                                <th scope="row" class="table-check-cell grid-actions"><?php echo form_checkbox('action_to[]', $post->id); ?></th>
                                <td><?php echo $post->name; ?></td>
                                <td><?php echo $post->description ; ?></td>
                                <td><?php echo $post->date ?></td>
                                <td><?php echo $post->added_by; ?></td>
                                 
                                <!-- The class table-actions is designed for action icons -->
                                <td class="table-actions">
	                                 <?php //echo anchor('admin/vcard/preview/' . $post->id, lang($post->status == 'live' ? 'blog_view_label' : 'blog_preview_label'), 'rel="modal-large" class="iframe button preview" target="_blank"'); ?>
							         <?php echo anchor('admin/vcard/edit/' . $post->id, '<img src="system/codexfw/assets/img/admin/icons/16/pencil.png" alt="">', 'title="'.lang('vcard.edit_label').'"'); ?>
							         <?php echo anchor('admin/vcard/delete/' . $post->id, '<img src="system/codexfw/assets/img/admin/icons/16/cross-circle.png" alt="">', array('class'=>'confirm','title'=>'are you sure delete this vcard ?') ); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                             
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                
                                    <img src="system/codexfw/assets/img/admin/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto">

                					<a href="#" class="button check-all-users">Select All</a> 
                					<span class="sep"></span>
                					<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
                                
                                </td>
                                <td><a href="#" class="button check-all-users"><img src="system/codexfw/assets/img/admin/icons/fugue/cross-circle.png" width="16" height="16"> delete all</a></td>
                            </tr>
                        </tfoot>
                        
                     <?php echo form_close(); ?> 
                    </table>
                  </div>            
        </div><!-- end block-content -->
    </div>

</section>

<?php else: ?>
	<div class="blank-slate">
		<h2>Nothing to view</h2>
        <a href="admin/vcard/create"><img src="system/codexfw/assets/img/admin/icons/fugue/plus-circle-blue.png" width="16" height="16">Create your first vcard</a>
	</div>
<?php endif; ?>