<?php $user = wp_get_current_user(); ?>

<style>

    #respond form{
        text-align: right;
        float:right;
        width:70%;
    }

    #respond form input{
        float:left;
        width:150px;
    }

    #respond form label{
        float:right;
        width:150px;
        text-align: right;
    }

</style>


<div id="respond">

	<form action="" method="post">
		<?php wp_nonce_field( 'app-edit-profile' ); ?>
		<input type="hidden" name="action" value="app-edit-profile" />

		<input type="hidden" name="user_id" value="<?php echo (int) $user->ID; ?>" />

		<fieldset>

			<legend><?php _e( 'الملف الشخصي', APP_TD ); do_action( 'appthemes_notice' ); ?></legend>
<?php if (current_user_can('edit_published_posts')){ ?>
            <p id="sales-url">
                <label for="sales-url"><?php _e( 'رابط التسجيل الخاص بي', APP_TD ); ?></label>
                <a href="<?php echo home_url( 'create-ticket?sales=' . esc_attr( $user->user_login ) ); ?>"><?php echo home_url( '?page_id=5&sales=' . esc_attr( $user->user_login ) ); ?></a>
            </p>
<?php }?>
			<p id="user-display-name">
				<label for="display_name"><?php _e( 'اسم المستخدم:', APP_TD ); ?></label>
				<input name="display_name" type="text" value="<?php echo esc_attr( $user->display_name ); ?>" />
			</p>

            <p id="user-phone">
                <label for="user-phone"><?php _e( 'رقم الهاتف:', APP_TD ); ?></label>
                <input name="aim" type="text" value="<?php echo esc_attr( $user->aim ); ?>" />
            </p>

			<p id="user-email">
				<label for="email"><?php _e( 'البريد الالكتروني:', APP_TD ); ?></label>
				<input name="email" type="text" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>

			<p id="user-password">
				<label for="password"><?php _e( 'كلمة السر الجديدة:', APP_TD ); ?></label>
                <br class="clear" />
				<input type="password" name="pass1" id="pass1"  value="" autocomplete="off" /> <span class="description"><?php _e( "اذا كنت تريد تغيير كلمة السر لخاصة بك اكتب كلمة السر الجديدة هنا.", APP_TD ); ?></span>
				<br class="clear" />
				<input type="password" name="pass2" id="pass2"  value="" autocomplete="off" /> <span class="description"><?php _e( "اعد كتابة كلمة السر مرة هنا اخرى.", APP_TD ); ?></span><br />
                <br class="clear" />
			</p>

		</fieldset>

		<p >
			<input type="submit" style="text-align: center" value="<?php _e( 'تعديل', APP_TD ); ?>" />
		</p>

	</form>

</div>

