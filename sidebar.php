<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _starter
 */

?>
<div id="secondary" class="site-sidebar" role="complementary">

<?php

/**
 * Get the page template slug (templates/tpl-slug.php) and remove
 * 'template-', 'templates/tpl-' and '.php' to set as a variable $template.
 */
$template = str_replace( array( 'page-', 'templates/tpl-', '.php' ), '', get_page_template_slug( $post->ID ) );

/**
 * Check if on the homepage and if there is content in
 * the dynamic sidebar 'Homepage'.
 */
if ( is_home() || is_front_page() && is_dynamic_sidebar( 'homepage' ) ) {
    dynamic_sidebar( 'homepage' );
}

/**
 * If the conditions above return False, check if
 * $template has a value and if there is a sidebar
 * with the matching value.  Get the widgets in the
 * corresponding sidebar.
 */
elseif ( '' !== $template && is_dynamic_sidebar( $template ) ) {
    dynamic_sidebar( $template );
}

/**
 * Set the Default Page if:
 * 1. no template is being used;
 * 2. is a single page;
 * 3. has widgets in 'template-default-content'
 */
elseif ( ! $template && is_page() && is_dynamic_sidebar( 'template-default-content' ) ) {
    dynamic_sidebar( 'template-default-content' );
}

/**
 * Set the Single Article if:
 * 1. previous statements were not met
 * 2. is a single post
 * 3. has widgets in 'template-article'
*/
elseif ( is_single() && is_dynamic_sidebar( 'template-article' ) ) {
    dynamic_sidebar( 'template-article' );
}

/**
 * Set the Category if:
 * 1. previous statements were not met
 * 2. is a category
 * 3. has widgets in 'template-category'
 */
elseif ( is_category() && is_dynamic_sidebar( 'template-category' ) ) {
    dynamic_sidebar( 'template-category' );
}

/**
 * Set the Archive if:
 * 1. previous statements were not met
 * 2. is an archive
 * 3. has widgets in 'template-archive'
 */
elseif ( is_archive() && is_dynamic_sidebar( 'template-archive' ) ) {
    dynamic_sidebar( 'template-archive' );
}

/**
 * Set Global Sidebar section to be used on all pages.
 */
if ( is_dynamic_sidebar( 'global' ) ) {
    dynamic_sidebar( 'global' );
}

?>

</div><!-- #secondary -->
