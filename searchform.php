<?php
/**
 * Template for displaying search form
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="form-content">
		<input type="text" placeholder="<?php esc_attr_e( 'Search..', 'bevro' ); ?>" name="s" id="s" value="<?php echo get_search_query(); ?>"/>
		<input type="submit" value="<?php echo _x('Search', 'submit button', 'bevro' ); ?>" />
	</div>
</form>