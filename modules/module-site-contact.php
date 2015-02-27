<?php
	
	// set a class array for the footer wrapper
	$footer_class = array();
	
	// get the option to show the footer graphic
	$graphic_option = get_option('_starter_theme_options');
	$graphic_option = $graphic_option['checkbox_bottom_graphic'];
	
	// check if the graphic option is selected
	if ( $graphic_option ) {
		$footer_class[] = 'site-footer-graphic';
	}
?>

<div class="site-contact-wrapper<?php if ($footer_class!='') { echo ' '.implode($footer_class,' '); } ?>">
	<section class="site-contact">
		<h1 class="section-title"><?php _e('Feedback',''); ?></h1>
		<?php
			
			$text_options = get_option('_starter_theme_options');
			
			// Feedback
			if ( $text_options['text_feedback']!='' || $text_options['text_feedback_link']!='' || $text_options['text_feedback_link_text']!='' ) {
				?>
				<span class="feedback">
					<?php
						if ( $text_options['text_feedback']!='' ) { echo $text_options['text_feedback']; }
						if ( $text_options['text_feedback_link']!='' ) {
							echo ' <a href="'.$text_options['text_feedback_link'].'">';
							if ( $text_options['text_feedback_link_text']!='' ) {
								echo $text_options['text_feedback_link_text'];
							} else {
								echo $text_options['text_feedback_link'];
							}
							echo '</a>';
						}
					?>
				</span>
				<?php
			}
			
			// Website by
			if ( $text_options['text_website_by']!='' || $text_options['text_website_by_link']!='' || $text_options['text_website_by_link_text']!='' ) {
				?>
				<span class="website-by">
					<?php
						if ( $text_options['text_website_by']!='' ) { echo $text_options['text_website_by']; }
						if ( $text_options['text_website_by_link']!='' ) {
							echo ' <a href="'.$text_options['text_website_by_link'].'">';
							if ( $text_options['text_website_by_link_text']!='' ) {
								echo $text_options['text_website_by_link_text'];
							} else {
								echo $text_options['text_website_by_link'];
							}
							echo '</a>';
						}
					?>
				</span>
				<?php
			}
		?>
	</section>
</div>