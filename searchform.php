<?php
/**

	The Search Form
	
	@package usc-starter

**/
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="text" class="search-field" name="s" placeholder="search" title="search" />
	<button type="submit" class="search-submit"><?php _e('Search',''); ?></button>
</form>