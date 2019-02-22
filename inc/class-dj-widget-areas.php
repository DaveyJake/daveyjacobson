<?php
/**
 * Theme API: Register widget areas.
 *
 * @see {@link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar}
 *
 * @package Davey_Jacobson
 * @subpackage Widget_Areas
 * @since DJ_Widget_Areas 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Widget_Areas {

    /**
     * Primary constructor.
     *
     * @version 1.0.0
     */
    public function __construct() {
        add_action( 'widgets_init', array( __CLASS__, 'dj_portfolio_sidebars' ) );
    }

    /**
     * Register all widget sidebars.
     *
     * @version 1.0.0
     */
    public static function dj_portfolio_sidebars() {

        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'dj_portfolio' ),
            'id'            => 'sidebar',
            'description'   => esc_html__( 'Add widgets here.', 'dj_portfolio' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<span class="widget-title hide">',
            'after_title'   => '</span>',
        ) );

    }

}

new DJ_Widget_Areas();
