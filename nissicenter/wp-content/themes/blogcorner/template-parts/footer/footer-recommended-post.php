<?php
/**
 * Displays recommended post on footer.
 *
 * @package Blogcorner
 */
if ( class_exists( 'WooCommerce' ) ) {
    // Check if the current page is related to WooCommerce
    if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_product() ) {
        return;
    }
}
$enable_category_meta = blogcorner_get_option('enable_category_meta');
$enable_date_meta = blogcorner_get_option('enable_date_meta');
$enable_social_share = blogcorner_get_option('enable_social_share');
$enable_post_excerpt = blogcorner_get_option('enable_post_excerpt');
$enable_author_meta = blogcorner_get_option('enable_author_meta');
$select_number_of_post = blogcorner_get_option('select_number_of_post');
$select_number_of_col = blogcorner_get_option('select_number_of_col');
$footer_recommended_post_title = blogcorner_get_option('footer_recommended_post_title');
$select_cat_for_footer_recommended_post = blogcorner_get_option('select_cat_for_footer_recommended_post');
$select_font_size = blogcorner_get_option('select_font_size');
$select_image_size = blogcorner_get_option('select_image_size');
?>
<section class="site-section site-recommendation-section">
    <div class="wrapper">
        <header class="section-header site-section-header">
            <h2 class="site-section-title">
                <?php echo esc_html($footer_recommended_post_title); ?>
            </h2>
        </header>
    </div>
    <div class="wrapper">
        <div class="column-row">
            <?php
            $footer_recommended_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($select_number_of_post), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_cat_for_footer_recommended_post)));
            if ($footer_recommended_post_query->have_posts()):
                while ($footer_recommended_post_query->have_posts()): $footer_recommended_post_query->the_post();
                    ?>
                    <div class="column column-md-4 column-sm-6 column-xs-12 <?php echo esc_attr($select_number_of_col); ?>">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-recommended-post mb-15'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <div class="theme-entry-image image-hover image-radius">
                                    <figure class="featured-media <?php echo esc_attr($select_image_size); ?>">
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

                            <div class="theme-article-detail">
                              <?php if ($enable_category_meta) { ?>
                                  <div class="entry-categories mb-10">
                                      <?php the_category(' '); ?>
                                  </div>
                              <?php } ?>
                              <?php the_title('<h3 class="entry-title ' . $select_font_size . '  mb-10"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
  
                              <div class="entry-meta">
                                  <?php if ($enable_date_meta) {
                                      blogcorner_posted_date_only();
                                  } ?>
                                  <?php if ($enable_author_meta) {
                                      blogcorner_posted_by();
                                  } ?>
                              </div>
                            </div>
                        </article>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
        </div>
    </div>
</section>
<?php endif; ?>