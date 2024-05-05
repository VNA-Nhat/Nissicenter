<?php

$wp_customize->add_section(
    'single_options' ,
    array(
        'title' => __( 'Single Options', 'blogcorner' ),
        'panel' => 'blogcorner_option_panel',
    )
);

/* Global Layout*/
$wp_customize->add_setting(
    'blogcorner_options[single_sidebar_layout]',
    array(
        'default'           => $default_options['single_sidebar_layout'],
        'sanitize_callback' => 'blogcorner_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Blogcorner_Radio_Image_Control(
        $wp_customize,
        'blogcorner_options[single_sidebar_layout]',
        array(
            'label' => __( 'Single Post Sidebar Layout', 'blogcorner' ),
            'section' => 'single_options',
            'choices' => blogcorner_get_general_layouts()
        )
    )
);

// Hide Side Bar on Mobile
$wp_customize->add_setting(
    'blogcorner_options[hide_single_sidebar_mobile]',
    array(
        'default'           => $default_options['hide_single_sidebar_mobile'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[hide_single_sidebar_mobile]',
    array(
        'label'       => __( 'Hide Single Sidebar on Mobile', 'blogcorner' ),
        'section'     => 'single_options',
        'type'        => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_single_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_single_1',
        array(
            'settings' => 'blogcorner_section_seperator_single_1',
            'section'       => 'single_options',
        )
    )
);

/* Post Meta */
$wp_customize->add_setting(
    'blogcorner_options[single_post_meta]',
    array(
        'default'           => $default_options['single_post_meta'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Blogcorner_Checkbox_Multiple(
        $wp_customize,
        'blogcorner_options[single_post_meta]',
        array(
            'label' => __( 'Single Post Meta', 'blogcorner' ),
            'description'   => __( 'Choose the post meta you want to be displayed on post detail page', 'blogcorner' ),
            'section' => 'single_options',
            'choices' => array(
                'author' => __( 'Author', 'blogcorner' ),
                'date' => __( 'Date', 'blogcorner' ),
                'tags' => __( 'Tags', 'blogcorner' ),
            )
        )
    )
);



$wp_customize->add_setting(
    'blogcorner_section_seperator_single_5',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control( 
        $wp_customize,
        'blogcorner_section_seperator_single_5',
        array(
            'settings' => 'blogcorner_section_seperator_single_5',
            'section'       => 'single_options',
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[show_fixed_next_previous_post_navigation]',
    array(
        'default'           => $default_options['show_fixed_next_previous_post_navigation'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_fixed_next_previous_post_navigation]',
    array(
        'label' => esc_html__('Show Sticky Next/Previous Articles Navigation', 'blogcorner'),
        'section'     => 'single_options',
        'type'        => 'checkbox',
    )
);


/*Show Author Info Box start
*-------------------------------*/
$wp_customize->add_setting(
    'blogcorner_section_seperator_single_2',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control( 
        $wp_customize,
        'blogcorner_section_seperator_single_2',
        array(
            'settings' => 'blogcorner_section_seperator_single_2',
            'section'       => 'single_options',
        )
    )
);

$wp_customize->add_setting(
    'blogcorner_options[show_author_info]',
    array(
        'default'           => $default_options['show_author_info'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_author_info]',
    array(
        'label'    => __( 'Show Author Info Box', 'blogcorner' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_single_3',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_single_3',
        array(
            'settings' => 'blogcorner_section_seperator_single_3',
            'section'       => 'single_options',
        )
    )
);

/*Show Related Posts
*-------------------------------*/
$wp_customize->add_setting(
    'blogcorner_options[show_related_posts]',
    array(
        'default'           => $default_options['show_related_posts'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_related_posts]',
    array(
        'label'    => __( 'Show Related Posts', 'blogcorner' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

/*Related Posts Text.*/
$wp_customize->add_setting(
    'blogcorner_options[related_posts_text]',
    array(
        'default'           => $default_options['related_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[related_posts_text]',
    array(
        'label'    => __( 'Related Posts Text', 'blogcorner' ),
        'section'  => 'single_options',
        'type'     => 'text',
        'active_callback' => 'blogcorner_is_related_posts_enabled',
    )
);


/*Related Posts Orderby*/
$wp_customize->add_setting(
    'blogcorner_options[related_posts_orderby]',
    array(
        'default'           => $default_options['related_posts_orderby'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[related_posts_orderby]',
    array(
        'label'       => __( 'Orderby', 'blogcorner' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'date' => __('Date', 'blogcorner'),
            'id' => __('ID', 'blogcorner'),
            'title' => __('Title', 'blogcorner'),
            'rand' => __('Random', 'blogcorner'),
        ),
        'active_callback' => 'blogcorner_is_related_posts_enabled',
    )
);

/*Related Posts Order*/
$wp_customize->add_setting(
    'blogcorner_options[related_posts_order]',
    array(
        'default'           => $default_options['related_posts_order'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[related_posts_order]',
    array(
        'label'       => __( 'Order', 'blogcorner' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'asc' => __('ASC', 'blogcorner'),
            'desc' => __('DESC', 'blogcorner'),
        ),
        'active_callback' => 'blogcorner_is_related_posts_enabled',
    )
);

$wp_customize->add_setting(
    'blogcorner_section_seperator_single_4',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Blogcorner_Seperator_Control(
        $wp_customize,
        'blogcorner_section_seperator_single_4',
        array(
            'settings' => 'blogcorner_section_seperator_single_4',
            'section'       => 'single_options',
        )
    )
);
/*Show Author Posts
*-----------------------------------------*/
$wp_customize->add_setting(
    'blogcorner_options[show_author_posts]',
    array(
        'default'           => $default_options['show_author_posts'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[show_author_posts]',
    array(
        'label'    => __( 'Show Author Posts', 'blogcorner' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

/*Author Posts Text.*/
$wp_customize->add_setting(
    'blogcorner_options[author_posts_text]',
    array(
        'default'           => $default_options['author_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogcorner_options[author_posts_text]',
    array(
        'label'    => __( 'Author Posts Text', 'blogcorner' ),
        'section'  => 'single_options',
        'type'     => 'text',
        'active_callback' => 'blogcorner_is_author_posts_enabled',
    )
);

/*Author Posts Orderby*/
$wp_customize->add_setting(
    'blogcorner_options[author_posts_orderby]',
    array(
        'default'           => $default_options['author_posts_orderby'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[author_posts_orderby]',
    array(
        'label'       => __( 'Orderby', 'blogcorner' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'date' => __('Date', 'blogcorner'),
            'id' => __('ID', 'blogcorner'),
            'title' => __('Title', 'blogcorner'),
            'rand' => __('Random', 'blogcorner'),
        ),
        'active_callback' => 'blogcorner_is_author_posts_enabled',
    )
);

/*Author Posts Order*/
$wp_customize->add_setting(
    'blogcorner_options[author_posts_order]',
    array(
        'default'           => $default_options['author_posts_order'],
        'sanitize_callback' => 'blogcorner_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogcorner_options[author_posts_order]',
    array(
        'label'       => __( 'Order', 'blogcorner' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'asc' => __('ASC', 'blogcorner'),
            'desc' => __('DESC', 'blogcorner'),
        ),
        'active_callback' => 'blogcorner_is_author_posts_enabled',
    )
);