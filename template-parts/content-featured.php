<?php
/**
 * The template part for displaying content
 *
 * @package Conary
 * @since Conary 1.0
 */
?>
		<article <?php post_class(); ?>>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( $image_size ); ?>
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

