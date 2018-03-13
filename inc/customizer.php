<?php
/**
 * Conary Customizer functionality
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */


function conary_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'				=> '.site-title a',
			'container_inclusive'	=> false,
			'render_callback'     	=> 'conary_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' 				=> '.site-description',
			'container_inclusive' 	=> false,
			'render_callback'     	=> 'conary_customize_partial_blogdescription',
		) );
	}

	// Section : Posts Options
	$wp_customize->add_section('theme_options', array (
		'title'		 => esc_html__('Theme Options', 'conary'),
	) );

	$wp_customize->add_setting( 'blog_list_view', array (		
		'default'			=> 'classic',
		'sanitize_callback' => 'conary_sanitize_blog_list_view',
	) );

	$wp_customize->add_control( 'blog_list_view', array(
		'settings'				=> 'blog_list_view',
		'label'				=> esc_html__('Homepage/Blog posts shown as', 'conary'),
		'type'				=> 'radio',
		'choices'			=> array ( 
			'classic'	=> esc_html__( 'Classic View (Full Posts)', 'conary' ),
			'list'		=> esc_html__( 'List View (Small Thumbnail & excerpt)', 'conary' )
		 ),
		'section'			=> 'theme_options'
	) );

	$wp_customize->add_setting( 'archive_list_view', array (		
		'default'			=> 'classic',
		'sanitize_callback' => 'conary_sanitize_blog_list_view',
	) );

	$wp_customize->add_control( 'archive_list_view', array(
		'settings'				=> 'archive_list_view',
		'label'				=> esc_html__('Homepage/Blog posts shown as', 'conary'),
		'type'				=> 'radio',
		'choices'			=> array ( 
			'classic'	=> esc_html__( 'Classic View (Full Posts)', 'conary' ),
			'list'		=> esc_html__( 'List View (Small Thumbnail & excerpt)', 'conary' )
		 ),
		'section'			=> 'theme_options'
	) );

	$wp_customize->add_setting( 'search_list_view', array (		
		'default'			=> 'classic',
		'sanitize_callback' => 'conary_sanitize_blog_list_view',
	) );

	$wp_customize->add_control( 'search_list_view', array(
		'settings'				=> 'search_list_view',
		'label'				=> esc_html__('Homepage/Blog posts shown as', 'conary'),
		'type'				=> 'radio',
		'choices'			=> array ( 
			'classic'	=> esc_html__( 'Classic View (Full Posts)', 'conary' ),
			'list'		=> esc_html__( 'List View (Small Thumbnail & excerpt)', 'conary' )
		 ),
		'section'			=> 'theme_options'
	) );

	// Add the featured content layout setting and control.

	$wp_customize->add_setting( 'featured_content_layout', array (		
		'default'           => 'grid',
		'sanitize_callback' => 'conary_sanitize_featured_layout',
	) );

	$wp_customize->add_control( 'featured_content_layout', array(
		'settings' 				=> 'featured_content_layout',
		'label'				=> esc_html__( 'Layout', 'conary' ),
		'section'			=> 'featured_content',
		'type'				=> 'select',
		'choices'			=> array(
			'grid'		=> esc_html__( 'Grid',   'conary' ),
			'carousel'	=> esc_html__( 'Carousel Slider', 'conary' ),
			'full'	=> esc_html__( 'Wide Slider', 'conary' ),
		)
	) );

	if ( ! isset( $wp_customize->selective_refresh ) ) return;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'container_inclusive' => false,
		'render_callback' => 'conary_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'container_inclusive' => false,
		'render_callback' => 'conary_customize_partial_blogdescription',
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_credit', array(
		'selector' => '.site-info',
		'container_inclusive' => false,
		'render_callback' => 'conary_customize_partial_footer_credit',
	) );


}
add_action( 'customize_register', 'conary_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Conary 1.0
 * @see conary_customize_register()
 *
 * @return void
 */
function conary_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Conary 1.0
 * @see conary_customize_register()
 *
 * @return void
 */
function conary_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Conary 1.0
 *
 * @see conary_header_style()
 */
function conary_custom_header_and_background() {
	/**
	 * Filter the arguments used when adding 'custom-background' support in Conary.
	 *
	 * @since Conary 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'conary_custom_background_args', array(
		'default-color' => '#f7f7fa',
	) ) );

}
add_action( 'after_setup_theme', 'conary_custom_header_and_background' );