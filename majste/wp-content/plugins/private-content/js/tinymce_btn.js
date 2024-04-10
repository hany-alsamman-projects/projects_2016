// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.PrivateContent', {
		// creates control instances based on the control's id.
		// our button's id is "PrivateContent_button"
		createControl : function(id, controlManager) {
			if (id == 'pg_btn') {
				// creates the button
				var button = controlManager.createButton('pg_btn', {
					title : 'PrivateContent Shortcode', // title of the button
					image : '../wp-content/plugins/private-content/img/users_icon_tinymce.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 80;
						tb_show( 'PrivateContent Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=privatecontent-form' );
						
						
						// ajax load
						var data = { action: 'pg_get_user_cats' };
						jQuery('#pg_cats_wrap').empty().append('<span class="pg_loading"></span>');
						
						jQuery.post(ajaxurl, data, function(response) {
							jQuery('#pg_cats_wrap').empty().append(response);
						});	
						
						// empty the addon container
						jQuery('#pg_tinymce_addon').empty();
						

						////////////////////////////////////////////////////////////////////
						// CUSTOM JAVASCRIPT - USER DATA ADD-ON
						var data = { action: 'pcud_tinymce_add-on' };
						jQuery.post(ajaxurl, data, function(response) {
							if(response != 0) {
								resp = jQuery.parseJSON(response);
					
								jQuery('#pg_tinymce_addon').append(resp.html);
								jQuery('body').append(resp.js);			
							}
						});	
						///////////////////////////////////////////////////////////////////	
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('PrivateContent', tinymce.plugins.PrivateContent);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('\
		<div id="privatecontent-form">\
			<table id="pg_tinymce_table" class="form-table">\
			<tr>\
				<td colspan="2"><strong>PrivateContent block</strong></td>\
			</tr>\
			<tr>\
				<td style="width: 40%;"><label for="pg-all-cats">Content visible by all the categories? </label></td>\
				<td><input type="checkbox" id="pg-all-cats" name="pg-all-cats" value="1" /></td>\
			</tr>\
			<tr id="pg_user_cats_row">\
				<td colspan="2" style="min-height: 100px;">\
					<label for="mygallery-id">Choose the categories that can view the content</label>\
					<div id="pg_cats_wrap"></div>\
				</td>\
			</tr>\
			<tr class="tbl_last">\
				<td><label for="pg-text">Message for non logged users</label></td>\
				<td><textarea id="pg-text" name="pg-text"></textarea></td>\
			</tr>\
			<tr class="tbl_last">\
				<td><input type="button" id="pg-pvt-content-submit" class="button-primary" value="Insert" name="submit" /></td>\
				<td></td>\
			</tr>\
		</table>\
		<br/><hr/>\
		<table class="form-table">\
			<tr>\
			  <td style="width: 33.3%;">\
			  	<input type="button" id="pg-loginform-submit" class="button-primary" value="Insert Login Form" name="submit" />\
			  </td>\
			  <td style="width: 33.3%;">\
			  	<input type="button" id="pg-logoutbox-submit" class="button-primary" value="Insert Logout Box" name="submit" />\
			  </td>\
			  <td style="width: 33.3%;">\
			  	<input type="button" id="pg-regform-submit" class="button-primary" value="Insert Registration Form" name="submit" />\
			  </td>\
			</tr>\
		</table>\
		<div id="pg_tinymce_addon"></div>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		////////////////////////////////////////////////////////
		///// pvt-content
		
		// hide  categories if ALL is checked
		jQuery('#pg-all-cats').click(function() {
			if( jQuery(this).is(':checked') ) { jQuery('#pg_user_cats_row').slideUp(); }
			else { jQuery('#pg_user_cats_row').slideDown(); }
		});
		
		
		// handles the click event of the submit button
		form.find('#pg-pvt-content-submit').click(function(){
			
			if( jQuery('#pg-all-cats').is(':checked') ) {
				var pg_allow = 'all';	
			}
			else {
				// GET ALL CATEGORIES CHECKED	
				var sel_cats = new Array();
				jQuery('#pg_cats_wrap input').each(function(index, element) {
					if( jQuery(this).is(':checked') ) {
						sel_cats.push( jQuery(this).val() );
					}
                });
				
				var pg_allow = sel_cats.join(',');
			}
			
			var pg_message = jQuery('#pg-text').val();
			
			// build the shortcode
			if(pg_allow == 'all') {var pg_sc_allow = ' allow="all"';}
			else {var pg_sc_allow = ' allow="' + pg_allow + '"';}
			
			if(pg_message == '') {var pg_sc_message = '';}
			else {var pg_sc_message = ' message="' + pg_message + '"';}
			

			var shortcode = '[pc-pvt-content' + pg_sc_allow + pg_sc_message + '][/pc-pvt-content]';
			
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
		
		
		////////////////////////////////////////////////////////
		///// login-form
		form.find('#pg-loginform-submit').click(function(){
			var shortcode = '[pc-login-form]';
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
		
		
		////////////////////////////////////////////////////////
		///// logout-box
		form.find('#pg-logoutbox-submit').click(function(){
			var shortcode = '[pc-logout-box]';
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
		
		
		////////////////////////////////////////////////////////
		///// registration-form
		form.find('#pg-regform-submit').click(function(){
			var shortcode = '[pc-registration-form]';
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
		
	});
})()

