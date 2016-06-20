<?php
/**
 * Adds pages to site.
 *
 * @package _starter
 */

/**
 * Support Page Additons
 *
 * Set up support pages automatically on theme activeation.  This function will look at the
 * current site for matching page names.  The new page will only be created if it does not
 * exist currently.
 *
 * @link http://codex.wordpress.org/Function_Reference/update_post_meta
 *
 * @usage _starter_page_additions( [ page name ], [ page template ], [ post status ], [ password ], [ set as homepage ] );
 *
 * @param array $params 					An array of element that make up the post to be inserted.
 * @param string $params[post_title]		Set the name of the page title. Generates [slug-name].
 * @param string $params[post_content]		Content to insert into the post content area.
 * @param string $params[post_status]		[ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ]. Defult [false].
 * @param string $params[_wp_page_template]	Filename of a page template - [ 'templates/tpl-[name].php' ].
 * @param bool   $params[post_password]		Set a password to protect the page under the visibility section.
 * @param bool   $params[is_homepage]		Sets the page to be the homepage under Settings > Reading.
 * @param string $params[parent_title]		Sets the page as a child of the page by slug [$parent_title].
 *
 * @todo check for page template existence
 * @todo refactor code to reduce Cyclomatic and NPath complexities.
 */
function _starter_page_additions( $params ) {

	// Get options and set defaults if unset.
	$title = isset( $params['post_title'] ) ? $params['post_title'] : 'New Page';
	$content = isset( $params['post_content'] ) ? $params['post_content'] : 'Update this area with your own content.';
	$status = isset( $params['post_status'] ) ? $params['post_status'] : 'publish';
	$page_template = isset( $params['_wp_page_template'] ) ? $params['_wp_page_template'] : false;
	$password = isset( $params['post_password'] ) ? $params['post_password'] : false;
	$is_homepage = isset( $params['is_homepage'] ) ? $params['is_homepage'] : false;
	$parent_title = isset( $params['parent_title'] ) ? $params['parent_title'] : false;

	// get the new page by it's title.
	$page_check = get_page_by_title( $title );

	// Check if the page with the specified title exists by getting the ID.
	if ( empty( $page_check->ID ) ) {

		// Set the arguments to be used when creating the page.
		$page_args = array(
			'post_type' => 'page',
			'post_title' => $title,
			'post_content' => $content,
			'post_status' => $status,
			'post_author' => 1,
			'post_status' => $status,
			'post_password' => $password,
		);

		// Check if we have a $parent_title.
		if ( $parent_title ) {

			// get the title of the post parent if it exists.
			$parent = get_page_by_title( $parent_title, OBJECT, 'page' );

			// get the parent ID.
			$parent_id = $parent->ID;

			// if we have an integer ID.
			if ( is_integer( $parent_id ) ) {

				// attach the post_parent node to the post creation array.
				$page_args['post_parent'] = $parent_id;
			}
		}

		// Check if the page template variable exists.
		if ( $page_template ) {

			// Set the new page to use the page template.
			$page_args['_wp_page_template'] = $page_template;

		}

		// Set up the new page if it does not exist currently.
		$new_page = wp_insert_post( $page_args );

		// Check if the page template variable exists.
		if ( ! empty( $page_template ) ) {

			// Set the new page to use the page template.
			update_post_meta( $new_page, '_wp_page_template', $page_template );
		}

		if ( $is_homepage ) {
			/**
			 * Set the new page as the homepage in the settings.
			 *
			 * Note: Keep this inside the loop to check if the ID already exists.
			 * This will allow the admin user to set the homepage to a different
			 * page after initial setup.
			 */
			$set_as_home = get_page_by_title( $title );

			// Check to what the front page is currently set - 'post' or 'page'.
			$front_type = get_option( 'show_on_front' );

			/**
			 * Check the ID of the front page.
			 * If it is a post, the returned result will be '0'.
			 * If it is a page, the returned result will be the ID of the page.
			 */
			$front_page_id = get_option( 'page_on_front' );

			/**
			 * If the homepage is not set to use posts and (&&) there is not
			 * already a current page being used for the homepage, continue
			 * setting the options to use the page as a homepage
			 */
			if ( 'post' !== $front_type && empty( $front_page_id ) ) {

				// The ID of the page that should be displayed on the front page.
				update_option( 'page_on_front', $set_as_home->ID );

				// What to show on the front page - static page using 'page_on_front' setting.
				update_option( 'show_on_front', 'page' );
			}
		}
	}
}
