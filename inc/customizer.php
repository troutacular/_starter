<?php
/**
 * Theme Customizer
 *
 * @package _starter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _starter_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_starter_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _starter_customize_preview_js() {
	wp_enqueue_script( '_starter_customizer', get_template_directory_uri() . _starter_get_asset_path( 'js-admin' ) . 'customizer.js', array( 'customize-preview' ), _starter_get_version(), true );
}
add_action( 'customize_preview_init', '_starter_customize_preview_js' );
