<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @todo phpmd/phpcs
 * @package _starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		if ( 'post' === get_post_type() ) { ?>
		<div class="entry-meta">
			<?php _starter_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->

	<?php
	// Display Excerpts for Search, Archive, Category, Homepage.
	if ( is_search() || is_archive() || is_category() || is_front_page() || is_home() ) { ?>
	<div class="entry-content excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-excerpt -->
	<?php } else { ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_s' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php } ?>

	<footer class="entry-footer">
		<?php _starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
