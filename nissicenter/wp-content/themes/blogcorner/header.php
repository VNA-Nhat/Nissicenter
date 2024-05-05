<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogcorner
 */

?>
<!doctype html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'blogcorner_before_site' ); ?>

<div id="page" class="site">

    <?php get_template_part( 'template-parts/header/loader' ); ?>

    <?php get_template_part( 'template-parts/header/progressbar' ); ?>

    <a class="skip-link screen-reader-text" href="#theme-main-area"><?php esc_html_e('Skip to content', 'blogcorner'); ?></a>

    <div class="site-content-area">

    <?php do_action( 'blogcorner_before_header' ); ?>

    <?php get_template_part('template-parts/header/theme-header'); ?>

    <div id="theme-main-area" class="main-page-wrapper">
    <?php do_action( 'blogcorner_before_content' ); ?>

    <?php $is_banner_section = blogcorner_get_option('enable_banner_section');
    if (is_home() && !is_paged()) {
        if ($is_banner_section) {
            get_template_part('template-parts/front-page/banner-section');
        }
        get_template_part('template-parts/front-page/categories-section');
    }