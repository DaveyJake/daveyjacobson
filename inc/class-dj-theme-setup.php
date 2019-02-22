<?php
/**
 * Theme API: Default support.
 *
 * @package Davey_Jacobson
 * @subpackage Theme_Setup
 * @since DJ_Theme_Setup 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Theme_Setup {

    /**
     * Primary constructor.
     *
     * @version 1.0.0
     */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'dj_portfolio_nav_menus' ) );
        add_action( 'after_setup_theme', array( $this, 'dj_portfolio_theme_support' ) );
        add_action( 'after_setup_theme', array( $this, 'dj_portfolio_content_width' ), 0 );
    }

    /**
     * Register all navigation menus. This theme uses wp_nav_menu() in one location.
     *
     * @version 1.0.0
     */
    public function dj_portfolio_nav_menus() {
        register_nav_menus( array(
            'main-menu' => esc_html__( 'Primary', 'dj_portfolio' ),
        ) );
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
	public function dj_portfolio_theme_support() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Davey Jacobson Portfolio, use a find and replace
		 * to change 'dj_portfolio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dj_portfolio', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 *
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
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
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/**
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'dj_portfolio_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

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

	}

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    public function dj_portfolio_content_width() {
    	// This variable is intended to be overruled from themes.
    	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    	$GLOBALS['content_width'] = apply_filters( 'dj_portfolio_content_width', 1440 );
    }

}

new DJ_Theme_Setup();
