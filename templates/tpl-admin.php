<?php
/**

	Template Name: Admin

**/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) { the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				
				<?php
					
					/**
						Set a default variable to false
					**/
					$help_page = false;
					$help_uri = false;
					
					/**
						Get the Help page link URI by title
					**/
					$help_page = get_page_by_title( 'Site Help' );
					$help_uri = get_page_uri( $help_page->ID );
					
				?>
				<p><?php _e( 'This section is intended to help Editors use and manage their site.', '' ); ?></p>
				
				<?php  if ( $help_uri ) { ?>
					<p><?php _e( 'For information about managing the site, please see the', '' ); ?> <a href="/<?php echo $help_uri; ?>"><?php _e( 'Help Section', '' ); ?></a>.</p>
				<?php } ?>
				
				<?php
					
					/** 
						If comments are open or we have at least one comment, 
						load up the comment template 
					**/
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template();
					}
					
				?>

			<?php } // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
