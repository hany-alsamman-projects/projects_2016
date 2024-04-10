<?php
/**
 * @package Quality_Control
 * @since Codex Corp 0.2
 */

global $qc_options; ?>

<?php do_action( 'qc_ticket_before' ); ?>

<?php appthemes_before_comments_form(); ?>

<div id="respond">

	<form id="update-ticket" action="<?php echo site_url( 'wp-comments-post.php' ); ?>" method="post" name="add-ticket" enctype="multipart/form-data">

		<?php do_action( 'qc_ticket_form_top' ); ?>

		<?php do_action( 'qc_ticket_form_before_fields' ); ?>

		<fieldset>

			<legend>
				<?php _e( 'رد على المراسلة', APP_TD ); ?>
			</legend>

			<?php do_action( 'qc_ticket_form_before_basic_fields' ); ?>

			<p>
				<textarea name="comment" id="comment"></textarea>
			</p>

			<?php do_action( 'qc_ticket_form_after_basic_fields' ); ?>

		</fieldset>

        <?php if (current_user_can('publish_posts') == true){ ?>
		<fieldset id="edit_ticket_data">

			<legend>
				<?php _e( 'يمكنك تعديل بعض المعلومات', APP_TD ); ?>
			</legend>

			<?php if ( !current_theme_supports( 'ticket-tags' ) ) : ?>

				<p id="ticket-tags">
					<label for="ticket_tags"><?php _e( 'Tags: <em>(Optional) Separated multiple tags with commas.</em>', APP_TD ); ?></label>
					<input type="text" name="ticket_tags" value="<?php echo qc_get_ticket_tags( $post->ID ); ?>" />
				</p>

			<?php endif; ?>



			<?php do_action( 'qc_ticket_form_advanced_fields', 'update' ); ?>



		</fieldset>

<!--        <fieldset style="text-align: right; padding: 5px">

            <legend style="color: white">تعديل القسم</legend>

            <?php /*//do_action( 'qc_ticket_create_cat_dropdown' ); */?>

        </fieldset>-->

        <?php } ?>

        <?php
        //$category = end(get_the_category());
        //$current =$category->cat_ID;
        //$current_name = $category->cat_name;



        if(current_user_can( 'read' ) && !current_user_can( 'edit_published_posts' )){

            $catid = get_the_category( get_the_ID() );
            $get_status = qc_taxonomy( 'ticket_status', false );
            //$old_balance = get_post_meta( get_the_ID() , '_balance' );

            echo '<input type="hidden" name="ticket_status" value="'.$get_status->term_id.'" />';
            echo '<input type="hidden" name="category" value="'.$catid[0]->cat_ID.'" />';
        }
?>

        <?php do_action( 'qc_ticket_form_sales_dropdown', 'update' ); ?>

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

		<p class="form-submit" style="margin-top: 20px">


			<input type="submit" style="text-align: center" class="button" name="submit" value="<?php _e( 'تعديل', APP_TD ); ?>" />

			<?php do_action( 'comment_form', $post->ID ); ?>
			<?php comment_id_fields(); ?>
		</p>

		<?php do_action( 'qc_ticket_form_bottom' ); ?>

	</form>
    <script>

        $("select#ticket_status").change(function() {
            if ($(this).val() == "8") {
                $('#edit_ticket_data legend').after('<p class="inline-input"><label>المبلغ</label><input style="height: 14px" type="text" name="_balance"></p>');
            }
        });

    </script>

</div>

<?php appthemes_after_comments_form(); ?>
