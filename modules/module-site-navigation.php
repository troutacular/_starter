<nav id="site-navigation" class="site-navigation" role="navigation">
	<?php // @todo - add aria expanded support for menu ?>
	<h2 class="site-navigation-title menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Main Navigation', '_starter' ); ?></h2>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-navigation-list' ) ); ?>
	<?php get_search_form(); ?>
</nav><!-- .site-navigation -->
