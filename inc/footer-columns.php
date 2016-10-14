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
		 * Parameters for columns, wrapper and css style.
		 *
		 * @var array
		 */
		public $params;

		/**
		 * Constructor to run when class is initiated.
		 *
		 * @param  array $params  Parameters for [columns], [wrapper], [class].
		 */
		public function __construct( $params ) {
			$this->params['columns'] = isset( $params['columns'] ) ? $params['columns'] : 4;
			$this->params['wrapper'] = isset( $params['wrapper'] ) ? $params['wrapper'] : 'div';
			$this->params['class'] = isset( $params['class'] ) ? $params['class'] : false;
		}

		/**
		 * Register footer columns.
		 *
		 * @return  void
		 */
		public function register() {
			/**
			 * Register the sidebars
			 */
			register_sidebars( $this->params['columns'], array(
				'name' => esc_html__( 'Site Footer Column %d', '_starter' ),
				'id' => 'site-footer-column',
				'description' => esc_html__( 'Drag widgets here to show in the corresponding column of the footer. The columns are dynamic and they will split their width\'s evenly between Footer Column areas that have active widgets.', '_starter' ),
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
		public function footer_columns_class() {

			// Set the default to 0.
			$count = $counter = 0;

			if ( is_active_sidebar( 'site-footer-column' ) ) {
				$count++;
			}

			if ( is_active_sidebar( 'site-footer-column-2' ) ) {
				$count++;
			}

			if ( is_active_sidebar( 'site-footer-column-3' ) ) {
				$count++;
			}
			if ( is_active_sidebar( 'site-footer-column-4' ) ) {
				$count++;
			}

			$columns = $this->params['columns'];

			for ( $i = 1; $i <= $columns; $i++ ) {

				$sidebar = 'site-footer-column';

				if ( $i > 1 ) {
					$sidebar .= '-' . $i;
				}

				if ( is_active_sidebar( $sidebar ) ) {
					$counter++;
				}
			}

			return 'site-footer-columns-' . esc_attr( $count );
		}

		/**
		 * Footer Column Output
		 *
		 * @return  void
		 */
		public function footer_columns() {

			$params = $this->params;

			// Defaults.
			$columns = $params['columns'];
			$element = $params['wrapper'];
			$base_class = $this->footer_columns_class() . ' site-info';
			$element_class = ! empty( $params['class'] ) ? $base_class . ' ' . $params['class'] : '';

			// Begin element wrapper.
			echo '<' . esc_html( $element ) . ' class="' . esc_html( $element_class ) . '">';

			for ( $i = 1; $i <= $columns; $i++ ) {

				// Set default variables.
				$sidebar = 'site-footer-column';
				$class = 'footer-column footer-column-' . $i;

				// Add the column number past first instance for sidebar reference.
				if ( $i > 1 ) {
					$sidebar .= '-' . $i;
				}

				// Check for the sidebar having widgets.
				if ( is_active_sidebar( $sidebar ) ) {

					// Wrapper open.
					echo '<div class="' . esc_html( $class ) . '">';

					// Get the sidebar.
					dynamic_sidebar( $sidebar );
					// Wrapper close.
					echo '</div>';
				}
			}

			// End element wrapper.
			echo '</' . esc_html( $element ) . '>';

		}
	}
}

if ( ! function_exists( '_starter_footer_arguments' ) ) {
	/**
	 * Footer Column Arguments
	 *
	 * Sets the default values for the:
	 *  - number of [columns]
	 *  - HTML5 element [wrapper]
	 *  - CSS [class] for the wrapper
	 *
	 * Set a local function of _starter_footer_arguments in the functions.php
	 * file to override these default settings.
	 *
	 * @return  array  Values for [columns], [wrapper], [class]
	 */
	function _starter_footer_arguments() {
		$args = array(
			'columns' => 4,
			'wrapper' => 'div',
			'class' => 'site-test',
		);
		return $args;
	}
}

if ( ! function_exists( '_starter_footer_register' ) ) {

	/**
	 * Register the amount of footer columns.
	 *
	 * @param   array $params Settings for registering columns.
	 * @return  void
	 */
	function _starter_footer_register( $params ) {
		$footer_columns = new Starter_Footer_Columns( $params );
		$footer_columns->register();
	}
}

if ( ! function_exists( '_starter_footer_columns' ) ) {
	/**
	 * Register the amount of footer columns.
	 *
	 * @return  void
	 */
	function _starter_footer_columns() {
		$footer = new Starter_Footer_Columns( _starter_footer_arguments() );
		$footer->footer_columns();
	}
}

/**
 * Register the Footer Columns
 */
_starter_footer_register( _starter_footer_arguments() );
