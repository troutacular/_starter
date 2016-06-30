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
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) { ?>
		<div class="entry-meta">
			<?php _starter_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() || is_category() || is_front_page() || is_home() ) { // Display Excerpts for Search, Archive, Category, Homepage ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php } else { ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_starter' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_starter' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php } ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', '_starter' ) );
				if ( $categories_list && _starter_categorized_blog() ) {
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', '_starter' ), $categories_list ); ?>
			</span>
			<?php } // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', '_starter' ) );
				if ( $tags_list ) {
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', '_starter' ), $tags_list ); ?>
			</span>
			<?php } // End if $tags_list ?>
		<?php } // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '_starter' ), __( '1 Comment', '_starter' ), __( '% Comments', '_starter' ) ); ?></span>
		<?php } ?>

		<?php edit_post_link( __( 'Edit', '_starter' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
