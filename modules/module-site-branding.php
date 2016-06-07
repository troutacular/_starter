<div class="site-branding">
	<h1 class="brand-title"><a href="http://www.usc.edu"><?php _e('University of Southern California', '_starter'); ?></a></h1>
	<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
	<?php if ( (get_bloginfo('description') != "") ) { ?>
		<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
	<?php } ?>
</div><!-- .site-branding -->