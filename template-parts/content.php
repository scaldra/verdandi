<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Verdandi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php verdandi_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php
        endif; ?>
        <?php
        if (has_post_format('aside') || has_post_format('quote') || has_post_format('status')) {
            ?>
            <br/>
            <?php
        } else {
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h1 class="entry-title"><!-- i class="dashicons dashicons-sticky"></i --><a href="' . esc_url(get_permalink()) . '" rel="bookmark">',
                    '</a></h1>');
            endif;
        }
        ?>
    </header><!-- .entry-header -->

    <?php if (has_post_thumbnail()) : ?>
        <div class="featured-image">
            <?php the_post_thumbnail(); ?>
        </div><!-- .featured-image -->
    <?php endif; ?>
    <div class="entry-content">
        <?php
        if ('blog-display-full-text' === get_theme_mod('display_article_content_settings', 'blog-display-full-text') ||
            has_post_format('status') || has_post_format('aside') || has_post_format('gallery') || has_post_format('image') || has_post_format('video') || has_post_format('quote') || is_singular()
        ) {
            if (has_post_format('image') || has_post_format('gallery') || has_post_format('video')) echo "<p>";
            the_content(sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'verdandi'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'verdandi'),
                'after'  => '</div>',
            ));
            if (has_post_format('image') || has_post_format('gallery') || has_post_format('video')) echo "</p>";
        } else {
            echo '<p>' . '<span class="verdandi-excerpt"><a href="' . esc_url(get_permalink()) . '">' . get_the_excerpt() . '<span class="verdandi-more">&nbsp;|&nbsp;mehr</span></a></span></p>';
        }
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php verdandi_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
