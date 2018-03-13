<?php
/**
 * The template for displaying featured content
 *
 * @since Conary 1.0
 */
?>

<?php
$layout = get_theme_mod( 'featured_content_layout', 'grid' );
$slider_class = '';
if ( 'grid' != $layout ) {
	$slider_opt = json_encode ( array (
		'prevText'			=> '<span class="screen-reader-text">'. esc_html__('Previous', 'conary') .'</span>' . conary_svg_icon('arrow-prev') ,
		'nextText'			=> '<span class="screen-reader-text">'. esc_html__('Next', 'conary') .'</span>' . conary_svg_icon('arrow-next'),
		'maxItems'			=> $layout == 'carousel' ? 3 : 1,
		'itemMargin'		=> 0,
		'itemWidth'			=> $layout == 'carousel' ? 335 : 0,
		'animation'			=> 'slide',
	) );
	$presented = 'image-overlay-view posts-slider slider-' . $layout;
	$img_size = $layout == 'full' ? 'full' : 'medium';
} else {
	$presented = 'thumbnail-view';
	$img_size = 'medium';
	$slider_opt = '';
}
?>
<div id="featured-content" class="featured-content">
	<div class="<?php echo esc_attr( $presented); ?> clear" data-slider-options="<?php echo esc_attr($slider_opt); ?>" >
		<?php if ( 'grid' !== $layout ) : ?>
			<div class="slides">
		<?php endif; ?>
		<?php

			$featured_posts = conary_get_featured_posts();
			foreach ( (array) $featured_posts as $order => $post ) :
				setup_postdata( $post );

				// Include the featured content template.
				//get_template_part( 'template-parts/content', 'featured' );
				?>
					<article <?php post_class(); ?>>

						<a class="post-thumbnail" href="<?php the_permalink(); ?>" >
							<?php the_post_thumbnail( $img_size ); ?>
						</a>

						<header class="entry-header">
							<div class="entry-categories">
								<?php conary_entry_taxonomies(); ?>
							</div>

							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<div class="entry-meta">
								<?php conary_entry_meta(); ?>
							</div><!-- .entry-meta -->

						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-## -->

				<?php
			endforeach;

			wp_reset_postdata();
		?>
		<?php if ( 'grid' !== $layout ) : ?>
			</div>
		<?php endif; ?>
	</div>
</div>
