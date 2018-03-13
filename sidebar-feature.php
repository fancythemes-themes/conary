<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

if ( ! is_active_sidebar( 'feature-widget-full-width' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<div id="feature-widgets-container" class="feature-widgets-container" role="complementary">
	<?php if ( is_active_sidebar( 'feature-widget-full-width' ) ) : ?>
		<div class="widget-area-full">
			<?php dynamic_sidebar( 'feature-widget-full-width' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</div><!-- .content-bottom-widgets -->
