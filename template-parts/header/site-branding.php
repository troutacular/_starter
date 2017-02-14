<?php
/**
 * The template for displaying the site branding.
 *
 * @since 3.4.0
 * @package _starter
 */

?>

<div class="site-branding">
	<h1 class="site-branding-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) { ?>
		<p class="site-branding-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php } ?>
</div>
