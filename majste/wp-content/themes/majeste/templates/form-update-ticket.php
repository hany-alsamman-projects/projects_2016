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


			<input type="submit" style="text-align: center" class="button" name="submit" value="<?php _e( 'ارسال', APP_TD ); ?>" />

			<?php do_action( 'comment_form', $post->ID ); ?>
			<?php comment_id_fields(); ?>
		</p>

		<?php do_action( 'qc_ticket_form_bottom' ); ?>

	</form>

    <?
    if ( current_user_can('manage_options') ){
    ?>

    <script>

        $("select#ticket_status").change(function() {

            if($(this).val() != "3") $("#reason_info").remove();
            if($(this).val() != "8") $("#paid_val, #remain_val").remove();


            if ($(this).val() == "8") {

                <?
                $paid = @get_post_meta( get_the_ID() , '_paid' );
                $remain = @get_post_meta( get_the_ID() , '_remain' );
                ?>

                $('#edit_ticket_data legend').after('' +
                        '<p class="inline-input" id="paid_val">' +
                        '<label>المسدد</label>' +
                        '<input style="height: 14px" value="<?=$paid[0]?>" type="text" id="paid" name="_paid"></p>' +
                        '<p class="inline-input" id="remain_val"><label>المتبقي</label>' +
                        '<input style="height: 14px" value="<?=$remain[0]?>" type="text" id="remain" name="_remain"></p>');

                $('input#paid').bind('keypress', function(e) {
                    return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
                });

                $('input#remain').bind('keypress', function(e) {
                    return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
                });
            }


            if ($(this).val() == "3") {

            <?
            $reason = @get_post_meta( get_the_ID() , '_reason' );
            ?>

                $("#reason_info").remove();

                $('#edit_ticket_data legend').after('' +
                        '<p class="inline-input" id="reason_info">' +
                        '<label>* سبب الاغلاق</label>' +
                        '<input style="height: 14px" value="<?=$reason[0]?>" type="text" id="reason" name="_reason"></p>');

            }

        });

        if( $("#ticket_status option:selected").val() == '3' ){

        <?
        $reason = @get_post_meta( get_the_ID() , '_reason' );
        ?>

            $('#edit_ticket_data legend').after('' +
                    '<p class="inline-input" id="reason_info">' +
                    '<label>* سبب الاغلاق</label>' +
                    '<input style="height: 14px" value="<?=$reason[0]?>" type="text" id="reason" name="_reason"></p>');

        }

    </script>
    <?
    }
    ?>

</div>

<?php appthemes_after_comments_form(); ?>
