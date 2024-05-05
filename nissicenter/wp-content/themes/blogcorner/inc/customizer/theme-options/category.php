<?php
/**/
$wp_customize->add_section(
    'home_page_category_option',
    array(
        'title'      => __( 'Categories Section Options', 'blogcorner' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_category_section]',
    array(
        'default'           => $default_options['enable_category_section'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_category_section]',
    array(
        'label'   => __( 'Enable Category Section', 'blogcorner' ),
        'section' => 'home_page_category_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[category_post_title]',
    array(
        'default'           => $default_options['category_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[category_post_title]',
    array(
        'label'    => __( 'Category Posts Title', 'blogcorner' ),
        'section'  => 'home_page_category_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[number_of_category]',
    array(
        'default'           => $default_options['number_of_category'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[number_of_category]',
    array(
        'label'       => __( 'Number Of Category', 'blogcorner' ),
        'section'     => 'home_page_category_option',
        'type'        => 'select',
        'choices'     => array(
            '2' => __( '2', 'blogcorner' ),
            '3' => __( '3', 'blogcorner' ),
            '4' => __( '4', 'blogcorner' ),
        ),
    )
);

for ( $i=1; $i <=  blogcorner_get_option( 'number_of_category' ) ; $i++ ) {
        $wp_customize->add_setting( 'select_featured_cat_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'blogcorner_sanitize_select',
            
        ) );

        $wp_customize->add_control( 'select_featured_cat_'. $i, array(
            'input_attrs'       => array(
                'style'           => 'width: 50px;'
                ),
            'label'             => __( 'Select Featured Category', 'blogcorner' ) . ' - ' . $i ,
            'section'           => 'home_page_category_option',
                            'type'        => 'select',
            'choices'     => blogcorner_post_category_list(),
            )
        );
    }
