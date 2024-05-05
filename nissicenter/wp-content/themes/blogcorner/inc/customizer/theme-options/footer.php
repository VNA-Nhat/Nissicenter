<?php
$widgets_link = admin_url('widgets.php');


$wp_customize->add_section(
    'footer_options',
    array(
        'title' => __('Footer Options', 'blogcorner'),
        'panel' => 'blogcorner_option_panel',
    )
);
/*Enable Sticky Menu*/
$wp_customize->add_setting(
    'blogcorner_options[enable_footer_sticky]',
    array(
        'default' => $default_options['enable_footer_sticky'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_footer_sticky]',
    array(
        'label' => __('Enable Sticky Footer', 'blogcorner'),
        'section' => 'footer_options',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'blogcorner_options[upload_footer_image]',
    array(
        'default' => '',
        'sanitize_callback' => 'blogcorner_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'blogcorner_options[upload_footer_image]',
        array(
            'label' => __('Upload Footer Image', 'blogcorner'),
            'section' => 'footer_options',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_options[enable_footer_image_overlay]',
    array(
        'default' => $default_options['enable_footer_image_overlay'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_footer_image_overlay]',
    array(
        'label' => __('Enable Background Overlay', 'blogcorner'),
        'section' => 'footer_options',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'blogcorner_section_seperator_footer_1',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_footer_1',
        array(
            'settings' => 'blogcorner_section_seperator_footer_1',
            'section' => 'footer_options',
        )
    )
);
/*Option to choose footer column layout*/
$wp_customize->add_setting(
    'blogcorner_options[footer_column_layout]',
    array(
        'default' => $default_options['footer_column_layout'],
        'sanitize_callback' => 'blogcorner_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Blogcorner_Radio_Image_Control(
        $wp_customize,
        'blogcorner_options[footer_column_layout]',
        array(
            'label' => __('Footer Column Layout', 'blogcorner'),
            'description' => sprintf(__('Footer widgetareas used will vary based on the footer column layout chosen. Head over to  <a href="%s" target="_blank">widgets</a> to see which footer widgetareas are used if you change the layout.', 'blogcorner'), $widgets_link),
            'section' => 'footer_options',
            'choices' => blogcorner_get_footer_layouts()
        )
    )
);
/* Footer Background Color*/
$wp_customize->add_setting(
    'blogcorner_options[footer_widgetarea_bg_color]',
    array(
        'default' => $default_options['footer_widgetarea_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_widgetarea_bg_color]',
        array(
            'label' => __('Footer Widget Area Background Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_options[footer_widgetarea_text_color]',
    array(
        'default' => $default_options['footer_widgetarea_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_widgetarea_text_color]',
        array(
            'label' => __('Footer Widget Area Text Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_section_seperator_footer_2',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_footer_2',
        array(
            'settings' => 'blogcorner_section_seperator_footer_2',
            'section' => 'footer_options',
        )
    )
);
/*Enable Footer Social Nav*/
$wp_customize->add_setting(
    'blogcorner_options[enable_footer_social_nav]',
    array(
        'default' => $default_options['enable_footer_social_nav'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_footer_social_nav]',
    array(
        'label' => __('Show Social Nav Menu in Footer', 'blogcorner'),
        'description' => sprintf(__('You can add/edit social nav menu from <a href="%s">here</a>.', 'blogcorner'), "javascript:wp.customize.control( 'nav_menu_locations[social-menu]' ).focus();"),
        'section' => 'footer_options',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'blogcorner_options[footer_middlearea_bg_color]',
    array(
        'default' => $default_options['footer_middlearea_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_middlearea_bg_color]',
        array(
            'label' => __('Footer Middle Area Background Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_options[footer_middlearea_text_color]',
    array(
        'default' => $default_options['footer_middlearea_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_middlearea_text_color]',
        array(
            'label' => __('Footer Middle Area Text Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
/*Enable footer credit*/
$wp_customize->add_setting(
    'blogcorner_section_seperator_footer_3',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_footer_3',
        array(
            'settings' => 'blogcorner_section_seperator_footer_3',
            'section' => 'footer_options',
        )
    )
);
/*Copyright Text.*/
$wp_customize->add_setting(
    'blogcorner_options[copyright_text]',
    array(
        'default' => $default_options['copyright_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[copyright_text]',
    array(
        'label' => __('Copyright Text', 'blogcorner'),
        'section' => 'footer_options',
        'type' => 'text',
    )
);
/*Todays Date Format*/
$wp_customize->add_setting(
    'blogcorner_options[copyright_date_format]',
    array(
        'default' => $default_options['copyright_date_format'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[copyright_date_format]',
    array(
        'label' => __('Todays Date Format', 'blogcorner'),
        'description' => sprintf(wp_kses(__('<a href="%s" target="_blank">Date and Time Formatting Documentation</a>.', 'blogcorner'), array('a' => array('href' => array(), 'target' => array()))), esc_url('https://wordpress.org/support/article/formatting-date-and-time')),
        'section' => 'footer_options',
        'type' => 'text',
    )
);
/*Enable Footer Nav*/
$wp_customize->add_setting(
    'blogcorner_options[enable_footer_nav]',
    array(
        'default' => $default_options['enable_footer_nav'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_footer_nav]',
    array(
        'label' => __('Show Footer Nav Menu', 'blogcorner'),
        'description' => sprintf(__('You can add/edit footer nav menu from <a href="%s">here</a>.', 'blogcorner'), "javascript:wp.customize.control( 'nav_menu_locations[footer-menu]' ).focus();"),
        'section' => 'footer_options',
        'type' => 'checkbox',
    )
);
/*Enable scroll to top*/
$wp_customize->add_setting(
    'blogcorner_options[enable_scroll_to_top]',
    array(
        'default' => $default_options['enable_scroll_to_top'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_scroll_to_top]',
    array(
        'label' => __('Show Scroll to top', 'blogcorner'),
        'section' => 'footer_options',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'blogcorner_options[footer_credit_bg_color]',
    array(
        'default' => $default_options['footer_credit_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_credit_bg_color]',
        array(
            'label' => __('Footer Credit Area Background Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_options[footer_credit_text_color]',
    array(
        'default' => $default_options['footer_credit_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogcorner_options[footer_credit_text_color]',
        array(
            'label' => __('Footer Credit Area Text Color', 'blogcorner'),
            'section' => 'footer_options',
            'type' => 'color',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_section_seperator_footer_4',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_footer_4',
        array(
            'settings' => 'blogcorner_section_seperator_footer_4',
            'section' => 'footer_options',
        )
    )
);
$wp_customize->add_setting(
    'blogcorner_premium_notice',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Blogcorner_Premium_Notice_Control(
        $wp_customize,
        'blogcorner_premium_notice',
        array(
            'label' => esc_html__('Footer Option', 'blogcorner'),
            'settings' => 'blogcorner_premium_notice',
            'section' => 'footer_options',
        )
    )
);