<?php
/**
 * Theme API: Customizer
 *
 * @package DaveyJacobson
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Customizer {
    /**
     * Primary constructor.
     *
     * @version 1.0.0
     */
    public function __construct() {
        add_action( 'customize_register', array( $this, 'daveyjacobson_customize_register' ) );
        add_action( 'customize_preview_init', array( $this, 'daveyjacobson_customize_preview_js' ) );
    }

    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public function daveyjacobson_customize_register( $wp_customize ) {
    	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    	if ( isset( $wp_customize->selective_refresh ) ) {

    		$wp_customize->selective_refresh->add_partial( 'blogname', array(
    			'selector'        => '.site-title a',
    			'render_callback' => 'daveyjacobson_customize_partial_blogname',
    		) );

    		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
    			'selector'        => '.site-description',
    			'render_callback' => 'daveyjacobson_customize_partial_blogdescription',
    		) );

    	}
    }

    /**
     * Render the site title for the selective refresh partial.
     *
     * @return void
     */
    public function daveyjacobson_customize_partial_blogname() {
    	bloginfo( 'name' );
    }

    /**
     * Render the site tagline for the selective refresh partial.
     *
     * @return void
     */
    public function daveyjacobson_customize_partial_blogdescription() {
    	bloginfo( 'description' );
    }

    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    public function daveyjacobson_customize_preview_js() {
    	wp_enqueue_script( 'daveyjacobson_customizer', get_template_directory_uri() . '/dist/assets/js/customizer.js', array( 'jquery' ), get_file_version( 'dist/assets/js/customizer.js' ), true );
    }
}

$customizer = new DJ_Customizer();
