<?php
/**
 * class-groups-notifications-mailer.php
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
 * @since groups-notifications 1.0.0
 */

/**
 * Notification mailer - provides email notifications.
 */
class Groups_Notifications_Mailer {

	/**
	 * Send email.
	 * Use <br/> not \r\n as line breaks in original message, the mailer
	 * generates a plain text version from the original message and
	 * sends a multipart/alternative including text/plain and text/html parts.
	 *
	 * @param string $email
	 * @param string $subject the email subject (do NOT pass it translated, it will be done here)
	 * @param string $message the email message (do NOT pass it translated, it will be done here) 
	 */
	public static function mail( $email, $subject, $message, $tokens = array() ) {

		$boundary_id = md5( time() );
		$boundary    = sprintf( 'groups-notification-%s', $boundary_id );

		// email headers
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: multipart/alternative; boundary="' . $boundary . '"' . "\r\n";

		// translate
		$subject = __( $subject, GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );
		$message = __( $message, GROUPS_NOTIFICATIONS_PLUGIN_DOMAIN );

		// token substitution
		$site_title = wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES );
		$site_url   = get_bloginfo( 'url' );

		$tokens = array_merge(
			$tokens,
			array(
				'site_title' => $site_title,
				'site_url'   => $site_url
			)
		);
		foreach ( $tokens as $key => $value ) {
			$substitute = self::filter( $value );
			$subject    = str_replace( "[" . $key . "]", $substitute, $subject );
			$message    = str_replace( "[" . $key . "]", $substitute, $message );
		}

		$subject = stripslashes( $subject );
		$message = stripslashes( $message );

		$plain_message = preg_replace( '/\\r\\n|\\r|\\n|<p>|<P>/', '', $message );
		$plain_message = preg_replace( '/<br>|<br\/>|<BR>|<BR\/>|<\/p>|<\/P>/', "\r\n", $plain_message );
		$plain_message = wp_filter_nohtml_kses( $plain_message );

		$message =
			"\r\n\r\n--" . $boundary . "\r\n" .
			'Content-type: text/plain; charset="' . get_option( 'blog_charset' ) . '"' . "\r\n\r\n" .
			$plain_message . "\r\n" .
			"\r\n\r\n--" . $boundary . "\r\n" .
			'Content-type: text/html; charset="' . get_option( 'blog_charset' ) . '"' . "\r\n\r\n" .
			$message . "\r\n" .
			"\r\n\r\n--" . $boundary . "--\r\n\r\n" ;

		@wp_mail( $email, wp_filter_nohtml_kses( $subject ),  $message, $headers );
	}

	/**
	 * Filters mail header injection, html, ...
	 * @param string $unfiltered_value
	 */
	public static function filter( $unfiltered_value ) {
		$filtered_value = preg_replace('/(%0A|%0D|content-type:|to:|cc:|bcc:)/i', '', $unfiltered_value );
		return stripslashes( wp_filter_nohtml_kses( self::filter_xss( trim( strip_tags( $filtered_value ) ) ) ) );
	}

	/**
	 * Filter xss
	 *
	 * @param string $string input
	 * @return filtered string
	 */
	public static function filter_xss( $string ) {
		// Remove NUL characters (ignored by some browsers)
		$string = str_replace( chr( 0 ), '', $string );
		// Remove Netscape 4 JS entities
		$string = preg_replace( '%&\s*\{[^}]*(\}\s*;?|$)%', '', $string );
		// Defuse all HTML entities
		$string = str_replace( '&', '&amp;', $string );
		// Change back only well-formed entities in our whitelist
		// Decimal numeric entities
		$string = preg_replace( '/&amp;#([0-9]+;)/', '&#\1', $string );
		// Hexadecimal numeric entities
		$string = preg_replace( '/&amp;#[Xx]0*((?:[0-9A-Fa-f]{2})+;)/', '&#x\1', $string );
		// Named entities
		$string = preg_replace( '/&amp;([A-Za-z][A-Za-z0-9]*;)/', '&\1', $string );
		return preg_replace( '%
				(
				<(?=[^a-zA-Z!/])  # a lone <
				|                 # or
				<[^>]*(>|$)       # a string that starts with a <, up until the > or the end of the string
				|                 # or
				>                 # just a >
		)%x', '', $string );
	}
}
