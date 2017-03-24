<?php
/**
 * Sprite Classes as an Array.
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

// @codingStandardsIgnoreStart
/**
 * _starter sprite classes.
 *
 * @return  array  Array of classes for sprite icons.
 */
function _starter_sprite_classes() {

	// Set the default project configurations.
	$classes = array(
		'icon' => array(
		{{#shapes}}
			'icon-{{base}}',
		{{/shapes}}
		),
		'icon-only' => array(
		{{#shapes}}
			'icon-only-{{base}}',
		{{/shapes}}
		),
	);
	return $classes;
}
// @codingStandardsIgnoreEnd
