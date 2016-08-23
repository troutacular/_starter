<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
// Display a noindex meta tag if required by the blog configuration.
if ( function_exists( 'noindex' ) ) {
	noindex();
}
?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="site"><?php /* closes in footer.php */ ?>
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', '_starter' ); ?></a>
	<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to secondary content', '_starter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-branding-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) { ?>
				<p class="site-branding-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php } ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="site-navigation" role="navigation">
			<h2 class="site-navigation-title"><?php esc_html_e( 'Primary Menu', '_starter' ); ?></h2>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu-id' => 'primary-menu', 'menu_class' => 'site-navigation-list' ) ); ?>
		</nav><!-- .site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content"><?php /* closes in footer.php */ ?>
