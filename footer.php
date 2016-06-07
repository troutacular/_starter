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
		<footer id="colophon" class="site-footer<?php footer_column_class(); ?>" role="contentinfo">
			
			<?php if ( is_active_sidebar( 'footer-column' ) ) { ?>
				<div class="footer-column footer-column-1"><?php dynamic_sidebar( 'footer-column' );?></div>
			<?php } ?>
			<?php if ( is_active_sidebar( 'footer-column-2' ) ) { ?>
				<div class="footer-column footer-column-2"><?php dynamic_sidebar( 'footer-column-2' );?></div>
			<?php } ?>
			<?php if ( is_active_sidebar( 'footer-column-3' ) ) { ?>
				<div class="footer-column footer-column-3"><?php dynamic_sidebar( 'footer-column-3' );?></div>
			<?php } ?>
			<?php if ( is_active_sidebar( 'footer-column-4' ) ) { ?>
				<div class="footer-column footer-columm-4"><?php dynamic_sidebar( 'footer-column-4' );?></div>
			<?php } ?>
			
			<?php if ( function_exists('site_credit') ) { site_credit(); } ?>
			
		</footer><!-- .site-footer -->
	</div><!-- .site-footer-wrapper -->
	
</div><!-- .site-wrapper --><?php /* opens in header.php */ ?>

<?php wp_footer(); ?>

</body>
</html>
