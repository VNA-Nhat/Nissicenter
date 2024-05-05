<?php
$wp_customize->add_section(
    'archive_options' ,
    array(
        'title' => __( 'Archive Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[archive_style]',
    array(
        'default'           => $default_options['archive_style'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[archive_style]',
    array(
        'label'       => __( 'Archive Style', 'blogcorner' ),
        'description' => __( 'Some options related to header may not show in the front-end based on header style chosen.', 'blogcorner' ),

        'section'     => 'archive_options',
        'type'        => 'select',
        'choices'     => array(
            'archive-style-1' => __( 'Archive Style 1', 'blogcorner' ),
            'archive-style-2' => __( 'Archive Style 2', 'blogcorner' ),
        ),
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_archive_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_archive_1',
        array(
            'settings' => 'blogcorner_section_seperator_archive_1',
            'section' => 'archive_options',
        )
    )
);

/* Archive Meta */
$wp_customize->add_setting(
    'blogcorner_options[archive_post_meta_1]',
    array(
        'default'           => $default_options['archive_post_meta_1'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Blogcorner_Checkbox_Multiple(
        $wp_customize,
        'blogcorner_options[archive_post_meta_1]',
        array(
            'label'	=> __( 'Archive Post Meta', 'blogcorner' ),
            'description'	=> __( 'Please select which post meta data you would like to appear on the listings for archived posts.', 'blogcorner' ),
            'section' => 'archive_options',
            'choices' => array(
                'author' => __( 'Author', 'blogcorner' ),
                'date' => __( 'Date', 'blogcorner' ),
                'category' => __( 'Category', 'blogcorner' ),
                'social-share' => __( 'Social Share', 'blogcorner' ),
            ),
        )

    )
);