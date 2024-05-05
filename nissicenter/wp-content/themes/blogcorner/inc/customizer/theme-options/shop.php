<?php
$wp_customize->add_section(
    'home_page_shop_option',
    array(
        'title'      => __( 'Shop  Section Options', 'blogcorner' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'blogcorner_options[enable_shop_section]',
    array(
        'default'           => $default_options['enable_shop_section'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_shop_section]',
    array(
        'label'   => __( 'Enable Shop Section', 'blogcorner' ),
        'section' => 'home_page_shop_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_post_title]',
    array(
        'default'           => $default_options['shop_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_post_title]',
    array(
        'label'    => __( 'Shop Post Title', 'blogcorner' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_post_description]',
    array(
        'default'           => $default_options['shop_post_description'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_post_description]',
    array(
        'label'    => __( 'Shop Post Description', 'blogcorner' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'textarea',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_select_product_from]',
    array(
        'default'           => $default_options['shop_select_product_from'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_select_product_from]',
    array(
        'label'       => __( 'Select Product From', 'blogcorner' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            'custom'            => __('Custom Select', 'blogcorner'),
            'recent-products'   => __('Recent Products', 'blogcorner'),
            'popular-products'  => __('Popular Products', 'blogcorner'),
            'sale-products'     => __('Sale Products', 'blogcorner'),
        )
    )
);


$wp_customize->add_setting(
    'blogcorner_options[select_product_category]',
    array(
        'default'           => $default_options['select_product_category'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[select_product_category]',
    array(
        'label'   => __( 'Select Product Category', 'blogcorner' ),
        'section' => 'home_page_shop_option',
        'type'        => 'select',
        'choices'     => blogcorner_woocommerce_product_cat(),
        'active_callback' => 'blogcorner_shop_select_product_from'
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_number_of_column]',
    array(
        'default'           => $default_options['shop_number_of_column'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_number_of_column]',
    array(
        'label'       => __( 'Select Number Of Column', 'blogcorner' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            '2'  => __('2', 'blogcorner'),
            '3'  => __('3', 'blogcorner'),
            '4'  => __('4', 'blogcorner'),
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_number_of_product]',
    array(
        'default'           => $default_options['shop_number_of_product'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_number_of_product]',
    array(
        'label'       => __( 'Select Number Of Product', 'blogcorner' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            '2'  => __('2', 'blogcorner'),
            '3'  => __('3', 'blogcorner'),
            '4'  => __('4', 'blogcorner'),
            '5'  => __('5', 'blogcorner'),
            '6'  => __('6', 'blogcorner'),
            '7'  => __('7', 'blogcorner'),
            '8'  => __('8', 'blogcorner'),
            '9'  => __('9', 'blogcorner'),
            '10'  => __('10', 'blogcorner'),
            '11'  => __('11', 'blogcorner'),
            '12'  => __('12', 'blogcorner'),
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[shop_post_button_text]',
    array(
        'default'           => $default_options['shop_post_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_post_button_text]',
    array(
        'label'    => __( 'Shop section Button Text', 'blogcorner' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'text',
    )
);
$wp_customize->add_setting(
    'blogcorner_options[shop_post_button_url]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'blogcorner_options[shop_post_button_url]',
    array(
        'label'           => __( 'Button Link', 'blogcorner' ),
        'section'         => 'home_page_shop_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the image to have a link', 'blogcorner' ),
    )
);