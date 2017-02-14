<?php
/**
 * The template for displaying the site navigation.
 *
 * @since 3.4.0
 * @package _starter
 */

?>

<nav id="site-navigation" class="site-navigation" role="navigation">
	<h2 class="site-navigation-title"><?php esc_html_e( 'Primary Menu', '_starter' ); ?></h2>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu-id' => 'primary-menu', 'menu_class' => 'site-navigation-menu' ) ); ?>
</nav>
