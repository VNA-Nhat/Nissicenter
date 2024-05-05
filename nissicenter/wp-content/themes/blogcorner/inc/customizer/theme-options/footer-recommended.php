<?php
/**/
$wp_customize->add_section(
    'footer_recommended_post_section',
    array(
        'title'      => __( 'Footer Related Post', 'blogcorner' ),
        'panel'      => 'blogcorner_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'blogcorner_options[enable_footer_recommended_post_section]',
    array(
        'default'           => $default_options['enable_footer_recommended_post_section'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_footer_recommended_post_section]',
    array(
        'label'   => __( 'Enable Footer Related Post Section', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[footer_recommended_post_title]',
    array(
        'default'           => $default_options['footer_recommended_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[footer_recommended_post_title]',
    array(
        'label'    => __( 'Footer Recoommended Posts Title', 'blogcorner' ),
        'section'  => 'footer_recommended_post_section',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[select_cat_for_footer_recommended_post]',
    array(
        'default'           => $default_options['select_cat_for_footer_recommended_post'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_cat_for_footer_recommended_post]',
    array(
        'label'   => __( 'Choose Footer Related Post Category', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
            'type'        => 'select',
        'choices'     => blogcorner_post_category_list(),
    )
);


$wp_customize->add_setting(
    'blogcorner_options[select_number_of_post]',
    array(
        'default'           => $default_options['select_number_of_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blogcorner_sanitize_positive_integer',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_number_of_post]',
    array(
        'label'       => __( 'Select Number of Post', 'blogcorner' ),
        'section'     => 'footer_recommended_post_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 3, 'max' => 12, 'style' => 'width: 150px;'),
        )
);

$wp_customize->add_setting(
    'blogcorner_options[select_number_of_col]',
    array(
        'default'           => $default_options['select_number_of_col'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_number_of_col]',
    array(
        'label'       => __( 'Select Number of Col', 'blogcorner' ),
        'section'     => 'footer_recommended_post_section',
        'type'        => 'select',
        'choices' => array(
            'column-4'  => __('Three Column Layout', 'blogcorner'),
            'column-3'  => __('Four Column Layout', 'blogcorner'),
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[select_font_size]',
    array(
        'default'           => $default_options['select_font_size'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_font_size]',
    array(
        'label'       => __( 'Select Font Size', 'blogcorner' ),
        'section'     => 'footer_recommended_post_section',
        'type'        => 'select',
        'choices' => array(
            'entry-title-big'  => __('Big', 'blogcorner'),
            'entry-title-medium'  => __('Medium', 'blogcorner'),
            'entry-title-small'   => __('Small', 'blogcorner'),
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[select_image_size]',
    array(
        'default'           => $default_options['select_image_size'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_image_size]',
    array(
        'label'       => __( 'Select Image Size', 'blogcorner' ),
        'section'     => 'footer_recommended_post_section',
        'type'        => 'select',
        'choices' => array(
            'featured-media-medium'  => __('Medium', 'blogcorner'),
            'featured-media-large'   => __('Large', 'blogcorner'),
            'featured-media-big'  => __('Big', 'blogcorner'),
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_category_meta]',
    array(
        'default'           => $default_options['enable_category_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_category_meta]',
    array(
        'label'   => __( 'Enable Category Meta', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_date_meta]',
    array(
        'default'           => $default_options['enable_date_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_date_meta]',
    array(
        'label'   => __( 'Enable Date Meta', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_author_meta]',
    array(
        'default'           => $default_options['enable_author_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_author_meta]',
    array(
        'label'   => __( 'Enable Author Meta', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_social_share]',
    array(
        'default'           => $default_options['enable_social_share'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_social_share]',
    array(
        'label'   => __( 'Enable Social Share', 'blogcorner' ),
        'section' => 'footer_recommended_post_section',
        'type'    => 'checkbox',
    )
);
