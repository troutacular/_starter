<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _starter
 */

?>

	</div><!-- .site-content --><?php /* opens in header.php */ ?>

	<div class="site-footer-wrapper">
		<footer id="colophon" class="site-footer<?php _starter_get_footer_column_class(); ?>" role="contentinfo">

			<?php
			for ( $i = 0; $i <= 4; $i++ ) {

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
					echo '<div class="footer ' . esc_html( $class ) . '">';

					// Get the sidebar.
					dynamic_sidebar( $column );

					// Wrapper close.
					echo '</div>';
				}
			}
			?>

			<?php get_template_part( 'modules/module', 'site-contact' ); ?>

		</footer><!-- .site-footer -->
	</div><!-- .site-footer-wrapper -->

</div><!-- .site --><?php /* opens in header.php */ ?>

<?php wp_footer(); ?>

</body>
</html>
