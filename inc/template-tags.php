<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _starter
 */

if ( ! function_exists( '_starter_posted_on' ) ) {

	/**
	 * Posted On.
	 *
	 * Add the published date to posts using meta.
	 *
	 * @return void
	 */
	function _starter_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', '_starter' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', '_starter' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
}


if ( ! function_exists( '_starter_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @return  void
	 */
	function _starter_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', '_starter' ) );
			if ( $categories_list && _starter_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_starter' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', '_starter' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_starter' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_starter' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', '_starter' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( '_starter_categorized_blog' ) ) {

	/**
	 * Categorized Blog
	 *
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return  bool  Bool value for blog having cateogries.
	 */
	function _starter_categorized_blog() {
		// Check for transient.
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}

		// Check if the blog site has more than 1 category.
		$categorized = ( '1' !== $all_the_cool_cats ) ? true : false;

		return $categorized;
	}
}

// Add action to flush category transient on category edit.
add_action( 'edit_category', '_starter_category_transient_flusher' );

// Add action to flush category transient on post save.
add_action( 'save_post',	 '_starter_category_transient_flusher' );

if ( ! function_exists( '_starter_category_transient_flusher' ) ) {

	/**
	 * Transient Flush
	 *
	 * Flush out the transients used in _starter_categorized_blog.
	 *
	 * @return  void
	 */
	function _starter_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}
}
