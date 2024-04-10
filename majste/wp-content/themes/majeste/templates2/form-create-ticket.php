<?php global $qc_options; ?>

<div class="widget-header">
    <i class="icon-list-alt" style="float: right"></i><h5 style="float: right">انشاء مراسلة</h5>
    <div class="widget-buttons">

    </div>
</div>
<div class="widget-body">
    <div class="widget-forms clearfix">

<div id="respond">

	<form id="contact" action="" class="form-horizontal" method="post" enctype="multipart/form-data">

		<?php do_action( 'qc_ticket_form_top' ); ?>

		<fieldset>

			<legend>
				<?php _e( 'تعبئة الجدول', APP_TD ); ?>
			</legend>

			<?php do_action( 'qc_ticket_form_before_basic_fields' ); ?>

			<p id="ticket-title">
				<label for="ticket_title"><?php _e( 'العنوان:', APP_TD ); ?></label>
				<input type="text" class="span7" placeholder="اكتب هنا ..."  name="ticket_title" value="" class="required" />
			</p>

			<p>
				<label for="comment"><?php _e( 'الشرح:', APP_TD ); ?></label>
				<textarea name="comment" id="comment" class="required" ></textarea>
			</p>

			<?php if ( current_theme_supports( 'ticket-tags' ) ) : ?>

				<p id="ticket-tags">
					<label for="ticket_tags"><?php _e( 'علامات: <em>(اختياريه)</em>', APP_TD ); ?></label>
					<input type="text" class="span7" placeholder="اكتب هنا ..."  name="ticket_tags" value="" />
				</p>

			<?php endif; ?>

			<?php do_action( 'qc_ticket_form_after_basic_fields' ); ?>

		</fieldset>

		<fieldset style="float:right">

			<legend>
				<?php _e( '', APP_TD ); ?>
			</legend>

			<?php do_action( 'qc_ticket_form_advanced_fields', 'create' ); ?>

		</fieldset>

		<?php if ( current_theme_supports( 'ticket-attachments' ) ) : ?>

			<fieldset>

				<legend>
					<?php _e( 'ارفق ملف', APP_TD ) ; ?>
				</legend>

				<p id="ticket-attachment">
					<input type="file" name="ticket_attachment" id="ticket_attachment"/>
				</p>

			</fieldset>

		<?php endif; ?>

		<?php do_action( 'qc_ticket_form_after_fields' ); ?>


			<input type="hidden" name="action" value="qc-create-ticket" />
			<?php wp_nonce_field( 'qc-create-ticket' ); ?>

</div>

    </div>
</div>
<div class="widget-footer">
    <button class="btn  btn-large" type="submit">اضافة وحفظ</button>
</div>
</form>