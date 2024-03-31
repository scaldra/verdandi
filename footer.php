<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Verdandi
 */

?>

        </div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container">
			<a id="back-to-top" href="#page"><svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M14.15 30.15 12 28l12-12 12 12-2.15 2.15L24 20.3Z"/></svg></a>
            <div class="site-info">
                <?php
                $footer_text = get_theme_mod( 'footer_text', '' );
                if ( empty( $footer_text ) ) {
                    /* translators: 1: Theme name */
                    printf( esc_html__( 'Theme: %1$s', 'verdandi' ), '<a href="https://codeberg.org/scaldra/verdandi">Verdandi</a>' );
                    ?>
                <?php
                } else {
                    echo $footer_text;
                }
                ?>
            </div><!-- .site-info -->
        </div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
