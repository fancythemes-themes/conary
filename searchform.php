<?php
/**
 * Template for displaying search forms in Conary
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'conary' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here', 'placeholder', 'conary' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'conary' ); ?></span><?php echo conary_svg_icon('search'); ?></button>
</form>
