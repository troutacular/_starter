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

/**
 * Add icons as style seclection to Tiny MCE editor.
 *
 * @since   3.1.0
 * @param   string $type  Choose [icon] or [icon-only] list to include.
 * @return  Array         Array of icons in WP Tiny MCE class format.
 */
function _starter_tiny_mce_icon_classes( $type = 'icon' ) {

	if ( function_exists( '_starter_sprite_classes' ) ) {
		// Get the icons.
		$icons = _starter_sprite_classes();

		// Set array for gathering classes.
		$classes = array();

		if ( ! empty( $icons[ $type ] ) ) {
			foreach ( $icons[ $type ] as $icon ) {
				$classes[] = array(
					'title' => $icon,
					'inline' => 'span',
					'classes' => $icon,
					'exact' => true,
					'icon' => $icon,
				);
			}
		}
	}
	return $classes;
}

// Register function callback to tiny_mce_before_init.
add_filter( 'tiny_mce_before_init', '_starter_tiny_mce_before_init_insert_formats' );
if ( ! function_exists( '_starter_tiny_mce_before_init_insert_formats' ) ) {
	/**
	 * Callback function to filter the MCE settings.
	 *
	 * @since   3.1.0
	 * @link    https://codex.wordpress.org/TinyMCE_Custom_Styles
	 * @param   array $init_array  Array of editor settings.
	 * @return  array              Updated array of editor settings.
	 */
	function _starter_tiny_mce_before_init_insert_formats( $init_array ) {

		// Get icon list.
		$icon = _starter_tiny_mce_icon_classes( 'icon' );

		// Get icon only list.
		$icon_only = _starter_tiny_mce_icon_classes( 'icon-only' );

		// Define the style_formats array.
		$style_formats = array(

			// Insert custom child array formats.
			array(
				'title' => 'Icon',
				'items' => $icon,
			),
			array(
				'title' => 'Icon Only',
				'items' => $icon_only,
			),
		);

		// Insert the json encoded array into 'style_formats'.
		$init_array['style_formats'] = wp_json_encode( $style_formats );

		return $init_array;

	}
} // End if().
