<?php
/**
 * Check for local environment.
 *
 * Used for development and maintenance through development environments
 *
 * @return boolean [description]
 */
function is_localhost() {

	// set the array for testing the local environment
	$whitelist = array( '127.0.0.1', '::1' );

	// check if the server is in the array
	return in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ? true : false;

}