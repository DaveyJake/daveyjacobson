<?php
/**
 * Davey Jacobson Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Davey_Jacobson_Portfolio
 */

/**
 * Autoload Composer
 */
require_once( get_template_directory() . '/vendor/autoload.php' );

/**
 * Theme setup.
 */
require_once( get_template_directory() . '/inc/class-dj-theme-setup.php' );

/**
 * Widget Areas
 */
require_once( get_template_directory() . '/inc/class-dj-widget-areas.php' );

/**
 * Enqueue Scripts
 */
require_once( get_template_directory() . '/inc/class-dj-scripts-styles.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once( get_template_directory() . '/inc/template-hooks-filters.php' );

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
require_once( get_template_directory() . '/inc/class-dj-customizer.php' );
