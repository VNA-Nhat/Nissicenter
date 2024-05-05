<?php
/**
 * Social Share Settings.
 *
 * @package Blogcorner
**/
// Layout Section.
$wp_customize->add_section( 'social_share',
	array(
	'title'      => esc_html__( 'Social Share Settings', 'blogcorner' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'blogcorner_option_panel',
	)
);

$wp_customize->add_setting(
    'blogcorner_options[enable_facebook]',
    array(
        'default'           => $default_options['enable_facebook'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_facebook]',
    array(
        'label'   => __( 'Enable Facebook', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_twitter]',
    array(
        'default'           => $default_options['enable_twitter'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_twitter]',
    array(
        'label'   => __( 'Enable Twitter', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_pinterest]',
    array(
        'default'           => $default_options['enable_pinterest'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_pinterest]',
    array(
        'label'   => __( 'Enable Pinterest', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_linkedin]',
    array(
        'default'           => $default_options['enable_linkedin'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_linkedin]',
    array(
        'label'   => __( 'Enable LinkedIn', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'blogcorner_options[enable_telegram]',
    array(
        'default'           => $default_options['enable_telegram'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_telegram]',
    array(
        'label'   => __( 'Enable Telegram', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_stumbleupon]',
    array(
        'default'           => $default_options['enable_stumbleupon'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_stumbleupon]',
    array(
        'label'   => __( 'Enable Stumbleupon', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'blogcorner_options[enable_email]',
    array(
        'default'           => $default_options['enable_email'],
        'sanitize_callback' => 'blogcorner_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'blogcorner_options[enable_email]',
    array(
        'label'   => __( 'Enable Email', 'blogcorner' ),
        'section' => 'social_share',
        'type'    => 'checkbox',
    )
);
