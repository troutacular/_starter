<?php
/**

	Template Name: Site Help

**/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) { the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				<?php get_template_part( 'modules/module-help' ); ?>

			<?php } // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
