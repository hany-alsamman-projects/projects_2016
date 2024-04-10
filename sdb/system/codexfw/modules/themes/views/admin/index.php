<?php if ($themes): ?>
<section class="grid_12">
			<div class="block-border"><form class="block-content form" id="table_form" method="post" action="admin/themes/set_default">

				<h1>Table</h1>
				
				<div class="block-controls">
					
					<ul class="controls-buttons">
										</ul>

					
				</div>
			
				<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				
					<thead>
					
						<tr>
							<th scope="col"><?php echo lang('themes.default_theme_label'); ?></th>
							<th scope="col"><?php echo lang('themes.theme_label'); ?></th>
							<th scope="col"><?php echo lang('themes.description_label'); ?></th>
							<th scope="col"><?php echo lang('themes.author_label'); ?></th>
							<th scope="col"><?php echo lang('themes.version_label'); ?></th>
							<th scope="col" class="table-actions"><?php echo lang('themes.actions_label'); ?></th>
							</tr>
					
					</thead>
					
					<tbody>
					<?php foreach($themes as $theme): ?>
						<tr>
							<td><input type="radio" name="theme" value="<?php echo $theme->slug; ?>" <?php echo $this->settings->default_theme == $theme->slug ? 'checked="checked" ' : ''; ?>/></td>

							<td><?php if (!empty($theme->website)): ?>
								<?php echo anchor($theme->website, $theme->name, array('target'=>'_blank')); ?>
							<?php else: ?>
								<?php echo $theme->name; ?>
							<?php endif; ?></td>
							<td><?php echo $theme->description; ?></td>
							<td><?php if ($theme->author_website): ?>
								<?php echo anchor($theme->author_website, $theme->author, array('target'=>'_blank')); ?>
							<?php else: ?>
								<?php echo $theme->author; ?>
							<?php endif; ?></td>
							<td><?php echo $theme->version; ?></td>
							<td class="table-actions"><a href="<?php echo $theme->screenshot; ?>" rel="screenshots" title="<?php echo $theme->name; ?>" class="button"><?php echo lang('buttons.preview'); ?></a>
					<?php echo anchor('admin/themes/delete/' . $theme->slug, lang('buttons.delete'), 'class="confirm button delete"'); ?>
</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				
				</table></div>
				
							
				<div class="block-footer">
							
								
								<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
								
				</div>
					
			</form>

			</div>
		</section>











	<script type="text/javascript">
		jQuery(function($) {
			$("a[rel='screenshots']").colorbox({width: "40%", height: "50%"});
		});
	</script>

<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('themes.no_themes_installed'); ?></h2>
	</div>
<?php endif; ?>