<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar('footer'); ?>

			<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
				<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'conary' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'footer-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the conary footer text for footer customization.
					 *
					 * @since Conary 1.0
					 */
					do_action( 'conary_credits' );

				?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'conary' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'conary' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'conary' ), 'Conary', '<a href="https://fortypixels.com/" rel="designer">FortyPixels</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
