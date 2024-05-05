<?php
/**
 * Blogcorner functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blogcorner
 */
if (!defined('BLOGCORNER_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('BLOGCORNER_S_VERSION', '1.0.0');
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogcorner_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Blogcorner, use a find and replace
        * to change 'blogcorner' to the name of your theme in all the template files.
        */
    load_theme_textdomain('blogcorner', get_template_directory() . '/languages');
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');
    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');
    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'blogcorner'),
            'social-menu' => esc_html__('Social Menu', 'blogcorner'),
            'footer-menu' => esc_html__('Footer Menu', 'blogcorner'),
        )
    );
    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'blogcorner_custom_background_args',
            array(
                'default-color' => 'fff',
                'default-image' => '',
            )
        )
    );
    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');
    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
}

add_action('after_setup_theme', 'blogcorner_setup');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogcorner_content_width()
{
    $GLOBALS['content_width'] = apply_filters('blogcorner_content_width', 640);
}

add_action('after_setup_theme', 'blogcorner_content_width', 0);
/**
 * Enqueue scripts and styles.
 */
function blogcorner_scripts()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $fonts_url = blogcorner_fonts_url();
    if ($fonts_url) {
        require_once get_theme_file_path('inc/webfont/class-theme-webfont-loader.php');
        wp_enqueue_style(
            'blogcorner-google-fonts',
            wptt_get_webfont_url($fonts_url),
            array(),
            BLOGCORNER_S_VERSION
        );
    }
    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/css/swiper-bundle' . $min . '.css', array(), BLOGCORNER_S_VERSION);
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/js/swiper-bundle' . $min . '.js', array(), BLOGCORNER_S_VERSION, true);
    wp_enqueue_style('blogcorner-style', get_stylesheet_uri(), array(), BLOGCORNER_S_VERSION);
    wp_style_add_data('blogcorner-style', 'rtl', 'replace');
    wp_add_inline_style('blogcorner-style', blogcorner_get_inline_css());
    wp_enqueue_script('blogcorner-script', get_template_directory_uri() . '/assets/js/script.js', array(), BLOGCORNER_S_VERSION, true);
    // Ajax Load Posts Scripts
    $pagination_type = blogcorner_get_option('pagination_type');
    if ('ajax_load_on_click' == $pagination_type || 'ajax_load_on_scroll' == $pagination_type):
        wp_enqueue_script('blogcorner-load-posts', get_template_directory_uri() . '/assets/js/pagination.js', array(), BLOGCORNER_S_VERSION, true);
        // Localized variables
        global $wp_query;
        wp_localize_script('blogcorner-load-posts', 'BlogcornerVars', array(
            'nonce' => wp_create_nonce('blogcorner-load-posts-nonce'),
            'ajaxurl' => admin_url('admin-ajax.php'),
            'query_vars' => json_encode($wp_query->query_vars)
        ));
    endif;
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'blogcorner_scripts');
/**
 * Admin enqueue script
 */
function blogcorner_admin_scripts($hook)
{
    $current_screen = get_current_screen();
    if ($current_screen->id === "post" || $current_screen->id === "page") {
        wp_enqueue_style('blogcorner-metabox', get_template_directory_uri() . '/inc/meta/css/metabox.css');
        wp_style_add_data('blogcorner-metabox', 'rtl', 'replace');
        wp_enqueue_script('blogcorner-metabox-js', get_template_directory_uri() . '/inc/meta/js/metabox.js', array('jquery'), '', 1);
    }
}

add_action('admin_enqueue_scripts', 'blogcorner_admin_scripts');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom functions for this theme.
 */
require get_template_directory() . '/inc/custom-functions.php';
/**
 * Custom Widgets and sidebars for this theme.
 */
require get_template_directory() . '/inc/widgets/init.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}
/**
 */
require get_template_directory() . '/classes/body-class.php';
/**
 * Load SVG Icons
 */
require get_template_directory() . '/classes/class-svg-icons.php';
/**
 * Admin
 */
require get_template_directory() . '/inc/admin.php';
/**
 * Load dynamic styles
 */
include(get_template_directory() . '/inc/dynamic-styles.php');
include(get_template_directory() . '/inc/pagination.php');
include(get_template_directory() . '/inc/meta/post-meta.php');
include(get_template_directory() . '/inc/meta/term-meta.php');

add_filter('themeinwp_enable_demo_import_compatiblity', 'blogcorner_demo_import_filter_apply');
if (!function_exists('blogcorner_demo_import_filter_apply')):
    function blogcorner_demo_import_filter_apply()
    {
        return true;
    }
endif;
