<?php
/**
 * Sprite Classes as an Array.
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

/**
 * _starter sprite classes.
 *
 * @return  array  Array of classes for sprite icons.
 */
function _starter_sprite_classes() {

	// Set the default project configurations.
	$classes = array(
		'icon' => array(
			'icon-wordpress-logo',
		),
		'icon-only' => array(
			'icon-only-wordpress-logo',
		),
	);

	return $classes;
}
