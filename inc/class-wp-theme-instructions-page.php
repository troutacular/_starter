<?php
/**
 * WordPress Theme Instructions Page Class.
 *
 * @package	_starter
 * @author troutacular <troutacular@gmail.com>
 */

if ( ! class_exists( 'WP_Theme_Instructions_Admin_Page' ) ) {

	/**
	 * Class for creating and setting theme instructions in the WP Admin.
	 *
	 * @since 3.1.0
	 */
	class WP_Theme_Instructions_Admin_Page {

		/**
		 * Constructor to initialize the class and its properties.
		 *
		 * @since   3.1.0
		 */
		function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}

		/**
		 * Create the admin menu for theme instructions.
		 *
		 * @since   3.1.0
		 * @return  void
		 */
		function admin_menu() {
			add_menu_page(
				'Using Starter',
				'Using Starter',
				'manage_options',
				'theme_information',
				array(
					$this,
					'settings_page',
				),
				'dashicons-layout'
			);
		}

		/**
		 * Settings page instructions content.
		 *
		 * @since   3.1.0
		 * @return  void
		 */
		function settings_page() {
			require get_template_directory() . '/theme-instructions/main.php';
		}
	}
} // End if().

/**
 * Initiate the WP_Theme_Instructions_Admin_Page class.
 */
new WP_Theme_Instructions_Admin_Page;
