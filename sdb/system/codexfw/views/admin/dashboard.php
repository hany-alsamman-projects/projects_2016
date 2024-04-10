        <section class="grid_4">
			<!--<div class="block-border"><div class="block-content">-->
				<h1><?php echo lang('cp_admin_quick_links') ?></h1>
				
				<ul class="favorites no-margin with-tip" title="Context menu available!">
					
			<?php if(in_array('comments', $this->permissions) OR $this->user->group == 'admin'): ?>
			<li class="clearfix">
				<img src="system/codexfw/assets/img/admin/icons/web-app/48/Comment.png" width="48" height="48">
				<a href="<?php echo site_url('admin/comments') ?>"><?php echo lang('cp_manage_comments'); ?><br>
				<small>System &gt; <?php echo lang('cp_manage_comments'); ?></small></a>
			</li>
			<?php endif; ?>
			
			<?php if(in_array('pages', $this->permissions) OR $this->user->group == 'admin'): ?>
			<li class="clearfix">
				<img src="system/codexfw/assets/img/admin/icons/web-app/48/Modify.png" width="48" height="48">
				<a href="<?php echo site_url('admin/pages') ?>"><?php echo lang('cp_manage_pages'); ?><br>
				<small>System &gt; <?php echo lang('cp_manage_pages'); ?></small></a>
			</li>
			<?php endif; ?>
			
			<?php if(in_array('files', $this->permissions) OR $this->user->group == 'admin'): ?>
			<li class="clearfix">
				<img src="system/codexfw/assets/img/admin/icons/web-app/48/Info.png" width="48" height="48">
				<a href="<?php echo site_url('admin/files') ?>"><?php echo lang('cp_manage_files'); ?><br>
				<small>System &gt; <?php echo lang('cp_manage_files'); ?></small></a>
			</li>
			<?php endif; ?>
			
			<?php if(in_array('users', $this->permissions) OR $this->user->group == 'admin'): ?>
			<li class="clearfix">
				<img src="system/codexfw/assets/img/admin/icons/web-app/48/Profile.png" width="48" height="48">
				<a href="<?php echo site_url('admin/users') ?>"><?php echo lang('cp_manage_users'); ?><br>
				<small>System &gt; <?php echo lang('cp_manage_users'); ?></small></a>
			</li>
			<?php endif; ?>
					
				</ul>
				
				<form class="form" name="stats_options" id="stats_options" method="post" action="">
					<fieldset class="grey-bg no-margin">
						<legend>Add favourite</legend>
						<p class="input-with-button">
							<label for="simple-action">Select page</label>
							<select name="simple-action" id="simple-action">
								<option value=""></option>
								<option value="1">Page 1</option>
								<option value="2">Page 2</option>
							</select>
							<button type="button">Add</button>
						</p>
					</fieldset>
				</form>
				
			<!--</div></div>-->
		</section>
		
		<section class="grid_8">
			<div class="block-border"><div class="block-content">
				<!-- We could put the menu inside a H1, but to get valid syntax we'll use a wrapper -->
			
				<div class="block-controls">
					
					<ul class="controls-tabs js-tabs same-height with-children-tip">
						<li><a href="#tab-panel" title="Con"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Info.png" width="24" height="24"></a></li>
                        <li><a href="#tab-stats" title="Charts"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Bar-Chart.png" width="24" height="24"></a></li>
						<li><a href="#tab-infos" title="Informations"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Info.png" width="24" height="24"></a></li>
					</ul>
					
				</div>
                
                <div id="tab-panel">
                
				<div class="h1">
					<h1>Control Panel</h1>
				</div>
                
                
				<h3>General options</h3>
				<ul class="shortcuts-list">
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Bar-Chart.png" width="48" height="48"> Stats
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Comment.png" width="48" height="48"> Comments
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Email.png" width="48" height="48"> Mail
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Delete.png" width="48" height="48"> Exit
					</a></li>
				</ul>
				
				<h3>Content management</h3>
				<ul class="shortcuts-list">
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Modify.png" width="48" height="48"> Write
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Profile.png" width="48" height="48"> My profile
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Search.png" width="48" height="48"> Search
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Add.png" width="48" height="48"> Add post
					</a></li>
				</ul>
				
				<h3>System</h3>
				<ul class="shortcuts-list">
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Info.png" width="48" height="48"> Settings
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Loading.png" width="48" height="48"> Monitoring
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Picture.png" width="48" height="48"> Images
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Pie-Chart.png" width="48" height="48"> Usage
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Print.png" width="48" height="48"> Print report
					</a></li>
					<li><a href="#">
						<img src="system/codexfw/assets/img/admin/icons/web-app/48/Save.png" width="48" height="48"> Backup
					</a></li>
				</ul>
                            
                </div>
                
                
				
				<div id="tab-stats">
                
				<div class="h1">
					<h1>Web Stats</h1>
				</div>
                
                
                    <script type="text/javascript">
                    
                	// Add listener for tab
                    jQuery(function($) {
    					$('#tab-stats').onTabShow(function() { 
    					   
                    		var visits = <?php echo $analytic_visits; ?>;
                    		var views = <?php echo $analytic_views; ?>;
                    		
                    		$('#analytics').css({
                    			height: '300px',
                    			width: '95%',
                                float: 'right'
                    		});
                    
                    		$.plot($('#analytics'), [{ label: 'Visits', data: visits },{ label: 'Page views', data: views }], {
                    			lines: { show: true },
                    			points: { show: true },
                    			grid: { backgroundColor: '#fffaff' },
                    			series: {
                    				lines: { show: true, lineWidth: 1 },
                    				shadowSize: 0
                    			},
                    			xaxis: { mode: "time" },
                    			yaxis: { min: 0},
                    			selection: { mode: "x" }
                    		});
                    		
                            // Message
                    		notify('Chart updated');
                           
    					});
                    });
                    
                    </script>
					
					<div  id="analytics" class="line" style="height:330px; padding-bottom: 10px"></div>

				</div>
				
				
				<div id="tab-infos" class="with-margin">
                
				<div class="h1">
					<h1>Codex News Feeds</h1>
				</div>

                    <h3><?php echo lang('cp_news_feed_title'); ?></h3>

        			<ul id="news-feed">
        				<?php foreach($rss_items as $rss_item): ?>
        				<li>
        					<h3><?php echo anchor($rss_item->get_permalink(), $rss_item->get_title(), 'target="_blank"'); ?></h3>
        					
        					<?php
        						$item_date	= strtotime($rss_item->get_date());
        						$item_month = date('M', $item_date);
        						$item_day	= date('j', $item_date);
        					?>
        					<div class="date">
        						<span><?php echo $item_month ?></span>
        						<?php echo $item_day; ?>
        					</div>
        										
        					<p class='item_body'><?php echo $rss_item->get_description(); ?></p>
        				</li>
        				<?php endforeach; ?>
        			</ul>
            
				</div>
				
				<ul class="message no-margin">
					<li><strong>  Total vistits :  <?php echo $total_visits; ?></strong></li>
				</ul>
				
			</div></div>
		</section>
		
		<div class="clear"></div>