<script type="text/javascript">
(function($) {
	
	$(".avatar").each(function() {
	
		var source = $(this).attr("src");
		
		$("<div />", {
		
			"class": "avatar",
			"css": {
				"background": "url(" + source + ")"
			}
		
		}).insertAfter($(this));
		
		$(this).remove();
	
	});

	
})(jQuery);
</script>

<ol class="commentlist group">

<li id="comment" class="comment odd alt thread-odd thread-alt depth-1 parent">

<div id="div-comment-<?php echo $post->id ?>" class="comment-body">
	
    <h3 class="rtl"><?php echo $post->title; ?></h3>
    
    <br />
	
    <div class="comment-author vcard">
		<div class="avatar">
		</div>
        <?php if ($post->author): ?>
		<cite class="fn"><a class="url" href="#"><?php echo anchor('user/' . $post->author_id, $post->author->display_name); ?></a></cite>
        <?php endif; ?>
        
		<span class="says">says:</span>
    </div>
    
	<div class="comment-meta commentmetadata">
    
    <a href="#"><?php echo format_date($post->created_on); ?></a></div>
   
    <?php if($post->category->slug): ?>
	<p><?php echo anchor('blog/category/'.$post->category->slug, $post->category->title);?>.</p>
    <?php endif; ?>
    
    <div style= "width:95%; float: right;"><?php echo $post->body; ?></div>
    
</div>
<div id="add_comm_ico"><a href="#">اكتب تعليقاً</a></div>
<?php if ($post->comments_enabled): ?>
	<?php echo display_comments($post->id); ?>
<?php endif; ?>

</li>
</ol>