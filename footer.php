<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Davey_Jacobson_Portfolio
 */
?>

    </div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="site-info"></div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><?php echo '<!-- #' . get_post_type() . '-->'; ?>

<?php wp_footer(); ?>

</body>
</html>
