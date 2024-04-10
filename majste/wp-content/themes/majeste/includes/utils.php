<?php

/**
 * Generates a message used when ticket attributes are changed.
 */
function _qc_get_message_diff( $added, $deleted ) {
		$msg = array();

		if ( !empty( $added ) ) {
			$list = '<em>' . implode( '</em>, <em>', $added ) . '</em>';
			$msg[] = sprintf( __( '%s added', APP_TD ), $list );
		}

		if ( !empty( $deleted ) ) {
			$list = '<em>' . implode( '</em>, <em>', $deleted ) . '</em>';
			$msg[] = sprintf( __( '%s removed', APP_TD ), $list );
		}

		return $msg;
}

