<?php if (!empty($blog)): ?>
<?php foreach ($blog as $post): ?>
<div class="event">
<div class="blog_box">

				
				<div class="blog_content" style="width:460px; float:left;">
					
					<div class="blog_title"><h4><a href="simple.html">
                    <?php echo  anchor('blog/' .date('Y/m', $post->created_on) .'/'. $post->slug, $post->title); ?></a>
                    </h4></div>
					
					
					<div class="blog_short_text">
						<div class="blog_content_text">	
                        <div style="width:25%; float: left;">					
							<div><div class="box_image_inside"><img align="right" src="/uploads/news/<?php echo $post->picture ?>" style="max-width:100px;" alt="" />
                            
                            </div>
                            <div class="blog_info">						
							<ul>
								<li><?php echo lang('blog_posted_label');?>: <?php echo format_date($post->created_on); ?></li>
							</ul>							
						</div>
                            </div>
                            </div>
                       <?php echo $post->intro; ?>
                            					
                            							
			
						</div>

					</div>

				</div>
</div>
</div>
<?php endforeach; ?>

<?php echo $pagination['links']; ?>

<?php else: ?>
	<p><?php echo lang('blog_currently_no_posts');?></p>
<?php endif; ?>

