<?php
/**
 * Hooks and Filters which enhance the theme.
 *
 * @package DaveyJacobson
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** Hookable Functions ********************************************************/
require_once get_template_directory() . '/inc/template-functions.php';


/** Filters & Hooks ***********************************************************/

// Custom Body Classes
add_filter( 'body_class', 'daveyjacobson_body_classes' );

// Nav Menu
add_filter( 'wp_nav_menu_objects', 'daveyjacobson_prepare_menu_links', 10, 2 );

// Content
add_filter( 'the_content', 'no_inline_styles' );

/**
 * Disable Customizr Outright!
 *
 * @see usarugby_disable_customizr()
 * @uses wp_before_admin_bar_render
 */
add_action( 'wp_before_admin_bar_render', 'disable_customizr', 9 );

// Pingback
add_action( 'wp_head', 'daveyjacobson_pingback_header' );
