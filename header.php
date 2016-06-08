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

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php 
	
	/**
	 * Fix for validation
	 */
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
		header( 'X-UA-Compatible: IE=edge,chrome=1' );
	}
	
?>
<?php global $noindex; if( $noindex ) { echo '	<meta name="robots" content="noindex"/>'; } ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

<div class="site-wrapper"><?php /* closes in footer.php */ ?>
	
	<header id="masthead" class="site-header" role="banner">
		
		<?php get_template_part('modules/module-site-branding'); ?>
		<?php get_template_part('modules/module-site-navigation'); ?>
		
	</header><!-- #masthead -->
	
	<?php get_template_part('modules/module-breadcrumbs'); ?>
	
	<div id="content" class="site-content-wrapper"><?php /* closes in footer.php */ ?>