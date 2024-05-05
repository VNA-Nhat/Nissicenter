<?php
/**
 * Template part for displaying post archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogcorner
 */
$enabled_post_meta = blogcorner_get_option('archive_post_meta_1');
$enable_social_share = blogcorner_get_option('enable_social_share');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-default'); ?>>


    <?php if (has_post_thumbnail() && !post_password_required()) : ?>
        <div class="theme-entry-image image-hover image-radius">
            <figure class="featured-media featured-media-big">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
            </figure><!-- .featured-media -->
        </div><!-- .theme-entry-image -->
    <?php endif; ?>

    <div class="theme-entry-details">
        <header class="entry-header">
            <?php if (in_array('category', $enabled_post_meta) && has_category()) : ?>
                <div class="entry-categories">
                    <?php the_category(' '); ?>
                </div><!-- .entry-categories -->
            <?php endif; ?>

            <?php the_title('<h3 class="entry-title entry-title-medium"><a href="' . esc_url(get_permalink()) . '">', '</a></h3>'); ?>

            <?php if ('post' === get_post_type()) : ?>
                <div class="entry-meta">
                    <?php if (in_array('author', $enabled_post_meta)) : ?>
                        <?php blogcorner_posted_by()?>
                    <?php endif; ?>

                    <?php if (in_array('date', $enabled_post_meta)) : ?>
                        <?php blogcorner_posted_date_only()?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        </header><!-- .entry-header -->

    </div>

</article><!-- #post-<?php the_ID(); ?> -->