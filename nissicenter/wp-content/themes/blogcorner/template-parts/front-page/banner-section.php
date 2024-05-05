<?php
/**
 * Displays Banner Section
 *
 * @package Blogcorner
 */
$enable_social_share = blogcorner_get_option('enable_social_share');
$is_banner_section = blogcorner_get_option('enable_banner_section');
$enable_banner_overlay = blogcorner_get_option('enable_banner_overlay');
$site_fallback_image = blogcorner_get_option('site_fallback_image');
$banner_section_cat = blogcorner_get_option('banner_section_cat');
$number_of_slider_post = blogcorner_get_option('number_of_slider_post');
$enable_banner_tag_meta = blogcorner_get_option('enable_banner_tag_meta');
$enable_banner_cat_meta = blogcorner_get_option('enable_banner_cat_meta');
$enable_banner_author_meta = blogcorner_get_option('enable_banner_author_meta');
$enable_banner_date_meta = blogcorner_get_option('enable_banner_date_meta');
$enable_banner_post_description = blogcorner_get_option('enable_banner_post_description');
$banner_overlay_class = '';
if ($enable_banner_overlay) {
    $banner_overlay_class = 'swiper-slide-has-overlay';
}
if ($is_banner_section) {
?>
<section class="site-section site-banner-section">
  <div class="wrapper">
    <div class="site-slider-wrapper">
        <?php
        $slider_pagenav = '';
        $banner_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_slider_post), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($banner_section_cat)));
        if ($banner_post_query->have_posts()): ?>
            <div class="site-banner-hero swiper">
                <div class="swiper-wrapper">
                    <?php while ($banner_post_query->have_posts()): $banner_post_query->the_post(); ?>
                        <div class="swiper-slide swiper-hero-slide <?php echo $banner_overlay_class; ?>">
                          <article class="theme-news-article site-banner-article">
                            <div class="theme-entry-image image-hover image-overlay image-radius">
                              <?php if (has_post_thumbnail()) : ?>
                                  <?php
                                  the_post_thumbnail('large', array(
                                      'alt' => the_title_attribute(array(
                                          'echo' => false,
                                      )),
                                  ));
                                  ?>
                              <?php else : ?>
                                  <img src="<?php echo esc_url($site_fallback_image); ?>"
                                      alt="<?php echo esc_attr(get_the_title()); ?>">
                              <?php endif; ?>
                            </div>

                            <div class="site-banner-description">
                                <div class="entry-meta mb-15">
                                    <?php if ($enable_banner_cat_meta) { ?>
                                        <span class="entry-categories">
                                            <?php the_category(' '); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                                <?php the_title('<h3 class="entry-title entry-title-large line-clamp line-clamp-3"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                <?php
                                if ($enable_banner_post_description && has_excerpt()): ?>
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php elseif ($enable_banner_post_description): ?>
                                    <div class="entry-content mb-20">
                                      <p>
                                        <?php echo esc_html(wp_trim_words(get_the_content(), 20, '...')); ?>
                                      </p>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-meta">
                                    <?php if ($enable_banner_date_meta) {
                                        blogcorner_posted_on();
                                    } ?>
                                    <?php if ($enable_banner_author_meta) {
                                        blogcorner_posted_by();
                                    } ?>
                                </div>
                            </div>
                          </article>
                        </div>
                        <?php
                        $slider_pagenav .= '<div class="swiper-slide swiper-pagination-slide">';
                        $slider_pagenav .= '<figure class="featured-media featured-media-thumbnail">';
                        if (has_post_thumbnail()) {
                            $slider_pagenav .= '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium_large') . '">';
                        } else {
                            $slider_pagenav .= '<img src="' . esc_url($site_fallback_image) . '">';
                        }
                        $slider_pagenav .= '</figure>';
                        $slider_pagenav .= '</div>';
                        ?>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        <?php endif; ?>

    </div>
  </div>
</section>
<?php }