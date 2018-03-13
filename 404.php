<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'conary' ); ?></h1>
			</header><!-- .page-header -->
			<article class="error-404 not-found">

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'conary' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</article><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
