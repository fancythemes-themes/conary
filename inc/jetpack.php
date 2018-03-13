<?php
/**
 * All functions that hooked to the Jetpack's filters and actions
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

/**
 * Registers support for various Jetpack features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 *
 * @since Conary 1.0
 */
function conary_jetpack_setup() {
	/* 
	 * Enable support for Jetpack social menu
	 */
	add_theme_support( 'jetpack-social-menu');

	/* 
	 * Enable support for Jetpack featured content
	 */
	add_theme_support( 'featured-content', array(
		'filter'     => 'conary_get_featured_posts',
		'max_posts'  => 20,
		'post_types' => array( 'post' ),
	) );

	add_theme_support( 'jetpack-content-options', array(
		'blog-display'       => 'content', // the default setting of the theme: 'content', 'excerpt' or array( 'content', 'excerpt' ) for themes mixing both display.
		'author-bio'         => true, // display or not the author bio: true or false.
		'author-bio-default' => false, // the default setting of the author bio, if it's being displayed or not: true or false (only required if false).
		'post-details'       => array(
			'stylesheet'      => 'conary-style', // name of the theme's stylesheet.
			'date'            => '.posted-on', // a CSS selector matching the elements that display the post date.
			'categories'      => '.cat-links', // a CSS selector matching the elements that display the post categories.
			'tags'            => '.tags-links', // a CSS selector matching the elements that display the post tags.
			'author'          => '.byline', // a CSS selector matching the elements that display the post author.
			'comment'         => '.comments-link', // a CSS selector matching the elements that display the comment link.
		),
		'featured-images'    => array(
			'archive'         => true, // enable or not the featured image check for archive pages: true or false.
			'archive-default' => true, // the default setting of the featured image on archive pages, if it's being displayed or not: true or false (only required if false).
			'post'            => true, // enable or not the featured image check for single posts: true or false.
			'post-default'    => true, // the default setting of the featured image on single posts, if it's being displayed or not: true or false (only required if false).
			'page'            => true, // enable or not the featured image check for single pages: true or false.
			'page-default'    => true, // the default setting of the featured image on single pages, if it's being displayed or not: true or false (only required if false).
		),
	) );

	add_theme_support( 'infinite-scroll', array(
		'type'           => 'scroll',
		'footer_widgets' => array('sidebar-3', 'sidebar-4', 'sidebar-5', 'sidebar-6', ),
		'container'      => 'main',
		'wrapper'        => true,
		'render'         => false,
		'posts_per_page' => false,
	) );
}
add_action( 'after_setup_theme', 'conary_jetpack_setup' );

/**
 * Checker if the featured posts is activated.
 */
function conary_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;
 
	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'conary_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;
 
	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
}

function conary_get_featured_posts() {
    return apply_filters( 'conary_get_featured_posts', array() );
}

/**
 * Remove the jetpack's share module from the_content() filter
 * It will called in the content's template tags, see template-parts/content.php, template-parts/content-single.php etc.
 *
 * @since Conary 1.0
 */
function conary_remove_jp_share( $domain ) {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
	/*if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}*/
}
add_action( 'loop_start', 'conary_remove_jp_share' );

/**
 * Remove the jetpack's Related Posts module from the_content() filter
 * It will called in the content's template tags, see template-parts/content.php, template-parts/content-single.php etc.
 *
 * @since Conary 1.0
 */
function conary_remove_jp_related( $domain ) {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_action( 'loop_start', 'conary_remove_jp_related' );


/**
 * Change Author Bio avatar size.
 *
 * @since Conary 1.0
 *
 */
function conary_author_bio_avatar_size() {
	return 80;
}
add_filter( 'jetpack_author_bio_avatar_size', 'conary_author_bio_avatar_size' );

/**
 * CSS tweak for social menu.
 *
 * @since Conary 1.0
 *
 */
function conary_jetpack_social_menu_inline_css() {
	$css = '
	.jetpack-social-navigation ul {
		margin-bottom: 0;
	}
	.jetpack-social-navigation a {
		color: inherit;
	}
	.jetpack-social-navigation li {
		margin-left: 20px;
	}
	.jetpack-social-navigation a:hover,
	.jetpack-social-navigation a:focus {
		color: #ff0036;
	}
	';
	wp_add_inline_style( 'jetpack-social-menu', wp_kses( $css, array( "\'", '\"' ) ) );
}
add_action( 'wp_enqueue_scripts', 'conary_jetpack_social_menu_inline_css', 1000 );