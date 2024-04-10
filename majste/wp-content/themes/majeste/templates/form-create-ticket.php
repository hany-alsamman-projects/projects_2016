<?php global $qc_options; ?>


    <form id="contact" action="" method="post" enctype="multipart/form-data">

    <?php do_action( 'qc_ticket_form_top' ); ?>

    <?php do_action( 'qc_ticket_form_before_basic_fields' ); ?>

    <section class="row">
        <label for="ticket_title"><?php _e( 'عنوان المراسلة:', APP_TD ); ?> <span>(مطلوب)</span></label>
        <input type="text" name="ticket_title" value="" class="required field right" />
    </section>
<!---->
<!--    <section class="row">-->
<!---->
<!--        --><?php //if ( current_theme_supports( 'ticket-tags' ) ) : ?>
<!--        <label for="ticket_tags">--><?php //_e( 'تاج:', APP_TD ); ?><!-- </label>-->
<!--        <input type="text" name="ticket_tags" value="" class="field right" />-->
<!---->
<!--        --><?php //endif; ?>
<!---->
<!--    </section>-->


<!--
    <fieldset>

        <?php //do_action( 'qc_ticket_form_advanced_fields', 'create' ); ?>

    </fieldset>
-->

    <section class="row">
        <label for="comment"><?php _e( '        اختر طلبك من قائمة خدماتنا:', APP_TD ); ?> <span>(مطلوب)</span></label>
        <?php do_action( 'qc_ticket_create_cat_dropdown' ); ?>
    </section>


    <?php do_action( 'qc_ticket_form_sales_dropdown', 'create' ); ?>


    <section class="row">
        <label for="comment"><?php _e( 'الشرح:', APP_TD ); ?> </label>
        <textarea name="comment" id="comment" class="required field right" ></textarea>
    </section>

    <?php do_action( 'qc_ticket_form_after_basic_fields' ); ?>

    <?php if ( current_theme_supports( 'ticket-attachments' ) ) : ?>


    <section class="row">
        <label for="comment"><?php _e( 'حمل ملف', APP_TD ); ?> </label>
        <input type="file" name="ticket_attachment" class="right" id="ticket_attachment"/>
    </section>

    <?php endif; ?>


    <?php do_action( 'qc_ticket_form_after_fields' ); ?>

    <section class="row">
        <input type="submit" name="submit" class="button " style="text-align: center" value="ارسل" />
        <input type="hidden" name="action" value="qc-create-ticket" />
        <?php wp_nonce_field( 'qc-create-ticket' ); ?>
        <p></p>
    </section>
    <?php do_action( 'qc_ticket_form_bottom' ); ?>
</form>

<script>

        $.extend({
            getUrlVars: function(){
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++)
                {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            },
            getUrlVar: function(name){
                return $.getUrlVars()[name];
            }
        });


        var lt = $.getUrlVar('sales');

        $("#ticket_assign option").each(function(){

            if ($(this).val() == lt.toLowerCase() ) {
                $(this).prop("selected", true);
            }
        })


	$("#ticket_assign").attr("disabled", false);

	if(lt.length > 2){

		$("#ticket_assign").attr("disabled", true);

		$('#contact').submit(function() {
			$("#ticket_assign").attr("disabled", false);
		});

	}



</script>
