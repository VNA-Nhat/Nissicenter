<?php
$wp_customize->add_setting(
    'blogcorner_options[enable_header_bg_overlay]',
    array(
        'default'           => $default_options['enable_header_bg_overlay'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_header_bg_overlay]',
    array(
        'label'    => __( 'Enable Image Overlay', 'blogcorner' ),
        'section'  => 'header_image',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[header_image_size]',
    array(
        'default'           => $default_options['header_image_size'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[header_image_size]',
    array(
        'label'       => __( 'Select Header Size', 'blogcorner' ),
        'description' => __( 'Some options related to header may not show in the front-end based on header style chosen.', 'blogcorner' ),

        'section'     => 'header_image',
        'type'        => 'select',
        'choices'     => array(
            'none' => __( 'Default', 'blogcorner' ),
            'small' => __( 'Small', 'blogcorner' ),
            'medium' => __( 'Medium', 'blogcorner' ),
            'large' => __( 'Large', 'blogcorner' ),
        ),
    )
);
/*Header Options*/
$wp_customize->add_section(
    'header_options' ,
    array(
        'title' => __( 'Header Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_header_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_header_1',
        array(
            'settings' => 'blogcorner_section_seperator_header_1',
            'section' => 'header_options',
        )
    )
);

/*Enable Sticky Menu*/
$wp_customize->add_setting(
    'blogcorner_options[enable_sticky_menu]',
    array(
        'default'           => $default_options['enable_sticky_menu'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_sticky_menu]',
    array(
        'label'    => __( 'Enable Sticky Menu', 'blogcorner' ),
        'section'  => 'header_options',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_section_seperator_header_2',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_header_2',
        array(
            'settings' => 'blogcorner_section_seperator_header_2',
            'section' => 'header_options',
        )
    )
);


if(class_exists( 'WooCommerce' )){
    
    /*Enable Mini Cart Icon on header*/
    $wp_customize->add_setting(
        'blogcorner_options[enable_mini_cart_header]',   
        array(
            'default'           => $default_options['enable_mini_cart_header'],
            'sanitize_callback' => 'blogcorner_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'blogcorner_options[enable_mini_cart_header]',
        array(
            'label'    => __( 'Enable Mini Cart Icon', 'blogcorner' ),
            'section'  => 'header_options',
            'type'     => 'checkbox',
        )
    );

    /*Enable Myaccount Link*/
    $wp_customize->add_setting(
        'blogcorner_options[enable_woo_my_account]',   
        array(
            'default'           => $default_options['enable_woo_my_account'],
            'sanitize_callback' => 'blogcorner_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'blogcorner_options[enable_woo_my_account]',
        array(
            'label'    => __( 'Enable My Account Icon', 'blogcorner' ),
            'section'  => 'header_options',
            'type'     => 'checkbox',
        )
    );
}