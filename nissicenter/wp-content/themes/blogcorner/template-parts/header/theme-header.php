<?php
/**
 * Displays the site header.
 *
 * @package Blogcorner
 */

$wrapper_classes = 'site-header theme-site-header';

$enable_header_bg_overlay = blogcorner_get_option('enable_header_bg_overlay');
$header_image_size = blogcorner_get_option('header_image_size');
?>

<?php
if ($enable_header_bg_overlay) {
    $wrapper_classes .= ' header-has-overlay';
}
$wrapper_classes .= ' header-has-height-' . $header_image_size;
if (!empty(get_header_image())) {
    $wrapper_classes .= ' data-bg';
}
?>
<header id="masthead" class="<?php echo esc_attr($wrapper_classes); ?> " <?php if (!empty(get_header_image())) { ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?> role="banner">
    <?php
    get_template_part('template-parts/header/styles/style-1');
    ?>
</header><!-- #masthead -->
