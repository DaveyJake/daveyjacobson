<?php
/**
 * Portfolio branding for masthead.
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

echo '<div class="site-branding">';
    the_custom_logo();

    if ( is_front_page() && is_home() ) :
        echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . bloginfo( 'name' ) . '</a></h1>';
    else :
        echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . bloginfo( 'name' ) . '</a></p>';
    endif;

    $daveyjacobson_description = get_bloginfo( 'description', 'display' );

    if ( $daveyjacobson_description || is_customize_preview() ) :
        echo '<p class="site-description">' . $daveyjacobson_description . /* WPCS: xss ok. */ '</p>';
    endif;
echo '</div><!-- .site-branding -->';
