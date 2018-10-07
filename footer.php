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

		<div class="site-info">

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dj_portfolio' ) ); ?>">
			<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'dj_portfolio' ), 'WordPress' );
			?>
			</a>

			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'dj_portfolio' ), 'dj_portfolio', '<a href="http://daveyjacobson.com">Davey Jacboson</a>' );
			?>

        </div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><?php echo '<!-- #' . get_post_type() . '-->'; ?>

<?php wp_footer(); ?>

</body>
</html>
