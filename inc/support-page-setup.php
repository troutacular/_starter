<?php
	/* Set up support pages automatically on theme activeation.  This function will look at the
	 * current site for matching page names.  The new page will only be created if it does not 
	 * exist currently.
	 * 
	 * Usage
	 *
	 * _starter_page_additions( [ page name ], [ page template ], [ post status ], [ password ], [ set as homepage ] );
	 * 
	 * page name: [ 'string' ] Set the name of the Page Title.  The slug will be generated from this also.
	 * page template: [ 'string' ] Use the filename of a page template - [ 'templates/tpl-[name].php' ].  This must be in existence first to apply it's use to the new page. Default [false]
	 * post status: [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ]. Defult [false]
	 * password: [ 'string' ] Set a password to protect the page under the visibility section.
	 * set as homepage: [ true | false ] Set the page to be the homepage under Settings > Reading. Note: if more than one is set to [true] then .  Default [false]
	 */
	
	function _starter_page_additions( $page, $template = false, $status = 'draft', $password = false, $home = false, $parent_slug = false ) {
		
		// check if there is a page named 'Home', if not, create it and set it as the Homepage in the Settings.
			
			// set the title of the page
			$new_page_title = $page;
			
			// set the content of the page
			$new_page_content = 'Update this area with your own content.';
			
			// set the template name to be used.  example: templates/tpl-name.php.  leave blank '' to not use a page template.
			$new_page_template = $template;
			
			// get the new page by it's title
			$new_page_check = get_page_by_title( $new_page_title );
			
			// set post status
			if ( $status ) {
				$new_page_status = $status;
			} else {
				$new_page_status = 'publish';
			}
			
			// set post password
			if ( $password ) {
				$new_page_password = $password;
			} else {
				$new_page_password = '';
			}
			
			// set the arguments to be used when creating the page
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_status' => $new_page_status,
				'post_password' => $new_page_password,
			);
			
			// set the default parent id to be false
			$parent_id = false;
			
			// get the slug of the post parent if it exists
			if ( $parent_slug ) {
				$parent = get_page_by_title( $parent_slug );
				$parent_id = $parent->ID;
			}
			
			if ( $parent_id ) {
				$new_page['post_parent'] = $parent_id;
			}
			
			// check if the page with the specified title exists by getting the ID
			if( !isset( $new_page_check->ID ) ) {
				
				// set up the new page if it does not exist currently
				$new_page_id = wp_insert_post( $new_page );
				
				// check if the page template variable exists
				if ( !empty( $new_page_template ) ) {
					
					// set the new page to use the page template
					update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
				
				}
				
				if ( !empty( $home ) ) {
					/* Set the new page as the homepage in the settings
					 * 
					 * Note: Keep this inside the loop to check if the ID already exists.
					 * This will allow the admin user to set the homepage to a different
					 * page after initial setup.
					 */
					$set_as_home = get_page_by_title( $new_page_title );
					
					/* Check to what the front page is currently set - 'post' or 'page'
					 */
					$front_type = get_option('show_on_front');
					
					/* Check the ID of the front page.  If it is a post, the returned 
					 * result will be '0'.  If it is a page, the returned result will 
					 * be the ID of the page.
					 */
					$front_page_id = get_option('page_on_front');
					
					/* If the homepage is not set to use posts and (&&) there is not 
					 * already a current page being used for the homepage, continue
					 * setting the options to use the page as a homepage
					 */
					if ( $front_type != 'post' && empty($front_page_id) ) {
					
						// The ID of the page that should be displayed on the front page.
						update_option( 'page_on_front', $set_as_home->ID );
						
						// What to show on the front page - static page using 'page_on_front' setting.
						update_option( 'show_on_front', 'page' );
					
					}
				}
			}
		
		// end
	}
	
?>