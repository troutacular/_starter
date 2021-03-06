<?php
/**
 * Functions and definitions for _starter theme.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @todo phpmd/phpcs
 *
 * @package _starter
 */

/** --------------------------------------------------------------

Table of Contents

1.0 - Globals
	1.1 - Configuration Settings
	1.2 - Environment
	1.3 - Dependencies
	1.4 - Theme Setup
		1.4.1 - Sidebar Registration
		1.4.2 - Customizer
		1.4.3 - Taxonomy Creation
		1.4.4 - Custom Post Types
2.0 - Scripts
	2.1 - CSS
	2.2 - Javascript
3.0 - Site Header
4.0 - Site Footer
5.0 - Navigation
	5.1 - Menus
	5.2 - Search
	5.3 - Pagination
	5.4 - Adjacent Post Navigation
6.0 - Content
	6.1 - Excerpt
7.0 - Media
	7.1 - Images
	7.2 - Video
8.0 - Taxonomy
	8.1 - Category
	8.2 - Tags
9.0 - Templates
	9.1 - Template Tags
	9.2 - Template Types
		9.2.1 - Posts
		9.2.2 - Pages
		9.2.3 - Media
		9.2.4 - Archive / Category
		9.2.5 - Search
10.0 - Admin
	10.1 - TinyMCE
	10.2 - Theme Instructions

----------------------------------------------------------------*/

/** --------------------------------------------------------------
1.0 - Globals
----------------------------------------------------------------*/


/** --------------------------------------------------------------
1.1 - Configuration Settings
----------------------------------------------------------------*/

// Require the _starter_get_config function generated by Gulp.
require get_template_directory() . '/inc/config-options.php';

// Require the theme sprite function.
require get_template_directory() . '/inc/sprite-classes.php';

/**
 * Set the configuration option value.
 *
 * @param   string $value    Value to test if exists.
 * @param   string $default  Default value if test fails.
 * @return  string           Value based on test.
 */
function _starter_set_config_option( $value, $default = '' ) {

	if ( ! empty( $value ) ) {
		return $value;
	}

	return $default;
}

/**
 * Get the theme version from the build.
 *
 * @return  string  Theme version.
 */
function _starter_get_version() {
	$config = _starter_get_config();
	return $config['version'];
}

/**
 * Get the theme version from the build.
 *
 * @return  string  Theme version.
 */
function _starter_get_filename_base() {
	$config = _starter_get_config();
	return $config['assets']['filename_base'];
}

/**
 * Get the path of the assets.
 *
 * @param   string $type  Type of assets to get the path.
 * @return  string        Path to asset type.
 */
function _starter_get_asset_path( $type ) {
	$config = _starter_get_config();
	switch ( $type ) {

		case 'js-admin':
			return $config['paths']['assets']['js']['admin'];
			break;

		case 'js-lib':
			return $config['paths']['assets']['js']['lib'];
			break;

		case 'js-vendor':
			return $config['paths']['assets']['js']['vendor'];
			break;

		case 'images':
			return $config['paths']['assets']['images'];
			break;

		// Default CSS.
		default:
			return $config['paths']['assets']['css'];
			break;
	}
}



/** --------------------------------------------------------------
1.2 - Environment
----------------------------------------------------------------*/


/** --------------------------------------------------------------
1.3 - Dependencies
----------------------------------------------------------------*/


/** --------------------------------------------------------------
1.4 - Theme Setup
----------------------------------------------------------------*/

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
		 *
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _starter, use a find and replace
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
				'primary' => esc_html__( 'Primary Menu', '_starter' ),
			) );
		}

		// Check if 'add_theme_support' is supported.
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
		} // End if().
	}
} // End if().


/** --------------------------------------------------------------
1.4.1 - Sidebar Registration
----------------------------------------------------------------*/

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
	 *
	 * Note: To add custom page template sidebars, a page template will need to be created for each type (page-templates/tpl-[slug].php).
	 * The [slug] will be used in the sidebar to check if that template type exists.
	 *
	 * @return void
	 */
	function _starter_widgets_init() {
		/**
		 * Set the names to use for the page templates.
		 *
		 * @var  array
		 */
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

		/**
		 * Loop through the $sidebars array and register the widget area.
		 */
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
} // End if().


/** --------------------------------------------------------------
1.4.2 - Customizer
----------------------------------------------------------------*/

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/** --------------------------------------------------------------
1.4.3 - Taxonomy Creation
----------------------------------------------------------------*/

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
	 * @return void
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

		/**
		 * Check that we have taxonomies to process.
		 */
		if ( ! empty( $taxonomies ) ) {

			/**
			 * Loop through the taxonomies array and add them to the site.
			 */
			foreach ( $taxonomies as $taxonomy ) {

				/**
				 * Check if the taxonomy already exists.
				 *
				 * @var  bool
				 */
				$term = term_exists( $taxonomy['name'], $taxonomy['taxonomy'] );

				/**
				 * If the term doesn't exist, add it.
				 */
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
} // End if().


/** --------------------------------------------------------------
1.4.4 - Custom Post Types
----------------------------------------------------------------*/


/** --------------------------------------------------------------
2.0 - Scripts
----------------------------------------------------------------*/


/** --------------------------------------------------------------
2.1 - CSS
----------------------------------------------------------------*/

/**
 * Add action to enqueue CSS stylesheets.
 */
add_action( 'wp_enqueue_scripts', '_starter_enqueue_css' );

if ( ! function_exists( '_starter_enqueue_css' ) ) {

	/**
	 * Enqueue css file(s).
	 */
	function _starter_enqueue_css() {

		wp_enqueue_style( '_starter-style', get_stylesheet_directory_uri() . _starter_get_asset_path( 'css' ) . _starter_get_filename_base() . '.css', false, _starter_get_version(), 'screen,print' );

	}
}

/**
 * Add action to enqueue CSS stylesheet for admin pages.
 */
add_action( 'admin_enqueue_scripts', '_starter_enqueue_admin_css' );

if ( ! function_exists( '_starter_enqueue_admin_css' ) ) {

	/**
	 * Enqueue css file(s).
	 */
	function _starter_enqueue_admin_css() {

		wp_enqueue_style( '_starter-style-admin', get_stylesheet_directory_uri() . _starter_get_asset_path( 'css' ) . 'admin-styles.css', false, _starter_get_version(), 'screen,print' );

	}
}

/** --------------------------------------------------------------
2.2 - Javascript
----------------------------------------------------------------*/

/**
 * Check that we are not in the WP Admin.
 */
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

		/**
		 * Dequeue jQuery if not needed
		 *
		 * @usage wp_deregister_script( 'jquery' );
		 */

		/**
		 * Add HTML5 Shiv in header.
		 */
		wp_enqueue_script( 'html5-shiv', get_stylesheet_directory_uri() . _starter_get_asset_path( 'js-vendor' ) . 'html5shiv.min.js', array(), _starter_get_version(), false );

		/**
		 * Add metadata to script to load only for IE less than 9.
		 */
		wp_script_add_data( 'html5-shiv', 'conditional', 'lte IE 9' );

		/**
		 * Set primary theme script dependencies.
		 */
		$script_dependencies = array();

		/**
		 * Get configuration options.
		 */
		$config = _starter_get_config();

		/**
		 * Load Modernizr script if requested.
		 */
		$modernizr = $config['assets']['modernizr'];

		if ( $modernizr['include']  && ! empty( $modernizr['filename'] ) ) {
			wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . _starter_get_asset_path( 'js-vendor' ) . $modernizr['filename'], array(), _starter_get_version(), $modernizr['in_footer'] );

			// Add modernizr as a dependency.
			$script_dependencies[] = 'modernizr';
		}

		/**
		 * Load theme scripts.
		 */
		wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . _starter_get_asset_path( 'js-lib' ) . _starter_get_filename_base() . '.min.js', $script_dependencies, _starter_get_version(), true );

		/**
		 * Load comments reply script.
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // End if().


/** --------------------------------------------------------------
3.0 - Site Header
----------------------------------------------------------------*/

add_action( 'widgets_init', '_starter_remove_recent_comments_style' );
if ( ! function_exists( '_starter_remove_recent_comments_style' ) ) {

	/**
	 * Removes inline styles from <head> for comments.
	 *
	 * @global  object  $wp_widget_factory
	 * @return  void
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

		/**
		 * Remove emojis
		 */
		remove_action( 'wp_head', 'print_emoji_styles' ); // Remove the emoji's.
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
		remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version.
	}
}


/** --------------------------------------------------------------
4.0 - Site Footer
----------------------------------------------------------------*/

/**
 * See WP_Custom_Footer_Columns->_starter_footer_arguments for
 * setting a theme specific function to set values different than
 * the defaults.
 */

/**
 * Dynamic Footer Columns.
 */
require get_template_directory() . '/inc/class-wp-custom-footer-columns.php';



/** --------------------------------------------------------------
5.0 - Navigation
----------------------------------------------------------------*/


/** --------------------------------------------------------------
5.1 - Menus
----------------------------------------------------------------*/


/** --------------------------------------------------------------
5.2 - Search
----------------------------------------------------------------*/


/** --------------------------------------------------------------
5.3 - Pagination
----------------------------------------------------------------*/


/** --------------------------------------------------------------
5.4 - Adjacent Post Navigation
----------------------------------------------------------------*/

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( '_starter_post_nav' ) ) {

	/**
	 * Post Navigation
	 *
	 * Show the 'Previous' and 'Next' links for the adjacent posts.
	 *
	 * @return  string  HTML output
	 */
	function _starter_post_nav() {
		/**
		 * Don't print empty markup if there's nowhere to navigate.
		 *
		 * @var  object
		 */
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', '_starter' ); ?></h1>
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
6.0 - Content
----------------------------------------------------------------*/


/** --------------------------------------------------------------
6.1 - Excerpt
----------------------------------------------------------------*/

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
	return ' <a class="read-more" href="' . get_permalink( $post->ID ) . '">' . esc_html__( 'Read more', '_starter' ) . '</a>';
}


/** --------------------------------------------------------------
7.0 - Media
----------------------------------------------------------------*/


/** --------------------------------------------------------------
7.1 - Images
----------------------------------------------------------------*/

/**
 * Add image sizes
 */
if ( function_exists( 'add_image_size' ) ) {

	/**
	 * Add images with width, height, cropping boolean.
	 * Keep ratios the same between size.
	 */
	add_image_size( 'single-post-image', 300, 300, false ); // 1:1

}

/**
 * Standard Image output for posts.
 */
if ( ! function_exists( '_starter_get_the_post_figure_thumbnail' ) ) {
	/**
	 * Post Image
	 *
	 * Returns a common structure for images and captions.
	 *
	 * @todo Add WP Core 4.4+ responsive image handling.
	 * @link https://make.wordpress.org/core/2015/11/10/responsive-images-in-wordpress-4-4/
	 *
	 * @param  array $args  [image_size {sting}], [attr {array}] [caption {boolean}], [caption_before{string}], [link {boolean}], [echo {boolean}].
	 * @return string
	 */
	function _starter_get_the_post_figure_thumbnail( $args = array() ) {

		$figcaption = $figcaption_before = '';

		$allowed_tags = wp_kses_allowed_html( 'post' );

		$post_id = get_the_ID();

		// Defaults.
		$defaults = array(
			'image_size' => 'single-post-image',
			'attr' => array(),
			'caption' => false,
			'caption_before' => '',
			'link' => false,
			'analytics' => array(),
		);

		$args = wp_parse_args( $args, $defaults );

		// Check that a post thumbnail exists.
		if ( has_post_thumbnail() ) {

			/**
			 * Figcaption.
			 */

			// Get the image caption (excerpt).
			$image_caption = get_the_post_thumbnail_caption( $post_id );

			if ( ! empty( $args['caption_before'] ) ) {
				$figcaption_before = '<span class="figcaption_before">' . esc_attr( $args['caption_before'] ) . '</span>';
			}

			if ( $args['caption'] && $image_caption ) {

				$figcaption = sprintf(
					'<figcaption class="entry-figcaption">%1$s%2$s</figcaption>',
					wp_kses( $figcaption_before, $allowed_tags ),
					esc_html( $image_caption )
				);
			}

			/**
			 * Image.
			 */

			// Get the image.
			$image = get_the_post_thumbnail( $post_id, $args['image_size'], $args['attr'] );

			if ( $args['link'] ) {
				$image = sprintf(
					'<a class="entry-image-link" href="%1$s" %2$s>%3$s</a>',
					get_the_permalink( $post_id ),
					_starter_set_analytics_data( $args['analytics'] ),
					get_the_post_thumbnail( $post_id, $args['image_size'], $args['attr'] )
				);
			}

			/**
			 * Figure.
			 */
			$figure = sprintf(
				'<figure class="entry-image">%1$s%2$s</figure>',
				$image,
				$figcaption
			);

			return $figure;
		} // End if().
	}
} // End if().

if ( ! function_exists( '_starter_the_post_figure_thumbnail' ) ) {
	/**
	 * Echoes _starter_get_the_post_figure_thumbnail with passed $args.
	 *
	 * @param   array $args  Passed arguments.
	 * @return  void
	 */
	function _starter_the_post_figure_thumbnail( $args = array() ) {
		echo _starter_get_the_post_figure_thumbnail( $args );
	}
}

/** --------------------------------------------------------------
7.2 - Video
----------------------------------------------------------------*/


/** --------------------------------------------------------------
8.0 - Taxonomy
----------------------------------------------------------------*/

/**
 * See 1.4.4 - Taxonomy Creation for categories created on theme activation.
 */


/** --------------------------------------------------------------
8.1 - Category
----------------------------------------------------------------*/


/** --------------------------------------------------------------
8.2 - Tags
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.1 - Template Tags
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.1 - Template Tags
----------------------------------------------------------------*/

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/** --------------------------------------------------------------
9.2 - Template Types
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.1 - Posts
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.2 - Pages
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.3 - Media
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.4 - Archive / Category
----------------------------------------------------------------*/


/** --------------------------------------------------------------
9.2.5 - Search
----------------------------------------------------------------*/


/** --------------------------------------------------------------
10.0 - Admin
----------------------------------------------------------------*/


/** --------------------------------------------------------------
10.1 - TinyMCE
----------------------------------------------------------------*/

/**
 * Tiny MCE custom styles.
 */
require get_template_directory() . '/inc/tiny-mce-classes.php';


/** --------------------------------------------------------------
10.2 - Theme Instructions
----------------------------------------------------------------*/

/**
 * Theme insstructions page.
 */
require get_template_directory() . '/inc/class-wp-theme-instructions-page.php';
