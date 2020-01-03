<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Davey_Jacobson_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

if ( ! is_active_sidebar( 'sidebar' ) ) {
    return;
}

echo '<aside id="secondary" class="widget-area">';
    dynamic_sidebar( 'sidebar' );
echo '</aside><!-- #secondary -->';