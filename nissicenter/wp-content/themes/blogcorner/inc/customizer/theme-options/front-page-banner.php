<?php
/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Front Page Options', 'blogcorner' ),
        'description' => __( 'Contains all front page settings', 'blogcorner'),
        'priority' => 150
    )
);
/**/
$wp_customize->add_section(
    'home_page_banner_option',
    array(
        'title'      => __( 'Main Banner Options', 'blogcorner' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'blogcorner_options[enable_banner_section]',
    array(
        'default'           => $default_options['enable_banner_section'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_section]',
    array(
        'label'   => __( 'Enable Banner Section', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[number_of_slider_post]',
    array(
        'default'           => $default_options['number_of_slider_post'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[number_of_slider_post]',
    array(
        'label'       => __( 'Post In Slider', 'blogcorner' ),
        'section'     => 'home_page_banner_option',
        'type'        => 'select',
        'choices'     => array(
            '3' => __( '3', 'blogcorner' ),
            '4' => __( '4', 'blogcorner' ),
            '5' => __( '5', 'blogcorner' ),
            '6' => __( '6', 'blogcorner' ),
        ),
    )
);

$wp_customize->add_setting(
    'blogcorner_options[banner_section_cat]',
    array(
        'default'           => $default_options['banner_section_cat'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[banner_section_cat]',
    array(
        'label'   => __( 'Choose Banner Category', 'blogcorner' ),
        'section' => 'home_page_banner_option',
            'type'        => 'select',
        'choices'     => blogcorner_post_category_list(),
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_banner_post_description]',
    array(
        'default'           => $default_options['enable_banner_post_description'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_post_description]',
    array(
        'label'   => __( 'Enable Post Description', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_banner_tag_meta]',
    array(
        'default'           => $default_options['enable_banner_tag_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_tag_meta]',
    array(
        'label'   => __( 'Enable Tag Meta', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_banner_cat_meta]',
    array(
        'default'           => $default_options['enable_banner_cat_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_cat_meta]',
    array(
        'label'   => __( 'Enable Category Meta', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_banner_author_meta]',
    array(
        'default'           => $default_options['enable_banner_author_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_author_meta]',
    array(
        'label'   => __( 'Enable Author Meta', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_banner_date_meta]',
    array(
        'default'           => $default_options['enable_banner_date_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_date_meta]',
    array(
        'label'   => __( 'Enable Date On Banner', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_banner_overlay]',
    array(
        'default'           => $default_options['enable_banner_overlay'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_banner_overlay]',
    array(
        'label'   => __( 'Enable Banner Overlay', 'blogcorner' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);
