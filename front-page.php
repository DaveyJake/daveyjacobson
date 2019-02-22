<?php
/**
 * Main landing page.
 *
 * @since 1.0.0
 */
get_header();
get_sidebar();
    ?>
    <div id="front-page" class="site-main">
        <?php echo apply_filters( 'the_content', get_post( get_the_ID() )->post_content ); ?>
    </div>
    <?php
get_footer();
