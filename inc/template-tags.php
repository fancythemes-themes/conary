<?php
/**
 * Custom Conary template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * 
 * @package Conary
 * @since Conary 1.0
 */

if ( ! function_exists( 'conary_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own conary_entry_meta() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_entry_meta() {

	/*$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'conary' ) );
	if ( $categories_list && conary_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories', 'Used before category names.', 'conary' ),
			$categories_list
		);
	}*/

	if ( 'post' === get_post_type() ) {
		$author_avatar_size = apply_filters( 'conary_author_avatar_size', 49 );
		printf( '<span class="byline"><span class="author vcard">%1$s<span>%2$s </span><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			esc_html_x( 'By', 'Used before post author name.', 'conary' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		conary_entry_date();
	}

	/*$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'conary' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}*/

	/*if ( 'post' === get_post_type() ) {
		conary_entry_taxonomies();
	}*/

	if ( ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo conary_svg_icon('comment');
		comments_popup_link( 
			sprintf( 
				wp_kses( 
					__( '0 Comment<span class="screen-reader-text"> on %s</span>', 'conary' ),
					array( 'span' => array( 'class' => array() ) )
				),
				get_the_title() 
			) 
		);
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'conary_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own conary_entry_date() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span>%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html_x( 'On', 'Used before publish date.', 'conary' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'conary_entry_taxonomies' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own conary_entry_taxonomies() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_entry_taxonomies() {
	$categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'conary' ) );
	if ( $categories_list && conary_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			esc_html_x( 'Categories', 'Used before category names.', 'conary' ),
			$categories_list
		);
	}
}
endif;

if ( ! function_exists( 'conary_entry_tags' ) ) :
/**
 * Prints HTML with tags for current post.
 *
 * Create your own conary_entry_tags() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_entry_tags() {
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'conary' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span>%1$s </span>%2$s</span>',
			esc_html_x( 'Tags', 'Used before tag names.', 'conary' ),
			$tags_list
		);
	}

}
endif;

if ( ! function_exists( 'conary_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own conary_post_thumbnail() function to override in a child theme.
 *
 * @since Conary 1.0
 */
function conary_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'conary_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own conary_excerpt() function to override in a child theme.
	 *
	 * @since Conary 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function conary_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php the_excerpt(); ?>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'conary_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Read more' link.
 *
 * Create your own conary_excerpt_more() function to override in a child theme.
 *
 * @since Conary 1.0
 *
 * @return string 'Read More' link prepended with an ellipsis.
 */
function conary_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf(
			wp_kses( 
				__( 'Read More<span class="screen-reader-text"> "%s"</span>', 'conary' ),
				array( 'span' => array( 'class' => array() ) )
			), 
			get_the_title( get_the_ID() )
		)
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'conary_excerpt_more' );
endif;

if ( ! function_exists( 'conary_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own conary_categorized_blog() function to override in a child theme.
 *
 * @since Conary 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function conary_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'conary_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'conary_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so conary_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so conary_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in conary_categorized_blog().
 *
 * @since Conary 1.0
 */
function conary_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'conary_categories' );
}
add_action( 'edit_category', 'conary_category_transient_flusher' );
add_action( 'save_post',     'conary_category_transient_flusher' );

if ( ! function_exists( 'conary_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Conary 1.0
 */
function conary_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Print markup for SVG icon.
 *
 * @since Conary 1.0
 * @param string $icon keyword for icon name
 */
function conary_svg_icon ( $icon ) {
	$icon = esc_attr( $icon );
	$symbol = '<svg class="icon icon-' . $icon . '"><use xlink:href="' . get_template_directory_uri() . '/icons/symbol-defs.svg#icon-' . $icon . '"></use></svg>';

	return $symbol;
}