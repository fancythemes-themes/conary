<?php
/**
 * Conary functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

if ( ! function_exists( 'conary_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own conary_setup() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/conary
	 * If you're building a theme based on Conary, use a find and replace
	 * to change 'conary' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'conary' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Conary 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	/* 
	 * Add a new image size, square 300px 
	 */
	add_image_size( 'square-300', 300, 300, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'conary' ),
		'menu-2'  => esc_html__( 'Footer Menu', 'conary' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		//'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'audio',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', conary_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // conary_setup
add_action( 'after_setup_theme', 'conary_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Conary 1.0
 */
function conary_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'conary_content_width', 840 );
}
add_action( 'after_setup_theme', 'conary_content_width', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function conary_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'conary_pingback_header' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Conary 1.0
 */
function conary_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'conary' ),
		'id'            => 'sidebar-1', 
		'description'   => conary_common_kses( __( 'Add widgets here to appear in your sidebar.', 'conary' )),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 2 (Left Sidebar)', 'conary' ),
		'id'            => 'sidebar-2',
		'description'   => conary_common_kses( __( 'Add widgets here to appear in your left sidebar.', 'conary' ) ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 1', 'conary' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 2', 'conary' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 3', 'conary' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 4', 'conary' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'conary_widgets_init' );

if ( ! function_exists( 'conary_fonts_url' ) ) :
/**
 * Register Google fonts for Conary.
 *
 * Create your own conary_fonts_url() function to override in a child theme.
 *
 * @since Conary 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function conary_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Source Sans Pro font: on or off', 'conary' ) ) {
		$fonts[] = 'Source Sans Pro:400,400i,600,600i';
	}

	/* translators: If there are characters in your language that are not supported by Source Serif Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Source Serif Serif font: on or off', 'conary' ) ) {
		$fonts[] = 'Source Serif Pro:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueues scripts and styles.
 *
 * @since Conary 1.0
 */
function conary_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'conary-fonts', conary_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'conary-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'conary-ie', get_template_directory_uri() . '/css/ie.css', array( 'conary-style' ), '20160816' );
	wp_style_add_data( 'conary-ie', 'conditional', 'lt IE 10' );

	wp_enqueue_script( 'conary-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	wp_enqueue_script( 'svgxuse', get_template_directory_uri() . '/js/svgxuse.js', array(), '1.2.4' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'conary-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'conary-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'conary-script', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'conary' ),
		'collapse' => esc_html__( 'collapse child menu', 'conary' ),	
	) );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20160816', true );

	wp_enqueue_script( 'conary-fitvids-script', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20160816', true );
}
add_action( 'wp_enqueue_scripts', 'conary_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Conary 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function conary_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	$layout_class = '';
	if ( is_active_sidebar( 'sidebar-2' ) && ( is_home() || is_page_template('blog3-page.php' ) ) ) {
		$layout_class .= 'right-';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$layout_class .= 'left-';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
		$layout_class .= 'no-';
	}

	$layout_class .= 'sidebar';

	$classes[] = $layout_class;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'conary_body_classes' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/sanitize-callbacks.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Jetpack.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Conary 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function conary_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'conary_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Conary 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function conary_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'conary_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Conary 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function conary_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'conary_widget_tag_cloud_args' );

/**
 * Setting a new excerpt length
 *
 * @since Conary 1.0
 *
 */
function conary_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'conary_excerpt_length', 999 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Conary 1.0
 *
 * @see wp_add_inline_style()
 */
function conary_post_nav_image() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); background-size: 50px; background-repeat: no-repeat; background-position: 0 40px; }
			.post-navigation .nav-previous a { padding-left: 90px; }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; background-size: 50px; background-repeat: no-repeat; background-position: 100% 40px; }
			.post-navigation .nav-next a { padding-right: 90px; }
		';
	}

	wp_add_inline_style( 'conary-style', $css );
}
add_action( 'wp_enqueue_scripts', 'conary_post_nav_image' );


/**
 * Function helper for easier common wp_kses.
 *
 * @since Conary 1.0
 *
 */
function conary_common_kses( $string ) {
	return wp_kses( $string, array (
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'span' => array(),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	) );
}