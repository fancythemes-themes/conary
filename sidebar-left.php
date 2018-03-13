<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * 
 * @package Rote
 * @since Rote 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' )  ) : ?>
	<aside id="secondary" class="sidebar-left widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
