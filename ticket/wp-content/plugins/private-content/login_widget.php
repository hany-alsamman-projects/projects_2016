<?php
// LOGIN WIDGET
 
class PrivateContentLogin extends WP_Widget {
	
  function PrivateContentLogin() {
    $widget_ops = array('classname' => 'PrivateContentLogin', 'description' => 'Displays a login form for PrivateContent users' );
    $this->WP_Widget('PrivateContentLogin', 'PrivateContent Login', $widget_ops);
  }
 
 
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title') ?>:</label> <br />
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </p>
<?php
  }
  
 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
  
 
  function widget($args, $instance) {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	  
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 		
		// switch if is logged or not
		if(isset($_SESSION['pg_user_id'])) :
			// get user data
			$user_data = $wpdb->get_row( $wpdb->prepare( "SELECT name, surname FROM  ".$table_name." WHERE ID = '".$_SESSION['pg_user_id']."' ") );
		
		?>
        	<p><?php _e('Welcome') ?> <?php echo ucfirst($user_data->name).' '.($user_data->surname); ?></p>
        	<p>
                <form>
                    <input type="button" name="pg_widget_logout" class="pg_logout_btn pg_trigger" value="<?php _e('Logout', 'pg_ml') ?>" />
                    <span class="pg_loginform_loader"></span>
                </form>
            </p>
        
        <?php else :?>
           <form>
              <input type="hidden" name="auca" value="single" id="pg_auth_auca" />
           
              <label><?php _e('Username', 'pg_ml') ?></label>
              <input type="text" name="pg_auth_username" value=""  />
              
              <br/>
              
              <label><?php _e('Password', 'pg_ml') ?></label>
              <input type="password" name="pg_auth_psw" value=""  />
              
              <br/>
              <div id="pg_auth_message"><br/></div>
              
              <input type="button" class="pg_auth_btn" value="<?php _e('Submit', 'pg_ml') ?>" />
              <div class="pg_loginform_loader"></div>
          </form>
	  <?php 
	  endif;
	  
	  echo $after_widget;
  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("PrivateContentLogin");') );
?>