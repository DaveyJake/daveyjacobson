<?php
/**
 * Primary site navigation.
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

echo '<nav id="site-navigation" class="main-navigation">';
    //echo '<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">'; esc_html_e( 'Primary Menu', 'daveyjacobson' ); echo '</button>';
    the_nav_menu();
echo '</nav><!-- #site-navigation -->';