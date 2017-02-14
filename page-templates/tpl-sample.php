<?php
/**
 * Template Name: Sample Template
 *
 * The template for displaying a Custom Page Template.
 *
 * Templates should be named 'tpl-[template-name].php' in order to use the
 * option in sidebar.php to load a dyanmic_sidebar based on the template
 * filename.
 *
 * @package _starter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) {

			// Iterate the post index in The Loop.
			the_post();

			get_template_part( 'template-parts/page/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || '0' !== get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
