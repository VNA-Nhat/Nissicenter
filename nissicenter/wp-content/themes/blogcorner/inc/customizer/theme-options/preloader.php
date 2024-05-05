<?php
/*Preloader Options*/
$wp_customize->add_section(
    'preloader_options' ,
    array(
        'title' => __( 'Preloader Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'blogcorner_options[show_preloader]',
    array(
        'default'           => $default_options['show_preloader'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_preloader]',
    array(
        'label'    => __( 'Show Preloader', 'blogcorner' ),
        'section'  => 'preloader_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[preloader_style]',
    array(
        'default'           => $default_options['preloader_style'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[preloader_style]',
    array(
        'label'       => __( 'Preloader Style', 'blogcorner' ),
        'section'     => 'preloader_options',
        'type'        => 'select',
        'choices'     => array(
            'theme-preloader-spinner-1' => __( 'Style 1', 'blogcorner' ),
            'theme-preloader-spinner-2' => __( 'Style 2', 'blogcorner' ),
            'theme-preloader-spinner-3' => __( 'Style 3', 'blogcorner' ),
            'theme-preloader-spinner-4' => __( 'Style 4', 'blogcorner' ),
        ),
        'active_callback' => 'blogcorner_is_show_preloader',

    )
);
