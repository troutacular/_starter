<nav id="site-navigation" class="site-navigation" role="navigation">
	<?php // @todo - add aria expanded support for menu ?>
	<h2 class="site-navigation-title menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Main Navigation', '_starter' ); ?></h2>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_starter' ); ?></a>
	<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to secondary content', '_starter' ); ?></a>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-navigation-list' ) ); ?>
	<?php get_search_form(); ?>
</nav><!-- .site-navigation -->
