<?php
/**
 * Template part for displaying post archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogcorner
 */
$enabled_post_meta = blogcorner_get_option('archive_post_meta_1');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-default'); ?>>


        <?php $enabled_post_meta = blogcorner_get_option('archive_post_meta_1'); ?>
        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <div class="theme-entry-image image-hover image-radius">
                <figure class="featured-media featured-media-big">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>

                    <?php
                    $caption = get_the_post_thumbnail_caption();
                    if ( $caption ) {
                        ?>
                        <figcaption class="wp-caption-text"><?php echo wp_kses_post( $caption ); ?></figcaption>
                        <?php
                    }
                    ?>
                </figure><!-- .featured-media -->

            </div><!-- .theme-entry-image -->
        <?php endif; ?>

        <header class="entry-header">
            <?php if ( in_array('category', $enabled_post_meta) && has_category() ) :?>
                <div class="entry-categories">
                    <?php the_category( ' ' ); ?>
                </div><!-- .entry-categories -->
            <?php endif; ?>

            <?php the_title( '<h2 class="entry-title entry-title-big"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );?>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>

                <?php if ('post' === get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php if (in_array('date', $enabled_post_meta)) : ?>
                            <?php blogcorner_posted_date_only()?>
                        <?php endif; ?>
                        <?php if (in_array('author', $enabled_post_meta)) : ?>
                            <?php blogcorner_posted_by()?>
                        <?php endif; ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
        </header><!-- .entry-header -->
        

</article><!-- #post-<?php the_ID(); ?> -->