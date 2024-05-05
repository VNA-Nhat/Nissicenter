<?php
$wp_customize->add_section(
    'home_page_newsletter',
    array(
        'title'      => __( 'Newsletter Options', 'blogcorner' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'blogcorner_options[enable_newsletter_section]',
    array(
        'default'           => $default_options['enable_newsletter_section'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_newsletter_section]',
    array(
        'label'   => __( 'Enable Newsletter Section', 'blogcorner' ),
        'section' => 'home_page_newsletter',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[newsletter_section_title]',
    array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[newsletter_section_title]',
    array(
        'label'    => __( 'Newsletter Section Title', 'blogcorner' ),
        'section'  => 'home_page_newsletter',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[newsletter_description]',
    array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[newsletter_description]',
    array(
        'label'    => __( 'Newsletter Description', 'blogcorner' ),
        'section'  => 'home_page_newsletter',
        'type'     => 'textarea',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[newsletter_shortcode]',
    array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[newsletter_shortcode]',
    array(
        'label'    => __( 'Newsletter Shortcode', 'blogcorner' ),
        'section'  => 'home_page_newsletter',
        'type'     => 'text',
    )
);
