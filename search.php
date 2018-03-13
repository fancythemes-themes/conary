<?php
/**
 * The template for displaying search results pages
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'conary' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				if ( get_theme_mod('search_result_list_view', 'list') == 'classic' ) {
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
				'prev_text'          => esc_html__( 'Previous page', 'conary' ),
				'next_text'          => esc_html__( 'Next page', 'conary' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'conary' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>