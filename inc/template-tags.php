<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Verdandi
 */

if (!function_exists('verdandi_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function verdandi_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s%3$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s%3$s</time><time class="updated" datetime="%4$s">%5$s%6$s</time>';
        }

        $display_time = 'datetime' === get_theme_mod('display_datetime', 'date');
        $time_string  = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            ($display_time ? esc_html(' ' . get_the_time()) : ''),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date()),
            ($display_time ? esc_html(' ' . get_the_modified_time()) : '')
        );
        /*
                $posted_on = sprintf(
                    esc_html_x( 'Posted on %s', 'post date', 'verdandi' ),
                    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
                );*/
        $posted_on = '<span class="posted-on">' . $time_string . '</span>';

        $byline = '';
        if (get_theme_mod('display_author', '1') === '1') {
            $byline = sprintf(
            /* translators: %s: post author. */
                esc_html_x('by %s', 'post author', 'verdandi'),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
            );
            $byline = '<span class="byline"> ' . $byline . '</span>';
        }

        $categories = "";
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'verdandi'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                $categories = sprintf('<span class="cat-links">' . esc_html__('%1$s', 'verdandi') . '</span>',
                    $categories_list); // WPCS: XSS OK.
            }
        }


        $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-text"></span></a>';
        if (has_post_format('aside')) {
            $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-aside"></span></a>';
        } else {
            if (has_post_format('image')) {
                $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-image"></span></a>';
            } else {
                if (has_post_format('video')) {
                    $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-video"></span></a>';
                } else {
                    if (has_post_format('quote')) {
                        $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-quote"></span></a>';
                    } else {
                        if (has_post_format('gallery')) {
                            $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-gallery"></span></a>';
                        }else {
                            if (has_post_format('status')) {
                                $icon = '<a href="' . esc_url(get_permalink()) . '"><span class="typeicon dashicons dashicons-format-status"></span></a>';
                            }
                        }
                    }
                }
            }
        }
        $icon = '<span class="post-type">' . $icon . '</span>';
        echo $icon . $posted_on . $byline . $categories;

        /*
                edit_post_link(
                    sprintf(
                        wp_kses(
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'verdandi' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
        */
    }
endif;

if (!function_exists('verdandi_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function verdandi_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            /*			$categories_list = get_the_category_list( esc_html__( ', ', 'verdandi' ) );
                        if ( $categories_list ) {
                            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'verdandi' ) . '</span>', $categories_list ); // WPCS: XSS OK.
                        }<span class="dashicons dashicons-admin-links"></span>
            */
            if (is_single()) {
                /* translators: used between list items, there is a space after the comma */
                $tags_list = '<span class="typeicon dashicons dashicons-tag"></span> '. get_the_tag_list('', ', ');
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html__('%1$s', 'verdandi') . '</span><span></span><br />',
                        $tags_list); // WPCS: XSS OK.
                }
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                '<span class="dashicons dashicons-admin-comments"></span><span class="screen-reader-text">no comments on %s</span>',
                '1 <span class="dashicons dashicons-admin-comments"></span><span class="screen-reader-text">comments on %s</span>',
                '% <span class="dashicons dashicons-admin-comments"></span><span class="screen-reader-text">comments on %2$s</span>'

            );
            echo '</span>';
        }
        echo '<div style="clear: both;"></div>';
    }
endif;
