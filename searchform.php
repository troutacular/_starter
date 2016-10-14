<?php
/**
 * The Search Form
 *
 * @package _starter
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', '_starter' ); ?></span>
		<input type="text" class="search-field" name="s" placeholder="<?php esc_html_e( 'Search', '_starter' ); ?>" title="search" />
	</label>
	<button type="submit" class="search-submit"><?php esc_html_e( 'Search', '_starter' ); ?></button>
</form>
