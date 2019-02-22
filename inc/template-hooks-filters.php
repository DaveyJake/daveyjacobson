<?php
/**
 * Hooks and Filters which enhance the theme.
 *
 * @package Davey_Jacobson_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** Hookable Functions ********************************************************/
require_once( get_template_directory() . '/inc/template-functions.php' );


/** Hooks & Filters ***********************************************************/

/**
 * Disable Customizr Outright!
 *
 * @see usarugby_disable_customizr()
 * @uses wp_before_admin_bar_render
 */
add_action( 'wp_before_admin_bar_render', 'disable_customizr', 9 );

// Custom Body Classes
add_filter( 'body_class', 'dj_portfolio_body_classes' );

// Pingback
add_action( 'wp_head', 'dj_portfolio_pingback_header' );