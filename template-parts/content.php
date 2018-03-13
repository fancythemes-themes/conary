<?php
/**
 * The template part for displaying content
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

<?php 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('view-classic'); ?>>

	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php esc_html_e( 'Featured', 'conary' ); ?></span>
		<?php endif; ?>

		<div class="entry-categories">
			<?php conary_entry_taxonomies(); ?>
		</div>


		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta clear">
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

	<?php //conary_excerpt(); ?>

	<?php conary_post_thumbnail(); ?>

	<div class="entry-content">
		<?php 
			the_content( esc_html__('Read More', 'conary') );
	
			echo '<p>';
			conary_entry_tags();
			echo '</p>';

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'conary' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'conary' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
