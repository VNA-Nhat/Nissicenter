<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogcorner
 */
get_header();
// Add a main container in case if sidebar is present
global $post;
$blogcorner_page_layout = esc_html(get_post_meta($post->ID, 'blogcorner_page_layout', true));
$site_fallback_image = blogcorner_get_option('site_fallback_image');


if ($blogcorner_page_layout == "layout-2") { ?>
    <div class="single-featured-banner">
        <div class="featured-banner-media">
            <div class="theme-entry-image">
                <figure class="featured-media featured-media-large">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php
                        the_post_thumbnail('full', [
                            'alt' => get_the_title(),
                            'class' => 'featured-banner-image',
                        ]);
                        ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url($site_fallback_image); ?>" class="featured-banner-image" alt="<?php echo esc_attr(get_the_title()); ?>">
                    <?php endif; ?>
                </figure>
            </div>
        </div>

        <div class="featured-banner-content">
            <div class="wrapper">
                <?php the_title('<h1 class="entry-title entry-title-large">', '</h1>'); ?>
            </div>
        </div>
    </div>
<?php } ?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'page');
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile; // End of the loop.
                ?>
            </div><!-- #primary -->
        </div>
    </main>
<?php
get_footer();