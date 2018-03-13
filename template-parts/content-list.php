<?php
/**
 * The template part for displaying content
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('view-list'); ?>>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'square-300' ); ?>
	</a>

	<header class="entry-header">
		<div class="entry-categories">
			<?php conary_entry_taxonomies(); ?>
		</div>

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php esc_html_e( 'Featured', 'conary' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta">
			<?php conary_entry_meta(); ?>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						wp_kses(
							__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'conary' ),
							array( 'span' => array( 'class' => array() ) )
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
