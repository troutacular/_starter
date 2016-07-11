<?php
/**
 * The functions for adding footer columns.
 *
 * @todo add for loop from footer.php as function
 * @package _starter
 */

if ( ! class_exists( 'Starter_Footer_Columns' ) ) {

	/**
	 * Starter Footer columns
	 *
	 * Registers sidebars for the footer
	 *
	 * @since 1.0.0
	 * @package _starter
	 * @subpackage inc
	 */
	class Starter_Footer_Columns {

		/**
		 * Number of columns to register
		 *
		 * @var  integer
		 */
		public $column_register = 4;

		/**
		 * Constructor to run when class is initiated.
		 */
		public function __construct() {

			/**
			 * Register the sidebars
			 */
			register_sidebars( $this->column_register, array(
				'name' => __( 'Footer Column %d', '_starter' ),
				'id' => 'footer-column',
				'description' => __( 'Drag widgets here to show in the corresponding column of the footer. The columns are dynamic and they will split their width\'s evenly between Footer Column areas that have active widgets.', '_starter' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			) );

		}

		/**
		 * Footer column class
		 *
		 * Counts the number of footer sidebars that have widgets and returns a class.
		 *
		 * @return  string		Column class
		 */
		public function footer_column_class() {

			// Set the default to 0.
			$count = 0;

			if ( is_active_sidebar( 'footer-column' ) ) {
				$count++;
			}

			if ( is_active_sidebar( 'footer-column-2' ) ) {
				$count++;
			}

			if ( is_active_sidebar( 'footer-column-3' ) ) {
				$count++;
			}
			if ( is_active_sidebar( 'footer-column-4' ) ) {
				$count++;
			}

			return 'footer-columns-' . esc_attr( $count );
		}

		/**
		 * Footer Column Output
		 *
		 * @return  string 	Output of Widget HTML
		 */
		public function footer_columns() {

			$count = $this->column_register;
			$output = '';

			for ( $i = 0; $i <= $count; $i++ ) {

				// Set default variables.
				$column = 'footer-column';
				$class = 'footer-column-' . $i;

				// Add the column number past first instance for sidebar reference.
				if ( $i > 0 ) {
					$column .= '-' . $i;
				}

				// Check for the sidebar having widgets.
				if ( is_active_sidebar( $column ) ) {

					// Wrapper open.
					$output .= '<div class="footer ' . esc_html( $class ) . '">';

					// Get the sidebar.
					dynamic_sidebar( $column );

					// Wrapper close.
					$output .= '</div>';
				}
			}

			// Start the object collection.
			ob_start();

			// Output the html.
			echo esc_html( $output );

			// Return the clean object.
			return ob_get_clean();

		}
	}
}

new Starter_Footer_Columns();

/**
 * Function for footer columns
 *
 * @return  void
 */
function _starter_footer_columns() {
	$function = new Starter_Footer_Columns;
	$function->footer_columns();
}
