<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

    echo '</div><!-- #content -->';

    echo '<footer id="colophon" class="site-footer">';

        echo '<div class="site-info"></div><!-- .site-info -->';

    echo '</footer><!-- #colophon -->';

echo '</div><!-- #' . get_post_type() . '-->';

wp_footer();

echo '<div id="hamburger">'; dynamic_sidebar( 'nav-bar' ); echo '</div>';
//echo '<div id="blocker"></div>';

echo '</body>';
echo '</html>';