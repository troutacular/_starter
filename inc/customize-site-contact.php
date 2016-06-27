<?php
/**
 * Site Contact Customizer Input
 *
 * Adds Customizer support for adding inputs for:
 *  - Feedback Text
 *  - Feedback Link
 *  - Feedback Link Text
 *  - Created by Text
 *  - Created by Link
 *  - Created by Link Text
 *
 * @param  object 	$wp_customize 	WP Class for the Customizer
 * @return object
 */
function _starter_site_contact_register( $wp_customize ) {

	// ----------------
	//  Feedback Section
	// ----------------
	$wp_customize->add_section(
		'_starter_feedback',
		array(
			'title'    => __( 'Feedback', '_starter' ),
			'priority' => 130,
		)
	);

	// ----------------
	//  Feedback Text
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_feedback]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'_starter_text_feedback',
		array(
			'label'    => __( 'Website Feedback Text', '_starter' ),
			'section'  => '_starter_feedback',
			'settings' => '_starter_options[text_feedback]',
		)
	);

	// ----------------
	//  Feedback Link
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_feedback_link]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		'_starter_text_feedback_link',
		array(
			'label'    => __( 'Website Feedback Link', '_starter' ),
			'section'  => '_starter_feedback',
			'settings' => '_starter_options[text_feedback_link]',
		)
	);

	// ----------------
	//  Feedback Link Text
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_feedback_link_text]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'_starter_text_feedback_link_text',
		array(
			'label'    => __( 'Website Feedback Link Text', '_starter' ),
			'section'  => '_starter_feedback',
			'settings' => '_starter_options[text_feedback_link_text]',
		)
	);

	// ----------------
	// Created by Section
	// ----------------
	$wp_customize->add_section(
		'_starter_created_by',
		array(
			'title'    => __( 'Created By', '_starter' ),
			'priority' => 140,
		)
	);

	// ----------------
	// Created by Text
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_created_by]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'_starter_text_created_by',
		array(
			'label'    => __( 'Created By Text', '_starter' ),
			'section'  => '_starter_created_by',
			'settings' => '_starter_options[text_created_by]',
		)
	);

	// ----------------
	//  Created by Link
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_created_by_link]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		'_starter_text_created_by_link',
		array(
			'label'    => __( 'Created By Link', '_starter' ),
			'section'  => '_starter_created_by',
			'settings' => '_starter_options[text_created_by_link]',
		)
	);

	// ----------------
	//  Created by Link Text
	// ----------------
	$wp_customize->add_setting(
		'_starter_options[text_created_by_link_text]',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'_starter_text_created_by_link_text',
		array(
			'label'    => __( 'Created By Link Text', '_starter' ),
			'section'  => '_starter_created_by',
			'settings' => '_starter_options[text_created_by_link_text]',
		)
	);
}

// add the function to the customize register
add_action( 'customize_register', '_starter_site_contact_register' );
