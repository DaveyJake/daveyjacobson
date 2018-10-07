<?php
/**
 * Main landing page.
 *
 * @since 1.0.0
 */
get_header(); ?>

    <div id="front-page">
        <?php echo apply_filters( 'the_content', get_post( get_the_ID() )->post_content ); ?>
    </div>
    <?php

get_sidebar();
get_footer();
