<?php
/**
 * Verdandi Theme Customizer
 *
 * @package Verdandi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function verdandi_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'verdandi_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'verdandi_customize_partial_blogdescription',
        ));
    }

    $wp_customize->add_section(
        'display_settings',
        array(
            'title' => __('Display Settings', 'verdandi'),
        )
    );

    // Author name display
    $wp_customize->add_setting(
        'display_author',
        array(
            'default'           => '1',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control(
        'display_author',
        array(
            'label'   => esc_html__('Display author name', 'verdandi'),
            'type'    => 'checkbox',
            'section' => 'display_settings',
        )
    );

    // Publish date
    $wp_customize->add_setting(
        'display_datetime',
        array(
            'default'           => 'date',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control(
        'display_datetime',
        array(
            'label'   => esc_html__('Publish Date', 'verdandi'),
            'type'    => 'radio',
            'section' => 'display_settings',
            'choices' => array(
                'date'     => esc_html__('Date only', 'verdandi'),
                'datetime' => esc_html__('Date and time', 'verdandi'),
            ),
        )
    );

    $choices = array(
        'blog-display-full-text' => __('Full Text', 'verdandi'),
        'blog-display-summary'   => __('Summary', 'verdandi')
    );

    $wp_customize->add_setting('display_article_content_settings',
        array('default' => 'blog-display-full-text', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('display_article_content_settings', array(
        'id'      => 'verdandi-article-content-display',
        'label'   => __('For each article display:', 'verdandi'),
        'section' => 'display_settings',
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-display-full-text',
    ));


    // Footer text
    $wp_customize->add_setting(
        'footer_text',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'footer_text',
        array(
            'label'       => esc_html__('Custom Footer Text', 'verdandi'),
            'type'        => 'text',
            'section'     => 'title_tagline',
            'description' => esc_html__('HTML enabled. Displays theme name by default.', 'verdandi')
        )
    );
}

add_action('customize_register', 'verdandi_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function verdandi_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function verdandi_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function verdandi_customize_preview_js()
{
    wp_enqueue_script('verdandi-customizer', get_template_directory_uri() . '/js/customizer.js',
        array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'verdandi_customize_preview_js');
