/**************************
         LOGIN
**************************/

// loading image to append
jQuery(document).ready(function(){
	pg_loader = '<span class="pg_loading"></span>';
});

// add login form
jQuery(document).ready(function(){
	jQuery('.pg_login_trig').live('click', function() {

		var cur_url = jQuery(location).attr('href');
		
		jQuery('.pg_login_trig').parent().slideUp();
		jQuery(this).parents('.pg_login_block').empty().append(' ' + pg_loader);
		
		jQuery.ajax({
			type: "POST",
			url: cur_url,
			data: "type=pg_get_auth_form",
			success: function(response){
				
				jQuery('.pg_login_block').empty().append(response);
				
				var auca = jQuery('.pg_login_block').attr('id');
				jQuery('#pg_auth_auca').val(auca);
			}
		});
	});	
});


// handle form
jQuery(document).ready(function(){
	jQuery('.pg_auth_btn').live('click', function() {
		$target_form = jQuery(this).parents('form');
		
		var f_data = $target_form.serialize();
		
		$target_form.find('.pg_loginform_loader').empty().append(pg_loader);
		
		var cur_url = jQuery(location).attr('href');
		jQuery.ajax({
			type: "POST",
			url: cur_url,
			dataType: "json",
			data: "type=js_ajax_auth&" + f_data,
			success: function(pg_data){
				//var pg_data = jQuery.parseJSON(jQuery.trim(response));
				
				//resp = jQuery.trim(response['resp']);
				jQuery('.pg_loginform_loader').empty();
		
				if(pg_data.resp == 'success') {
					$target_form.find('#pg_auth_message').empty().append('<span class="pg_success_mess">' + pg_data.mess + '</span>');
					
					if(pg_data.redirect == '') {var red_url = cur_url;}
					else {var red_url = pg_data.redirect;}
					
					setTimeout(function() {
					  window.location.href = red_url;
					}, 1000);
				}
				else {
					$target_form.find('#pg_auth_message').empty().append('<span class="pg_error_mess">' + pg_data.mess + '</span>');	
				}
			}
		});
	});	
});



/**************************
         LOGOUT
**************************/

// execute logout		 
jQuery(document).ready(function(){	
	jQuery('.pg_logout_btn').live('click', function() {
		
		jQuery(this).parent().append(' <span class="pg_loading"></span>');
		
		var cur_url = jQuery(location).attr('href');
		jQuery.ajax({
			type: "POST",
			url: cur_url,
			data: "type=pg_logout",
			success: function(response){
				resp = jQuery.trim(response);
				
				if(resp == '') {window.location.href = cur_url;}
				else {window.location.href = resp;}
			}
		});	
	});
});
	
	
	
/**************************
       REGISTRATION
**************************/	

// handle form
jQuery(document).ready(function(){
	jQuery('.pg_reg_btn').live('click', function() {
		$target_form = jQuery(this).parents('form');
		
		var f_data = $target_form.serialize();
		
		$target_form.find('.pg_loginform_loader').empty().append(pg_loader);
		
		var cur_url = jQuery(location).attr('href');
		jQuery.ajax({
			type: "POST",
			url: cur_url,
			data: "type=js_ajax_registration&" + f_data,
			dataType: "json",
			success: function(pg_data){
				if(pg_data.resp == 'success') {
					jQuery('#pg_reg_message').empty().append('<span class="pg_success_mess">' + pg_data.mess + '</span>');
					
					// redirect
					if(pg_data.redirect != '') {
						setTimeout(function() {
						  window.location.href = pg_data.redirect;
						}, 1000);
					}
				}
				else {
					jQuery('#pg_reg_message').empty().append('<span class="pg_error_mess">' + pg_data.mess + '</span>');
					
					// if exist recaptcha - reload
					if( jQuery('#recaptcha_response_field').size() > 0 ) {
						Recaptcha.reload();	
					}
				}
				
				$target_form.find('.pg_loginform_loader').empty();
			}
		});
	});
});
	