<?php
/**
 * Portfolio API: Enqueue scripts and styles.
 *
 * @package Davey_Jacobson_Portfolio
 * @subpackage Scripts_Styles
 * @since 1.0.0
 */

/** Vendor Version Constants */
require_once( 'core-version-constants.php' );

class DJ_Scripts_Styles {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    /**
     * Primary script and style injector.
     *
     * @return void
     */
    public function enqueue() {

        $this->register();

        // Default style.css.
        wp_enqueue_style( 'dj_portfolio-style' );

        // jQuery.
        wp_enqueue_script( 'jquery' );

        // Frontend.
        wp_enqueue_script( 'dj_portfolio-custom-js' );

        // Post comments.
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }

    /**
     * Primary script and style registrar.
     *
     * @return void
     */
    public function register() {

        $this->remove();

        global $current_url;

        $dev    = strpos( $current_url, '.test' ) ? '' : '.min';
        $vendor = 'node_modules';

    	// Default `style.css`
    	wp_register_style( 'dj_portfolio-style', get_template_directory_uri() . '/dist/assets/style.css', false, get_file_version( 'dist/assets/style.css' ), 'all' );

        // Replace `underscore` with `lodash`
        wp_deregister_script( 'underscore' );
        wp_register_script( 'underscore', includes_url( "js/dist/vendor/lodash$dev.js" ), array(), LODASH, true );

        // Deregister jQuery and re-register jQuery core.
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array(), '1.12.14', true );

    	// Bundle JS
    	wp_register_script( 'dj_portfolio-custom-js', get_template_directory_uri() . '/dist/assets/js/frontend-bundle.js', array( 'jquery' ), get_file_version( 'dist/assets/js/frontend-bundle.js' ), true );

    }

    /**
     * Remove/Prevent/Disable specific scripts and styles from loading.
     *
     * @return void
     */
    public function remove() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }

}

new DJ_Scripts_Styles();
