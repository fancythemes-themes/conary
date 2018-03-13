<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title();
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				if ( get_theme_mod('archive_list_view', 'list') == 'classic' ) {
					get_template_part( 'template-parts/content-classic', get_post_format() );
				} else {
					$highlight_tags = explode ( ',', get_theme_mod('highlighted_posts', 'headline') );
					if ( has_tag( $highlight_tags ) ) {
						get_template_part( 'template-parts/content-featured', get_post_format() );
					} else {
						get_template_part( 'template-parts/content-list', get_post_format() );
					}
				}

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => sprintf( '<span class="screen-reader-text">%1$s</span>%2$s',
											esc_html__( 'Previous page', 'conary' ),
											conary_svg_icon('arrow-prev')
										),
				'next_text'          => sprintf( '<span class="screen-reader-text">%1$s</span>%2$s',
											esc_html__( 'Next page', 'conary' ),
											conary_svg_icon('arrow-next')
										),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'conary' ) . ' </span>',
			) );
			
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
