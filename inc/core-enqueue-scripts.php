<?php
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */

/** Globals *******************************************************************/

global $current_url;

$dev    = strpos( $current_url, '.rugby' ) ? '' : '.min';
$vendor = 'node_modules';

/** Vendor Version Constants */
require_once 'core-version-constants.php';

function dj_portfolio_scripts() {

	global $vendor;

	// Default `style.css`
	wp_enqueue_style( 'dj_portfolio-style', get_stylesheet_uri() );

	// jQuery
	wp_enqueue_script( 'jquery' );

	// Replace `underscore` with `lodash`
	wp_deregister_script( 'underscore' );
	wp_enqueue_script( 'underscore', get_template_directory_uri() . "/{$vendor}/lodash/lodash$dev.js", array(), LODASH, true );

	// Navigation.js
	wp_enqueue_script( 'dj_portfolio-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	// Skip Link Focus
	wp_enqueue_script( 'dj_portfolio-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	// Custom JS
	wp_enqueue_script( 'dj_portfolio-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0.0', true );

	// Comment.js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'dj_portfolio_scripts' );
