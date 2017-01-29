<?php
/**
 * Theme Instructions: Icons
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

/**
 * Theme sprites.
 */
require_once get_template_directory() . '/inc/sprite-classes.php';

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

<h2 id="theme-instructions-theme-icons">Icons</h2>

<p>Included with this theme are the following icons and their associative classes.</p>

<div class="sprite-icon-samples">
<h3 id="title-icon">Icon</h3>
<?php _starter_sprite_classes_list( 'icon' ); ?>
<h3 id="title-icon-only">Icon Only</h3>
<?php _starter_sprite_classes_list( 'icon-only' ); ?>
</div>
