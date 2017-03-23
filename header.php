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
<html <?php language_attributes(); ?> class="no-js">
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
<link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . _starter_get_asset_path( 'images' ) ); ?>/favicon.ico" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="site"><?php /* closes in footer.php */ ?>
	<?php
		/**
		 * Skip link navigation.
		 */
		get_template_part( '/template-parts/navigation/navigation', 'skip-links' );
	?>

	<header id="masthead" class="site-header" role="banner">

		<?php
			/**
			 * Site branding.
			 */
			get_template_part( '/template-parts/header/site', 'branding' );

			/**
			 * Site navigation.
			 */
			get_template_part( '/template-parts/navigation/navigation', 'site' );
		?>

	</header><!-- #masthead -->

	<div id="content" class="site-content"><?php /* closes in footer.php */ ?>
