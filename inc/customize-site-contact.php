<?php
	add_action('customize_register', '_starter_site_contact_register');
	function _starter_site_contact_register($wp_customize){

		// ----------------
		//  Feedback Section
		// ----------------
		$wp_customize->add_section('_starter_feedback', array(
			'title'    => __('Feedback', '_starter'),
			'priority' => 130,
		));

		// ----------------
		//  Feedback Text
		// ----------------
		$wp_customize->add_setting('_starter_options[text_feedback]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_feedback', array(
			'label'      => __('Website Feedback Text', '_starter'),
			'section'    => '_starter_feedback',
			'settings'   => '_starter_options[text_feedback]',
		));

		// ----------------
		//  Feedback Link
		// ----------------
		$wp_customize->add_setting('_starter_options[text_feedback_link]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_feedback_link', array(
			'label'      => __('Website Feedback Link', '_starter'),
			'section'    => '_starter_feedback',
			'settings'   => '_starter_options[text_feedback_link]',
		));

		// ----------------
		//  Feedback Link Text
		// ----------------
		$wp_customize->add_setting('_starter_options[text_feedback_link_text]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_feedback_link_text', array(
			'label'      => __('Website Feedback Link Text', '_starter'),
			'section'    => '_starter_feedback',
			'settings'   => '_starter_options[text_feedback_link_text]',
		));



		// ----------------
		// Website by Section
		// ----------------
		$wp_customize->add_section('_starter_website_by', array(
			'title'    => __('Website By', '_starter'),
			'priority' => 140,
		));

		// ----------------
		// Website by Text
		// ----------------
		$wp_customize->add_setting('_starter_options[text_website_by]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_website_by', array(
			'label'      => __('Website By Text', '_starter'),
			'section'    => '_starter_website_by',
			'settings'   => '_starter_options[text_website_by]',
		));

		// ----------------
		//  Website by Link
		// ----------------
		$wp_customize->add_setting('_starter_options[text_website_by_link]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_website_by_link', array(
			'label'      => __('Website By Link', '_starter'),
			'section'    => '_starter_website_by',
			'settings'   => '_starter_options[text_website_by_link]',
		));

		// ----------------
		//  Website by Link Text
		// ----------------
		$wp_customize->add_setting('_starter_options[text_website_by_link_text]', array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control('_starter_text_website_by_link_text', array(
			'label'      => __('Website By Link Text', '_starter'),
			'section'    => '_starter_website_by',
			'settings'   => '_starter_options[text_website_by_link_text]',
		));
	}
?>