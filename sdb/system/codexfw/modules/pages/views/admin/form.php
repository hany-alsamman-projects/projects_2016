
<div class="block-border">
    <div class="block-content">
        
        <?php if ($this->method == 'create'): ?>
        	<h1><?php echo lang('pages.create_title');?></h1>
        <?php else: ?>
        	<h1><?php echo sprintf(lang('pages.edit_title'), $page->title);?></h1>
        <?php endif; ?>
                
    <div class="block-controls">
    
    	<ul class="controls-tabs js-tabs with-children-tip">
    		<li><a href="#page-content" title="<?php echo lang('pages.content_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Modify.png" width="24" height="24"></a></li>
    		<li><a href="#page-meta" title="<?php echo lang('pages.meta_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Info.png" width="24" height="24"></a></li>
    		<li><a href="#page-design" title="<?php echo lang('pages.design_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Picture.png" width="24" height="24"></a></li>
    		<li><a href="#page-script" title="<?php echo lang('pages.script_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Loading.png" width="24" height="24"></a></li>
    		<li><a href="#page-options" title="<?php echo lang('pages.options_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Pie-Chart.png" width="24" height="24"></a></li>
    		<li><a href="#revision-options" title="<?php echo lang('pages.revisions_label');?>"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Line-Chart.png" width="24" height="24"></a></li>
    	</ul> 
           
    </div>
    
    <?php echo form_open(uri_string(), 'class="crud"'); ?>
    <?php echo form_hidden('parent_id', (@$page->parent_id == '')? 0 : $page->parent_id); ?>

	<div id="page-content">

		<ul>

			<li>
				<label for="title"><?php echo lang('pages.title_label');?></label>
				<?php echo form_input('title', $page->title, 'maxlength="60"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>

			<li class="even">
				<label for="slug"><?php echo lang('pages.slug_label');?></label>

				<?php if ( ! empty($page->parent_id)): ?>
					<?php echo site_url($parent_page->uri); ?>/
				<?php else: ?>
					<?php echo site_url() . (config_item('index_page') ? '/' : ''); ?>
				<?php endif; ?>

				<?php if ($this->uri->segment(3,'') == 'edit'): ?>
					<?php echo form_hidden('old_slug', $page->slug); ?>
				<?php endif; ?>

				<?php if ($page->slug == 'home' || $page->slug == '404'): ?>
					<?php echo form_hidden('slug', $page->slug); ?>
					<?php echo form_input('', $page->slug, 'size="20" class="width-10" disabled="disabled"'); ?>
				<?php else: ?>
					<?php echo form_input('slug', $page->slug, 'size="20" class="width-10"'); ?>
					<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
				<?php endif;?>

				<?php echo config_item('url_suffix'); ?>
			</li>

			<li>
				<label for="category_id"><?php echo lang('pages.status_label');?></label>
				<?php echo form_dropdown('status', array('draft'=>lang('pages.draft_label'), 'live'=>lang('pages.live_label')), $page->status) ?>
			</li>

			<?php if ($this->method == 'create'): ?>
			<li class="even">
				<label for="navigation_group_id"><?php echo lang('pages.navigation_label');?></label>
				<?php echo form_dropdown('navigation_group_id', array(lang('select.none')) + $navigation_groups, $page->navigation_group_id) ?>
			</li>
			<?php endif; ?>

			<li>
				<?php echo form_textarea(array('id'=>'body', 'name'=>'body', 'value' => stripslashes($page->body), 'rows' => 50, 'class'=>'wysiwyg-advanced')); ?>
			</li>
		</ul>

	</div>

	<!-- Meta data tab -->
	<div id="page-meta">

		<ul>
			<li class="even">
				<label for="meta_title"><?php echo lang('pages.meta_title_label');?></label>
				<input type="text" id="meta_title" name="meta_title" maxlength="255" value="<?php echo $page->meta_title; ?>" />
			</li>
			<li>
				<label for="meta_keywords"><?php echo lang('pages.meta_keywords_label');?></label>
				<input type="text" id="meta_keywords" name="meta_keywords" maxlength="255" value="<?php echo $page->meta_keywords; ?>" />
			</li>
			<li class="even">
				<label for="meta_description"><?php echo lang('pages.meta_desc_label');?></label>
				<?php echo form_textarea(array('name' => 'meta_description', 'value' => $page->meta_description, 'rows' => 5)); ?>
			</li>
		</ul>

	</div>

	<!-- Design tab -->
	<div id="page-design">

		<ul>
			<li class="even">
				<label for="layout_id"><?php echo lang('pages.layout_id_label');?></label>
				<?php echo form_dropdown('layout_id', $page_layouts, $page->layout_id); ?>
			</li>

			<li>
				<label for="css"><?php echo lang('pages.css_label');?></label>
				<div style="margin-left: 160px;">
					<?php echo form_textarea('css', $page->css, 'id="css_editor"'); ?>
				</div>
			</li>
		</ul>

		<br class="clear-both" />

	</div>

	<!-- Script tab -->
	<div id="page-script">

		<ul>
			<li>
				<label for="js"><?php echo lang('pages.js_label');?></label>
				<div style="margin-left: 160px;">
					<?php echo form_textarea('js', $page->js, 'id="js_editor"'); ?>
				</div>
			</li>
		</ul>

		<br class="clear-both" />

	</div>

	<!-- Meta data tab -->
	<div id="page-options">

		<ul>

			<li class="even">
				<label for="restricted_to[]"><?php echo lang('pages.access_label');?></label>
				<?php echo form_multiselect('restricted_to[]', $group_options, $page->restricted_to, 'size="'.(($count = count($group_options)) > 1 ? $count : 2).'"'); ?>
			</li>
			<li>
				<label for="comments_enabled"><?php echo lang('pages.comments_enabled_label');?></label>
				<?php echo form_checkbox('comments_enabled', 1, $page->comments_enabled == 1); ?>
			</li>
			<li class="even">
				<label for="rss_enabled"><?php echo lang('pages.rss_enabled_label');?></label>
				<?php echo form_checkbox('rss_enabled', 1, $page->rss_enabled == 1); ?>
			</li>

			<li>
				<label for="is_home"><?php echo lang('pages.is_home_label');?></label>
				<?php echo form_checkbox('is_home', 1, $page->is_home == 1); ?>
			</li>
		</ul>

	</div>

	<!-- Revisions -->
	<div id="revision-options">
		<ul>
			<!-- Select a revision -->
			<li>
				<label for="use_revision_id"><?php echo lang('pages.preview_revision_title'); ?></label>
				<select id="use_revision_id" name="use_revision_id">
					<!-- Current revision to be used -->
					<optgroup label="<?php echo lang('pages.current_label'); ?>">
						<option value="<?php echo @$page->revision_id; ?>"><?php echo format_date(@$page->revision_date, $this->settings->date_format . ' h:ia '); ?></option>
					</optgroup>
					<!-- All available revisions -->
					<optgroup label="<?php echo lang('pages.revisions_label'); ?>">
						<?php foreach ($revisions as $revision): ?>
						<option value="<?php echo @$revision->id; ?>"><?php echo format_date(@$revision->revision_date, $this->settings->date_format . ' h:ia '); ?></option>
						<?php endforeach; ?>
					</optgroup>
				</select>
				<input type="button" name="btn_preview_revision" id="btn_preview_revision" value="<?php echo lang('pages.preview_label'); ?>" />
			</li>
			<!-- Compare two revisions -->
			<li class="even">
				<label for="compare_revision_1"><?php echo lang('pages.compare_revisions_title'); ?></label>
				<?php $i = 1; while ($i <= 2): ?>
				<select id="compare_revision_<?php echo $i; ?>" name="compare_revision_<?php echo $i; ?>">
					<!-- Current revision to be used -->
					<optgroup label="<?php echo lang('pages.current_label'); ?>">
						<option value="<?php echo @$page->revision_id; ?>"><?php echo format_date(@$page->revision_date, $this->settings->date_format . ' h:ia '); ?></option>
					</optgroup>
					<!-- All available revisions -->
					<optgroup label="<?php echo lang('pages.revisions_label'); ?>">
						<?php foreach ($revisions as $revision): ?>
						<option value="<?php echo @$revision->id; ?>"><?php echo format_date(@$revision->revision_date, $this->settings->date_format . ' h:ia '); ?></option>
						<?php endforeach; ?>
					</optgroup>
				</select>
				<?php ++$i; endwhile; ?>
				<input type="button" name="btn_compare_revisions" id="btn_compare_revisions" value="<?php echo lang('pages.compare_label'); ?>" />
			</li>
		</ul>
	</div>

<div class="buttons align-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
</div>

    <?php echo form_close(); ?>

    </div>
</div>



<script type="text/javascript">
	css_editor('css_editor', "39em");
	js_editor('js_editor', "39em");
</script>