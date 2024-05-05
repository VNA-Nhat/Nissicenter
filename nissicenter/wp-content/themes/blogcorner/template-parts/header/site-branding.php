<?php
/**
 * Displays header site branding
 *
 * @package Blogcorner
 */

$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );

$hide_title = blogcorner_get_option('hide_title');
$hide_tagline = blogcorner_get_option('hide_tagline');

$header_class = $hide_title ? 'screen-reader-text' : 'site-title';
?>
<div class="site-branding">
    <?php if (has_custom_logo()) : ?>
        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div>
    <?php endif; ?>
    <?php if ((is_front_page() || is_home()) && $blog_info) : ?>
        <h1 class="<?php echo esc_attr($header_class); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a>
        </h1>
    <?php else : ?>
        <div class="<?php echo esc_attr($header_class); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        </div>
    <?php endif; ?>
    <?php if ($description && !$hide_tagline) : ?>
        <div class="site-description">
            <?php echo $description; ?>
        </div>
    <?php endif; ?>
</div><!-- .site-branding -->