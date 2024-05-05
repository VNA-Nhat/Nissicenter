<?php
/*Enable Search*/
$wp_customize->add_setting(
    'blogcorner_options[enable_search_on_header]',
    array(
        'default'           => $default_options['enable_search_on_header'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_search_on_header]',
    array(
        'label'    => __( 'Enable Search Icon', 'blogcorner' ),
        'section'  => 'header_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_header_3',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_header_3',
        array(
            'settings' => 'blogcorner_section_seperator_header_3',
            'section' => 'header_options',
        )
    )
);

/* ========== Progressbar Section. ==========*/
$wp_customize->add_section(
    'progressbar_options',
    array(
        'title' => __( 'Progressbar Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);
/*Show progressbar*/
$wp_customize->add_setting(
    'blogcorner_options[show_progressbar]',
    array(
        'default'           => $default_options['show_progressbar'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_progressbar]',
    array(
        'label'   => __( 'Show Progressbar', 'blogcorner' ),
        'section' => 'progressbar_options',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[progressbar_position]',
    array(
        'default'           => $default_options['progressbar_position'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[progressbar_position]',
    array(
        'label'           => __( 'Progressbar Position', 'blogcorner' ),
        'section'         => 'progressbar_options',
        'type'            => 'select',
        'choices'         => array(
            'top'    => __( 'Top', 'blogcorner' ),
            'bottom' => __( 'Bottom of the browser window', 'blogcorner' ),
        ),
        'active_callback' => 'blogcorner_is_progressbar_enabled',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[progressbar_color]',
    array(
        'default'           => $default_options['progressbar_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[progressbar_color]',
        array(
            'label'           => __( 'Progressbar Color', 'blogcorner' ),
            'section'         => 'progressbar_options',
            'type'            => 'color',
            'active_callback' => 'blogcorner_is_progressbar_enabled',
        )
    )
);