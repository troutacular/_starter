<div class="site-branding">
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php if ( (get_bloginfo('description') != "") ) { ?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php } ?>
</div>
