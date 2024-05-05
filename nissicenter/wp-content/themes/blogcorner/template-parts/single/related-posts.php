<?php
global $post;
$post_id = $post->ID;

$related_posts_text = blogcorner_get_option('related_posts_text');
$order = esc_attr(blogcorner_get_option('related_posts_order'));
$orderby = esc_attr(blogcorner_get_option('related_posts_orderby'));

$single_post_meta = blogcorner_get_option('single_post_meta');

$no_of_related_posts = 3;
$page_layout = blogcorner_get_page_layout();
if('no-sidebar' == $page_layout ){
    $no_of_related_posts = 4;
}

// Covert id to ID to make it work with query
if( 'id' == $orderby ){
    $orderby = 'ID';
}

$category_ids = array();
$categories = get_the_category($post_id);

if(!empty($categories)) :
    foreach($categories as $cat):
        $category_ids[] = $cat->term_id;
    endforeach;
endif;

if( !empty($category_ids) ):

    $related_posts_args = array(
        'category__in' => $category_ids,
        'post_type' => 'post',
        'post__not_in' => array($post_id),
        'posts_per_page' => $no_of_related_posts,
        'ignore_sticky_posts' => 1,
        'orderby' => $orderby,
        'order' => $order,
    );

    $related_posts_query = new WP_Query($related_posts_args);

    if( $related_posts_query->have_posts() ):
        ?>
        <div class="single-related-posts-area theme-single-post-component">
            <header class="component-header single-component-header">
                <h2 class="single-component-title">
                    <?php echo esc_html($related_posts_text);?>
                </h2>
            </header>
            <div class="component-content single-component-content">
                <?php while($related_posts_query->have_posts()):$related_posts_query->the_post();?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-single-component-article'); ?>>
                        <?php if (has_post_thumbnail()): ?>
                            <div class="theme-entry-image image-hover">
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
                        <div class="theme-entry-details">
                            <h3 class="entry-title entry-title-small">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php if ('post' === get_post_type()) : ?>
                                <div class="entry-meta">
                                    <?php if (in_array('author', $single_post_meta)) : ?>
                                        <?php blogcorner_posted_by()?>
                                    <?php endif; ?>

                                    <?php if (in_array('date', $single_post_meta)) : ?>
                                        <?php blogcorner_posted_date_only()?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <?php

    endif;

endif;