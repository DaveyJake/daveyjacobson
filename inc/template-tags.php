<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

if ( ! function_exists( 'daveyjacobson_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function daveyjacobson_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'daveyjacobson' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
}

if ( ! function_exists( 'daveyjacobson_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function daveyjacobson_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'daveyjacobson' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
}

if ( ! function_exists( 'daveyjacobson_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function daveyjacobson_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'daveyjacobson' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'daveyjacobson' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'daveyjacobson' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'daveyjacobson' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'daveyjacobson' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'daveyjacobson' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'daveyjacobson_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function daveyjacobson_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() )
        {
			echo '<div class="post-thumbnail">'; the_post_thumbnail(); echo '</div><!-- .post-thumbnail -->';
        }
        else
        {
            echo '<a class="post-thumbnail" href="'; the_permalink(); echo '" aria-hidden="true">';
                the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) );
            echo '</a>';
        } // End is_singular().
    }
}

if ( ! function_exists( 'the_sections' ) ) {
    /**
     * Display the site sections.
     *
     * @uses {@link 'get_the_sections'}
     * @uses {@link 'generate_the_sections'}
     */
    function the_sections() {
        $sections = get_the_sections();

        $html_array = generate_the_sections( $sections );

        ksort( $html_array );

        echo implode( '', $html_array );
    }
}

if ( ! function_exists( 'the_nav_menu' ) ) {
    /**
     * Display the main navigation menu.
     *
     * @link {@see 'DJ_Theme_Setup'}
     */
    function the_nav_menu() {
        global $theme_setup;
        echo $theme_setup::daveyjacobson_main_menu();
    }
}

if ( ! function_exists( 'the_mobile_nav_menu' ) ) {
    /**
     * Display the main mobile navigation menu.
     */
    function the_mobile_nav_menu() {

    }
}