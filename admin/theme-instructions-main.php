<?php
/**
 * Theme Instructions: Main
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

/**
 * Get the url parameter 'tab'.
 *
 * @since   3.1.0
 * @return  string  Value of 'tab' url parameter (default 'setup').
 */
function _starter_theme_instructions() {
	return isset( $_GET['tab'] ) ? $_GET['tab'] : 'setup';
}

/**
 * Echo active tab class if 'tab' url parameter equals $tab_name.
 *
 * @since   3.1.0
 * @param   string $tab_name  URL parameter to check if matched.
 * @return  void              Nav tab acive class (default: '').
 */
function _starter_theme_instructions_class( $tab_name ) {
	echo _starter_theme_instructions() === $tab_name ? 'nav-tab-active' : '';
}

?>
<style type="text/css">

	/* headings */
	.usc_lfwp_wrap h1 { font-size: 2.5rem; }
	.usc_lfwp_wrap h2 { font-size: 2.25rem; }
	.usc_lfwp_wrap h3 { font-size: 1.75rem; }
	.usc_lfwp_wrap h4 { font-size: 1.3rem; }
	.usc_lfwp_wrap h5 { font-size: 1.0rem; }
	.usc_lfwp_wrap h6 { font-size: 0.7rem; }

	/* code style */
	.usc_lfwp_wrap pre {
		padding: 1rem;
		background: #23282d;
		color: #fff;
		white-space: pre-wrap;		/* css-3 */
		white-space: -moz-pre-wrap;	/* Mozilla, since 1999 */
		white-space: -pre-wrap;		/* Opera 4-6 */
		white-space: -o-pre-wrap;	/* Opera 7 */
		word-wrap: break-word;		/* Internet Explorer 5.5+ */
	}

	/* list style */
	.usc_lfwp_wrap ul {
		padding: .25rem 0 0 1rem;
	}

	.usc_lfwp_wrap table ul {
		padding: 0;
	}

</style>
<div class="usc_lfwp_wrap">

	<h1 id="settings-bookmark-theme-instructions">Starter Theme</h1>

	<div class="nav-tab-wrapper">
		<a href="?page=theme_information&tab=setup" class="nav-tab <?php _starter_theme_instructions_class( 'setup' ); ?>">Theme Setup</a>
		<a href="?page=theme_information&tab=icons" class="nav-tab <?php _starter_theme_instructions_class( 'icons' ); ?>">Icons</a>
	</div>

<?php
if ( 'setup' === _starter_theme_instructions() ) {
	require_once get_template_directory() . '/admin/theme-instructions-setup.php';
}
if ( 'icons' === _starter_theme_instructions() ) {
	require_once get_template_directory() . '/admin/theme-instructions-icons.php';
}
