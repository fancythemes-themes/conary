<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'conary' ); ?></h1>
</header><!-- .page-header -->
<article class="no-results not-found">

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( 
						wp_kses( 
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'conary' ),
							array( 'a' => array( 'href' => array() ) )
						),
						esc_url( admin_url( 'post-new.php' ) ) 
					); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'conary' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'conary' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</article><!-- .no-results -->
