<?php
/**
 * Main landing page.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

get_header();

    echo '<div id="fp" class="site-main">';

        the_sections();

    echo '</div>';

get_footer();
