<?php
/**
 * The Search Form
 *
 * @package _starter
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search-field" name="s" placeholder="<?php esc_html_e( 'Search', '_starter' ); ?>" title="search" />
	<button type="submit" class="search-submit"><?php esc_html_e( 'Search', '_starter' ); ?></button>
</form>
