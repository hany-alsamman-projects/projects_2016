<?php
/**
 * class-groups-notifications-admin-notifications.php
 *
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package groups-notifications
 * @since groups-notifications 1.3.0
 */

/**
 * Admin settings for Groups Notifications.
 */
class Groups_Notifications_Admin_Settings {

	const NONCE = 'groups-notifications-admin-nonce';

	/**
	 * Show notifications
	 */
	public static function view() {

		$output = '';

		if ( !current_user_can( GROUPS_ADMINISTER_GROUPS ) ) {
			wp_die( __( 'Access denied.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) );
		}

		if ( isset( $_POST['submit'] ) ) {

			if ( !wp_verify_nonce( $_POST[self::NONCE], 'settings' ) ) {
				wp_die( __( 'I fart in your general direction.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) );
			}

			Groups_Options::update_option( Groups_Notifications::NOTIFY_REGISTERED_GROUP, !empty( $_POST[Groups_Notifications::NOTIFY_REGISTERED_GROUP] ) );

			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_GROUPS_CREATED_USER_GROUP, !empty( $_POST[Groups_Notifications::NOTIFY_ADMIN_GROUPS_CREATED_USER_GROUP] ) );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_SUBJECT_CREATED, $_POST[Groups_Notifications::NOTIFY_ADMIN_SUBJECT_CREATED] );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_MESSAGE_CREATED, $_POST[Groups_Notifications::NOTIFY_ADMIN_MESSAGE_CREATED] );

			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_GROUPS_DELETED_USER_GROUP, !empty( $_POST[Groups_Notifications::NOTIFY_ADMIN_GROUPS_DELETED_USER_GROUP] ) );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_SUBJECT_DELETED, $_POST[Groups_Notifications::NOTIFY_ADMIN_SUBJECT_DELETED] );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_ADMIN_MESSAGE_DELETED, $_POST[Groups_Notifications::NOTIFY_ADMIN_MESSAGE_DELETED] );

			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_GROUPS_CREATED_USER_GROUP, !empty( $_POST[Groups_Notifications::NOTIFY_USER_GROUPS_CREATED_USER_GROUP] ) );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_SUBJECT_CREATED, $_POST[Groups_Notifications::NOTIFY_USER_SUBJECT_CREATED] );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_MESSAGE_CREATED, $_POST[Groups_Notifications::NOTIFY_USER_MESSAGE_CREATED] );

			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_GROUPS_DELETED_USER_GROUP, !empty( $_POST[Groups_Notifications::NOTIFY_USER_GROUPS_DELETED_USER_GROUP] ) );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_SUBJECT_DELETED, $_POST[Groups_Notifications::NOTIFY_USER_SUBJECT_DELETED] );
			Groups_Options::update_option( Groups_Notifications::NOTIFY_USER_MESSAGE_DELETED, $_POST[Groups_Notifications::NOTIFY_USER_MESSAGE_DELETED] );

		}

		$notify_registered_group = Groups_Options::get_option( Groups_Notifications::NOTIFY_REGISTERED_GROUP, false );

		$notify_admin_created  = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_GROUPS_CREATED_USER_GROUP, false );
		$subject_admin_created = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_SUBJECT_CREATED, Groups_Notifications::$subjects['admin']['created'] );
		$message_admin_created = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_MESSAGE_CREATED, Groups_Notifications::$messages['admin']['created'] );

		$notify_user_created  = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_GROUPS_CREATED_USER_GROUP, false );
		$subject_user_created = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_SUBJECT_CREATED, Groups_Notifications::$subjects['user']['created'] );
		$message_user_created = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_MESSAGE_CREATED, Groups_Notifications::$messages['user']['created'] );

		$notify_admin_deleted  = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_GROUPS_DELETED_USER_GROUP, false );
		$subject_admin_deleted = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_SUBJECT_DELETED, Groups_Notifications::$subjects['admin']['deleted'] );
		$message_admin_deleted = Groups_Options::get_option( Groups_Notifications::NOTIFY_ADMIN_MESSAGE_DELETED, Groups_Notifications::$messages['admin']['deleted'] );

		$notify_user_deleted  = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_GROUPS_DELETED_USER_GROUP, false );
		$subject_user_deleted = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_SUBJECT_DELETED, Groups_Notifications::$subjects['user']['deleted'] );
		$message_user_deleted = Groups_Options::get_option( Groups_Notifications::NOTIFY_USER_MESSAGE_DELETED, Groups_Notifications::$messages['user']['deleted'] );

		// options form
		$output .=
			'<h2>' . __( 'Notification Settings', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h2>' .
			'<div class="groups-notifications-settings">' .
			'<form action="" name="settings" method="post">' .		
			'<div>';

		$output .= '<div class="panel">';
		$output .='<h3>' . __( 'Message format', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h3>';

		$output .= '<p class="description">' . __( 'The message format is HTML.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';
		$output .= '<p class="description">' . __( 'Line breaks must be inserted explicitly using <code>&lt;br/&gt;</code>.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';
		$output .= '<p class="description">' . __( 'A plain text version is generated automatically and included with the HTML version of messages sent.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';
		$output .= '<p class="description">' . __( 'These tokens can be used in the subject and message: [group_name] [user_email] [user_login] [site_title] [site_url].', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';
		$output .= '</div>';

		$output .= '<div class="save">';
		$output .= '<input type="submit" class="button" name="submit" value="' . __( 'Save', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '"/>';
		$output .= '<div>';

		$output .= '<h3>';
		$output .= __( 'Registered group', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</h3>';

		$output .= '<div class="check">';
		$output .= '<label>';
		$output .= sprintf( '<input type="checkbox" name="%s" %s />', esc_attr( Groups_Notifications::NOTIFY_REGISTERED_GROUP ), $notify_registered_group ? ' checked="checked" ' : '' );
		$output .= ' ';
		$output .= __( 'Send notifications for the <em>Registered</em> group.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</label>';
		$output .= '</div>';

		//
		// Admin notifications
		//

		$output .= '<h3>';
		$output .= __( 'Administrator Notifications', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</h3>';

		$output .= '<p>' . __( 'When enabled, these notifications are sent to the site admin.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';

		//
		// Notify admin when a user has joined a group
		//

		$output .= '<div class="notification">';
		$output .= '<h4>' . __( 'User joined', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h4>';
		
		$output .= '<div class="check">';
		$output .= '<label>';
		$output .= sprintf( '<input type="checkbox" name="%s" %s />', esc_attr( Groups_Notifications::NOTIFY_ADMIN_GROUPS_CREATED_USER_GROUP ), $notify_admin_created ? ' checked="checked" ' : '' );
		$output .= ' ';
		$output .= __( 'Notify when a user has joined a group.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="subject">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Subject', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<input type="text" name="%s" value="%s" />', Groups_Notifications::NOTIFY_ADMIN_SUBJECT_CREATED, esc_attr( $subject_admin_created ) );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="message">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Message', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<textarea name="%s">%s</textarea>', Groups_Notifications::NOTIFY_ADMIN_MESSAGE_CREATED, stripslashes( $message_admin_created ) );
		$output .= '</label>';		
		$output .= '</div>';

		$output .= '<div class="defaults">';
		$output .= '<span class="title">';
		$output .= __( 'Defaults', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$subjects['admin']['created'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$messages['admin']['created'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '</div>';

		$output .= '</div>'; // .notification

		//
		// Notify admin when a user has left a group
		//

		$output .= '<div class="notification">';
		$output .= '<h4>' . __( 'User left', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h4>';

		$output .= '<div class="check">';
		$output .= '<label>';
		$output .= sprintf( '<input type="checkbox" name="%s" %s />', esc_attr( Groups_Notifications::NOTIFY_ADMIN_GROUPS_DELETED_USER_GROUP ), $notify_admin_deleted ? ' checked="checked" ' : '' );
		$output .= ' ';
		$output .= __( 'Notify when a user has left a group.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="label">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Subject', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<input type="text" name="%s" value="%s" />', Groups_Notifications::NOTIFY_ADMIN_SUBJECT_DELETED, esc_attr( $subject_admin_deleted ) );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="message">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Message', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<textarea name="%s">%s</textarea>', Groups_Notifications::NOTIFY_ADMIN_MESSAGE_DELETED, stripslashes( $message_admin_deleted ) );
		$output .= '</label>';
		$output .= '</div>';
		
		$output .= '<div class="defaults">';
		$output .= '<span class="title">';
		$output .= __( 'Defaults', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$subjects['admin']['deleted'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$messages['admin']['deleted'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '</div>';

		$output .= '</div>'; // .notification

		//
		// User notifications
		//

		$output .= '<h3>';
		$output .= __( 'User Notifications', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</h3>';
		
		$output .= '<p>' . __( 'When enabled, these notifications are sent to the user.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</p>';

		//
		// Notify user after joining a group
		//

		$output .= '<div class="notification">';
		$output .= '<h4>' . __( 'User joined', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h4>';
		
		$output .= '<div class="check">';
		$output .= '<label>';
		$output .= sprintf( '<input type="checkbox" name="%s" %s />', esc_attr( Groups_Notifications::NOTIFY_USER_GROUPS_CREATED_USER_GROUP ), $notify_user_created ? ' checked="checked" ' : '' );
		$output .= ' ';
		$output .= __( 'Notify when the user has joined a group.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="subject">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Subject', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<input type="text" name="%s" value="%s" />', Groups_Notifications::NOTIFY_USER_SUBJECT_CREATED, esc_attr( $subject_user_created ) );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="message">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Message', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<textarea name="%s">%s</textarea>', Groups_Notifications::NOTIFY_USER_MESSAGE_CREATED, stripslashes( $message_user_created ) );
		$output .= '</label>';
		$output .= '</div>';
		
		$output .= '<div class="defaults">';
		$output .= '<span class="title">';
		$output .= __( 'Defaults', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$subjects['user']['created'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$messages['user']['created'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '</div>';

		$output .='</div>'; // .notification

		//
		// Notify user after leaving a group 
		//

		$output .= '<div class="notification">';
		$output .= '<h4>' . __( 'User left', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '</h4>';

		$output .= '<div class="check">';
		$output .= '<label>';
		$output .= sprintf( '<input type="checkbox" name="%s" %s />', esc_attr( Groups_Notifications::NOTIFY_USER_GROUPS_DELETED_USER_GROUP ), $notify_user_deleted ? ' checked="checked" ' : '' );
		$output .= ' ';
		$output .= __( 'Notify when the user has left a group.', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="subject">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Subject', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<input type="text" name="%s" value="%s" />', Groups_Notifications::NOTIFY_USER_SUBJECT_DELETED, esc_attr( $subject_user_deleted ) );
		$output .= '</label>';
		$output .= '</div>';

		$output .= '<div class="message">';
		$output .= '<label>';
		$output .= '<span class="title">';
		$output .= __( 'Message', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= sprintf( '<textarea name="%s">%s</textarea>', Groups_Notifications::NOTIFY_USER_MESSAGE_DELETED, stripslashes( $message_user_deleted ) );
		$output .= '</label>';
		$output .= '</div>';
		
		$output .= '<div class="defaults">';
		$output .= '<span class="title">';
		$output .= __( 'Defaults', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$output .= '</span>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$subjects['user']['deleted'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '<pre>';
		$output .= htmlentities( Groups_Notifications::$messages['user']['deleted'], ENT_COMPAT, get_bloginfo( 'charset' ) );
		$output .= '</pre>';
		$output .= '</div>';
		

		$output.= '</div>'; // .notification

		$output .=
			'<div class="save">' .
			wp_nonce_field( 'settings', self::NONCE, true, false ) .
			'<input type="submit" class="button" name="submit" value="' . __( 'Save', GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN ) . '"/>' .
			'</div>' .
			'</div>' .
			'</form>' .
			'</div>';

		echo $output;
		Groups_Help::footer();
	}

}
