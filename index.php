<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

get_header(); ?>
	<?php //if ( get_theme_mod('featured_posts_on', false ) ) get_template_part('featured-posts'); 
	//get_sidebar('feature');
	if ( conary_has_featured_posts(1) ) {
		get_template_part('featured-posts', '');
	}
	?>

<?php get_sidebar('left'); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				if ( get_theme_mod('blog_list_view', 'classic') == 'classic' ) {
					get_template_part( 'template-parts/content', get_post_format() );
				} else {
					get_template_part( 'template-parts/content-list', get_post_format() );
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
