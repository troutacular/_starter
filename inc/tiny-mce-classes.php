<?php
/**
 * Tiny MCE custom styles.
 *
 * @package _starter
 */

// Register function callback to admin_init.
add_action( 'admin_init', 'wpdocs_starter_add_editor_styles' );
if ( ! function_exists( 'wpdocs_starter_add_editor_styles' ) ) {

	/**
	 * Registers an editor stylesheet for the theme.
	 */
	function wpdocs_starter_add_editor_styles() {
		add_editor_style( get_stylesheet_directory_uri() . _starter_get_asset_path( 'css' ) . 'admin-content-editor-styles.css' );
	}
}

// Register function callback to mce_buttons_2.
add_filter( 'mce_buttons_2', '_starter_tiny_mce_buttons' );
if ( ! function_exists( '_starter_tiny_mce_buttons' ) ) {
	/**
	 * Callback function to insert 'styleselect' into the $buttons array.
	 *
	 * @since   3.1.0
	 * @param   array $buttons  Array of existing $button options.
	 * @return  array           Second-row list of buttons.
	 */
	function _starter_tiny_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
}

// Register function callback to tiny_mce_before_init.
add_filter( 'tiny_mce_before_init', '_starter_tiny_mce_before_init_insert_formats' );
if ( ! function_exists( '_starter_tiny_mce_before_init_insert_formats' ) ) {
	/**
	 * Callback function to filter the MCE settings.
	 *
	 * @since   3.1.0
	 * @param   array $init_array  Array of editor settings.
	 * @return  array              Updated array of editor settings.
	 */
	function _starter_tiny_mce_before_init_insert_formats( $init_array ) {

		// Define the style_formats array.
		$style_formats = array(

			// Each array child is a format with it's own settings.
			array(
				'title' => 'Horizontal Rule',
				'block' => 'hr',
			),
			array(
				'title' => 'Content Block: Divider',
				'block' => 'div',
				'classes' => 'inline-content-block-divider',
				'wrapper' => 'div',
			),
			array(
				'title' => 'Content Block',
				'block' => 'div',
				'classes' => 'inline-content-block',
				'wrapper' => 'div',
			),
		);

		// Insert the json encoded array into 'style_formats'.
		$init_array['style_formats'] = wp_json_encode( $style_formats );

		return $init_array;

	}
} // End if().
