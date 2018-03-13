<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

if ( ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) && ! is_active_sidebar( 'sidebar-4' ) && ! is_active_sidebar( 'sidebar-5' )  ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<div id="footer-widgets-container" class="footer-widgets-container" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>	
</div><!-- .content-bottom-widgets -->
