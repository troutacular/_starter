<?php


// get the option to show the footer graphic
$graphic_option = $text_options = get_option( '_starter_options' );
$graphic_option = $graphic_option['checkbox_bottom_graphic'];

// class wrapper
function get_site_contact_footer_class( $classes = array() ) {
	if ( isset( $classes ) ) {
		echo ' ' . esc_attr( implode( $classes, ' ' ) );
	}
	return false;
}

// feedback options
$feedback = $text_options['text_feedback'];
$feedback_link = $text_options['text_feedback_link'];
$feedback_link_text = $text_options['text_feedback_link_text'];

// created by options
$created_by = $text_options['text_created_by'];
$created_by_link = $text_options['text_created_by_link'];
$created_by_link_text = $text_options['text_created_by_link_text'];


echo '<div class="site-contact-wrapper' . esc_attr( get_site_contact_footer_class() ) . '">';
echo '<section class="site-contact">';
echo '<h1 class="section-title">' . esc_html_e( 'Feedback', '_starter' ) . '</h1>';

// Feedback
if ( '' !== $feedback || '' !== $feedback_link || '' !== $feedback_link_text ) {

	echo '<span class="feedback">';

	if ( '' !== $feedback ) {
		printf( esc_html__( '%1$s', '_starter' ), esc_html( $feedback ) );
	}

	if ( '' !== $text_options['text_feedback_link'] ) {

		echo ' <a href="' . esc_url( $feedback_link ) . '">';

		if ( '' !== $feedback_link_text ) {
			printf( esc_html__( '%1$s', '_starter' ), esc_html( $feedback_link_text ) );
		} else {
			printf( esc_html__( '%1$s', '_starter' ), esc_html( $feedback_link ) );
		}

		echo '</a>';
	}

	echo '</span>';
}

// Website by
if ( '' !== $created_by || '' !== $created_by_link || '' !== $created_by_link_text ) {

	echo '<span class="created_by">';

	if ( '' !== $created_by ) {
		printf( esc_html__( '%1$s', '_starter' ), esc_html( $created_by ) );
	}

	if ( '' !== $text_options['text_created_by_link'] ) {

		echo ' <a href="' . esc_url( $created_by_link ) . '">';

		if ( '' !== $created_by_link_text ) {
			printf( esc_html__( '%1$s', '_starter' ), esc_html( $created_by_link_text ) );
		} else {
			printf( esc_html__( '%1$s', '_starter' ), esc_html( $created_by_link ) );
		}

		echo '</a>';
	}

	echo '</span>';
}

echo '</section>';
echo '</div>';
