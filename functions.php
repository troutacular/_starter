<?php
/**
	usc-starter functions and definitions
	
	@package usc-starter
**/
  
/**
	Table of Contents

	1.0 - Global Functions
		1.1 - Dependencies
		1.2 - Theme Init
			1.2.1 - Page Creation
			1.2.3 - Taxonomy Creation
		1.3 - Header
			1.3.1 - CSS
		1.4 - Navigation
			1.4.1 - Menus
			1.4.2 - Pagination
			1.4.3 - Post Navigation
			1.4.4 - Search
			1.4.5 - Section Navigation
			1.4.6 - Navigation with Descriptions
		1.5 - Content
			1.5.1 - Breadcrumbs
			1.5.2 - Excerpt
		1.6 - Sidebars
		1.7 - Media
			1.7.1 - Images
			1.7.2 - Video
		1.8 - Footer
		1.9 - Scripts
	2.0 - Category
	3.0 - Archive
	4.0 - Tags
	5.0 - Page
	6.0 - Post
		6.1 - Post Meta
		6.2 - Custom Post Types
	7.0 - Author
	8.0 - Index/Home
	9.0 - Login
	10.0 - Customizations
	11.0 - Admin
**/


/*--------------------------------------------------------------
1 - Global Functions
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.1 - Dependencies
--------------------------------------------------------------*/

	// Check if we are in a local environment
		require get_template_directory() . '/inc/is-localhost.php';
	// end


/*--------------------------------------------------------------
1.2 - Theme Init
--------------------------------------------------------------*/

	// Set the content width based on the theme's design and stylesheet.
		if ( ! isset( $content_width ) ) {
			$content_width = 1120; /* pixels */
		}
	    
    /**
     * Starter Remove Recent Comments
     *
     * Removes inline styles from <head> for comments
     *
     * @since 1.0.0
     * @return	boolean 	widget factory removal of css
     */
    function _starter_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', '_starter_remove_recent_comments_style' );
	

	if ( ! function_exists( '_starter_setup' ) ) {

		/**
		 * Starter Theme Setup
		 *
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which runs 
		 * before the init hook. The init hook is too late for some features, such as 
		 * indicating support for post thumbnails.
		 * 
		 * @since 1.0.0
		 */
		function _starter_theme_setup() {
		
			/**
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on usc-starter, use a find and replace
			 * to change '_starter' to the name of your theme in all the template files
			 *
			 * @link https://codex.wordpress.org/Function_Reference/load_theme_textdomain
			**/
			load_theme_textdomain( '_starter', get_template_directory() . '/languages' );
		
			/**
			 * Enable wp_nav_menu() in one location.
			 * @link https://codex.wordpress.org/Function_Reference/register_nav_menu
			 */
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', '_starter' ),
			) );
		
			
			// Check if 'add_theme_support' is supported
			if ( function_exists( 'add_theme_support' ) ) {
				
				/**
				 * Enable support for Post Thumbnails on posts and pages.
				 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
				**/
				add_theme_support( 'post-thumbnails' );
				
				/**
				 * Enable support for Post Formats.
				 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Formats
				**/
				add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
				
				/**
				 * Enable support for HTML5 elements.
				 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
				**/
				add_theme_support( 'html5', array(
					'comment-list',
					'search-form',
					'comment-form',
					'gallery',
					'caption'
				) );

				/**
				 * Enable Theme Title.
				 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
				 */
				add_theme_support( 'title-tag' );

			}
		}

	}
	add_action( 'after_setup_theme', '_starter_theme_setup' );



/*--------------------------------------------------------------
1.2.1 - Page Creation
--------------------------------------------------------------*/

	/**
	 * Run this function after theme setup.  Did not use 'after_switch_theme'
	 * to allow for future automatic additions to existing sites.
	**/
	add_action( 'after_setup_theme', '_starter_page_add' );	
	
	// run the function if it doesn't already exist
	if ( ! function_exists( '_starter_page_add' ) ) {
		
		// get the support page function
		require_once get_template_directory() . '/inc/support-page-setup.php';

		/**
		 * Starter Page Add
		 *
		 * Uses _starter_page_additions function to add pages to the site.
		 *
		 * @since 1.0.0
		 * @return 	function 	Adds pages to the site if they do no exist.
		 */
		
		function _starter_page_add() {
			
			/**
			 * usage: (see full documentation in '/inc/support-page-setup.php'
			 * _starter_page_additions( [ page title ], [ page template ], [ post status ], [ password ], [ set as homepage ], [ parent slug ] );
			 * 
			 * sample:
			 * _starter_page_additions( 'Site Help', 'templates/tpl-help.php', 'private', false, false, false, false );
			**/
			
			// create admin page
			_starter_page_additions( 'Site Admin', 'templates/tpl-admin.php', 'private', false, false, false, false );
			
			// create help page
			_starter_page_additions( 'Site Help', 'templates/tpl-help.php', 'private', false, false, false, false );
			
			// create styleguide page
			_starter_page_additions( 'Site Styleguide', 'templates/tpl-styleguide.php', 'private', false, false, false, false );
								
		}
	}
			


	/**
	 * Set up the following pages only once on theme switch.
	 * Does not require updates each time the admin is accessed.
	 * Does not override settings, particularly for the selection of the homepage designation.
	**/
	add_action( 'after_switch_theme', '_starter_page_add_once' );

	// run the function if it doesn't already exist
	if ( ! function_exists( '_starter_page_add_once' ) ) {
		
		/**
		 * Starter Page Add Once
		 *
		 * Adds a page to the site once.
		 * 
		 * @return 	function 	Adds pages only once to the site after theme switch.
		 */
		function _starter_page_add_once() {
			
			/**
			 * usage: (see full documentation in '/inc/support-page-setup.php'
			 * _starter_page_additions( [ page title ], [ page template ], [ post status ], [ password ], [ set as homepage ], [ parent slug ] );
			**/
								
		}
	}


/*--------------------------------------------------------------
1.2.3 - Taxonomy Creation
--------------------------------------------------------------*/

		
		
	/**
	 * Run this function after theme setup.  Did not use 'after_switch_theme'
	 * to allow for future automatic additions to existing sites.
	**/
	add_action( 'after_setup_theme', '_starter_create_new_taxonomies' );
	
	/**
	 * Create New Taxonomies
	 *
	 * Add specified taxonomies to the site.
	 *
	 * @link https://codex.wordpress.org/Taxonomies#Default_Taxonomies
	 *
	 * @since 1.0.0
	 * @return  array|WP Error 	Inserts taxonomy or returens WP Error message
	 */
	function _starter_create_new_taxonomies() {

		/**
		 * Set an array of taxonomies to add
		 *
		 * @link https://codex.wordpress.org/Function_Reference/wp_insert_term
		 *
		 * usage:
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
				$term = term_exists($taxonomy['name'], $taxonomy['taxonomy']);
				
				// if the term doesn't exist, add it
				if ($term == 0 || $term == null) {
					wp_insert_term( 
						$taxonomy['name'], 
						$taxonomy['taxonomy'], 
						$taxonomy['args'] 
					);
				}

			}

		}

	}



/*--------------------------------------------------------------
1.3 - Header
--------------------------------------------------------------*/

	// remove some metadata from the <head> of each page
		if ( ! function_exists( 'remheadlink' ) ) {
		    add_action('init', 'remheadlink');
			function remheadlink() {
				//remove_action('wp_head', 'rel_canonical');  // Display a link for the URL to help search engines
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
    // end
    
    // remove inline styles from <head> for comments
		add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );
	    function twentyten_remove_recent_comments_style() {
			global $wp_widget_factory;
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
    // end
    
    // Filters wp_title to print a neat <title> tag based on what is being viewed.
		
		/**
			@param string $title Default title text for current view.
			@param string $sep Optional separator.
			@return string The filtered title.
		**/
		add_filter( 'wp_title', '_starter_wp_title', 10, 2 );
		function _starter_wp_title( $title, $sep ) {
			if ( is_feed() ) {
				return $title;
			}
			
			global $page, $paged;
			
			// Get the Site Title from the settings
			$site_title = get_bloginfo( 'name', 'display' );
			
			// Set a custom element for the end of the <title> output
			$title_last = 'USC';
			
			// Add the blog name
			$title .= $site_title;
			
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) ) {
				$title .= " $sep $site_description";
			}
			
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 ) {
				$title .= " $sep " . sprintf( __( 'Page %s', '_starter' ), max( $paged, $page ) );
			}
			
			// Check if $title_last exists in the main site name
			$title_check = strpos($site_title, $title_last);
			
			// If $title_last is not in the site title, then add it to the end of the <title>
			if ($title_check === false) {
				$title .= " $sep $title_last";
			}
			
			return $title;
		}
	// end



/*--------------------------------------------------------------
1.3.1 - CSS
--------------------------------------------------------------*/

	// Add CSS files to the header
	add_action( 'wp_enqueue_scripts', '_starter_css' );
		function _starter_css() {
			wp_enqueue_style( 'usc-starter-style', get_stylesheet_directory_uri().'/css/stylesheet.css', false, null, 'screen,print'  ); // $handle, $src, $deps, $ver, $media
		}
	// end



/*--------------------------------------------------------------
1.4 - Navigation
--------------------------------------------------------------*/

	/**
		To add preset mobile navigation:
		
		1. add the navigation css option in sass partial sass/_modules - @import 'modules/site-navigation-mobile';
		2. add javascript options for modernizr and mobile navigation js in section '1.8 - Scripts'	
	**/



/*--------------------------------------------------------------
1.4.1 - Menus
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.4.2 - Pagination
--------------------------------------------------------------*/

	// Display navigation to next/previous set of posts when applicable.
		if ( ! function_exists( '_starter_paging_nav' ) ) :
		// @return void
			function _starter_paging_nav() {
				// Don't print empty markup if there's only one page.
				if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
					return;
				}
				?>
				<nav class="navigation paging-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Posts navigation', '_starter' ); ?></h1>
					<div class="nav-links">
			
						<?php if ( get_next_posts_link() ) : ?>
						<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_starter' ) ); ?></div>
						<?php endif; ?>
			
						<?php if ( get_previous_posts_link() ) : ?>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_starter' ) ); ?></div>
						<?php endif; ?>
			
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
				<?php
			}
		endif;
	// end



/*--------------------------------------------------------------
1.4.3 - Post Navigation
--------------------------------------------------------------*/

	// Display navigation to next/previous post when applicable.
		if ( ! function_exists( '_starter_post_nav' ) ) {
			// @return void
			function _starter_post_nav() {
				// Don't print empty markup if there's nowhere to navigate.
				$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
				$next     = get_adjacent_post( false, '', false );
			
				if ( ! $next && ! $previous ) {
					return;
				}
				?>
				<nav class="navigation post-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Post navigation', '_starter' ); ?></h1>
					<div class="nav-links">
						<?php
							previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', '_starter' ) );
							next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     '_starter' ) );
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
				<?php
			}
		}
	// end



/*--------------------------------------------------------------
1.4.4 - Search
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.4.5 - Section Navigation
--------------------------------------------------------------*/

	// Section Navigation
		require get_template_directory() . '/inc/class-walker-nav-menu-section.php';
	// end



/*--------------------------------------------------------------
1.4.6 - Navigation with Descriptions
--------------------------------------------------------------*/

	// Navigation with Descriptions
		require get_template_directory() . '/inc/navigation-descriptions.php';
	// end



/*--------------------------------------------------------------
1.5 - Content
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.5.1 - Breadcrumbs
--------------------------------------------------------------*/

	// Breadcrumbes
		require get_template_directory() . '/inc/breadcrumbs.php';
	// end



/*--------------------------------------------------------------
1.5.2 - Exerpt
--------------------------------------------------------------*/

	// set a custom length (truncation point) for excerpts
		add_filter( 'excerpt_length', 'custom_excerpt_length' );	
		function custom_excerpt_length( $length ) {
			return 55; //Change this number to any integer you like - default is 55.
		}
	// end
	
	// set a custom 'more' for excerpts
		add_filter( 'excerpt_more', 'custom_excerpt_more' );
		function custom_excerpt_more( $more ) {
			global $post;
			return ' <a class="read-more" href="'. get_permalink($post->ID) . '">Read more</a>';
		}
	//


/*--------------------------------------------------------------
1.6 - Sidebars
--------------------------------------------------------------*/

	// Register widgetized area and update sidebar with default widgets.
		
		/** 
			This will set up sidebars in the admin for each page template type in the admin.
			A page template will need to be created for each type (templates/tpl-[slug].php).
			The [slug] will be used in the sidebar to check if that template type exists.
		**/
		
		add_action( 'widgets_init', '_starter_widgets_init' );
		function _starter_widgets_init() {
			// set the names to use for the page templates
			$sidebars = array(
				array(
					'name' => 'Global',
					'slug' => 'template-global',
					'description' => 'Items placed here will appear in the sidebar on every page at the bottom.'
				),
				array(
					'name' => 'Homepage',
					'slug' => 'template-homepage',
					'description' => 'Items placed here will only appear in the sidebar on the Homepage and above the Global items.'
				),
				array(
					'name' => 'Category',
					'slug' => 'template-category',
					'description' => 'Items placed here will only appear on Categories and above the Global Items.'
				),
				array(
					'name' => 'Archive',
					'slug' => 'template-archive',
					'description' => 'Items placed here will only appear in the Archives and above the Global Items.'
				),
				array(
					'name' => 'Article',
					'slug' => 'template-article',
					'description' => 'Items placed here will only appear on Single Posts and above the Global Items.'
				),
				array(
					'name' => 'Default Page',
					'slug' => 'template-default-content',
					'description' => 'Items placed here will only appear on Pages with the Template \'Default Page\' selected and above the Global Items.'
				)
			);
			foreach ( $sidebars as $sidebar ) {
				register_sidebar( array(
					'name'          => __( $sidebar['name'], '_starter' ),
					'id'            => $sidebar['slug'],
					'description'	=> __( $sidebar['description'], '_starter' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h1 class="widget-title">',
					'after_title'   => '</h1>',
				) );
			}
		}
	// end



/*--------------------------------------------------------------
1.7 - Media
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.7.1 - Images
--------------------------------------------------------------*/
	
	// Add custom image sizes
		if ( function_exists( 'add_image_size' ) ) {
			
			/* Example
			 * add_image_size( 'image-name', 1440, 900, true ); //width, height, cropping boolean - 1.6:1 ratio
			 */
			
			add_image_size( 'starter-full-width', 1440, 900, true ); // 1.6:1
			add_image_size( 'featured-image', 825, 550, true ); // 1.5:1
			
			add_image_size( 'single-post-image', 585, 1200, false ); // 1.5:1
			add_image_size( 'category-post-image', 330, 675, false ); // 1.5:1
			
		}
	// end
	
	// Standard Image output for posts
		function _starter_post_image( $image_size = 'sinle-post-image', $caption = false ){
			if ( has_post_thumbnail() ) { ?>
			<figure class="entry-image">
				<?php the_post_thumbnail($image_size); ?>
				<?php 
					if ( $caption ) {
						$image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
						if ( $image_caption ) { ?>
					<figcaption>
						<?php echo $image_caption; ?>
					</figcaption>
					<?php }
					}
				?>
			</figure>
			<?php }
		}
	// end


/*--------------------------------------------------------------
1.7.2 - Video
--------------------------------------------------------------*/



/*--------------------------------------------------------------
1.8 - Footer
--------------------------------------------------------------*/

	// Dynamic Footer Columns
		require get_template_directory() . '/inc/footer-columns.php';
	// end
	
	// Set the link url for student affairs
		$footer_logo_link = 'https://studentaffairs.usc.edu/';
	// end



/*--------------------------------------------------------------
1.9 - Scripts
--------------------------------------------------------------*/
	
	// Enqueue scripts and styles.
		if( !is_login_page() && !is_admin() ) {
			add_action( 'wp_enqueue_scripts', '_starter_scripts' );
			function _starter_scripts() {
				
				/* jQuery - By default jQuery should not be enabled.
				   Try to solve the need with CSS and native javascript first.
				 */
				$jquery = false;
				
				// jquery include from CDN
				
				//turn off for development
				wp_deregister_script('jquery');
				
				if ($jquery) {
					wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', false, null, true );
					wp_enqueue_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-1.2.1.min.js', 'jquery', null, true );
				}
				
				wp_enqueue_script( 'starter', get_stylesheet_directory_uri() . '/js/starter.js', array(), null, true );
			
				if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}
				
				// let future child themes know the parent scripts are loaded
				do_action('starter_scripts_loaded');
				
			}
		}
	// end



/*--------------------------------------------------------------
2.0 - Category
--------------------------------------------------------------*/

	// See 1.1.3 - Taxonomy Creation for categories created on theme activation



/*--------------------------------------------------------------
3.0 - Archive
--------------------------------------------------------------*/



/*--------------------------------------------------------------
4.0 - Tags
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
		
			if ( '1' != $all_the_cool_cats ) {
				// This blog has more than 1 category so _starter_categorized_blog should return true.
				return true;
			} else {
				// This blog has only 1 category so _starter_categorized_blog should return false.
				return false;
			}
		}
	// end
	
	// Flush out the transients used in _starter_categorized_blog.
		function _starter_category_transient_flusher() {
			// Like, beat it. Dig?
			delete_transient( 'all_the_cool_cats' );
		}
		add_action( 'edit_category', '_starter_category_transient_flusher' );
		add_action( 'save_post',     '_starter_category_transient_flusher' );
	// end



/*--------------------------------------------------------------
5.0 - Page
--------------------------------------------------------------*/



/*--------------------------------------------------------------
6.0 - Post
--------------------------------------------------------------*/
	
	// add page order to posts
		add_post_type_support ( 'post', 'page-attributes' );
	// end



/*--------------------------------------------------------------
6.1 - Post Meta
--------------------------------------------------------------*/

	// Prints HTML with meta information for the current post-date/time and author.
		if ( ! function_exists( '_starter_posted_on' ) ) {
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
	// end



/*--------------------------------------------------------------
6.2 - Custom Post Types
--------------------------------------------------------------*/



/*--------------------------------------------------------------
7.0 - Author
--------------------------------------------------------------*/

	// Sets the authordata global when viewing an author archive.
		/**
		 * This provides backwards compatibility with
		 * http://core.trac.wordpress.org/changeset/25574
		 *
		 * It removes the need to call the_post() and rewind_posts() in an author
		 * template to print information about the author.
		 *
		 * @global WP_Query $wp_query WordPress Query object.
		 * @return void
		 */
		add_action( 'wp', '_starter_setup_author' );
		function _starter_setup_author() {
			global $wp_query;
		
			if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
				$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
			}
		}
	// end


/*--------------------------------------------------------------
8.0 - Index/Home
--------------------------------------------------------------*/

	// See 1.1.1 - Page Creation for pages created on theme activation 



/*--------------------------------------------------------------
9.0 - Login
--------------------------------------------------------------*/

	// set function for testing if on login page 
		function is_login_page() {
			return !strncmp($_SERVER['REQUEST_URI'], '/wp-login.php', strlen('/wp-login.php'));
		}
	// end



/*--------------------------------------------------------------
10.0 - Customizations
--------------------------------------------------------------*/
	
	// Customizer additions.
		require get_template_directory() . '/inc/customizer.php';
	// end
	
	// Customizer additions - Site Contact.
		require get_template_directory() . '/inc/customize-site-contact.php';
	// end



/*--------------------------------------------------------------
11.0 - Admin
--------------------------------------------------------------*/