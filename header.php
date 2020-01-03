<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DaveyJacobson
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="<?php echo ( is_front_page() ? 'front-page' : get_post_type() ); ?>" class="site no-sidebar">

        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'daveyjacobson' ); ?></a>

        <header id="masthead" class="site-header">
            <a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_self"><img src="<?php echo get_template_directory_uri() . '/dist/assets/images/dj-logo-white.png' ?>" class="logo" alt="Davey Jacobson" /></a>
            <?php get_template_parts( 'masthead', 'site-navigation' ); ?>
        </header><!-- #masthead -->

        <div id="content" class="site-content">
