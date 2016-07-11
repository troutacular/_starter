<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @todo add for loop to /inc/footer-columns.php as function
 * @package _starter
 */

?>

	</div><!-- .site-content --><?php /* opens in header.php */ ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<?php _starter_footer_columns(); echo 'hi';?>

		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site --><?php /* opens in header.php */ ?>

<?php wp_footer(); ?>

</body>
</html>
