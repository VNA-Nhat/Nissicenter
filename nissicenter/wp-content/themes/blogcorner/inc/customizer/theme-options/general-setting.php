<?php
/*Header Options*/
$wp_customize->add_section(
    'general_settings' ,
    array(
        'title' => __( 'General Settings', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_cursor_dot_outline]',
    array(
        'default' => $default_options['enable_cursor_dot_outline'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_cursor_dot_outline]',
    array(
        'label' => esc_html__('Enable Cursor Dot Outline', 'blogcorner'),
        'section' => 'general_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[site_fallback_image]',
    array(
        'default' => $default_options['site_fallback_image'],
        'sanitize_callback' => 'blogcorner_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'blogcorner_options[site_fallback_image]',
        array(
            'label' => __('Upload Fallback Image', 'blogcorner'),
            'section' => 'general_settings',
        )
    )
);
