<?php if ($comments): ?>

<ul class="children">
    <?php foreach ($comments as $comment): ?>
    <li id="comment-<? echo $comment->id?>" class="comment even depth-2">
	<div id="div-comment-<? echo $comment->id?>" class="comment-body">
		<div class="comment-author vcard">
			<div class="avatar" style="background: url(/uploads/files/hany.jpg) repeat scroll 0% 0% transparent;"></div>
			<cite class="fn">
			
		<?php if ($comment->user_id): ?>
		      <?php echo anchor('user/' . $comment->user_id, $this->ion_auth->get_user($comment->user_id)->display_name); ?>
		<?php else: ?>
		      <?php echo anchor($comment->website, $comment->name); ?>
		<?php endif; ?>
            
			</cite> </div>
		<div class="comment-meta commentmetadata">
			<a href="#"><?php echo format_date($comment->created_on); ?></a></div>
            <br />
		<p><?php echo nl2br($comment->comment); ?></p>
	</div>
	</li>
    <?php endforeach; ?>
</ul>


<?php else: ?>
	<p><?php echo lang('comments.no_comments'); ?></p>
<?php endif; ?>

<div id="comments_form_container"></div>
	<?php echo $form; ?>
</div>