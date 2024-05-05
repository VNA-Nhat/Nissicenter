<?php
/**
 * Template Name: Homepage Page Template
 * Template Post Type: post, page, product
 * Displays the Page Template provided via the theme.
 *
 * @package    Blogcorner
 * @since      Blogcorner 1.0.0
 */
get_header();

$is_banner_section = blogcorner_get_option('enable_banner_section');

if (is_active_sidebar('blogcorner-homepage-top-widget')) { ?>
    <section class="site-section site-widgetarea site-widgetarea-full widgetarea-before-customizer">
        <?php dynamic_sidebar('blogcorner-homepage-top-widget'); ?>
    </section>
    <?php
}

get_template_part('template-parts/front-page/banner-section');
get_template_part('template-parts/front-page/categories-section');
get_template_part('template-parts/front-page/newsletter');

get_template_part('template-parts/front-page/featured-post');

if (is_active_sidebar('blogcorner-homepage-bottom-widget')) { ?>
    <section class="site-section site-widgetarea site-widgetarea-full widgetarea-before-customizer">
        <?php dynamic_sidebar('blogcorner-homepage-bottom-widget'); ?>
    </section>
    <?php
}


get_footer();
