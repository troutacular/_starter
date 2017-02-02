<?php
/**
 * Theme Instructions: Icons
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

/**
 * Sprite classes as list.
 *
 * @since 3.1.0
 * @param   string $type  Choose [icon] or [icon-only] list to display.
 * @return  void
 */
function _starter_sprite_classes_list( $type = 'icon' ) {

	$icons = _starter_sprite_classes();

	if ( ! empty( $icons[ $type ] ) ) {
		echo '<ul>';
		foreach ( $icons[ $type ] as $icon ) {
			echo '<li><span class="' . esc_attr( $icon ) . '"></span>' . esc_attr( $icon ) . '</li>';
		}
		echo '</ul>';
	}
}
?>

<h2 id="theme-instructions-theme-icons"><?php esc_html_e( 'Icons', '_starter' ); ?></h2>

<p><?php esc_html__( 'Included with this theme are the following icons and their associative classes.', '_starter' ); ?></p>

<div class="sprite-icon-samples">
<h3 id="title-icon"><?php esc_html_e( 'Icons', '_starter' ); ?></h3>
<?php _starter_sprite_classes_list( 'icon' ); ?>
<h3 id="title-icon-only"><?php esc_html_e( 'Icon Only', '_starter' ); ?></h3>
<?php _starter_sprite_classes_list( 'icon-only' ); ?>
</div>
