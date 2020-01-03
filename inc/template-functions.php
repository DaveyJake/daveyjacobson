<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
 * @return array
 */
function daveyjacobson_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

/**
 * No more modifying the `WPINC . theme.php` file.
 *
 * @return mixed
 */
function disable_customizr() {
    // No more customizr!
    remove_action( 'wp_before_admin_bar_render', 'wp_customize_support_script' );
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @return mixed
 */
function daveyjacobson_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}


/** Content-specific filter functions *****************************************/

/**
 * No inline styles.
 *
 * @see {@link 'the_content'}
 */
function no_inline_styles( $content ) {
    $search = array(
        '/(\s)(style="text-align\:)(left|center|right)(")/'
    );

    $replacements = array(
        '$1class="text-$3"'
    );

    return preg_replace( $search, $replacements, $content );
}

/**
 * Convert menu links to menu tabs. Parameters are documented in
 * wp-includes/nav-menu-template.php.
 *
 * @see {@link 'wp_nav_menu_objects'}
 */
function daveyjacobson_prepare_menu_links( array $items, $args ) {
    $menus = array();

    foreach ( $items as $k => $item ) {
        $tab_id = sanitize_title_with_dashes( $item->title );

        $whitelist = array();

        foreach ( $item->classes as $class ) {
            if ( preg_match( '/^fa/', $class ) ) {
                $whitelist[] = $class;
            }
        }

        $item->data      = array( 'menuanchor' => $tab_id );
        $item->classes   = $whitelist;
        //$item->classes[] = $tab_id;
        //$item->classes[] = $item->object;

        $parse_url = wp_parse_url( $item->url );

        if ( ! empty( $parse_url['host'] ) ) {
            if ( ! preg_match( '/(localhost|davey|javascript)/', $parse_url['host'] ) ) {
                $item->classes[] = 'external';
                $item->xfn       = 'nofollow';
            } else {
                $item->url = "#{$tab_id}";
                $item->xfn = $item->object_id;
            }
        }

        $menus[] = $item;
    }

    return $menus;
}


/** Content-specific retrieval functions **************************************/

/**
 * Short-hand function to generate file version timestamp.
 *
 * @param  string $file File path with no leading slash.
 * @return int         Version timestamp.
 */
function get_file_version( $file ) {
    $path = get_template_directory() . "/{$file}";

    if ( ! file_exists( $path ) )
    {
        return time();
    }
    else
    {
        return filemtime( $path );
    }
}

/**
 * Short-hand function for to get directly from `template-parts` directory.
 *
 * @return mixed
 */
function get_template_parts( $slug, $name = null ) {
    if ( ! is_null( $name ) )
    {
        get_template_part( "template-parts/{$slug}", $name );
    }
    else
    {
        get_template_part( "template-parts/{$slug}" );
    }
}

/**
 * Get the pages which are the sections of the site.
 *
 * @return WP_Query
 */
function get_the_sections() {
    $final = array();

    $args = array(
        'post_type'   => 'page',
        'post_status' => 'publish',
    );

    $pages = new WP_Query( $args );

    if ( $pages->have_posts() ) {
        while( $pages->have_posts() ) {
            $pages->the_post();

            global $post;
            $final[] = $post;
        }
    }

    wp_reset_postdata();

    return $final;
}

/**
 * Generate sections for `fullpage.js` compatibility.
 *
 * @param array $sections Website sections.
 * @return array          HTML sections.
 */
function generate_the_sections( array $sections ) {
    $final = array();

    foreach ( $sections as $section ) {
        $image = get_template_directory_uri() . '/dist/assets/images/' . $section->post_name . '@2x.jpg';

        if ( $section instanceof WP_Post ) {
            setup_postdata( $section );

            //$html = "<div id='{$section->post_name}-page' class='section {$about}{$section->post_name}' data-parallax='scroll' data-image-src='" . esc_url( $image ) . "' data-post_ID='{$section->ID}'>";
            $html = "<div id='{$section->post_name}-page' class='section {$section->post_name}' data-post_ID='{$section->ID}'>";
                $html .= "<div class='fp-bg'><div class='mask'></div></div>";
                $html .= "<div class='column'>";
                    $html .= apply_filters( 'the_content', $section->post_content );
                $html .= "</div>";
            $html .= "</div>";

            switch ( $section->post_name ) {
                case 'home':
                    $final[0] = $html;
                    break;
                case 'portfolio':
                    $final[1] = $html;
                    break;
                case 'blog':
                    $final[2] = $html;
                    break;
                case 'about':
                    $final[3] = $html;
                    break;
                case 'contact':
                    $final[4] = $html;
                    break;
            }
        }
    }

    return $final;
}