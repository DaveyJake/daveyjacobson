<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Davey_Jacobson_Portfolio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dj_portfolio_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {

		$classes[] = 'hfeed';

	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {

		$classes[] = 'no-sidebar';

	}

	return $classes;
}


/**
 * No more modifying the `WPINC . theme.php` file.
 *
 * @returns void
 */
function disable_customizr() {
    // No more customizr!
    remove_action( 'wp_before_admin_bar_render', 'wp_customize_support_script' ); ?>
    <script type="text/javascript">
        (function() {
            var b   = document.body,
                c   = 'className',
                cs  = 'customize-support',
                rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');
            b[c] = b[c].replace( rcs, ' ' );
            b[c] += ' no-customize-support';
        }());
    </script>
    <?php
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dj_portfolio_pingback_header() {

	if ( is_singular() && pings_open() ) {

		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';

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
        return get_template_part( "template-parts/{$slug}-{$name}.php" );
    }
    else
    {
        return get_template_part( "template-parts/{$slug}.php" );
    }
}
