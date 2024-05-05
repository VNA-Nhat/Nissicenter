<?php
/**/
$wp_customize->add_section(
    'featured_post_option',
    array(
        'title'      => __( 'Featured Post Options', 'blogcorner' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'blogcorner_options[enable_featured_post]',
    array(
        'default'           => $default_options['enable_featured_post'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_featured_post]',
    array(
        'label'   => __( 'Enable Featured Post Section', 'blogcorner' ),
        'section' => 'featured_post_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[featured_post_section_title]',
    array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[featured_post_section_title]',
    array(
        'label'    => __( 'Featured Post Section Title', 'blogcorner' ),
        'section'  => 'featured_post_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[featured_post_cat]',
    array(
        'default'           => $default_options['featured_post_cat'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[featured_post_cat]',
    array(
        'label'   => __( 'Choose Featured Post Category', 'blogcorner' ),
        'section' => 'featured_post_option',
            'type'        => 'select',
        'choices'     => blogcorner_post_category_list(),
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_featured_post_description]',
    array(
        'default'           => $default_options['enable_featured_post_description'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_featured_post_description]',
    array(
        'label'   => __( 'Enable Post Description', 'blogcorner' ),
        'section' => 'featured_post_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_featured_post_cat_meta]',
    array(
        'default'           => $default_options['enable_featured_post_cat_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_featured_post_cat_meta]',
    array(
        'label'   => __( 'Enable Category Meta', 'blogcorner' ),
        'section' => 'featured_post_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_featured_post_author_meta]',
    array(
        'default'           => $default_options['enable_featured_post_author_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_featured_post_author_meta]',
    array(
        'label'   => __( 'Enable Author Meta', 'blogcorner' ),
        'section' => 'featured_post_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_featured_post_date_meta]',
    array(
        'default'           => $default_options['enable_featured_post_date_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_featured_post_date_meta]',
    array(
        'label'   => __( 'Enable Date', 'blogcorner' ),
        'section' => 'featured_post_option',
        'type'    => 'checkbox',
    )
);
