<?php
/**
 * Davey Jacobson Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Davey_Jacobson_Portfolio
 */

/**
 * Theme setup.
 */
require_once( get_template_directory() . '/inc/core-theme-setup.php' );

/**
 * Widget Areas
 */
require_once( get_template_directory() . '/inc/core-widget-areas.php' );

/**
 * Enqueue Scripts
 */
require_once( get_template_directory() . '/inc/core-enqueue-scripts.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once( get_template_directory() . '/inc/template.filters-hooks.php' );

/**
 * Custom template tags for this theme.
 */
require_once( get_template_directory() . '/inc/template-tags.php' );

/**
 * Implement the Custom Header feature.
 */
require_once( get_template_directory() . '/inc/custom-header.php' );

/**
 * Customizer additions.
 */
require_once( get_template_directory() . '/inc/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

