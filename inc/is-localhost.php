<?php
	// Check if we are in a local environment
		
		function is_localhost() {
			
			// set the array for testing the local environment
			$whitelist = array( '127.0.0.1', '::1' );
			
			// check if the server is in the array
			if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {
				
				// this is a local environment
				return true;
				
			}
			
		}
		
	// end
?>