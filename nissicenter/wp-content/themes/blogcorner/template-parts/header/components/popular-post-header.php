<?php
/**
* Displays Popular Post on header.
*
* @package Blogcorner
*/
$enable_category_meta_popular_video = blogcorner_get_option('enable_category_meta_popular_video');
$enable_date_meta_popular_video = blogcorner_get_option('enable_date_meta_popular_video');
$enable_social_share_popular_video = blogcorner_get_option('enable_social_share_popular_video');
$enable_author_meta_popular_video = blogcorner_get_option('enable_author_meta_popular_video');
$popular_video_title = blogcorner_get_option('popular_video_title');
$select_cat_for_popular_video = blogcorner_get_option('select_cat_for_popular_video');
?>
<div id="theme-popular-item">
    <span class="popular-item-toggle"><?php blogcorner_theme_svg('menu-three-dots'); ?></span>

    <div class="popular-item-panel">
        <?php if ($popular_video_title) { ?>
            <div class="wrapper">
                <header class="section-header site-section-header">
                    <h2 class="site-section-title">
                        <?php echo esc_html($popular_video_title); ?>
                    </h2>
                </header>
            </div>
        <?php } ?>


        <div class="wrapper">
            <div class="column-row">
                <?php
                $popular_video_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_cat_for_popular_video)));
                if ($popular_video_query->have_posts()):
                    while ($popular_video_query->have_posts()): $popular_video_query->the_post();
                        ?>
                        <div class="column column-sm-6 column-xs-12 mb-30 column-quarter">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-recommended-post'); ?>>

                                <?php if (has_post_thumbnail()): ?>
                                    <div class="theme-entry-image">
                                        <figure class="featured-media featured-media-small">
                                            <a href="<?php the_permalink() ?>">
                                                <?php
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => the_title_attribute(array(
                                                        'echo' => false,
                                                    )),
                                                ));
                                                ?>
                                            </a>
                                        </figure>
                                    </div>
                                <?php endif; ?>
                                

                                <?php if ($enable_category_meta_popular_video) { ?>
                                    <div class="entry-categories">
                                        <?php the_category(' '); ?>
                                    </div>
                                <?php } ?>

                                <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                <div class="entry-meta">
                                    <?php if ($enable_date_meta_popular_video) {
                                        blogcorner_posted_date_only();
                                    } ?>
                                    <?php if ($enable_author_meta_popular_video) {
                                        blogcorner_posted_by();
                                    } ?>
                                </div>
                            </article>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                    ?>
            </div>
        </div>
    </div>
</div>
