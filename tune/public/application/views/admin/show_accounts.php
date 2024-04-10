<?php if (!empty($users)): ?>

        <section class="grid_9">
			<div class="block-border">
            <form class="block-content form" name="table_form" id="table_form" method="post" action="">
				<h1>
					Grid view
					<a href="#"><img src="images/icons/fugue/plus-circle-blue.png" width="16" height="16"> add</a>
				</h1>
				
				<div class="block-controls">
                     
					<ul class="controls-buttons">
 
                      
                      
					   <li><a href="#"><img src="images/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
                    
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
								<small><?php echo $member['name']; ?></small>
								<p class="grid-name"><?=$member['name']?></p>
								<p class="grid-details"><?php echo $member['email'] ?><br>
								<strong>Active</strong>: <b><?php echo $member['activated']  ? 'yes' : 'no' ; ?></b><br>
								Last login: <b><?php echo ( $member['action_time'] > 0 ) ? date("j-m-Y", $member['last_login']) : 'never' ?></b></p>
							</div>
							<ul class="grid-actions">
                                <li><a class="confirm with-tip" href="./?section=ActiveMember&id=<?=$member['id']?>" title="active"><img src="images/icons/fugue/<?php echo $member['activated']  ? 'deactive.png' : 'active.png' ; ?>" width="16" height="16"></a></li>
                                <li><a class="confirm with-tip" href="./?section=EditMember&id=<?=$member['id']?>" title="edit"><img src="images/icons/fugue/pencil.png" width="16" height="16"></a></li>
                                <li><a class="confirm with-tip" href="./?section=RemoveMember&id=<?=$member['id']?>" title="delete"><img src="images/icons/fugue/cross-circle.png" width="16" height="16"></a></li>
								<li><input type="checkbox" name="action_to[]" value="<?=$member['id']?>" /></li>
							</ul>
						</li>                        
                        <?php endforeach; ?>
                                                      
                    </ul>

				</div>
				
				<ul class="message no-margin">
					<li>Results <strong><?=count($users)?></strong></li>
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
						<option value="delete">delete</option>
					</select>
					<button type="submit" class="small">Ok</button>
				</div>
					
			</form></div>
		</section>
        
    <?php else: ?>
    
    	<div class="blank-slate">

    		<h2>NOT FOUND ANY USERS</h2>
            
    	</div>
        
    <?php endif; ?>        