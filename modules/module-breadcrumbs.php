<?php
	/**
		
		Requires the following to be included in functions.php:
		require get_template_directory() . '/functions/module-breadcrumbs.php';
		
	**/
?>

<?php if ( function_exists('bread_crumbs') ) { ?>
	<nav class="nav-breadcrumbs">
		<h1 class="breadcrumbs-title"><?php _e('Breadcrumb Navigation',''); ?></h1>
		<?php bread_crumbs(); ?>
	</nav>
<?php } ?>