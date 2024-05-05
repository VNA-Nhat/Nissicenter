<?php
$wp_customize->add_section(
    'pagination_options' ,
    array(
        'title' => __( 'Pagination Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

/* Pagination Type*/
$wp_customize->add_setting(
    'blogcorner_options[pagination_type]',
    array(
        'default'           => $default_options['pagination_type'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[pagination_type]',
    array(
        'label'       => __( 'Pagination Type', 'blogcorner' ),
        'section'     => 'pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'default' => __( 'Default (Older / Newer Post)', 'blogcorner' ),
            'numeric' => __( 'Numeric', 'blogcorner' ),
            'ajax_load_on_click' => __( 'Load more post on click', 'blogcorner' ),
            'ajax_load_on_scroll' => __( 'Load more posts on scroll', 'blogcorner' ),
        ),
    )
);
