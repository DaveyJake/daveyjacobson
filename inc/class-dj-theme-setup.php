<?php
/**
 * Theme API: Default support.
 *
 * @package DaveyJacobson
 * @subpackage Theme_Setup
 * @since DJ_Theme_Setup 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

if ( ! class_exists( 'DJ_Nav_Walker' ) ) {
    require_once 'class-dj-nav-walker.php';
}

class DJ_Theme_Setup {

    /**
     * Configure navigation menu.
     *
     * @link {@see 'the_nav_menu'}
     *
     * @version 1.0.0
     */
    public static function daveyjacobson_main_menu() {
        wp_nav_menu( array(
            'container'      => false,
            'theme_location' => 'main-menu',
            'menu_id'        => 'menu',
            'walker'         => new DJ_Nav_Walker(),
        ));
    }

    /**
     * Primary constructor.
     *
     * @version 1.0.0
     *
     * @return DJ_Theme_Setup   Class instance.
     */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'daveyjacobson_theme_setup' ), 5 );
        add_action( 'init', array( $this, 'daveyjacobson_theme_cleanup' ), 10 );
    }

    /**
     * Initialize nav menus and theme support.
     *
     * @return void
     */
    public function daveyjacobson_theme_setup() {
        $this->daveyjacobson_nav_menu();
        $this->daveyjacobson_theme_support();
    }

    /**
     * Register all navigation menus. This theme uses wp_nav_menu() in one location.
     *
     * @version 1.0.0
     */
    private function daveyjacobson_nav_menu() {
        register_nav_menus( array(
            'main-menu' => esc_html__( 'Primary', 'daveyjacobson' ),
        ));
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
	private function daveyjacobson_theme_support() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Davey Jacobson Portfolio, use a find and replace
		 * to change 'daveyjacobson' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'daveyjacobson', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        // Add post formats support: http://codex.wordpress.org/Post_Formats
        add_theme_support( 'post-formats', array( 'aside', 'image' ) );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

		/**
		 * Add theme support for selective refresh for widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

        $this->daveyjacobson_content_width();
	}

    /**
     * Initialize theme cleanup.
     *
     * @return void
     */
    public function daveyjacobson_theme_cleanup() {
        $this->daveyjacobson_cleanup_head();
        $this->daveyjacobson_disable_wp_emojicons();
    }

    /**
     * Remove non-essential tags from the 'head' tag.
     *
     * @since 2.0.0 - Initial commit.
     * @since 2.5.0 - WordPress Core standards prohibits certain tags from being
     *                removed. Adjusted and to make things 97% compliant.
     */
    private function daveyjacobson_cleanup_head() {
        // EditURI link.
        remove_action( 'wp_head', 'rsd_link' );
        // Windows Live Writer.
        remove_action( 'wp_head', 'wlwmanifest_link' );
    }

    /**
     * Disable all `emoji.js` and prevent its injection.
     *
     * @since 2.0.0
     */
    private function daveyjacobson_disable_wp_emojicons() {
        // All actions related to emojis.
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        /**
         * Filter to remove TinyMCE emojis.
         *
         * @link {@see 'DJ_Theme_Setup::disable_emojicons_tinymce'}
         */
        add_filter( 'tiny_mce_plugins', array( $this, 'daveyjacobson_disable_emojicons_tinymce' ) );
    }

    /**
     * Disable emojis in admin dashboard.
     *
     * @link {@see 'tiny_mce_plugins'}
     */
    public function daveyjacobson_disable_emojicons_tinymce( $plugins ) {
        if ( is_array( $plugins ) )
        {
            return array_diff( $plugins, array( 'wpemoji' ) );
        }
        else
        {
            return array();
        }
    }

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    public function daveyjacobson_content_width() {
    	// This variable is intended to be overruled from themes.
    	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    	$GLOBALS['content_width'] = apply_filters( 'daveyjacobson_content_width', 1440 );
    }

}

global $theme_setup;
$theme_setup = new DJ_Theme_Setup();
