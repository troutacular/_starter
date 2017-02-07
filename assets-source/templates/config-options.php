<?php
/**
 * The config settings for the asset paths.
 *
 * @package _starter
 */

/**
 * _starter configuration settings.
 *
 * @return  array  Array of configuration settings.
 */
function _starter_get_config() {

	// Set the default project configurations.
	$config = array(
		'version' => '@@theme_version@@',
		'assets' => array(
			'filename_base' => '@@filename_base@@',
			'modernizr' => array(
				'include' => modernizr_include,
				'in_footer' => modernizr_in_footer,
				'filename' => '@@modernizr_filename@@',
			),
		),
		'paths' => array(
			'assets' => array(
				'css' => '@@css@@',
				'js' => array(
					'lib' => '@@js_lib@@',
					'vendor' => '@@js_vendor@@',
					'admin' => '@@js_admin@@',
				),
			),
		),
	);

	return $config;
}
