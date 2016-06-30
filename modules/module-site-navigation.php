<?php
/**
 * The template for displaying the Primary Navigation.
 *
 * @package _starter
 */

?>
<nav id="site-navigation" class="site-navigation" role="navigation">
	<?php // @todo - add aria expanded support for menu. ?>
	<h2 class="site-navigation-title menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_starter' ); ?></h2>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu-id' => 'primary-menu', 'menu_class' => 'site-navigation-list' ) ); ?>
</nav><!-- .site-navigation -->
