<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Davey_Jacobson_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

get_header();

    echo '<section id="primary" class="content-area">';

        echo '<main id="main" class="site-main">';

        if ( have_posts() ) {
            echo '<header class="page-header">';
                echo '<h1 class="page-title">';
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'dj' ), '<span>' . get_search_query() . '</span>' );
                echo '</h1>';
            echo '</header><!-- .page-header -->';

            /* Start the Loop */
            while ( have_posts() ) {
                the_post();

                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
                get_template_part( 'template-parts/content', 'search' );
            }

            the_posts_navigation();
        }
        else {
            get_template_part( 'template-parts/content', 'none' );
        }

        echo '</main><!-- #main -->';

    echo '</section><!-- #primary -->';

get_sidebar();

get_footer();
