<?php
/**
 * _starter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _starter
 */

/** --------------------------------------------------------------

Table of Contents

1.0 - Globals
	1.1 - Version
	1.2 - Environment
	1.3 - Dependencies
	1.4 - Theme Setup
		1.4.2 - Sidebar Registration
		1.4.3 - Customizations
		1.4.4 - Page Creation
		1.4.5 - Taxonomy Creation
		1.4.6 - Custom Post Types
2.0 - Scripts
	2.1 - CSS
	2.2 - Javascript
3.0 - Header
4.0 - Footer
5.0 - Navigation
	5.1 - Menus
	5.2 - Search
	5.3 - Breadcrumbs
	5.4 - Section Navigation
	5.5 - Pagination
	5.6 - Adjacent Post Navigation
	5.7 - Navigation with Descriptions
6.0 - Content
	6.1 - Excerpt
7.0 - Media
	7.1 - Images
	7.2 - Video
8.0 - Taxonomy
	8.1 - Category
	8.2 - Tags
9.0 - Posts
	9.1 - Post Meta
	9.2 - Post Types
		9.2.1 - Posts
		9.2.2 - Pages
10.0 - Templates
	10.1 - Archive
	10.2 - Author
	10.3 - Home
	10.4 - Page
	10.5 - Post

--------------------------------------------------------------*/

/** --------------------------------------------------------------
1.0 - Globals
--------------------------------------------------------------*/


/** --------------------------------------------------------------
1.1 - Version
--------------------------------------------------------------*/


/** --------------------------------------------------------------
1.2 - Environment
--------------------------------------------------------------*/

// Check if we are in a local environment
require get_template_directory() . '/inc/is-localhost.php';


/** --------------------------------------------------------------
1.3 - Dependencies
--------------------------------------------------------------*/


/** --------------------------------------------------------------
1.4 - Theme Setup
--------------------------------------------------------------*/

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1120; /* pixels */
}

/*
 * Run this function after theme setup.
 * Allows for future automatic additions to existing sites.
**/
add_action( 'after_setup_theme', '_starter_theme_setup' );

if ( ! function_exists( '_starter_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as
	 * indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 */
	function _starter_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on usc-starter, use a find and replace
		 * to change '_starter' to the name of your theme in all the template files
		 *
		 * @link https://codex.wordpress.org/Function_Reference/load_theme_textdomain
		**/
		if ( function_exists( 'load_theme_textdomain' ) ) {
			load_theme_textdomain( '_starter', get_template_directory() . '/languages' );
		}

		/*
		 * Enable wp_nav_menu() in one location.
		 * @link https://codex.wordpress.org/Function_Reference/register_nav_menu
		 */
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', '_starter' ),
				'secondary' => __( 'Secondary Menu', '_starter' ),
			) );
		}

		// Check if 'add_theme_support' is supported
		if ( function_exists( 'add_theme_support' ) ) {

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			**/
			add_theme_support( 'post-thumbnails' );

			/*
			 * Enable support for Post Formats.
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Formats
			**/
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			) );

			/*
			 * Enable support for HTML5 elements.
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
			**/
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Enable Theme Title.
			 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable automatic feed links
			 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
			 */
			add_theme_support( 'automatic-feed-links' );
		}
	}
}


/** --------------------------------------------------------------
1.4.2 - Sidebar Registration
--------------------------------------------------------------*/

/*
	This will set up sidebars in the admin for each page template type in the admin.
	A page template will need to be created for each type (templates/tpl-[slug].php).
	The [slug] will be used in the sidebar to check if that template type exists.
**/
add_action( 'widgets_init', '_starter_widgets_init' );

if ( ! function_exists( '_starter_widgets_init' ) ) {

	/**
	 * Register Widget Areas.
	 *
	 * This will set up sidebars in the admin for each page template type in the admin.
	 * A page template will need to be created for each type (templates/tpl-[slug].php).
	 * The [slug] will be used in the sidebar to check if that template type exists.
	 *
	 * @return void
	 */
	function _starter_widgets_init() {

		// set the names to use for the page templates
		$sidebars = array(
			array(
				'name' => 'Global',
				'slug' => 'template-global',
				'description' => 'Items placed here will appear in the sidebar on every page at the bottom.',
			),
			array(
				'name' => 'Homepage',
				'slug' => 'template-homepage',
				'description' => 'Items placed here will only appear in the sidebar on the Homepage and above the Global items.',
			),
			array(
				'name' => 'Category',
				'slug' => 'template-category',
				'description' => 'Items placed here will only appear on Categories and above the Global Items.',
			),
			array(
				'name' => 'Archive',
				'slug' => 'template-archive',
				'description' => 'Items placed here will only appear in the Archives and above the Global Items.',
			),
			array(
				'name' => 'Article',
				'slug' => 'template-article',
				'description' => 'Items placed here will only appear on Single Posts and above the Global Items.',
			),
			array(
				'name' => 'Default Page',
				'slug' => 'template-default-content',
				'description' => 'Items placed here will only appear on Pages with the Template \'Default Page\' selected and above the Global Items.',
			),
		);

		// loop through the $sidebars array and register the widget area
		foreach ( $sidebars as $sidebar ) {
			register_sidebar( array(
				'name' => $sidebar['name'],
				'id' => $sidebar['slug'],
				'description' => $sidebar['description'],
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			) );
		}
	}
}


/** --------------------------------------------------------------
1.4.3 - Customizations
--------------------------------------------------------------*/

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Customizer additions - Site Contact.
require get_template_directory() . '/inc/customize-site-contact.php';


/** --------------------------------------------------------------
1.4.4 - Page Creation
--------------------------------------------------------------*/

/*
 * Run this function after theme setup.
 * Allow for future automatic additions to existing sites.
**/
add_action( 'after_setup_theme', '_starter_page_add' );

if ( ! function_exists( '_starter_page_add' ) ) {

	/**
	 * Add pages to theme.
	 *
	 * Uses _starter_page_additions function to add page(s) to the site.
	 *
	 * @return array|WP Error 	Inserts Page or returens WP Error message.
	 */
	function _starter_page_add() {

		// get the support page function
		require_once get_template_directory() . '/inc/support-page-setup.php';

		/*
		 * (see full documentation in '/inc/support-page-setup.php'
		 * @usage: _starter_page_additions( array( $args ) );
		**/

		// create admin page
		_starter_page_additions( array(
			'post_title' => 'Site Admin',
			'post_status' => 'private',
			'_wp_page_template' => 'templates/tpl-admin.php',
		) );

		// create styleguide page
		_starter_page_additions( array(
			'post_title' => 'Site Styleguide',
			'post_status' => 'private',
			'_wp_page_template' => 'templates/tpl-styleguide.php',
		) );
	}
}

/*
 * Set up the following pages only once on theme switch.
 * Does not require updates each time the admin is accessed.
 * Does not override settings, particularly for the selection of the homepage designation.
**/
add_action( 'after_switch_theme', '_starter_page_add_once' );

if ( ! function_exists( '_starter_page_add_once' ) ) {
	/**
	 * Uses _starter_page_additions function to add page(s) to the site one time only.
	 *
	 * @return array|WP Error 	Inserts Page or returens WP Error message.
	 */
	function _starter_page_add_once() {

		/*
		 * (see full documentation in '/inc/support-page-setup.php'
		 * @usage: _starter_page_additions( array( $args ) );
		**/
	}
}


/** --------------------------------------------------------------
1.4.5 - Taxonomy Creation
--------------------------------------------------------------*/

if ( ! function_exists( '_starter_create_new_taxonomies' ) ) {

	/*
	 * Run this function after theme setup.
	 * Allow for future automatic additions to existing sites.
	**/
	add_action( 'after_setup_theme', '_starter_create_new_taxonomies' );

	/**
	 * Creates new taxonomies to the site.
	 *
	 * @link https://codex.wordpress.org/Taxonomies#Default_Taxonomies
	 * @since 1.0.0
	 *
	 * @return array|WP Error 	Inserts taxonomy or returens WP Error message.
	 */
	function _starter_create_new_taxonomies() {

		/**
		 * Set an array of taxonomies to add.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/wp_insert_term
		 *
		 * @usage:
		 * 	$taxonomies = array(
		 * 		array(
		 * 			'name' => 'Featured',
		 * 			'taxonomy' => 'category',
		 * 			'args' => array (
		 * 				'slug' => 'featured',
		 * 				'description'=> 'Featured Category Posts'
		 * 			)
		 * 		)
		 * 	);
		 */
		$taxonomies = array();

		// check that we have taxonomies to process
		if ( ! empty( $taxonomies ) ) {

			// loop through the taxonomies array and add them to the site
			foreach ( $taxonomies as $taxonomy ) {

				// check if the taxonomy already exists
				$term = term_exists( $taxonomy['name'], $taxonomy['taxonomy'] );

				// if the term doesn't exist, add it
				if ( 0 === $term || null === $term ) {
					wp_insert_term(
						$taxonomy['name'],
						$taxonomy['taxonomy'],
						$taxonomy['args']
					);
				}
			}
		}
	}
}


/** --------------------------------------------------------------
1.4.6 - Custom Post Types
--------------------------------------------------------------*/


/** --------------------------------------------------------------
2.0 - Scripts
--------------------------------------------------------------*/


/** --------------------------------------------------------------
2.1. - CSS
--------------------------------------------------------------*/

/**
 * Add action to enqueue CSS stylesheets
 */
add_action( 'wp_enqueue_scripts', '_starter_enqueue_css' );

if ( ! function_exists( '_starter_enqueue_css' ) ) {

	/**
	 * Enqueue css file(s).
	 *
	 */
	function _starter_enqueue_css() {

		// $handle, $src, $deps, $ver, $media
		wp_enqueue_style( 'usc-starter-style', get_stylesheet_directory_uri() . '/css/_starter.css', false, null, 'screen,print' );

	}
}

/** --------------------------------------------------------------
2.2 - Javascript
--------------------------------------------------------------*/

// Check that we are not in the WP Admin.
if ( ! is_admin() ) {

	/**
	 * Add action to enqueue javascript files.
	 */
	add_action( 'wp_enqueue_scripts', '_starter_scripts' );

}

if ( ! function_exists( '_starter_scripts' ) ) {

	/**
	 * Enqueue javascript files
	 *
	 * @return void
	 */
	function _starter_scripts() {

		// Dequeue jQuery if not needed
		// wp_deregister_script( 'jquery' );

		// Load individual scripts.
		wp_enqueue_script( 'starter', get_stylesheet_directory_uri() . '/js/starter.js', array(), null, true );

		// Load comments reply script.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/** --------------------------------------------------------------
3.0 - Header
--------------------------------------------------------------*/

add_action( 'widgets_init', '_starter_remove_recent_comments_style' );
if ( ! function_exists( '_starter_remove_recent_comments_style' ) ) {

	/**
	 * Removes inline styles from <head> for comments.
	 *
	 * @global  object  $wp_widget_factory
	 * @return  bool    widget factory removal of css
	 */
	function _starter_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
}

add_action( 'init', '_starter_remove_head_links' );
if ( ! function_exists( '_starter_remove_head_links' ) ) {

	/**
	 * Remove links and metadata from the <head>.
	 */
	function _starter_remove_head_links() {

		// remove emojis
		remove_action( 'wp_head', 'print_emoji_styles' ); // Remove the emoji's
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
		remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
		remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
		remove_action( 'wp_head', 'index_rel_link' ); // index link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
		remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
	}
}


/** --------------------------------------------------------------
4.0 - Footer
--------------------------------------------------------------*/

// Dynamic Footer Columns
require get_template_directory() . '/inc/footer-columns.php';

/** --------------------------------------------------------------
5.0 - Navigation
--------------------------------------------------------------*/


/** --------------------------------------------------------------
5.1 - Menus
--------------------------------------------------------------*/


/** --------------------------------------------------------------
5.2 - Search
--------------------------------------------------------------*/


/** --------------------------------------------------------------
5.3 - Breadcrumbs
--------------------------------------------------------------*/

// Breadcrumbes
require get_template_directory() . '/inc/breadcrumbs.php';


/** --------------------------------------------------------------
5.4 - Section Navigation
--------------------------------------------------------------*/

// Section Navigation
require get_template_directory() . '/inc/class-walker-nav-menu-section.php';


/** --------------------------------------------------------------
5.5 - Pagination
--------------------------------------------------------------*/

if ( ! function_exists( '_starter_paging_nav' ) ) {
	/**
	 * Paging Navigation.
	 *
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @global  $wp_query   WordPress Query Object
	 *
	 * @return string HTML output of pagination links
	 */
	function _starter_paging_nav() {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation navigation-paging" role="navigation">
			<h1 class="screen-reader-text"><?php __( 'Posts navigation', '_starter' ); ?></h1>
			<div class="nav-links">
			<?php
			if ( get_next_posts_link() ) { ?>
				<div class="nav-previous"><span class="meta-nav">&larr;</span> <?php next_posts_link( __( 'Older posts', '_starter' ) ); ?></div>
			<?php } ?>
			<?php if ( get_previous_posts_link() ) { ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', '_starter' ) ); ?> <span class="meta-nav">&rarr;</span></div>
			<?php } ?>
			</div>
		</nav><?php

	}
}


/** --------------------------------------------------------------
5.6 - Adjacent Post Navigation
--------------------------------------------------------------*/

// Display navigation to next/previous post when applicable.
if ( ! function_exists( '_starter_post_nav' ) ) {

	/**
	 * Post Navigation
	 *
	 * Show the 'Previous' and 'Next' links for the adjacent posts.
	 *
	 * @return  string  HTML output
	 */
	function _starter_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php __( 'Post navigation', '_starter' ); ?></h1>
			<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', '_starter' ) );
				next_post_link( '<div class="nav-next">%link</div>',	 _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',	 '_starter' ) );
			?>
			</div>
		</nav>
		<?php
	}
}


/** --------------------------------------------------------------
5.6 - Navigation with Descriptions
--------------------------------------------------------------*/

add_filter( 'walker_nav_menu_start_el', '_starter_add_description_to_menu', 10, 4 );

/**
 * Add Menu Descriptions
 *
 * Add menu descriptions for each item in the 'primary' menu at the first level only.
 *
 * @param string $item_output The menu item's starting HTML output.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param array $args An array of wp_nav_menu() arguments.
 */
function _starter_add_description_to_menu( $item_output, $item, $depth, $args ) {

	// Insert description for the 'primary' menu at the first level only and we have a description.
	if ( 'primary' === $args->theme_location && 0 === $depth && ! empty( $item->description ) ) {

		// Append description after link.
		$item_output .= sprintf( '<span class="description">%s</span>', esc_html( $item->description ) );

		// Insert description 'in' link at the end.
		// $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;

}


/** --------------------------------------------------------------
6.0 - Content
--------------------------------------------------------------*/


/** --------------------------------------------------------------
6.1 - Excerpt
--------------------------------------------------------------*/

add_filter( 'excerpt_length', '_starter_excerpt_length' );
/**
 * Excerpt length.
 *
 * Customize the excerpt length for the theme.
 *
 * @return int Charachter length for excerpt
 */
function _starter_excerpt_length() {
	return 55;
}

add_filter( 'excerpt_more', '_starter_excerpt_read_more' );
/**
 * Excerpt Read More.
 *
 * Add a customized 'Read More' link to the end of excerpts.
 *
 * @global  object  $post   WordPress Post Object
 * @return string Permalink with text
 */
function _starter_excerpt_read_more() {
	global $post;
	return ' <a class="read-more" href="' . get_permalink( $post->ID ) . '">' . __( 'Read more', '_starter' ) . '</a>';
}


/** --------------------------------------------------------------
7.0 - Media
--------------------------------------------------------------*/


/** --------------------------------------------------------------
7.1 - Images
--------------------------------------------------------------*/

// Add custom image sizes
	if ( function_exists( 'add_image_size' ) ) {

		/* Example
		 * add_image_size( 'image-name', 1440, 900, true ); //width, height, cropping boolean - 1.6:1 ratio
		 */
	}
// end

// Standard Image output for posts
	function _starter_post_image( $image_size = 'sinle-post-image', $caption = false ) {
		if ( has_post_thumbnail() ) {
			?>
		<figure class="entry-image">
			<?php the_post_thumbnail( $image_size );
			?>
			<?php
				if ( $caption ) {
					$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
					if ( $image_caption ) {
						?>
				<figcaption>
					<?php echo $image_caption;
						?>
				</figcaption>
				<?php

					}
				}
			?>
		</figure>
		<?php

		}
	}


/** --------------------------------------------------------------
7.2 - Video
--------------------------------------------------------------*/


/** --------------------------------------------------------------
8.0 - Taxonomy
--------------------------------------------------------------*/

// See 1.4.4 - Taxonomy Creation for categories created on theme activation


/** --------------------------------------------------------------
8.1 - Category
--------------------------------------------------------------*/


/** --------------------------------------------------------------
8.2 - Tags
--------------------------------------------------------------*/

// Returns true if a blog has more than 1 category.
	function _starter_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}

		// check if the blog site has more than 1 category
		$categorized = ( '1' !== $all_the_cool_cats ) ? true : false;

		return $categorized;
	}
// end

// Flush out the transients used in _starter_categorized_blog.
	function _starter_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}
	add_action( 'edit_category', '_starter_category_transient_flusher' );
	add_action( 'save_post',	 '_starter_category_transient_flusher' );


/** --------------------------------------------------------------
9.0 - Posts
--------------------------------------------------------------*/


/** --------------------------------------------------------------
9.1 - Post Meta
--------------------------------------------------------------*/

if ( ! function_exists( '_starter_posted_on' ) ) {

/**
 * Posted On.
 *
 * Add the published date to posts using
 *
 * @return [type] [description]
 */
function _starter_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= ' [Updated: <time class="updated" datetime="%3$s">%4$s</time>]';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', '_starter' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
}


/** --------------------------------------------------------------
9.2 - Post Types
--------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.1 - Posts
--------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.2 - Pages
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.0 - Templates
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.1 - Archive
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.2 - Author
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.3 - Home
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.4 - Page
--------------------------------------------------------------*/


/** --------------------------------------------------------------
10.5 - Post
--------------------------------------------------------------*/
