<?php

/* requires the appropriate css to split the columns:

	static css:
		.site-footer .footer-column { float: left; margin: 0 1%; }
		.site-footer.columns-1 .footer-column { width: 98.0%; }
		.site-footer.columns-2 .footer-column { width: 48.0%; }
		.site-footer.columns-3 .footer-column { width: 31.333%; }
		.site-footer.columns-4 .footer-column { width: 23.0%; }

		.site-footer .widget { clear: both; }
		.site-footer.columns-3 .footer-column:nth-child(2) .widget { margin: 0 auto; }

	scss:
		customize per project with susy grids
		sass/styleguide/_grid.scss - grids
		sass/styleguide/_footer.scss - default footer
*/

// add footer sidebars

	register_sidebars( 4, array(
		'name' => __( 'Footer Column %d', '_starter' ),
		'id' => 'footer-column',
		'description' => __( 'Drag widgets here to show in the corresponding column of the footer. The columns are dynamic and they will split their width\'s evenly between Footer Column areas that have active widgets.', '_starter' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>'
	) );
// end

// Count the number of footer sidebars to enable dynamic classes for the footer
	function footer_column_class() {
		$count = 0;

		if ( is_active_sidebar( 'footer-column' ) )
			$count++;

		if ( is_active_sidebar( 'footer-column-2' ) )
			$count++;

		if ( is_active_sidebar( 'footer-column-3' ) )
			$count++;

		if ( is_active_sidebar( 'footer-column-4' ) )
			$count++;

		$class = '';

		switch ( $count ) {
			case '1':
				$class = 'columns-1';
				break;
			case '2':
				$class = 'columns-2';
				break;
			case '3':
				$class = 'columns-3';
				break;
			case '4':
				$class = 'columns-4';
				break;
		}

		if ( $class )
			echo ' '.$class;
	}

// end