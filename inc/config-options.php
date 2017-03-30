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
		'version' => '3.5.1',
		'assets' => array(
			'filename_base' => '_starter',
			'modernizr' => array(
				'include' => true,
				'in_footer' => true,
				'filename' => 'modernizr.js',
			),
		),
		'paths' => array(
			'assets' => array(
				'css' => '/assets/css/',
				'images' => '/assets/images/',
				'js' => array(
					'lib' => '/assets/js/lib/',
					'vendor' => '/assets/js/vendor/',
					'admin' => '/assets/js/admin/',
				),
			),
		),
	);

	return $config;
}
