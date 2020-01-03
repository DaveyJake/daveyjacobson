<?php
/**
 * Davey Jacobson Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

/**
 * Composer packages.
 */
require_once get_template_directory() . '/vendor/autoload.php';

/**
 * Admin settings.
 */
require_once get_template_directory() . '/admin/class-dj-admin.php';

/**
 * Custom post types and taxonomies.
 */
require_once get_template_directory() . '/inc/class-dj-post-types-taxonomies.php';

/**
 * Theme setup.
 */
require_once get_template_directory() . '/inc/class-dj-theme-setup.php';

/**
 * Custom header.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Widget filters.
 */
require_once get_template_directory() . '/inc/class-dj-widget-filters.php';

/**
 * Widget areas.
 */
require_once get_template_directory() . '/inc/class-dj-widget-areas.php';

/**
 * Enqueue scripts.
 */
require_once get_template_directory() . '/inc/class-dj-scripts-styles.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-hooks-filters.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/class-dj-customizer.php';


/** Theme-specific globals ****************************************************/

// Mobile Detection
$mobile = new Mobile_Detect();