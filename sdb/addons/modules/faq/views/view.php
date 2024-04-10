<h3 class="faq-heading"><?php echo $title; ?></h3>
<?php if(!empty($faqs)): ?>
<ul id="faq">
    <?php foreach($faqs as $faq): ?>
    <li class="question">
        <?php echo $faq->question; ?>
        <span><?php echo lang('faq_question_label'); ?>: </span>
        
    </li>
    <li class="answer"><?php echo $faq->answer; ?></li>
    <?php endforeach; ?>
</ul>

<?php else: ?>
    <p><?php echo lang('faq_no_questions'); ?></p>
<?php endif; ?>
