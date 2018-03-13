<?php
/**
 * The template part for displaying single posts
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-categories">
			<?php conary_entry_taxonomies(); ?>
		</div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php //conary_excerpt(); ?>

		<div class="entry-meta clear">
			<?php conary_entry_meta(); ?>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						wp_kses(
							__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'conary' ),
							array( 'span' => array('class' => array() ) )
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div><!-- .entry-footer -->
	</header><!-- .entry-header -->


	<?php conary_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

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

			if ( function_exists( 'jetpack_author_bio' ) ) {
				jetpack_author_bio();
			}
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<?php
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
		?>
	</div>

</article><!-- #post-## -->
