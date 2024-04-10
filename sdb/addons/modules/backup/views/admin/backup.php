<div id="main_top_panel">
	<h2 class="ico ico_tools_backup"><?=lang('module_backup')?></h2>
</div>
<div class="clear"></div>

<div id="notification" class="notification">
	<?=$notifications?>
</div>
<div id="main_content" class="noaction">

	<div id="main_content_inner">
	<p class="instructions"><?=lang('data_backup_instructions')?>
	
	<?php if ($is_writable) : ?>
		<?=lang('data_backup_instructions_writable')?><br />
			<strong><em><?=$download_path?></em></strong></p>
	<?php else: ?>
		<?=lang('data_backup_instructions_not_writable')?><br />
			<strong><em><span class="error"><?=$download_path?></span></em>  <?=lang('data_backup_not_writable')?></strong></p>
	<?php endif; ?>
	
    <?=form_open('admin/backup')?>
    	
	<div style="padding: 10px 0;"><?//$this->form->checkbox('include_assets', '1')?> <label for="include_assets"><?=lang('data_backup_include_assets')?></label></div>
	
	<div class="buttonbar">
		<ul>
			<li class="end"><?=lang('data_backup_no_backup')?></li>
		</ul>
	</div>
    
    <input type="submit" id="submit" value="<?=lang('data_backup_yes_backup')?>" />

	<?//$this->form->hidden('action', 'backup')?>
    <input type="hidden" name="action" value="backup" />
	<?=form_close()?>
	</div>

</div>